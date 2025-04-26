<nav class="bg-gradient-to-r from-pink-200 to-blue-200 shadow-md py-4">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">

        <!-- Bienvenue -->
        <div class="flex items-center space-x-2">
            <span class="text-2xl">👋</span>
            <span class="text-xl font-bold text-pink-600">Bienvenue {{ Auth::user()->name }} !</span>
        </div>

        <!-- Déconnexion -->
        <div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-400 hover:bg-red-500 text-white font-bold py-2 px-4 rounded-full shadow-md transition duration-200">
                    🔒 Déconnexion
                </button>
            </form>
        </div>

    </div>
</nav>
