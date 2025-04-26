<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Apprendre les chiffres') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row justify-content-center">
                        @foreach($chiffres as $chiffre)
                        <div class="inline-block w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 p-2">
                            <a href="{{ route('chiffres.show', $chiffre->id) }}" class="block no-underline">
                                <div class="bg-white rounded-lg shadow-md p-4 text-center transition transform hover:scale-110">
                                    <h1 class="text-5xl mb-0">{{ $chiffre->valeur }}</h1>
                                    <p class="mt-2">{{ $chiffre->nom }}</p>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center my-8">
    <a href="{{ route('chiffres.quiz') }}" class="bg-green-500 hover:bg-green-600 text-white py-3 px-6 rounded-xl shadow-lg inline-flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
        </svg>
        Faire le quiz des chiffres
    </a>
</div>
</x-app-layout>