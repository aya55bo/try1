<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apprentissage des couleurs</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid bg-gradient-to-r from-purple-200 to-pink-200 min-h-screen">
        <!-- En-tête -->
        <div class="p-4 bg-gradient-to-r from-purple-300 to-pink-300 rounded-lg shadow-lg mb-6">
            <div class="flex justify-between items-center">
                <a href="{{ route('dashboard') }}" class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-full transition-all">
                    ⬅️ Retour
                </a>
                <h1 class="text-center font-bold text-3xl text-purple-800">
                    🎨 Les Couleurs 🌈
                </h1>
                <div class="w-20"></div> <!-- Div vide pour l'équilibre du flexbox -->
            </div>
        </div>

        <!-- Section principale -->
        <div class="px-4">
            <!-- Galerie des couleurs -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8" id="galerieColors">
                <!-- Les couleurs seront générées par JavaScript -->
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
                    <div id="couleurApprentissage" class="w-48 h-48 rounded-lg shadow-lg"></div>
                </div>
                
                <h3 id="nomCouleur" class="text-3xl font-bold text-center text-purple-600 mb-4"></h3>
                
                <div class="flex justify-between mt-6">
                    <button onclick="couleurPrecedente()" class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-full">
                        ⬅️ Précédente
                    </button>
                    <button onclick="ecouterSon()" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-full">
                        🔊 Écouter
                    </button>
                    <button onclick="couleurSuivante()" class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-full">
                        Suivante ➡️
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
                <h2 class="text-2xl font-bold text-center text-red-700 mb-4">Quiz - Devine la couleur</h2>
                
                <div class="flex justify-center mb-4">
                    <div id="couleurQuiz" class="w-48 h-48 rounded-lg shadow-lg"></div>
                </div>
                
                <div id="optionsQuiz" class="grid grid-cols-2 gap-3 mb-4">
                    <!-- Les options seront générées ici -->
                </div>
                
                <div id="feedbackQuiz" class="text-xl font-bold text-center mb-4 hidden"></div>
                
                <div class="flex justify-center">
                    <button id="btnProchainQuiz" onclick="genererQuiz()" class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-2 rounded-full hidden">
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
        // Liste des couleurs avec leurs noms et codes hexadécimaux
        const couleurs = [
            { nom: 'Rouge', code: '#FF0000', son: 'rouge' },
            { nom: 'Bleu', code: '#0000FF', son: 'bleu' },
            { nom: 'Jaune', code: '#FFFF00', son: 'jaune' },
            { nom: 'Vert', code: '#00FF00', son: 'vert' },
            { nom: 'Orange', code: '#FFA500', son: 'orange' },
            { nom: 'Violet', code: '#800080', son: 'violet' },
            { nom: 'Rose', code: '#FFC0CB', son: 'rose' },
            { nom: 'Noir', code: '#000000', son: 'noir' },
            { nom: 'Blanc', code: '#FFFFFF', son: 'blanc' },
            { nom: 'Marron', code: '#A52A2A', son: 'marron' },
            { nom: 'Gris', code: '#808080', son: 'gris' },
            { nom: 'Turquoise', code: '#40E0D0', son: 'turquoise' }
        ];
        
        // Initialiser la galerie de couleurs
        function initialiserGalerie() {
            const galerie = document.getElementById('galerieColors');
            galerie.innerHTML = '';
            
            couleurs.forEach(couleur => {
                const divCouleur = document.createElement('div');
                divCouleur.className = 'bg-white rounded-xl shadow-lg p-4 hover:shadow-xl transition-all transform hover:scale-105';
                
                const nomCouleur = document.createElement('h3');
                nomCouleur.className = 'text-xl font-bold text-center text-purple-600 mb-2';
                nomCouleur.textContent = couleur.nom;
                
                const carreColor = document.createElement('div');
                carreColor.className = 'h-32 w-full rounded-lg shadow mx-auto mb-2';
                carreColor.style.backgroundColor = couleur.code;
                
                // Pour le blanc, ajouter une bordure pour la visibilité
                if (couleur.code === '#FFFFFF') {
                    carreColor.style.border = '1px solid #DDDDDD';
                }
                
                const btnEcouter = document.createElement('button');
                btnEcouter.className = 'bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-full mx-auto block';
                btnEcouter.innerHTML = '🔊 Écouter';
                btnEcouter.onclick = () => playAudio(couleur.son);
                
                divCouleur.appendChild(nomCouleur);
                divCouleur.appendChild(carreColor);
                divCouleur.appendChild(btnEcouter);
                
                galerie.appendChild(divCouleur);
            });
        }
        
        // Appeler la fonction au chargement de la page
        window.onload = initialiserGalerie;
        
        let indexCouleurActuelle = 0;
        let audio = new Audio();
        
        // Fonction pour jouer le son
        function playAudio(nom) {
            // Vérifier si c'est un effet sonore que nous avons
            if (nom === 'correct' || nom === 'incorrect' || nom === 'success') {
                // Utiliser le fichier audio
                audio.src = `sons/${nom}.mp3`;
                audio.play();
            } else {
                // Pour les noms de couleurs, utiliser la synthèse vocale
                if ('speechSynthesis' in window) {
                    const utterance = new SpeechSynthesisUtterance(nom);
                    utterance.lang = 'fr-FR';
                    speechSynthesis.speak(utterance);
                }
            }
        }
        
        // Mode Apprentissage
        function ouvrirModeApprentissage() {
            indexCouleurActuelle = 0;
            afficherCouleur();
            document.getElementById('modalApprentissage').classList.remove('hidden');
        }
        
        function afficherCouleur() {
            const couleur = couleurs[indexCouleurActuelle];
            const carreColor = document.getElementById('couleurApprentissage');
            carreColor.style.backgroundColor = couleur.code;
            
            // Pour le blanc, ajouter une bordure pour la visibilité
            if (couleur.code === '#FFFFFF') {
                carreColor.style.border = '1px solid #DDDDDD';
            } else {
                carreColor.style.border = 'none';
            }
            
            document.getElementById('nomCouleur').textContent = couleur.nom;
            playAudio(couleur.son);
        }
        
        function couleurSuivante() {
            indexCouleurActuelle = (indexCouleurActuelle + 1) % couleurs.length;
            afficherCouleur();
        }
        
        function couleurPrecedente() {
            indexCouleurActuelle = (indexCouleurActuelle - 1 + couleurs.length) % couleurs.length;
            afficherCouleur();
        }
        
        function ecouterSon() {
            const couleur = couleurs[indexCouleurActuelle];
            playAudio(couleur.son);
        }
        
        function fermerModalApprentissage() {
            document.getElementById('modalApprentissage').classList.add('hidden');
            if ('speechSynthesis' in window) {
                speechSynthesis.cancel();
            }
        }
        
        // Jeu de Mémoire
        let premiereCarteRetournee = null;
        let deuxiemeCarteRetournee = null;
        let verrouillagePlateau = false;
        
        function ouvrirJeuMemoire() {
            const plateau = document.getElementById('plateauJeu');
            plateau.innerHTML = '';
            
            // Créer un tableau avec chaque couleur en double
            let cartesMemoire = [];
            couleurs.forEach(couleur => {
                cartesMemoire.push({...couleur, id: Math.random()});
                cartesMemoire.push({...couleur, id: Math.random()});
            });
            
            // Limiter à un nombre raisonnable de paires pour le jeu
            cartesMemoire = cartesMemoire.slice(0, 16);
            
            // Mélanger les cartes
            cartesMemoire.sort(() => 0.5 - Math.random());
            
            // Créer les cartes sur le plateau
            cartesMemoire.forEach(carte => {
                const divCarte = document.createElement('div');
                divCarte.className = 'bg-purple-100 rounded-lg h-28 flex items-center justify-center cursor-pointer shadow transition-all';
                divCarte.dataset.nom = carte.nom;
                divCarte.dataset.code = carte.code;
                
                const divCouleur = document.createElement('div');
                divCouleur.className = 'h-20 w-20 rounded-lg hidden';
                divCouleur.style.backgroundColor = carte.code;
                
                // Pour le blanc, ajouter une bordure pour la visibilité
                if (carte.code === '#FFFFFF') {
                    divCouleur.style.border = '1px solid #DDDDDD';
                }
                
                divCarte.appendChild(divCouleur);
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
            
            const divCouleur = carte.querySelector('div');
            divCouleur.classList.remove('hidden');
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
                playAudio('success');  // Jouer le son de succès
                
                // Vérifier si toutes les paires sont trouvées
                const cartesTrouvees = document.querySelectorAll('.found');
                if (cartesTrouvees.length === document.querySelectorAll('#plateauJeu > div').length) {
                    setTimeout(() => {
                        alert('Bravo ! Tu as trouvé toutes les paires !');
                    }, 500);
                }
            } else {
                verrouillagePlateau = true;
                setTimeout(() => {
                    premiereCarteRetournee.querySelector('div').classList.add('hidden');
                    deuxiemeCarteRetournee.querySelector('div').classList.add('hidden');
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
            
            // Sélectionner une couleur aléatoire
            const indexAleatoire = Math.floor(Math.random() * couleurs.length);
            const couleurCorrecte = couleurs[indexAleatoire];
            reponseCorrecte = couleurCorrecte.nom;
            
            // Afficher la couleur
            const carreCouleur = document.getElementById('couleurQuiz');
            carreCouleur.style.backgroundColor = couleurCorrecte.code;
            
            // Pour le blanc, ajouter une bordure pour la visibilité
            if (couleurCorrecte.code === '#FFFFFF') {
                carreCouleur.style.border = '1px solid #DDDDDD';
            } else {
                carreCouleur.style.border = 'none';
            }
            
            // Générer les options (incluant la réponse correcte)
            let options = [couleurCorrecte.nom];
            
            // Ajouter des options incorrectes
            while (options.length < 4 && options.length < couleurs.length) {
                const optionAleatoire = couleurs[Math.floor(Math.random() * couleurs.length)].nom;
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
                btn.className = 'bg-purple-100 hover:bg-purple-200 py-3 px-4 rounded-lg text-lg font-medium';
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
                playAudio('correct');  // Jouer le son de réponse correcte
            } else {
                divFeedback.textContent = `❌ Ce n'est pas ça. C'est ${reponseCorrecte}.`;
                divFeedback.className = 'text-xl font-bold text-center text-red-600 mb-4';
                
            }
            
            document.getElementById('btnProchainQuiz').classList.remove('hidden');
        }
        
        function fermerModalQuiz() {
            document.getElementById('modalQuiz').classList.add('hidden');
        }
    </script>
</body>
</html>