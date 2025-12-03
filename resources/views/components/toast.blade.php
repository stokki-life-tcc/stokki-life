@if(session('success'))
    <div id="flash-success" class="bg-stokki-green text-white px-4 py-2 rounded mb-4 transition-opacity duration-500">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(() => {
            const el = document.getElementById('flash-success');
            if (el) el.style.opacity = '0';
            setTimeout(() => el && el.remove(), 600);
        }, 5000);
    </script>
@endif

@if($errors->any())
    <div id="flash-error" class="bg-stokki-red text-white px-4 py-2 rounded mb-4 transition-opacity duration-500">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
    <script>
        setTimeout(() => {
            const el = document.getElementById('flash-error');
            if (el) el.style.opacity = '0';
            setTimeout(() => el && el.remove(), 600);
        }, 5000);
    </script>
@endif
