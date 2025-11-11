@props(['name']) <!-- gets name property to call from the database -->

<div class="border rounded-lg shadow-md p-6 bg-[#2b1b1b] hover:shadow-lg transition duration-300 border-yellow-600/40"> 
    <h4 class="font-bold text-lg mb-4 text-[#f2c94c]">{{ $name }}</h4> <!-- displays name -->
</div>
