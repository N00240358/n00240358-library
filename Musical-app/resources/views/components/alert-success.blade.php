@if(session('success'))
<div id="success-alert" class="mb-4 px-4 py-2 bg-green-100 border border-green-500 text-green-700 rounded-md">
    {{ session('success') }}
</div>

<script>
    setTimeout(function() {
        const alert = document.getElementById('success-alert');
        if(alert){
            alert.style.transition = 'opacity 1s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 1000); // remove after fade
        }
    }, 10000); // 10 seconds
</script>
@endif
