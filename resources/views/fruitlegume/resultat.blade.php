<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Résultat Fruits & Légumes') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-6">
                <h3 class="text-xl font-bold">Votre score : {{ $score }}/{{ count($solutions) }}</h3>

                <ul class="mt-4">
                    @foreach ($solutions as $index => $solution)
                        <li class="mb-2">
                            @if (strtolower(trim($reponses[$index] ?? '')) == strtolower($solution))
                                <span class="text-green-600">✔️ Correct : {{ $solution }}</span>
                            @else
                                <span class="text-red-600">❌ Incorrect : {{ $solution }} (Votre réponse : {{ $reponses[$index] ?? 'Aucune réponse' }})</span>
                            @endif
                        </li>
                    @endforeach
                </ul>

                <div class="mt-8 text-center">
                    <a href="{{ route('fruitlegume.exercice') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded">
                        Rejouer
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
