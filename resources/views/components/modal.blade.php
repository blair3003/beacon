@if(session()->has('message'))



<dialog id="modal" class="backdrop:bg-gradient-to-tr backdrop:from-green-600 backdrop:to-blue-700 backdrop:opacity-50 rounded p-8">
    <p class="font-semibold text-xl mb-4">{{ session('message') }}</p>
    <form method="dialog" class="text-center">
        <button class="text-white bg-blue-900 hover:opacity-90 font-bold py-2 px-4 rounded focus-visible:outline-none">OK</button>
    </form>
</dialog>


<script>
    document.getElementById("modal").showModal()
</script>




@endif