@if(session('success')) <!-- checks if there is a success message that was sent from an operation -->
<div id="success-alert" class="mb-4 px-4 py-2 bg-green-100 border border-green-500 text-green-700 rounded-md">
    {{ session('success') }} <!-- displays success message -->
</div>

<script>
    setTimeout(function() { // after 10 seconds, fade out and remove the alert
        const alert = document.getElementById('success-alert'); 
        if(alert){
            alert.style.transition = 'opacity 1s'; // fade over 1 second
            alert.style.opacity = '0'; // starts fading
            setTimeout(() => alert.remove(), 1000); // remove after fade is finished
        }
    }, 10000); // 10 seconds is how long it stays on the screen.
</script>
@endif
