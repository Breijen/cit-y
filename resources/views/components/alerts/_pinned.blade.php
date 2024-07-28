<div id="pinnedAlert" class="fixed inset-x-0 bottom-16 sm:bottom-4 flex justify-center items-center hidden" style="z-index: 9999;">
    <div class="z-60 p-4 text-sm border border-icons text-white rounded-lg bg-background" role="alert">
        <span class="font-medium">Post pinned!</span>
    </div>
</div>

<script>
    function showPinnedAlert() {
        var alertDiv = document.getElementById('pinnedAlert');
        alertDiv.classList.remove('hidden');

        // Hide the alert after 2 seconds
        setTimeout(function() {
            alertDiv.classList.add('hidden');
        }, 2000);
    }
</script>
