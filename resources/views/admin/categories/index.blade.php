<h1 class="text-xl font-bold mb-4">Liste des catégories</h1>

@foreach ($categories as $categorie)
    <div class="mb-2 p-2 border">{{ $categorie->nom }}</div>
@endforeach

<a href="{{ route('admin.categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter</a>
