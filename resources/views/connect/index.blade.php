<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $pageName = 'Explore';
    @endphp

    <title>Cit-Y</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-background">

    <div class="flex">
        @include("components._sidebar")
        @include("components.alerts._shared")

        @include("connect._payment_form")

        <main>
            <div class="fixed flex justify-center items-center h-20 bottom-0 w-full bg-background text-white z-50">
                @if($existingInventory === null)
                    <button id="create-inventory-button" class="bg-content_bg p-2 border border-divider">
                        CREATE INVENTORY
                    </button>
                @endif
                <button id="button-selector" class="bg-content_bg p-2 border border-divider">
                    SELECTOR
                </button>
                <button id="button-placer" class="bg-content_bg p-2 border border-divider">
                    PLACER
                </button>
            </div>
        </main>
    </div>

    @vite('resources/js/connect/main.js')
</body>
</html>

<script>
    if (document.getElementById('create-inventory-button') != null) {
        document.getElementById('create-inventory-button').addEventListener('click', function() {
            // Get the current user ID (replace this with your method of getting the user ID)
            const userId = 1;

            // Make an AJAX request to create an inventory
            fetch(`/users/${userId}/create-inventory`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({})
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(error => { throw new Error(error.message); });
                }
                return response.json();
            })
            .then(data => {
                alert(data.message);
            })
            .catch(error => {
                alert('Error: ' + error.message);
            });
        });
    }
</script>
