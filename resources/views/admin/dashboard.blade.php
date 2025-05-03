{{-- resources/views/admin/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen flex">

    <!-- Sidebar -->
    <div class="w-64 bg-indigo-800 text-white p-6">
        <h2 class="text-2xl font-bold mb-6">Admin Dashboard</h2>
        <ul>
            <li class="mb-4">
                <a href="{{ route('admin.dashboard') }}" class="hover:bg-indigo-700 p-2 rounded block">Tableau de bord</a>
            </li>
            <li class="mb-4">
                <a href="{{ route('admin.categories.index') }}" class="hover:bg-indigo-700 p-2 rounded block">Gérer les catégories</a>
            </li>
            <!-- Ajoute d'autres liens selon les fonctionnalités -->
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-3xl font-semibold text-gray-800">Bienvenue dans l'administration</h1>
            <p class="text-gray-600 mt-2">Ici, vous pouvez gérer les catégories, les éléments, et d'autres ressources.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                <!-- Card 1: Gérer les catégories -->
                <div class="bg-indigo-600 text-white p-6 rounded-lg shadow-lg hover:bg-indigo-700 transition-all duration-300">
                    <h3 class="text-xl font-semibold">Gérer les catégories</h3>
                    <p class="mt-2">Ajoutez, modifiez ou supprimez des catégories pour organiser vos contenus.</p>
                    <a href="{{ route('admin.categories.index') }}" class="block mt-4 text-indigo-200 hover:text-white">Accéder</a>
                </div>

                <!-- Card 2: Gérer les éléments -->
                <div class="bg-green-600 text-white p-6 rounded-lg shadow-lg hover:bg-green-700 transition-all duration-300">
                    <h3 class="text-xl font-semibold">Gérer les éléments</h3>
                    <p class="mt-2">Ajoutez, modifiez ou supprimez des éléments de contenu sur votre plateforme.</p>
                    <a href="#" class="block mt-4 text-green-200 hover:text-white">Accéder</a>
                </div>

                <!-- Card 3: Statistiques ou autre fonction -->
                <div class="bg-yellow-600 text-white p-6 rounded-lg shadow-lg hover:bg-yellow-700 transition-all duration-300">
                    <h3 class="text-xl font-semibold">Voir les statistiques</h3>
                    <p class="mt-2">Suivez les performances de vos contenus et gérez les rapports.</p>
                    <a href="#" class="block mt-4 text-yellow-200 hover:text-white">Accéder</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
