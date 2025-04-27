@php
    $theme = session('theme', 'default');

    $background = match ($theme) {
        'fille' => "url('/images/backgroundfille.png')",
        'garcon' => "url('/images/backgroundgarcon.png')",
        default => 'linear-gradient(to bottom right, #bfdbfe, #fbcfe8)', // dégradé default
    };
@endphp

<x-app-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-cover bg-center relative" style="background-image: {{ $background }};">
        <h1 class="text-4xl font-bold text-gray-800 mb-6">Bienvenue {{ Auth::user()->name }} !</h1>
        <p class="text-lg text-gray-700 mb-4">Tu es maintenant connecté(e). Choisis une catégorie pour commencer à apprendre ✨</p>

        <div class="grid grid-cols-2 gap-6 mt-8">
            <a href="{{ route('animals') }}" class="bg-yellow-400 hover:bg-yellow-500 text-white py-3 px-6 rounded-xl shadow-lg">Les animaux 🐶</a>
            <a href="{{ route('alphabet') }}" class="bg-green-400 hover:bg-green-500 text-white py-3 px-6 rounded-xl shadow-lg">L'alphabet 🔤</a>

            <a href="{{ route('chiffres.index') }}" class="bg-purple-400 hover:bg-purple-500 text-white py-3 px-6 rounded-xl shadow-lg">Les chiffres 🔢</a>
            <a href="#" class="bg-red-400 hover:bg-red-500 text-white py-3 px-6 rounded-xl shadow-lg">Les couleurs 🌈</a>

            <a href="#" class="bg-purple-400 hover:bg-purple-500 text-white py-3 px-6 rounded-xl shadow-lg">Les chiffres 🔢</a>
            <a href="{{ route('couleurs') }}" class="bg-red-400 hover:bg-red-500 text-white py-3 px-6 rounded-xl shadow-lg">Les couleurs 🌈</a>

            <a href="#" class="bg-pink-400 hover:bg-pink-500 text-white py-3 px-6 rounded-xl shadow-lg">Fruits & Légumes 🍎🥦</a>
            <a href="{{ route('transports') }}" class="bg-blue-400 hover:bg-blue-500 text-white py-3 px-6 rounded-xl shadow-lg">Transports 🚗✈️</a>
            <a href="{{ route('dessin.index') }}"
 class="bg-blue-400 hover:bg-blue-500 text-white py-3 px-6 rounded-xl shadow-lg">🖌️ Atelier de Dessin 🎨</a>

            <a href="{{ route('corps') }}" class="bg-pink-300 hover:bg-pink-400 text-white font-bold py-4 px-6 rounded-2xl shadow-xl text-center transition-all duration-200">
    🧍‍♂️ Les Parties du Corps
</a>
<a href="{{ route('formes') }}" class="bg-blue-300 hover:bg-blue-400 text-white font-bold py-6 px-4 rounded-2xl shadow-xl transition-all">
                🔷 Les Formes
            </a>

        </div>

        <!-- ✅ Bouton pour changer de thème -->
        <form action="{{ route('theme.toggle') }}" method="POST" class="absolute bottom-6 right-6">
            @csrf
            <button type="submit" class="bg-white text-gray-700 hover:bg-gray-100 px-4 py-2 rounded-full shadow-lg border border-gray-300 text-sm">
                🎨 Changer de thème
            </button>
        </form>
    </div>
</x-app-layout>