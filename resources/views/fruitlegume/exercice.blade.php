<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Exercice Fruits & Légumes') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('fruitlegume.resultat') }}" method="POST">
                @csrf

                @foreach ($questions as $index => $question)
                    <div class="mb-6">
                        <img src="{{ asset($question->image_path) }}" alt="Image" class="h-32 mx-auto mb-4">

                        <p class="text-lg mb-2">Quel est le nom de ce fruit ou légume ?</p>

                        <div class="space-y-4">
                            @php
                                $options = [$question->name];
                                while (count($options) < 4) {
                                    $option = App\Models\FruitLegume::inRandomOrder()->first()->name;
                                    if (!in_array($option, $options)) {
                                        $options[] = $option;
                                    }
                                }
                                shuffle($options);
                            @endphp

                            @foreach ($options as $option)
                                <label class="block">
                                    <input 
                                        type="radio" 
                                        name="reponses[{{ $index }}]" 
                                        value="{{ $option }}" 
                                        class="mr-2">
                                    {{ $option }}
                                </label>
                            @endforeach
                        </div>

                        <input type="hidden" name="solutions[{{ $index }}]" value="{{ $question->name }}">
                    </div>
                @endforeach

                <div class="flex justify-center">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded">
                        Valider
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
