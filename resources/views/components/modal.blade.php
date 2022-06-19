@if(session()->has('message'))

<dialog open>
    <p>{{ session('message') }}</p>
    <form method="dialog">
        <button>OK</button>
    </form>
</dialog>

@endif