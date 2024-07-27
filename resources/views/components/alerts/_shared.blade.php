<div id="copiedAlert" class="fixed inset-x-0 bottom-4 flex justify-center items-center hidden">
    <div class="z-60 p-4 text-sm border border-icons text-white rounded-lg bg-background" role="alert">
        <span class="font-medium">Link copied!</span>
    </div>
</div>

<script>
    function showCopiedAlert(username, uuid) {
        var link = `https://cit-y.com/${username}/${uuid}`;

        // Copy the link to the clipboard
        navigator.clipboard.writeText(link).then(function() {
            // Show the alert
            var alertDiv = document.getElementById('copiedAlert');
            alertDiv.classList.remove('hidden');
                
            // Hide the alert after 2 seconds
            setTimeout(function() {
                alertDiv.classList.add('hidden');
            }, 2000);
        }).catch(function(error) {
            console.error('Error copying text: ', error);
        });
    }
</script>
