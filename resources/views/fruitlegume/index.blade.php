<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fruits & Légumes') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($fruitLegumes->isEmpty())
                <p class="text-center text-gray-500">Aucun fruit ou légume trouvé.</p>
            @else
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach ($fruitLegumes as $item)
                        @if ($item) <!-- Vérification si $item n'est pas null -->
                            <div class="bg-white overflow-hidden shadow-xl rounded-lg p-4">
                                <!-- Image du fruit/légume avec un clic qui appelle la fonction playAudio -->
                                <img src="{{ asset($item->image_path ?? 'images/default.png') }}" 
                                     alt="{{ $item->name ?? 'Nom inconnu' }}" 
                                     class="h-32 mx-auto mb-4 cursor-pointer"
                                     onclick="playAudio('{{ asset('sons/' . strtolower($item->name ?? 'nom_inconnu') . '.mp3') }}')">
                                <h3 class="text-center font-bold">{{ $item->name ?? 'Nom inconnu' }}</h3>
                                <p class="text-center text-sm text-gray-500">{{ ucfirst($item->type ?? 'Type inconnu') }}</p>
                                <!-- Bouton pour écouter le nom -->
                                <div class="text-center mt-2">
                                    <button 
                                        class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded"
                                        onclick="playAudio('{{ asset('sons/' . strtolower($item->name ?? 'nom_inconnu') . '.mp3') }}')">
                                        Écouter
                                    </button>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif

            <!-- Bouton pour rediriger vers la page des exercices -->
            <div class="text-center mt-8">
                <a href="{{ route('fruitlegume.exercice') }}" 
                   class="bg-green-500 hover:bg-green-700 text-white py-2 px-6 rounded-xl">
                   Aller aux exercices
                </a>
            </div>
        </div>
    </div>

    <!-- JavaScript pour jouer le son -->
    <script>
        function playAudio(audioUrl) {
            var audio = new Audio(audioUrl); // Crée un objet Audio avec l'URL du fichier audio
            audio.play(); // Joue le fichier audio
        }
    </script>
</x-app-layout>
