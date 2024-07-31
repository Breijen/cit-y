<div class="fixed text-placeholder left-1/4 bottom-32 z-50 bg-content_bg rounded-2xl shadow-2xl pl-2">
    <div class="overflow-y-auto	max-h-80 bg-content_bg items-center justify-center rounded-md h-80 w-[26rem] pr-2" id="inventory">
        <!-- Items will be dynamically added here -->
    </div>
    <div class="pt-2 pb-2">
        <h2>Predefined Items:</h2>
        <ul id="predefined-item-list"></ul>
    </div>
</div>

<script type="module"> 
    const userId = {{ auth()->user()->id }};
    let inventoryId = null;
    let hasInventory = false;
    let currentTool = 'select';
    let currentItem = null;

    // Fetch inventory status
    fetch(`/user/${userId}/inventory`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.exists) {
            inventoryId = data.inventoryId;
            hasInventory = true;
            loadInventoryItems(userId);
        } else {
            hasInventory = false;
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });

    // Fetch predefined items
    fetch('connect/items/predefined')
        .then(response => response.json())
        .then(predefinedItems => {
            const predefinedItemList = document.getElementById('predefined-item-list');
            predefinedItems.forEach(item => {
                const listItem = document.createElement('li');
                listItem.textContent = `${item.item_name} - ${item.price}`;
                const buyButton = document.createElement('button');
                buyButton.textContent = 'Buy';
                buyButton.addEventListener('click', () => buyItem(item.id));
                listItem.appendChild(buyButton);
                predefinedItemList.appendChild(listItem);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });

    function buyItem(itemId) {
        if (hasInventory === false) {
            alert('You need to create an inventory first.');
            return;
        }

        fetch(`/inventories/${inventoryId}/items/buy`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ item_id: itemId })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(error => { throw new Error(error.message); });
            }
            return response.json();
        })
        .then(data => {
            loadInventoryItems(userId);
        })
        .catch(error => {
            alert('Error: ' + error.message);
        });
    }

    function loadInventoryItems(userId) {
        fetch(`/user/${userId}/inventory/items`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(items => {
            const inventoryContainer = document.getElementById('inventory');
            inventoryContainer.innerHTML = ''; // Clear the container

            items.forEach(item => {
                const itemDiv = createInventoryItem(item);
                inventoryContainer.appendChild(itemDiv);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function createInventoryItem(item) {
        const itemDiv = document.createElement('div');
        itemDiv.className = 'pt-3 flex flex-col space-y-2 items-center';

        const itemBox = document.createElement('div');
        itemBox.className = 'h-20 w-20 bg-white rounded-md border border-divider';
        itemBox.textContent = item.item_name;

        const spawnButton = document.createElement('button');
        spawnButton.textContent = 'Spawn';
        spawnButton.addEventListener('click', () => {
            currentTool = 'place';
            currentItem = item.item_name.toLowerCase();
            console.log('Current tool:', currentTool);
            console.log('Current item:', currentItem);
        });

        itemDiv.appendChild(itemBox);
        itemDiv.appendChild(spawnButton);

        return itemDiv;
    }


</script>
