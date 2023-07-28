<nav class="bg-blue-500 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="text-white text-2xl font-bold">Monolith</a>

        <!-- Links -->
        <div id="navbarLinks" class="hidden md:flex space-x-4">
            <a href="{{ url('/') }}" class="text-white">Home</a>
            <a href="{{ url('/login') }}" class="text-white">Login</a>
            <a href="{{ url('/register') }}" class="text-white">Register</a>
            <a href="{{ url('/katalog-barang') }}" class="text-white">Katalog</a>
            <a href="{{ url('/riwayat-pembelian') }}" class="text-white">Riwayat</a>
        </div>

        <!-- Mobile Menu (Hamburger Icon) -->
        <div class="md:hidden">
            <button id="hamburgerButton" class="text-white text-2xl">
                &#9776;
            </button>
        </div>
    </div>
    <!-- Mobile Links - Initially Hidden -->
    <div id="mobileNavLinks" class="hidden md:hidden">
        <a href="{{ url('/') }}" class="block text-white p-2">Home</a>
        <a href="{{ url('/login') }}" class="block text-white p-2">Login</a>
        <a href="{{ url('/register') }}" class="block text-white p-2">Register</a>
        <a href="{{ url('/katalog-barang') }}" class="block text-white p-2">Katalog</a>
        <a href="{{ url('/riwayat-pembelian') }}" class="block text-white p-2">Riwayat</a>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mobileNavLinks = document.getElementById('mobileNavLinks');
        const hamburgerButton = document.getElementById('hamburgerButton');

        hamburgerButton.addEventListener('click', function () {
            mobileNavLinks.classList.toggle('hidden');
        });
    });
</script>
