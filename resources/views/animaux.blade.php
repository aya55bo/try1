<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-green-300 to-blue-200 p-6">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Découvre les animaux</h1>

        <!-- MENU -->
<div class="flex justify-center mb-8 space-x-6">
    <button onclick="showSection('lesson')" class="button2 text-white py-3 px-6 rounded-xl shadow-lg">Leçon</button>
    <button onclick="toggleExercicesModal()" class="button2 text-white py-3 px-6 rounded-xl shadow-lg">Exercices</button>
    <button onclick="showSection('rating')" class="button2 text-white py-3 px-6 rounded-xl shadow-lg">Avancement</button>
</div>

<!-- Modal pour les exercices -->
<div id="exercices-modal" class="fixed inset-0 bg-black bg-opacity-60 hidden justify-center items-center z-50">
    <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md relative mx-4">
        <button onclick="toggleExercicesModal()" class="absolute top-4 right-4 text-red-500 hover:text-red-700 text-2xl font-bold">
            &times;
        </button>
        <h2 class="text-2xl font-bold text-center text-orange-600 mb-6">Choisis ton exercice</h2>
        <div class="grid grid-cols-1 gap-4">
            <button onclick="showSection('quiz'); toggleExercicesModal();" class="bg-yellow-400 hover:bg-yellow-500 text-white py-4 px-6 rounded-xl shadow-md text-lg">
                Quiz: Trouve l'animal
            </button>
            <button onclick="showSection('dragQuiz'); toggleExercicesModal();" class="bg-green-500 hover:bg-green-600 text-white py-4 px-6 rounded-xl shadow-md text-lg">
                Quiz: Quel est le bon animal?
            </button>
            <button onclick="showSection('puzzle'); toggleExercicesModal();" class="bg-purple-500 hover:bg-purple-600 text-white py-4 px-6 rounded-xl shadow-md text-lg">
                Puzzle des animaux
            </button>
        </div>
    </div>
</div>

        <!-- SECTION LEÇON -->
        <div id="lesson" class="section">
            <div class="grid grid-cols-3 gap-6 max-w-4xl mx-auto">
                @foreach($animals as $animal)
                <div class="bg-white rounded-xl shadow-lg p-4 text-center flex flex-col h-auto min-h-[300px]">
                    <div class="flex-grow overflow-hidden rounded-lg mb-2" style="height: 220px;">
                        <img src="{{ asset('images/animaux/' . $animal->image) }}"
                             alt="{{ $animal->nom }}"
                             class="w-full h-full object-contain"> 
                    </div>
                    
                    <div class="mt-auto">
                        <button onclick="showAnimalModal({{ $animal->id }})"
                                class="text-sm bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-2 rounded-full w-full">
                            {{ $animal->nom }}
                        </button>
                    </div>
                </div>                    
                    <!-- MODALE ANIMAL -->
                    <div id="modal-{{ $animal->id }}" class="fixed inset-0 bg-black bg-opacity-60 hidden justify-center items-center z-50">
                        <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md relative mx-4">
                            <button onclick="closeAnimalModal({{ $animal->id }})"
                                    class="absolute top-4 right-4 text-red-500 hover:text-red-700 text-2xl font-bold">
                                &times;
                            </button>

                            <h2 class="text-2xl font-bold text-center text-yellow-600 mb-4">{{ $animal->nom }}</h2>

                            <img src="{{ asset('images/animaux/' . $animal->image) }}"
     alt="{{ $animal->nom }}"
     class="w-full h-auto max-h-64 object-contain rounded-lg mb-4"> 

                            <div class="flex justify-center gap-4 mb-4">
                                <button onclick="playSound('son-{{ $animal->id }}')"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full text-sm">
                                     Écouter le son
                                </button>
                                <button onclick="playSound('nom-{{ $animal->id }}')"
                                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-full text-sm">
                                     Prononciation du nom
                                </button>
                            </div>

                            <div class="text-sm text-gray-700 space-y-2">
                                <p><strong class="text-blue-700">Description du son :</strong><br>{{ $animal->description_son }}</p>
                                <p><strong class="text-gray-800">Description :</strong><br>{{ $animal->description }}</p>
                            </div>

                            <audio id="son-{{ $animal->id }}">
                                <source src="{{ asset('audio/animaux/' . $animal->son_animal) }}" type="audio/mpeg">
                            </audio>
                            <audio id="nom-{{ $animal->id }}">
                                <source src="{{ asset('audio/animaux/' . $animal->son_nom) }}" type="audio/mpeg">
                            </audio>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- SECTION QUIZ -->
<div id="quiz" class="section hidden">
    <div class="bg-white rounded-xl shadow-md p-6 max-w-4xl mx-auto">
        <h2 class="text-2xl font-bold text-center text-pink-600 mb-4">Quiz : Trouve le bon animal</h2>
        
        <!-- Barre de progression -->
        <div class="mb-6 bg-gray-200 rounded-full h-4">
            <div id="quizProgress" class="bg-green-500 h-4 rounded-full transition-all duration-500" style="width: 0%"></div>
        </div>
        
        <div class="space-y-4" id="quizQuestions">
            <!-- Les questions seront générées par JavaScript -->
        </div>

        <!-- Bouton de validation bien visible -->
        <div class="text-center mt-6">
            <button type="button" onclick="submitQuiz()" 
                    class="bg-yellow-400 hover:bg-yellow-500 text-white py-3 px-6 rounded-xl shadow-lg">
                 Valider toutes les réponses
            </button>
        </div>

        <!-- Résultats du quiz -->
        <div id="quizResult" class="mt-4 text-center text-xl font-bold text-green-600 hidden"></div>
    </div>
</div>
        <!-- SECTION PUZZLE -->
<div id="puzzle" class="section hidden">
    <div class="bg-white rounded-xl shadow-md p-6 max-w-4xl mx-auto">
        <h2 class="text-2xl font-bold text-center text-purple-700 mb-6"> Puzzle des animaux</h2>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-6 mb-6" id="puzzle-zones">
            <!-- Les 6 zones seront générées dynamiquement par JavaScript -->
        </div>
        
        <div class="flex flex-wrap justify-center gap-4 mb-4" id="puzzle-images-zone">
            <!-- Les 6 images seront générées dynamiquement par JavaScript -->
        </div>
        
        <div id="puzzle-message-erreur" class="text-center text-red-600 font-semibold mb-2 hidden"> Mauvais endroit !</div>
        
        <div class="text-center mt-6">
            <button onclick="validatePuzzle()" class="bg-purple-500 hover:bg-purple-600 text-white py-3 px-6 rounded-xl shadow-lg">
                Valider mes réponses
            </button>
        </div>
        
        <div id="puzzle-results" class="mt-4 p-4 rounded-lg bg-gray-50 hidden">
            <div id="puzzle-score" class="text-xl font-bold text-center mb-2"></div>
            <div id="puzzle-feedback" class="space-y-2"></div>
            <div class="text-center mt-4">
                <button onclick="resetPuzzle()" class="bg-yellow-400 text-white px-6 py-2 rounded-full shadow hover:bg-yellow-500">
                     Rejouer
                </button>
            </div>
        </div>
    </div>
</div>

        <!-- SECTION DRAG QUIZ -->
<div id="dragQuiz" class="section hidden">
    <div class="bg-white rounded-xl shadow-md p-6 max-w-4xl mx-auto">
        <h2 class="text-2xl font-bold text-center text-green-700 mb-6"> Quel est le bon animal ?</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6" id="dragQuiz-questions">
            <!-- Les 6 questions seront générées dynamiquement ici -->
        </div>
        
        <div class="text-center mt-6">
            <button onclick="validateDragQuiz()" class="bg-green-500 hover:bg-green-600 text-white py-3 px-6 rounded-xl shadow-lg">
                Valider mes réponses
            </button>
        </div>
        
        <div id="dragQuiz-results" class="mt-4 p-4 rounded-lg bg-gray-50 hidden">
            <div id="dragQuiz-score" class="text-xl font-bold text-center mb-2"></div>
            <div id="dragQuiz-feedback" class="space-y-2"></div>
            <div class="text-center mt-4">
                <button onclick="resetDragQuiz()" class="bg-yellow-400 text-white px-6 py-2 rounded-full shadow hover:bg-yellow-500">
                     Rejouer
                </button>
            </div>
        </div>
    </div>
</div>

        <!-- SECTION CLASSEMENT -->
<div id="rating" class="section hidden">
    <div class="bg-white rounded-xl shadow-md p-6 max-w-md mx-auto">
        <h2 class="text-2xl font-bold text-purple-600 mb-4">Historique des Scores</h2>
        
        <!-- Navigation des classements -->
        <div class="flex justify-center mb-4 gap-2">
            <button onclick="showScoreCategory('quiz')" class="px-4 py-2 bg-pink-500 text-white rounded-lg">Quiz</button>
            <button onclick="showScoreCategory('dragQuiz')" class="px-4 py-2 bg-green-500 text-white rounded-lg">Quiz Audio</button>
            <button onclick="showScoreCategory('puzzle')" class="px-4 py-2 bg-purple-500 text-white rounded-lg">Puzzle</button>
        </div>
        
        <div id="scoreHistory" class="space-y-3">
            <!-- Les scores apparaîtront ici -->
        </div>
        <button onclick="clearHistory()" class="mt-4 text-sm text-red-500 hover:text-red-700">
             Effacer l'historique
        </button>
    </div>
</div>
    </div>

    <script>
// Variables globales pour les jeux
let currentQuizAttempt = 1;
let currentDragQuizAttempt = 1;
let currentPuzzleAttempt = 1;
const MAX_HISTORY = 5; // Garde les 5 derniers essais
let currentQuizSet = [];
let currentScoreCategory = 'quiz';
let allAnimals = []; // Stockera tous les animaux
let currentDragQuizSet = []; // 6 animaux pour le drag quiz
let userDragQuizAnswers = {}; // Stocke les réponses de l'utilisateur pour le drag quiz

// Fonctions d'affichage des sections
function showSection(sectionId) {
    document.querySelectorAll('.section').forEach(sec => {
        sec.classList.add('hidden');
        sec.classList.remove('active');
    });
    const activeSection = document.getElementById(sectionId);
    activeSection.classList.remove('hidden');
    activeSection.classList.add('active');
    
    // Initialiser les jeux 
    if(sectionId === 'dragQuiz') {
        initDragQuiz();
    } else if(sectionId === 'quiz') {
        initQuiz();
    } else if(sectionId === 'puzzle') {
        initPuzzle();
    } else if(sectionId === 'rating') {
        showScoreCategory(currentScoreCategory);
    }
}

// Afficher/cacher le modal des exercices
function toggleExercicesModal() {
    const modal = document.getElementById('exercices-modal');
    if(modal.classList.contains('hidden')) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    } else {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
}

// Gestion des modales
function showAnimalModal(id) {
    const modal = document.getElementById(`modal-${id}`);
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeAnimalModal(id) {
    const modal = document.getElementById(`modal-${id}`);
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Lecture des sons
function playSound(id) {
    const audio = document.getElementById(id);
    if (audio) {
        audio.currentTime = 0;
        audio.play();
    }
}

// Initialisation du quiz 
function initQuiz() {
    // Récupérer tous les animaux et mélanger
    if (allAnimals.length === 0) {
        
        // on utilise une simulation basée sur les données du document
        document.querySelectorAll('[id^="modal-"]').forEach(modal => {
            const id = modal.id.replace('modal-', '');
            const nom = modal.querySelector('h2').textContent;
            const image = modal.querySelector('img').src;
            const son = document.getElementById(`son-${id}`).querySelector('source').src;
            
            allAnimals.push({ id, nom, image, son });
        });
    }
    
    // Prendre 4 animaux aléatoires
    const shuffled = [...allAnimals].sort(() => 0.5 - Math.random());
    currentQuizSet = shuffled.slice(0, 4);
    
    // Générer les questions
    const questionsContainer = document.getElementById('quizQuestions');
    questionsContainer.innerHTML = '';
    
    currentQuizSet.forEach((animal, index) => {
        const questionDiv = document.createElement('div');
        questionDiv.className = 'flex items-center gap-4 p-2 bg-gray-50 rounded-lg quiz-item mb-4';
        
        questionDiv.innerHTML = `
            <audio id="quiz-son-${index}">
                <source src="${animal.son}" type="audio/mpeg">
            </audio>
            <button type="button" 
                    onclick="document.getElementById('quiz-son-${index}').play()" 
                    class="bg-blue-300 hover:bg-blue-400 text-white px-3 py-1 rounded-full w-10 h-10 flex items-center justify-center">
                🔊
            </button>
            <input type="text" 
                   placeholder="Écris le nom de l'animal"
                   class="flex-1 border rounded px-4 py-2 bg-white quiz-input"
                   data-answer="${animal.nom.toLowerCase()}">
        `;
        
        questionsContainer.appendChild(questionDiv);
    });
    
    // Réinitialiser la barre de progression et le résultat
    document.getElementById('quizProgress').style.width = '0%';
    document.getElementById('quizResult').classList.add('hidden');
}

// Gestion du quiz 
function submitQuiz() {
    const inputs = document.querySelectorAll('.quiz-input');
    let correct = 0;
    let total = inputs.length;

    inputs.forEach(input => {
        const userAnswer = input.value.trim().toLowerCase();
        const correctAnswer = input.dataset.answer;
        
        if(userAnswer === correctAnswer) {
            input.classList.add('border-green-400', 'bg-green-100');
            input.classList.remove('border-red-400', 'bg-red-100');
            correct++;
        } else {
            input.classList.add('border-red-400', 'bg-red-100');
            input.classList.remove('border-green-400', 'bg-green-100');
            
            // Ajouter la réponse correcte
            const correctHint = document.createElement('p');
            correctHint.className = 'text-sm text-green-600 mt-1';
            correctHint.textContent = `La bonne réponse est: ${correctAnswer}`;
            
            // Vérifier si on n'a pas déjà ajouté un indice
            const existingHint = input.parentNode.querySelector('p');
            if (!existingHint) {
                input.parentNode.appendChild(correctHint);
            }
        }
    });

    // Mise à jour de la barre de progression
    document.getElementById('quizProgress').style.width = `${(correct / total) * 100}%`;

    // Sauvegarder l'essai
    const attempt = {
        number: currentQuizAttempt,
        score: correct,
        total: total,
        date: new Date().toLocaleString()
    };
    
    saveAttempt(attempt, 'quiz');
    currentQuizAttempt++;
    
    // Afficher résultats
    const resultDiv = document.getElementById('quizResult');
    resultDiv.textContent = `Tu as trouvé ${correct} animal(aux) sur ${total}`;
    resultDiv.classList.remove('hidden');
    
    if (currentScoreCategory === 'quiz') {
        showScoreHistory('quiz');
    }
}

// -------------- FONCTIONS POUR LE PUZZLE -----------------

function initPuzzle() {
    // Prendre 6 animaux aléatoires pour le puzzle
    const puzzleAnimals = [...allAnimals].sort(() => 0.5 - Math.random()).slice(0, 6);
    
    // Générer les zones
    const puzzleZones = document.getElementById('puzzle-zones');
    puzzleZones.innerHTML = '';
    
    puzzleAnimals.forEach(animal => {
        const zone = document.createElement('div');
        zone.className = 'dropzone w-full h-32 border-4 border-dashed rounded-xl flex items-center justify-center';
        zone.dataset.animal = animal.nom;
        zone.innerHTML = `<span class="text-gray-400">${animal.nom}</span>`;
        zone.ondrop = dropAnimal;
        zone.ondragover = allowDrop;
        
        puzzleZones.appendChild(zone);
    });
    
    // Générer les images mélangées
    const imagesZone = document.getElementById('puzzle-images-zone');
    imagesZone.innerHTML = '';
    
    puzzleAnimals.sort(() => 0.5 - Math.random()).forEach(animal => {
        const img = document.createElement('img');
        img.src = animal.image;
        img.draggable = true;
        img.ondragstart = dragAnimal;
        img.id = `drag-animal-${animal.id}`;
        img.dataset.animal = animal.nom;
        img.className = 'w-20 h-20 rounded-xl shadow-md cursor-move hover:scale-110 transition';
        
        imagesZone.appendChild(img);
    });
    
    // Cacher les résultats précédents
    document.getElementById('puzzle-results').classList.add('hidden');
    document.getElementById('puzzle-message-erreur').classList.add('hidden');
}

function allowDrop(ev) {
    ev.preventDefault();
}

function dragAnimal(ev) {
    ev.dataTransfer.setData("animal", ev.target.dataset.animal);
    ev.dataTransfer.setData("id", ev.target.id);
}

function dropAnimal(ev) {
    ev.preventDefault();
    document.getElementById('puzzle-message-erreur').classList.add('hidden');

    const zone = ev.target.closest('.dropzone');
    if (!zone) return;

    // Vérifier si la zone contient déjà une image
    const existingImg = zone.querySelector('img');
    if (existingImg) {
        // Remettre l'image dans la zone d'images
        document.getElementById('puzzle-images-zone').appendChild(existingImg);
    }

    const draggedId = ev.dataTransfer.getData("id");
    const draggedElement = document.getElementById(draggedId);
    
    // Effacer le contenu de la zone et ajouter l'image
    zone.innerHTML = "";
    zone.appendChild(draggedElement);
}

function validatePuzzle() {
    const zones = document.querySelectorAll('.dropzone');
    let correctCount = 0;
    let totalCount = zones.length;
    const resultDiv = document.getElementById('puzzle-results');
    const scoreDiv = document.getElementById('puzzle-score');
    const feedbackDiv = document.getElementById('puzzle-feedback');
    
    feedbackDiv.innerHTML = '';
    
    zones.forEach(zone => {
        const expectedAnimal = zone.dataset.animal;
        const img = zone.querySelector('img');
        const animalName = img ? img.dataset.animal : null;
        
        const resultItem = document.createElement('div');
        resultItem.className = 'flex items-center gap-2 p-2 rounded-lg';
        
        if (animalName === expectedAnimal) {
            correctCount++;
            resultItem.className += ' bg-green-100';
            resultItem.innerHTML = `<span class="text-green-600">✓</span> ${expectedAnimal}: Correct!`;
        } else {
            resultItem.className += ' bg-red-100';
            resultItem.innerHTML = `<span class="text-red-600">✗</span> ${expectedAnimal}: ${animalName || 'Non placé'}`;
        }
        
        feedbackDiv.appendChild(resultItem);
    });
    
    // Afficher le score
    scoreDiv.textContent = `Score: ${correctCount}/${totalCount}`;
    resultDiv.classList.remove('hidden');
    
    // Sauvegarder le score
    const attempt = {
        number: currentPuzzleAttempt,
        score: correctCount,
        total: totalCount,
        date: new Date().toLocaleString()
    };
    
    saveAttempt(attempt, 'puzzle');
    currentPuzzleAttempt++;
    
    if (currentScoreCategory === 'puzzle') {
        showScoreHistory('puzzle');
    }
}

function resetPuzzle() {
    initPuzzle();
}

// -------------- FONCTIONS POUR LE DRAG QUIZ -----------------

function initDragQuiz() {
    // Réinitialiser les réponses utilisateur
    userDragQuizAnswers = {};
    
    // Prendre 6 animaux aléatoires pour les questions
    currentDragQuizSet = [...allAnimals].sort(() => 0.5 - Math.random()).slice(0, 6);
    
    // Container pour les questions
    const questionsContainer = document.getElementById('dragQuiz-questions');
    questionsContainer.innerHTML = '';
    
    // Créer les 6 questions avec sélection audio->image
    currentDragQuizSet.forEach((animal, index) => {
        const questionDiv = document.createElement('div');
        questionDiv.className = 'bg-gray-50 p-4 rounded-lg';
        
        // Créer l'audio
        const audioHtml = `
            <div class="mb-4 text-center">
                <audio id="dragQuiz-sound-${index}" src="${animal.son}"></audio>
                <button onclick="document.getElementById('dragQuiz-sound-${index}').play()" 
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full">
                    🔊 Animal #${index + 1}
                </button>
            </div>
        `;
        
        // Créer les options (4 images dont la bonne)
        const otherOptions = [...allAnimals]
            .filter(a => !currentDragQuizSet.some(q => q.id === a.id)) // Exclure les animaux déjà utilisés dans d'autres questions
            .sort(() => 0.5 - Math.random())
            .slice(0, 3);
        
        const options = [animal, ...otherOptions].sort(() => 0.5 - Math.random());
        
        let optionsHtml = '<div class="grid grid-cols-2 gap-2 mt-2">';
            options.forEach((option, optionIndex) => {
    optionsHtml += `
        <div class="text-center">
            <img src="${option.image}" 
                 alt="${option.nom}" 
                 class="w-full h-24 object-contain rounded-lg mx-auto cursor-pointer dragQuiz-option hover:ring-2 hover:ring-blue-500"
                 onclick="selectDragQuizOption(${index}, '${option.id}', this)"
                 data-animal-id="${option.id}">
            <p class="mt-1 text-sm">${option.nom}</p>
        </div>
    `;
});
        optionsHtml += '</div>';
        
        questionDiv.innerHTML = audioHtml + optionsHtml;
        questionsContainer.appendChild(questionDiv);
    });
    
    // Cacher les résultats précédents
    document.getElementById('dragQuiz-results').classList.add('hidden');
}

function selectDragQuizOption(questionIndex, animalId, element) {
    // Déselectionner les autres options de cette question
    const question = element.closest('.bg-gray-50');
    question.querySelectorAll('.dragQuiz-option').forEach(opt => {
        opt.classList.remove('ring-4', 'ring-blue-500', 'opacity-100');
        opt.classList.add('opacity-70');
    });
    
    // Sélectionner cette option
    element.classList.add('ring-4', 'ring-blue-500', 'opacity-100');
    element.classList.remove('opacity-70');
    
    // Enregistrer la réponse
    userDragQuizAnswers[questionIndex] = animalId;
}

function validateDragQuiz() {
    let correctCount = 0;
    let totalCount = currentDragQuizSet.length;
    const resultDiv = document.getElementById('dragQuiz-results');
    const scoreDiv = document.getElementById('dragQuiz-score');
    const feedbackDiv = document.getElementById('dragQuiz-feedback');
    
    feedbackDiv.innerHTML = '';
    
    currentDragQuizSet.forEach((question, index) => {
        const userAnswer = userDragQuizAnswers[index];
        const correctAnswer = question.id;
        
        const resultItem = document.createElement('div');
        resultItem.className = 'flex items-center gap-2 p-2 rounded-lg';
        
        if (userAnswer === correctAnswer) {
            correctCount++;
            resultItem.className += ' bg-green-100';
            resultItem.innerHTML = `<span class="text-green-600">✓</span> Animal #${index + 1}: Correct! (${question.nom})`;
        } else {
            const selectedAnimal = userAnswer ? allAnimals.find(a => a.id === userAnswer)?.nom || 'Non sélectionné' : 'Non sélectionné';
            resultItem.className += ' bg-red-100';
            resultItem.innerHTML = `<span class="text-red-600">✗</span> Animal #${index + 1}: Tu as choisi ${selectedAnimal} au lieu de ${question.nom}`;
        }
        
        feedbackDiv.appendChild(resultItem);
    });
    
    // Afficher le score
    scoreDiv.textContent = `Score: ${correctCount}/${totalCount}`;
    resultDiv.classList.remove('hidden');
    
    // Sauvegarder le score
    const attempt = {
        number: currentDragQuizAttempt,
        score: correctCount,
        total: totalCount,
        date: new Date().toLocaleString()
    };
    
    saveAttempt(attempt, 'dragQuiz');
    currentDragQuizAttempt++;
    
    if (currentScoreCategory === 'dragQuiz') {
        showScoreHistory('dragQuiz');
    }
}

function resetDragQuiz() {
    initDragQuiz();
}

// -------------- FONCTIONS COMMUNES -----------------

function saveAttempt(attempt, gameType) {
    let historyKey = `${gameType}History`;
    let history = JSON.parse(localStorage.getItem(historyKey) || '[]');
    
    // Garder seulement les MAX_HISTORY derniers
    history = [attempt, ...history].slice(0, MAX_HISTORY);
    
    localStorage.setItem(historyKey, JSON.stringify(history));
}

function showScoreCategory(category) {
    currentScoreCategory = category;
    
    
    document.querySelectorAll('#rating button').forEach(btn => {
        btn.classList.remove('font-bold', 'ring-2', 'ring-offset-2');
    });
    
    document.querySelector(`#rating button:nth-child(${
        category === 'quiz' ? 1 : (category === 'dragQuiz' ? 2 : 3)
    })`).classList.add('font-bold', 'ring-2', 'ring-offset-2');
    
    showScoreHistory(category);
}

function showScoreHistory(gameType = currentScoreCategory) {
    const historyKey = `${gameType}History`;
    const history = JSON.parse(localStorage.getItem(historyKey) || '[]');
    const container = document.getElementById('scoreHistory');
    
    let gameTitle;
    switch(gameType) {
        case 'quiz': gameTitle = 'Quiz - Écriture'; break;
        case 'dragQuiz': gameTitle = 'Quiz - Audio'; break;
        case 'puzzle': gameTitle = 'Puzzle'; break;
        default: gameTitle = 'Inconnu';
    }
    
    if (history.length === 0) {
        container.innerHTML = `
            <h3 class="font-bold text-lg mb-2">${gameTitle}</h3>
            <p class="text-gray-500">Aucun historique pour ce jeu</p>`;
        return;
    }
    
    container.innerHTML = `<h3 class="font-bold text-lg mb-2">${gameTitle}</h3>`;
    
    history.forEach(attempt => {
        const div = document.createElement('div');
        div.className = 'flex justify-between items-center bg-gray-50 p-2 rounded-lg mb-2';
        div.innerHTML = `
            <div class="flex items-center gap-2">
                <span class="font-bold">Essai #${attempt.number}</span>
                <span class="text-sm text-gray-500">${attempt.date}</span>
            </div>
            <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full">
                ${attempt.score}/${attempt.total}
            </span>
        `;
        container.appendChild(div);
    });
}

function clearHistory() {
    localStorage.removeItem('quizHistory');
    localStorage.removeItem('dragQuizHistory');
    localStorage.removeItem('puzzleHistory');
    
    currentQuizAttempt = 1;
    currentDragQuizAttempt = 1;
    currentPuzzleAttempt = 1;
    
    showScoreHistory(currentScoreCategory);
}

// Initialisation au chargement
document.addEventListener('DOMContentLoaded', function() {
    showSection('lesson'); // Section par défaut
    showScoreCategory('quiz'); // Catégorie de score par défaut
    
    // Extraction des animaux pour les jeux
    allAnimals = [];
    document.querySelectorAll('[id^="modal-"]').forEach(modal => {
        if (!modal.id) return;
        
        const id = modal.id.replace('modal-', '');
        const nomElement = modal.querySelector('h2');
        const imageElement = modal.querySelector('img');
        const sonElement = document.getElementById(`son-${id}`);
        
        if (nomElement && imageElement && sonElement) {
            const nom = nomElement.textContent;
            const image = imageElement.src;
            const son = sonElement.querySelector('source').src;
            
            allAnimals.push({ id, nom, image, son });
        }
    });
});
    </script>

    <style>
        .section {
            display: none;
        }
        .section.active {
            display: block;
        }
        [id^="modal-"] {
            transition: opacity 0.3s;
        }
        body {
            background-image: url(http://p1.pichost.me/i/11/1344899.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
        }

        .button2 {
            -webkit-transition: all 200ms cubic-bezier(0.390, 0.500, 0.150, 1.360);
            transition: all 200ms cubic-bezier(0.390, 0.500, 0.150, 1.360);
            border-radius: 9999px;
            color: rgba(30, 22, 54, 0.6);
            box-shadow: rgba(30, 22, 54, 0.4) 0 0px 0px 2px inset;
            background-color: #eab308; 
        }

        .button2:hover {
            color: rgba(255, 255, 255, 0.85);
            box-shadow: rgba(30, 22, 54, 0.7) 0 80px 0px 2px inset;
            background-color: #ca8a04; 
        }
        img {
            max-width: 100%;
            height: auto;
        }
        option.text-green-600 { color: #16a34a; font-weight: bold; }
        option.text-red-600 { color: #dc2626; font-weight: bold; }
        
        
        #quizProgress {
            transition: width 0.5s ease-in-out;
        }
        .bg-green-100 { background-color: #dcfce7; }
        .bg-red-100 { background-color: #fee2e2; }
        .border-green-400 { border-color: #4ade80; }
        .border-red-400 { border-color: #f87171; }
        .text-green-600 { color: #16a34a; }
        .text-red-600 { color: #dc2626; }
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        #scoreHistory div {
            animation: slideIn 0.3s ease-out;
        }
        
.quiz-input {
    transition: all 0.3s ease;
}
.quiz-input.border-green-400 {
    border-width: 2px;
}
.quiz-input.border-red-400 {
    border-width: 2px;
}
#exercices-modal button {
    transition: all 0.2s ease;
}
#exercices-modal button:hover {
    transform: translateY(-2px);
}
#rating button {
    transition: all 0.2s ease;
}
#rating button.font-bold {
    transform: translateY(-2px);
}
.ring-offset-2 {
    --tw-ring-offset-width: 2px;
    box-shadow: 0 0 0 var(--tw-ring-offset-width) white, 0 0 0 calc(2px + var(--tw-ring-offset-width)) currentColor;
}
/* Styles pour la section des résultats */
#puzzle-feedback div, 
#dragQuiz-feedback div {
    transition: all 0.3s ease;
    animation: fadeIn 0.5s;
}

.dragQuiz-option {
    transition: all 0.2s ease;
}

.dragQuiz-option:hover {
    transform: scale(1.05);
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Style pour les options sélectionnées */
.ring-4 {
    box-shadow: 0 0 0 4px rgb(59 130 246);
}
    </style>
</x-app-layout>