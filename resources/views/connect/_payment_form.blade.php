<div class="text-placeholder p-6 fixed top-8 right-8 z-50 w-80">
    <div class="mb-4 flex justify-between items-center bg-content_bg border border-divider rounded-md pl-2">
        <span id="current-tokens" class="block text-sm text-white font-medium">Huidige tokens: 0</span>
        <button id="show-payment-form" class="bg-icons hover:bg-icons-light text-white font-bold py-2 px-2 rounded focus:outline-none focus:shadow-outline flex items-center justify-center">
            <svg
              width="16"
              height="16"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M12 4C11.4477 4 11 4.44772 11 5V11H5C4.44772 11 4 11.4477 4 12C4 12.5523 4.44772 13 5 13H11V19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19V13H19C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11H13V5C13 4.44772 12.5523 4 12 4Z"
                fill="currentColor"
              />
            </svg>
        </button>
    </div>
</div>

<form id="payment-form" class="hidden bg-content_bg border border-divider text-placeholder p-6 rounded-lg shadow-lg fixed top-14 right-14 z-50 w-80">
    <div class="mb-4">
        <label for="amount" class="block text-sm font-medium">Add C-Units</label>
        <select id="amount" name="amount" class="mt-1 block w-full p-2 bg-content_bg border border-divider rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            <option value="100">100 C-Units - $1</option>
            <option value="500">500 C-Units - $5</option>
            <option value="1000">1000 C-Units - $10</option>
            <option value="5000">5000 C-Units - $50</option>
        </select>
    </div>
    <div id="ideal-element" class="p-2 bg-white border border-divider rounded-md shadow-sm mb-4"><!-- Stripe.js injects the Card Element --></div>
    <button type="submit" class="w-full bg-background hover:bg-icons border border-divider text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        Pay
    </button>
    <div id="card-errors" role="alert" class="mt-2 text-red-500 text-sm"></div>
</form>

<script src="https://js.stripe.com/v3/"></script>

<script>
    // Create a Stripe client
    var stripe = Stripe('pk_test_51PiBfS2MatHYzsWN78vHtLwrq6yMz0SedMBYwa8yuaXz8Ht4kY3Jvl7BMp8y7wildrIcwiY0MsfxxScHmjmMg75x00dNrHHett');

    const appearance = {
        theme: 'flat',
        variables: {
            colorPrimaryText: '#272222',
        },
    };

    // Create an instance of Elements
    var elements = stripe.elements({ appearance });

    const options = {
        style: {
            base: {
                color: '#272222',
                fontFamily: 'Roboto, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#272222'
                }
            },
            invalid: {
                color: '#f3f3f3',
                iconColor: '#f3f3f3'
            }
        },
    };

    // Create an instance of the card Element
    const idealBank = elements.create('idealBank', options);

    // Add an instance of the card Element into the `card-element` <div>
    idealBank.mount('#ideal-element');

    // Handle real-time validation errors from the card Element
    idealBank.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        fetch('/create-payment-intent', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                amount: document.getElementById('amount').value
            })
        }).then(function(response) {
            if (!response.ok) {
                return response.text().then(text => { throw new Error(text) });
            }
            return response.json();
        }).then(function(paymentIntent) {
            // Open a new tab
            const newTab = window.open('', '_blank');

            stripe.confirmIdealPayment(paymentIntent.clientSecret, {
                payment_method: {
                    ideal: idealBank,
                },
                return_url: 'https://your-website.com/ideal-return', // Replace with your actual return URL
            }).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('payment-message');
                    errorElement.textContent = result.error.message;
                    // Close the new tab if there's an error
                    newTab.close();
                } else {
                    if (result.paymentIntent.status === 'succeeded') {
                        alert('Payment successful!');
                    } else {
                        // Redirect to the Stripe-hosted page in the new tab
                        newTab.location.href = result.next_action.use_stripe_sdk.stripe_js;
                    }
                }
            });
        }).catch(function(error) {
            var errorElement = document.getElementById('payment-message');
            errorElement.textContent = error.message;
        });
    });

    // Show the payment form when the button is clicked
    document.getElementById('show-payment-form').addEventListener('click', function() {
        document.getElementById('payment-form').classList.remove('hidden');
    });

    var currentBalanceToInt = parseInt('{{ auth()->user()->currency_balance }}')

    // Update current tokens display (for demonstration purposes, this should be fetched from the server)
    document.getElementById('current-tokens').textContent = currentBalanceToInt + ' C-Units'; // Example token amount
</script>
