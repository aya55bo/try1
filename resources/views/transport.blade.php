<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apprentissage des transports</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid bg-gradient-to-r from-blue-200 to-green-200 min-h-screen">
        <!-- En-tête -->
        <div class="p-4 bg-gradient-to-r from-blue-300 to-green-300 rounded-lg shadow-lg mb-6">
            <div class="flex justify-between items-center">
                <a href="{{ route('dashboard') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full transition-all">
                    ⬅️ Retour
                </a>
                <h1 class="text-center font-bold text-3xl text-blue-800">
                    🚌 Les Moyens de Transport 🚗
                </h1>
                <div class="w-20"></div> <!-- Div vide pour l'équilibre du flexbox -->
            </div>
        </div>

        <!-- Section principale -->
        <div class="px-4">
            <!-- Galerie des transports -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-lg p-4 hover:shadow-xl transition-all transform hover:scale-105">
                    <h3 class="text-xl font-bold text-center text-blue-600 mb-2">Voiture</h3>
                    <div class="flex justify-center">
                        <img src="{{ asset('images/voiture.png') }}" alt="Voiture" class="h-32 object-contain">
                    </div>
                    <div class="mt-4 flex justify-center">
                        <button onclick="playAudio('voiture')" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-full">
                            🔊 Écouter
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-4 hover:shadow-xl transition-all transform hover:scale-105">
                    <h3 class="text-xl font-bold text-center text-blue-600 mb-2">Bus</h3>
                    <div class="flex justify-center">
                        <img src="{{ asset('images/bus.png') }}" alt="Bus" class="h-32 object-contain">
                    </div>
                    <div class="mt-4 flex justify-center">
                        <button onclick="playAudio('bus')" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-full">
                            🔊 Écouter
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-4 hover:shadow-xl transition-all transform hover:scale-105">
                    <h3 class="text-xl font-bold text-center text-blue-600 mb-2">Train</h3>
                    <div class="flex justify-center">
                        <img src="{{ asset('images/train.png') }}" alt="Train" class="h-32 object-contain">
                    </div>
                    <div class="mt-4 flex justify-center">
                        <button onclick="playAudio('train')" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-full">
                            🔊 Écouter
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-4 hover:shadow-xl transition-all transform hover:scale-105">
                    <h3 class="text-xl font-bold text-center text-blue-600 mb-2">Avion</h3>
                    <div class="flex justify-center">
                        <img src="{{ asset('images/avion.png') }}" alt="Avion" class="h-32 object-contain">
                    </div>
                    <div class="mt-4 flex justify-center">
                        <button onclick="playAudio('avion')" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-full">
                            🔊 Écouter
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-4 hover:shadow-xl transition-all transform hover:scale-105">
                    <h3 class="text-xl font-bold text-center text-blue-600 mb-2">Bicyclette</h3>
                    <div class="flex justify-center">
                        <img src="{{ asset('images/bicyclette.png') }}" alt="Bicyclette" class="h-32 object-contain">
                    </div>
                    <div class="mt-4 flex justify-center">
                        <button onclick="playAudio('bicyclette')" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-full">
                            🔊 Écouter
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-4 hover:shadow-xl transition-all transform hover:scale-105">
                    <h3 class="text-xl font-bold text-center text-blue-600 mb-2">Bateau</h3>
                    <div class="flex justify-center">
                        <img src="{{ asset('images/bateau.png') }}" alt="Bateau" class="h-32 object-contain">
                    </div>
                    <div class="mt-4 flex justify-center">
                        <button onclick="playAudio('bateau')" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-full">
                            🔊 Écouter
                        </button>
                    </div>
                </div>
            </div>

            <!-- Boutons d'activités -->
            <div class="flex flex-wrap justify-center gap-4 mb-8">
                <button onclick="ouvrirModeApprentissage()" class="bg-purple-600 hover:bg-purple-700 text-white text-lg px-6 py-3 rounded-full shadow-md">
                    📚 Mode Apprentissage
                </button>
                <button onclick="ouvrirJeuMemoire()" class="bg-green-600 hover:bg-green-700 text-white text-lg px-6 py-3 rounded-full shadow-md">
                    🎮 Jeu de Mémoire
                </button>
                <button onclick="ouvrirQuiz()" class="bg-red-600 hover:bg-red-700 text-white text-lg px-6 py-3 rounded-full shadow-md">
                    ❓ Quiz
                </button>
            </div>
        </div>

        <!-- Modal Mode Apprentissage -->
        <div id="modalApprentissage" class="fixed inset-0 bg-black bg-opacity-70 hidden z-50 flex items-center justify-center">
            <div class="bg-white rounded-xl p-6 max-w-md w-full">
                <h2 class="text-2xl font-bold text-center text-purple-700 mb-4">Mode Apprentissage</h2>
                
                <div class="flex justify-center mb-4">
                    <img id="imageApprentissage" src="" alt="Transport" class="h-48 object-contain">
                </div>
                
                <h3 id="nomTransport" class="text-3xl font-bold text-center text-blue-600 mb-4"></h3>
                
                <div class="flex justify-between mt-6">
                    <button onclick="transportPrecedent()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full">
                        ⬅️ Précédent
                    </button>
                    <button onclick="ecouterSon()" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-full">
                        🔊 Écouter
                    </button>
                    <button onclick="transportSuivant()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full">
                        Suivant ➡️
                    </button>
                </div>
                
                <div class="mt-6 text-center">
                    <button onclick="fermerModalApprentissage()" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-full">
                        Fermer
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Jeu de Mémoire -->
        <div id="modalMemoire" class="fixed inset-0 bg-black bg-opacity-70 hidden z-50 flex items-center justify-center">
            <div class="bg-white rounded-xl p-6 max-w-4xl w-full">
                <h2 class="text-2xl font-bold text-center text-green-700 mb-4">Jeu de Mémoire - Retrouve les paires</h2>
                
                <div id="plateauJeu" class="grid grid-cols-3 md:grid-cols-4 gap-4 mb-6">
                    <!-- Les cartes seront générées ici -->
                </div>
                
                <div class="flex justify-center">
                    <button onclick="fermerModalMemoire()" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-full">
                        Quitter
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Quiz -->
        <div id="modalQuiz" class="fixed inset-0 bg-black bg-opacity-70 hidden z-50 flex items-center justify-center">
            <div class="bg-white rounded-xl p-6 max-w-md w-full">
                <h2 class="text-2xl font-bold text-center text-red-700 mb-4">Quiz - Devine le transport</h2>
                
                <div class="flex justify-center mb-4">
                    <img id="imageQuiz" src="" alt="Transport" class="h-48 object-contain">
                </div>
                
                <div id="optionsQuiz" class="grid grid-cols-2 gap-3 mb-4">
                    <!-- Les options seront générées ici -->
                </div>
                
                <div id="feedbackQuiz" class="text-xl font-bold text-center mb-4 hidden"></div>
                
                <div class="flex justify-center">
                    <button id="btnProchainQuiz" onclick="genererQuiz()" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-full hidden">
                        Question suivante
                    </button>
                    <button onclick="fermerModalQuiz()" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-full ml-2">
                        Quitter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Liste des transports
        const transports = [
            { nom: 'Voiture', image: 'voiture.png', son: 'voiture.mp3' },
            { nom: 'Bus', image: 'bus.png', son: 'bus.mp3' },
            { nom: 'Train', image: 'train.png', son: 'train.mp3' },
            { nom: 'Avion', image: 'avion.png', son: 'avion.mp3' },
            { nom: 'Bicyclette', image: 'bicyclette.png', son: 'bicyclette.mp3' },
            { nom: 'Bateau', image: 'bateau.png', son: 'bateau.mp3' }
        ];
        
        let indexTransportActuel = 0;
        let audio = new Audio();
        
        // Fonction pour jouer le son
        function playAudio(nom) {
            audio.src = `{{ asset('sons/') }}/${nom}.mp3`;
            audio.play();
        }
        
        // Mode Apprentissage
        function ouvrirModeApprentissage() {
            indexTransportActuel = 0;
            afficherTransport();
            document.getElementById('modalApprentissage').classList.remove('hidden');
        }
        
        function afficherTransport() {
            const transport = transports[indexTransportActuel];
            document.getElementById('imageApprentissage').src = `{{ asset('images/') }}/${transport.image}`;
            document.getElementById('nomTransport').textContent = transport.nom;
            playAudio(transport.nom.toLowerCase());
        }
        
        function transportSuivant() {
            indexTransportActuel = (indexTransportActuel + 1) % transports.length;
            afficherTransport();
        }
        
        function transportPrecedent() {
            indexTransportActuel = (indexTransportActuel - 1 + transports.length) % transports.length;
            afficherTransport();
        }
        
        function ecouterSon() {
            const transport = transports[indexTransportActuel];
            playAudio(transport.nom.toLowerCase());
        }
        
        function fermerModalApprentissage() {
            document.getElementById('modalApprentissage').classList.add('hidden');
            audio.pause();
        }
        
        // Jeu de Mémoire
        let premiereCarteRetournee = null;
        let deuxiemeCarteRetournee = null;
        let verrouillagePlateau = false;
        
        function ouvrirJeuMemoire() {
            const plateau = document.getElementById('plateauJeu');
            plateau.innerHTML = '';
            
            // Créer un tableau avec chaque transport en double
            let cartesMemoire = [];
            transports.forEach(transport => {
                cartesMemoire.push({...transport, id: Math.random()});
                cartesMemoire.push({...transport, id: Math.random()});
            });
            
            // Mélanger les cartes
            cartesMemoire.sort(() => 0.5 - Math.random());
            
            // Créer les cartes sur le plateau
            cartesMemoire.forEach(carte => {
                const divCarte = document.createElement('div');
                divCarte.className = 'bg-blue-100 rounded-lg h-28 flex items-center justify-center cursor-pointer shadow transition-all';
                divCarte.dataset.nom = carte.nom;
                
                const imgCarte = document.createElement('img');
                imgCarte.src = `{{ asset('images/') }}/${carte.image}`;
                imgCarte.className = 'h-20 w-20 object-contain hidden';
                
                divCarte.appendChild(imgCarte);
                divCarte.addEventListener('click', () => retournerCarte(divCarte));
                
                plateau.appendChild(divCarte);
            });
            
            premiereCarteRetournee = null;
            deuxiemeCarteRetournee = null;
            verrouillagePlateau = false;
            document.getElementById('modalMemoire').classList.remove('hidden');
        }
        
        function retournerCarte(carte) {
            if (verrouillagePlateau) return;
            if (carte === premiereCarteRetournee) return;
            
            const img = carte.querySelector('img');
            img.classList.remove('hidden');
            carte.classList.add('bg-white');
            
            if (!premiereCarteRetournee) {
                premiereCarteRetournee = carte;
                return;
            }
            
            deuxiemeCarteRetournee = carte;
            verifierCorrespondance();
        }
        
        function verifierCorrespondance() {
            if (premiereCarteRetournee.dataset.nom === deuxiemeCarteRetournee.dataset.nom) {
                premiereCarteRetournee.classList.add('found');
                deuxiemeCarteRetournee.classList.add('found');
                premiereCarteRetournee.removeEventListener('click', retournerCarte);
                deuxiemeCarteRetournee.removeEventListener('click', retournerCarte);
                premiereCarteRetournee = null;
                deuxiemeCarteRetournee = null;
                playAudio('success');
                
                // Vérifier si toutes les paires sont trouvées
                const cartesTrouvees = document.querySelectorAll('.found');
                if (cartesTrouvees.length === transports.length * 2) {
                    setTimeout(() => {
                        alert('Bravo ! Tu as trouvé toutes les paires !');
                    }, 500);
                }
            } else {
                verrouillagePlateau = true;
                setTimeout(() => {
                    premiereCarteRetournee.querySelector('img').classList.add('hidden');
                    deuxiemeCarteRetournee.querySelector('img').classList.add('hidden');
                    premiereCarteRetournee.classList.remove('bg-white');
                    deuxiemeCarteRetournee.classList.remove('bg-white');
                    premiereCarteRetournee = null;
                    deuxiemeCarteRetournee = null;
                    verrouillagePlateau = false;
                }, 1000);
            }
        }
        
        function fermerModalMemoire() {
            document.getElementById('modalMemoire').classList.add('hidden');
        }
        
        // Quiz
        let reponseCorrecte = '';
        
        function ouvrirQuiz() {
            genererQuiz();
            document.getElementById('modalQuiz').classList.remove('hidden');
        }
        
        function genererQuiz() {
            document.getElementById('feedbackQuiz').classList.add('hidden');
            document.getElementById('btnProchainQuiz').classList.add('hidden');
            
            // Sélectionner un transport aléatoire
            const indexAleatoire = Math.floor(Math.random() * transports.length);
            const transportCorrect = transports[indexAleatoire];
            reponseCorrecte = transportCorrect.nom;
            
            // Afficher l'image
            document.getElementById('imageQuiz').src = `{{ asset('images/') }}/${transportCorrect.image}`;
            
            // Générer les options (incluant la réponse correcte)
            let options = [transportCorrect.nom];
            
            // Ajouter des options incorrectes
            while (options.length < 4 && options.length < transports.length) {
                const optionAleatoire = transports[Math.floor(Math.random() * transports.length)].nom;
                if (!options.includes(optionAleatoire)) {
                    options.push(optionAleatoire);
                }
            }
            
            // Mélanger les options
            options.sort(() => 0.5 - Math.random());
            
            // Afficher les options
            const divOptions = document.getElementById('optionsQuiz');
            divOptions.innerHTML = '';
            
            options.forEach(option => {
                const btn = document.createElement('button');
                btn.textContent = option;
                btn.className = 'bg-blue-100 hover:bg-blue-200 py-3 px-4 rounded-lg text-lg font-medium';
                btn.onclick = () => verifierReponse(option);
                divOptions.appendChild(btn);
            });
        }
        
        function verifierReponse(reponse) {
            const divFeedback = document.getElementById('feedbackQuiz');
            divFeedback.classList.remove('hidden');
            
            if (reponse === reponseCorrecte) {
                divFeedback.textContent = '✅ Bravo ! C\'est correct !';
                divFeedback.className = 'text-xl font-bold text-center text-green-600 mb-4';
                playAudio('correct');
            } else {
                divFeedback.textContent = `❌ Ce n'est pas ça. C'est un ${reponseCorrecte}.`;
                divFeedback.className = 'text-xl font-bold text-center text-red-600 mb-4';
                playAudio('incorrect');
            }
            
            document.getElementById('btnProchainQuiz').classList.remove('hidden');
        }
        
        function fermerModalQuiz() {
            document.getElementById('modalQuiz').classList.add('hidden');
        }
    </script>
</body>
</html>