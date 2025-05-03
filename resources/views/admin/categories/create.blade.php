{{-- resources/views/admin/categories/create.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer une catégorie</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">

    <form method="POST" action="{{ route('admin.categories.store') }}" class="bg-white p-6 rounded shadow-md w-96">
        @csrf
        <h1 class="text-xl font-bold mb-4">Créer une catégorie</h1>

        <div class="mb-4">
            <label for="name" class="block">Nom de la catégorie</label>
            <input type="text" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded">
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            Créer
        </button>
    </form>

</body>
</html>
