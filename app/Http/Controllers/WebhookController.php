<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Webhook;
use App\Models\User;
use Log;

class WebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $endpointSecret = env('STRIPE_WEBHOOK_SECRET');

        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        Log::info('Webhook received with payload: ' . $payload);
        Log::info('Webhook received with signature: ' . $sigHeader);
        Log::info('Webhook received with endpoint secret: ' . $endpointSecret);

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sigHeader,
                $endpointSecret
            );
        } catch (\UnexpectedValueException $e) {
            Log::error('Invalid payload: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::error('Invalid signature: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Log the event type
        Log::info('Received event type: ' . $event->type);

        try {
            // Handle the event
            switch ($event->type) {
                case 'payment_intent.succeeded':
                    $paymentIntent = $event->data->object; // contains a StripePaymentIntent
                    Log::info('Payment Intent Succeeded: ' . json_encode($paymentIntent));
                    $this->handlePaymentIntentSucceeded($paymentIntent);
                    break;
                case 'payment_intent.created':
                    $paymentIntent = $event->data->object;
                    Log::info('Payment Intent Created: ' . json_encode($paymentIntent));
                    break;
                case 'charge.updated':
                    $charge = $event->data->object;
                    Log::info('Charge Updated: ' . json_encode($charge));
                    break;
                case 'charge.succeeded':
                    $charge = $event->data->object;
                    Log::info('Charge Succeeded: ' . json_encode($charge));
                    break;
                default:
                    Log::info('Unhandled event type: ' . $event->type);
                    break;
            }
        } catch (\Exception $e) {
            Log::error('Error handling event: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return response()->json(['error' => 'Webhook handling error'], 500);
        }

        return response()->json(['status' => 'success']);
    }

    protected function handlePaymentIntentSucceeded($paymentIntent)
    {
        Log::info('handlePaymentIntentSucceeded triggered');
        Log::info('Payment Intent: ' . json_encode($paymentIntent));

        $userId = $paymentIntent->metadata->user_id ?? null;

        //* ALLEEN VOOR HET TESTEN *\\

        // $userId = 1;

        if (!$userId) {
            Log::error('User ID not found in metadata');
            return;
        }

        Log::info('User ID from metadata: ' . $userId);

        $amount = $paymentIntent->amount; // amount is in cents
        Log::info('Amount from Payment Intent: ' . $amount);

        $user = User::find($userId);

        if ($user) {
            // Add currency to user's account
            $tokens = $amount / 100; // Assuming 1 token = $1
            $user->currency_balance += $tokens;
            $user->save();

            Log::info('Updated user currency balance: ' . $user->currency_balance);
        } else {
            Log::error('User not found: ' . $userId);
        }
    }
}

