<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bienvenue sur notre site d'apprentissage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue&family=Fredoka:wght@600&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: linear-gradient(to bottom, #72c6f3, #d1f3ff);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            height: 100vh;
            font-family: 'Comic Neue', cursive;
        }

        h1 {
            font-family: 'Fredoka', cursive;
        }

        .btn {
            font-weight: bold;
            padding: 1rem 2.5rem;
            border-radius: 9999px;
            font-size: 1.25rem;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-blue {
            background-color: #3b82f6;
            color: white;
        }

        .btn-blue:hover {
            background-color: #2563eb;
        }

        .btn-pink {
            background-color: #ec4899;
            color: white;
        }

        .btn-pink:hover {
            background-color: #db2777;
        }

        .cadre {
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 2rem;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 500px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        .page-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .corner-image {
            position: absolute;
            width: 90px;
            opacity: 0.9;
        }

        .top-left { top: 10px; left: 10px; }
        .top-right { top: 10px; right: 10px; }
        .bottom-left { bottom: 10px; left: 10px; }
        .bottom-right { bottom: 10px; right: 10px; }
        .middle-left { top: 45%; left: 0; transform: translateY(-50%); }
        .middle-right { top: 45%; right: 0; transform: translateY(-50%); }

    </style>
</head>
<body>

<div class="page-container">

    <!-- Images dans les coins et bords -->
    <img src="{{ asset('images/oiseau.png') }}" alt="Oiseau" class="corner-image top-left">
    <img src="{{ asset('images/chat.png') }}" alt="Chat" class="corner-image bottom-left">
    <img src="{{ asset('images/chien.png') }}" alt="Chien" class="corner-image bottom-right">
    <img src="{{ asset('images/chat.png') }}" alt="Chat 2" class="corner-image middle-left">
    <img src="{{ asset('images/oiseau.png') }}" alt="Oiseau 2" class="corner-image top-right">
    <img src="{{ asset('images/chien.png') }}" alt="Chien 2" class="corner-image middle-right">

    <!-- Contenu principal -->
    <div class="cadre">
        <h1 class="text-4xl sm:text-5xl text-pink-500">KIDS ZONE</h1>
        <p class="text-lg sm:text-xl text-black mt-4">
            Apprends avec des jeux amusants créés par des experts en éducation 🎓🧠
        </p>

        <div class="flex flex-col sm:flex-row justify-center gap-6 mt-8">
            <a href="{{ route('login') }}" class="btn btn-blue">Connexion</a>
            <a href="{{ route('register') }}" class="btn btn-pink">Inscription</a>
        </div>
    </div>
</div>

</body>
</html>
