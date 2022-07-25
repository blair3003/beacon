@if(session()->has('message'))



<dialog id="modal" class="">
    <p>{{ session('message') }}</p>
    <form method="dialog">
        <button>OK</button>
    </form>
</dialog>


<script>
    document.getElementById("modal").showModal()
</script>




@endif