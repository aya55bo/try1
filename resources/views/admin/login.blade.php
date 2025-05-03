{{-- resources/views/admin/login.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
{{-- resources/views/admin/login.blade.php --}}
<body class="bg-gray-100 h-screen flex items-center justify-center">

    <form method="POST" action="{{ route('admin.login') }}" class="bg-white p-6 rounded shadow-md w-96">
        @csrf
        <h1 class="text-xl font-bold mb-4">Connexion Admin</h1>

        @if ($errors->any())
            <div class="text-red-500 text-sm mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="mb-4">
            <label for="email" class="block">Email</label>
            <input type="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded">
        </div>

        <div class="mb-4">
            <label for="password" class="block">Mot de passe</label>
            <input type="password" name="password" required class="w-full px-3 py-2 border border-gray-300 rounded">
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            Connexion
        </button>
    </form>

    <p class="text-center mt-4 text-gray-500">
        {{ date('Y-m-d H:i:s') }} <!-- Affiche l'heure pour vérifier si la page est bien générée -->
    </p>
</body>

</html>
