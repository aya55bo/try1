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
</x-app-layout>