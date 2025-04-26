<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chiffre') }} {{ $chiffre->valeur }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col md:flex-row items-center">
                        <div class="w-full md:w-1/2 text-center">
                            <h1 class="text-8xl">{{ $chiffre->valeur }}</h1>
                            <h2 class="text-2xl mb-4">{{ $chiffre->nom }}</h2>
                            <p>{{ $chiffre->description }}</p>
                            
                            <button onclick="playSound()" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM14.657 2.929a1 1 0 011.414 0A9.972 9.972 0 0119 10a9.972 9.972 0 01-2.929 7.071 1 1 0 01-1.414-1.414A7.971 7.971 0 0017 10c0-2.21-.894-4.208-2.343-5.657a1 1 0 010-1.414zm-2.829 2.828a1 1 0 011.415 0A5.983 5.983 0 0115 10a5.984 5.984 0 01-1.757 4.243 1 1 0 01-1.415-1.415A3.984 3.984 0 0013 10a3.983 3.983 0 00-1.172-2.828 1 1 0 010-1.415z" clip-rule="evenodd" />
                                </svg>
                                Écouter
                            </button>
                        </div>
                        <div class="w-full md:w-1/2 mt-4 md:mt-0">
                            <img src="{{ asset($chiffre->image_path) }}" alt="Image du chiffre {{ $chiffre->valeur }}" class="mx-auto animate-bounce">
                        </div>
                    </div>
                    
                    <div class="mt-8 text-center">
                        <a href="{{ route('chiffres.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Retour aux chiffres
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <audio id="chiffreSound" src="{{ asset($chiffre->son_path) }}"></audio>

    <script>
        function playSound() {
            const audio = document.getElementById('chiffreSound');
            audio.play();
        }
    </script>

    <style>
        .animate-bounce {
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }
    </style>
</x-app-layout>