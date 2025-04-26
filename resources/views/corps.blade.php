<x-app-layout>
<x-slot name="header">
        <div class="bg-gradient-to-r from-pink-100 to-blue-100 p-6 rounded-xl shadow-md">
            <div class="flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="px-6 py-2 bg-gray-400 text-white rounded-full hover:bg-gray-500 transition">
                    ⬅️ Retour à l'accueil
                </a>

                <h1 class="text-3xl font-bold text-pink-800">
                    🎉 Apprends les parties du corps  
                    <span class="ml-2 inline-block bg-blue-400 text-white px-2 py-1 rounded-lg text-sm">abc</span>
                </h1>
            </div>
        </div>
    </x-slot>

    <div class="flex flex-col items-center space-y-6 bg-gradient-to-br from-pink-100 to-blue-100 min-h-screen py-10">
        <!-- Cartes d'apprentissage -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4">
            @foreach ($parties as $partie)
                <div class="bg-white rounded-2xl shadow-md p-4 text-center hover:scale-105 transition">
                    <h2 class="text-xl font-bold text-pink-600">{{ $partie['nom'] }}</h2>
                    <img src="{{ asset('images/corps/' . $partie['image']) }}" class="w-24 h-24 mx-auto my-2 object-contain" />
                    <button onclick="playSound('{{ asset('sons/corps/' . $partie['son']) }}')" class="mt-2 bg-pink-500 text-white px-4 py-2 rounded-full hover:bg-pink-600">
                        🔊 Écouter
                    </button>
                </div>
            @endforeach
        </div>

        <!-- Boutons d'action -->
        <div class="mt-6 space-x-4">
            <button onclick="startCorpsLearnMode()" class="px-6 py-3 bg-orange-500 text-white font-semibold rounded-full shadow-md hover:bg-orange-600 transition-all">
                📘 Apprendre
            </button>
            <button onclick="afficherPuzzle()" class="px-6 py-3 bg-purple-600 text-white font-semibold rounded-full shadow-md hover:bg-purple-700 transition-all">
                🧩 Puzzle
            </button>
            <button onclick="startQuizCorps()" class="px-6 py-3 bg-green-600 text-white font-semibold rounded-full shadow-md hover:bg-green-700 transition-all">
                🧠 Quiz
            </button>
        </div>
    </div>

    <!-- Modal Mode Apprentissage -->
    <div id="corps-learn-modal" class="fixed inset-0 bg-black bg-opacity-70 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-8 text-center shadow-2xl max-w-md w-full">
            <h2 class="text-2xl font-bold text-orange-500 mb-4">Découvre la partie 📘</h2>
            <h3 id="learn-corps-nom" class="text-4xl text-pink-600 mb-4 font-bold"></h3>
            <img id="learn-corps-image" src="" class="w-32 h-32 mx-auto mb-4 rounded-xl shadow">
            <div class="flex justify-between mt-4 space-x-2 flex-wrap">
                <button onclick="closeCorpsLearnMode()" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-full">Quitter</button>
                <button onclick="nextCorpsLearn()" class="px-4 py-2 bg-orange-500 text-white rounded-full hover:bg-orange-600">Suivant</button>
                <button onclick="loopSound('/sons/corps/' + currentCorpsSonFile)" class="px-4 py-2 bg-yellow-400 text-white rounded-full hover:bg-yellow-500">🔁 Réécouter</button>
            </div>
        </div>
    </div>

    <!-- Modal Puzzle -->
    <div id="puzzle-zone" class="fixed inset-0 bg-black bg-opacity-70 hidden flex items-center justify-center z-50">

        <div class="bg-white rounded-2xl p-6 shadow-xl max-w-5xl w-full">
            <h2 class="text-2xl font-bold text-purple-700 text-center mb-6">🧩 Glisse les bonnes parties</h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-6 mb-6">
                @foreach ($parties as $partie)
                    <div class="dropzone w-full h-32 border-4 border-dashed rounded-xl flex items-center justify-center"
                         data-partie="{{ $partie['nom'] }}"
                         ondrop="dropPartie(event)" ondragover="allowDrop(event)">
                        <span class="text-gray-400">{{ $partie['nom'] }}</span>
                    </div>
                @endforeach
            </div>

            <div class="flex flex-wrap justify-center gap-4 mb-4" id="images-zone">
                @foreach ($parties as $partie)
                    <img src="{{ asset('images/corps/' . $partie['image']) }}"
                         draggable="true"
                         ondragstart="dragPartie(event)"
                         id="drag-{{ $partie['nom'] }}"
                         data-partie="{{ $partie['nom'] }}"
                         class="w-20 h-20 rounded-xl shadow-md cursor-move hover:scale-110 transition" />
                @endforeach
            </div>

            <div id="message-erreur" class="text-center text-red-600 font-semibold mb-2 hidden">❌ Mauvais endroit !</div>
            <div id="partie-puzzle-success" class="hidden mt-4 text-center text-green-600 font-bold text-xl">🎉 Bravo !</div>

            <div class="flex justify-center mt-4 gap-4">
                <button onclick="resetPartiePuzzle()" class="bg-yellow-400 text-white px-6 py-2 rounded-full shadow hover:bg-yellow-500">🔁 Rejouer</button>
                <button onclick="fermerPuzzle()" class="bg-gray-400 text-white px-6 py-2 rounded-full shadow hover:bg-gray-500">Quitter</button>
            </div>
        </div>
    </div>

    <!-- Modal Quiz -->
    <div id="quiz-zone" class="fixed inset-0 bg-black bg-opacity-70 hidden flex items-center justify-center z-50">

        <div class="bg-white p-6 rounded-2xl shadow-xl text-center space-y-4 max-w-md w-full">
            <h2 class="text-2xl font-bold text-green-700">🧠 Quel est le bon nom ?</h2>
            <img id="quiz-image" src="" class="w-32 h-32 mx-auto rounded-xl shadow" />
            <div id="quiz-options" class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4"></div>
            <div id="quiz-feedback" class="font-semibold text-lg mt-2 hidden"></div>
            <div class="flex justify-center gap-4">
                <button onclick="startQuizCorps()" class="px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-600">⏭️ Suivant</button>
                <button onclick="fermerQuiz()" class="px-4 py-2 bg-gray-400 text-white rounded-full hover:bg-gray-500">Quitter</button>
            </div>
        </div>
    </div>
   
    <!-- Scripts : inchangés -->
    <script>
        // ... Tous tes scripts JS initiaux (playSound, loopSound, drag/drop, quiz, etc.)

        function afficherPuzzle() {
            document.getElementById('puzzle-zone').classList.remove('hidden');
            document.getElementById('puzzle-zone').classList.add('flex');
            resetPartiePuzzle();
        }

        function fermerPuzzle() {
            document.getElementById('puzzle-zone').classList.add('hidden');
        }

        function fermerQuiz() {
            document.getElementById('quiz-zone').classList.add('hidden');
        }
     
        let currentCorpsIndex = 0;
        let currentCorpsSonFile = null;
        let currentCorpsLoopAudio = null;
        let corps = @json($parties);

        function playSound(url) {
            const audio = new Audio(url);
            audio.play();
        }

        function loopSound(url) {
            if (currentCorpsLoopAudio) currentCorpsLoopAudio.pause();
            currentCorpsLoopAudio = new Audio(url);
            currentCorpsLoopAudio.play();
        }

        function startCorpsLearnMode() {
            currentCorpsIndex = 0;
            document.getElementById('corps-learn-modal').classList.remove('hidden');
            document.getElementById('corps-learn-modal').classList.add('flex');
            showCorpsLearn();
        }

        function showCorpsLearn() {
            const data = corps[currentCorpsIndex];
            if (!data) return;
            currentCorpsSonFile = data.son;
            document.getElementById('learn-corps-nom').textContent = data.nom;
            document.getElementById('learn-corps-image').src = "/images/corps/" + data.image;
            loopSound("/sons/corps/" + currentCorpsSonFile);
        }

        function nextCorpsLearn() {
            currentCorpsIndex = (currentCorpsIndex + 1) % corps.length;
            showCorpsLearn();
        }

        function closeCorpsLearnMode() {
            document.getElementById('corps-learn-modal').classList.add('hidden');
            if (currentCorpsLoopAudio) currentCorpsLoopAudio.pause();
        }

        function afficherPuzzle() {
            document.getElementById('puzzle-zone').classList.remove('hidden');
            resetPartiePuzzle();
        }

        // --- Puzzle JS ---
        function allowDrop(ev) {
            ev.preventDefault();
        }

        function dragPartie(ev) {
            ev.dataTransfer.setData("partie", ev.target.dataset.partie);
            ev.dataTransfer.setData("id", ev.target.id);
        }

        function dropPartie(ev) {
            ev.preventDefault();
            document.getElementById('message-erreur').classList.add('hidden');

            const zone = ev.target.closest('.dropzone');
            const attendu = zone.dataset.partie;
            const reçu = ev.dataTransfer.getData("partie");
            const draggedId = ev.dataTransfer.getData("id");

            if (attendu === reçu) {
                const draggedElement = document.getElementById(draggedId);
                zone.innerHTML = "";
                zone.appendChild(draggedElement);
                verifierPartiePuzzle();
            } else {
                document.getElementById('message-erreur').classList.remove('hidden');
            }
        }

        function verifierPartiePuzzle() {
            const zones = document.querySelectorAll('.dropzone');
            let toutBon = true;
            zones.forEach(zone => {
                const img = zone.querySelector('img');
                if (!img || img.dataset.partie !== zone.dataset.partie) {
                    toutBon = false;
                }
            });

            if (toutBon) {
                document.getElementById('partie-puzzle-success').classList.remove('hidden');
            }
        }

        function resetPartiePuzzle() {
            const imagesZone = document.getElementById('images-zone');
            const images = [];

            // Récupérer toutes les images
            corps.forEach(partie => {
                const img = document.createElement('img');
                img.src = "/images/corps/" + partie.image;
                img.setAttribute("draggable", true);
                img.setAttribute("ondragstart", "dragPartie(event)");
                img.setAttribute("data-partie", partie.nom);
                img.id = "drag-" + partie.nom;
                img.className = "w-20 h-20 rounded-xl shadow-md cursor-move hover:scale-110 transition";
                images.push(img);
            });

            // Réinitialiser les zones
            document.querySelectorAll('.dropzone').forEach(zone => {
                zone.innerHTML = `<span class="text-gray-400">${zone.dataset.partie}</span>`;

            });

            // Mélanger et afficher les images
            images.sort(() => Math.random() - 0.5);
            imagesZone.innerHTML = '';
            images.forEach(img => imagesZone.appendChild(img));

            document.getElementById('partie-puzzle-success').classList.add('hidden');
            document.getElementById('message-erreur').classList.add('hidden');
        }
       
    let quizIndex = 0;
    let shuffledCorps = [];

    function startQuizCorps() {
        if (shuffledCorps.length === 0) {
            shuffledCorps = [...corps].sort(() => 0.5 - Math.random());
        }

        const current = shuffledCorps[quizIndex % shuffledCorps.length];
        const otherOptions = [...corps].filter(c => c.nom !== current.nom).sort(() => 0.5 - Math.random()).slice(0, 2);
        const options = [current.nom, ...otherOptions.map(c => c.nom)].sort(() => 0.5 - Math.random());

        document.getElementById("quiz-image").src = "/images/corps/" + current.image;
        document.getElementById("quiz-feedback").classList.add("hidden");

        const quizOptions = document.getElementById("quiz-options");
        quizOptions.innerHTML = '';
        options.forEach(option => {
            const btn = document.createElement('button');
            btn.textContent = option;
            btn.className = "bg-gray-200 px-4 py-2 rounded-full hover:bg-gray-300";
            btn.onclick = () => checkQuizAnswer(option, current.nom);
            quizOptions.appendChild(btn);
        });

        document.getElementById("quiz-zone").classList.remove("hidden");
        quizIndex++;
    }

     function checkQuizAnswer(selected, correct) {
        const feedback = document.getElementById("quiz-feedback");
        if (selected === correct) {
            feedback.textContent = "✅ Bravo !";
            feedback.classList.remove("text-red-600");
            feedback.classList.add("text-green-600");
        } else {
            feedback.textContent = "❌ Oups, c'était : " + correct;
            feedback.classList.remove("text-green-600");
            feedback.classList.add("text-red-600");
        }
        feedback.classList.remove("hidden");
    }
        // ... (reste du JS identique)
    </script>
</x-app-layout>
