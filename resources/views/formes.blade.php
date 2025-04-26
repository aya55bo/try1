<x-app-layout>
<x-slot name="header">
        <div class="bg-gradient-to-r from-pink-100 to-blue-100 p-6 rounded-xl shadow-md">
            <div class="flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="px-6 py-2 bg-gray-400 text-white rounded-full hover:bg-gray-500 transition">
                    ⬅️ Retour à l'accueil
                </a>

                <h1 class="text-3xl font-bold text-pink-800">
                    🎉 Apprends les formes géometriques  
                    <span class="ml-2 inline-block bg-blue-400 text-white px-2 py-1 rounded-lg text-sm">abc</span>
                </h1>
            </div>
        </div>
    </x-slot>

    <div class="flex flex-col items-center space-y-6 bg-gradient-to-br from-blue-100 to-yellow-100 min-h-screen py-10">
        <!-- Cartes d'apprentissage -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4">
            @foreach ($formes as $forme)
                <div class="bg-white rounded-2xl shadow-md p-4 text-center hover:scale-105 transition">
                    <h2 class="text-xl font-bold text-blue-600">{{ $forme['nom'] }}</h2>
                    <img src="{{ asset('images/formes/' . $forme['image']) }}" class="w-24 h-24 mx-auto my-2 object-contain" />
                    <button onclick="playSound('{{ asset('sons/formes/' . $forme['son']) }}')" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600">
                        🔊 Écouter
                    </button>
                </div>
            @endforeach
        </div>

        <!-- Boutons -->
        <div class="mt-6 space-x-4">
            <button onclick="startFormesLearnMode()" class="px-6 py-3 bg-orange-500 text-white font-semibold rounded-full hover:bg-orange-600">📘 Apprendre</button>
            <button onclick="startMemoryGame()" class="px-6 py-3 bg-purple-600 text-white font-semibold rounded-full hover:bg-purple-700">🧠 Memory</button>
            <button onclick="startQuizFormes()" class="px-6 py-3 bg-green-600 text-white font-semibold rounded-full hover:bg-green-700">🧠 Quiz</button>
        </div>
    </div>

    <!-- Modal Apprendre -->
    <div id="formes-learn-modal" class="fixed inset-0 bg-black bg-opacity-70 hidden items-center justify-center z-50 flex">
        <div class="bg-white rounded-2xl p-8 text-center shadow-2xl max-w-md w-full">
            <h2 class="text-2xl font-bold text-orange-500 mb-4">Découvre la forme 📘</h2>
            <h3 id="learn-formes-nom" class="text-4xl text-blue-600 mb-4 font-bold"></h3>
            <img id="learn-formes-image" src="" class="w-32 h-32 mx-auto mb-4 rounded-xl shadow">
            <div class="flex justify-between mt-4 space-x-2">
                <button onclick="closeFormesLearnMode()" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-full">Quitter</button>
                <button onclick="nextFormesLearn()" class="px-4 py-2 bg-orange-500 text-white rounded-full hover:bg-orange-600">Suivant</button>
                <button onclick="loopSound('/sons/formes/' + currentFormeSonFile)" class="px-4 py-2 bg-yellow-400 text-white rounded-full hover:bg-yellow-500">🔁 Réécouter</button>
            </div>
        </div>
    </div>

    <!-- Modal Quiz -->
    <div id="quiz-formes-zone" class="fixed inset-0 bg-black bg-opacity-70 hidden items-center justify-center z-50 flex">
        <div class="bg-white p-6 rounded-2xl shadow-xl text-center space-y-4 max-w-md w-full">
            <h2 class="text-2xl font-bold text-green-700">🧠 Quelle est cette forme ?</h2>
            <img id="quiz-forme-image" src="" class="w-32 h-32 mx-auto rounded-xl shadow" />
            <div id="quiz-formes-options" class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4"></div>
            <div id="quiz-formes-feedback" class="font-semibold text-lg mt-2 hidden"></div>
            <div class="flex justify-center gap-4">
                <button onclick="startQuizFormes()" class="px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-600">⏭️ Suivant</button>
                <button onclick="fermerQuizFormes()" class="px-4 py-2 bg-gray-400 text-white rounded-full hover:bg-gray-500">Quitter</button>
            </div>
        </div>
    </div>

    <!-- Modal Memory Game -->
    <div id="memory-game-zone" class="fixed inset-0 bg-black bg-opacity-70 hidden items-center justify-center z-50 flex">
        <div class="bg-white p-6 rounded-2xl shadow-xl text-center max-w-4xl w-full">
            <h2 class="text-2xl font-bold text-purple-700 mb-6">🧠 Trouve les paires de formes identiques</h2>
            <div id="memory-board" class="grid grid-cols-4 gap-4 justify-items-center mb-6"></div>
            <button onclick="closeMemoryGame()" class="bg-gray-500 text-white px-6 py-2 rounded-full hover:bg-gray-600">Quitter</button>
        </div>
    </div>

    <script>
        let formes = @json($formes);
        let currentFormeIndex = 0;
        let currentFormeSonFile = null;
        let audioLoop = null;

        function playSound(url) {
            const audio = new Audio(url);
            audio.play();
        }

        function loopSound(url) {
            if (audioLoop) audioLoop.pause();
            audioLoop = new Audio(url);
            audioLoop.play();
        }

        function startFormesLearnMode() {
            currentFormeIndex = 0;
            document.getElementById('formes-learn-modal').classList.remove('hidden');
            showFormesLearn();
        }

        function showFormesLearn() {
            const f = formes[currentFormeIndex];
            if (!f) return;
            currentFormeSonFile = f.son;
            document.getElementById('learn-formes-nom').textContent = f.nom;
            document.getElementById('learn-formes-image').src = "/images/formes/" + f.image;
            loopSound("/sons/formes/" + f.son);
        }

        function nextFormesLearn() {
            currentFormeIndex = (currentFormeIndex + 1) % formes.length;
            showFormesLearn();
        }

        function closeFormesLearnMode() {
            document.getElementById('formes-learn-modal').classList.add('hidden');
            if (audioLoop) audioLoop.pause();
        }

        function startQuizFormes() {
            const shuffled = [...formes].sort(() => 0.5 - Math.random());
            const current = shuffled[0];
            const autres = formes.filter(f => f.nom !== current.nom).sort(() => 0.5 - Math.random()).slice(0, 2);
            const options = [current.nom, ...autres.map(f => f.nom)].sort(() => 0.5 - Math.random());

            document.getElementById("quiz-forme-image").src = "/images/formes/" + current.image;
            const zone = document.getElementById("quiz-formes-options");
            zone.innerHTML = '';
            options.forEach(nom => {
                const btn = document.createElement("button");
                btn.textContent = nom;
                btn.className = "bg-gray-200 px-4 py-2 rounded-full hover:bg-gray-300";
                btn.onclick = () => checkQuizFormes(nom, current.nom);
                zone.appendChild(btn);
            });
            document.getElementById("quiz-formes-feedback").classList.add("hidden");
            document.getElementById("quiz-formes-zone").classList.remove("hidden");
        }

        function checkQuizFormes(selected, correct) {
            const feedback = document.getElementById("quiz-formes-feedback");
            feedback.textContent = selected === correct ? "✅ Bravo !" : "❌ C'était : " + correct;
            feedback.className = selected === correct ? "text-green-600 font-semibold mt-2" : "text-red-600 font-semibold mt-2";
            feedback.classList.remove("hidden");
        }

        function fermerQuizFormes() {
            document.getElementById("quiz-formes-zone").classList.add("hidden");
        }

        // MEMORY GAME
        let memoryFirst = null, memorySecond = null;
        function startMemoryGame() {
            const board = document.getElementById('memory-board');
            let cards = [...formes, ...formes].map(f => ({...f, id: Math.random()}));
            cards.sort(() => 0.5 - Math.random());

            board.innerHTML = '';
            cards.forEach((card, idx) => {
                const div = document.createElement("div");
                div.className = "w-20 h-20 bg-blue-200 rounded-xl flex items-center justify-center cursor-pointer shadow";
                div.dataset.nom = card.nom;
                div.dataset.id = card.id;
                div.innerHTML = `<img src="/images/formes/${card.image}" class="w-16 h-16 hidden" />`;
                div.onclick = () => flipMemoryCard(div);
                board.appendChild(div);
            });
            document.getElementById("memory-game-zone").classList.remove("hidden");
        }

        function flipMemoryCard(card) {
            if (card.classList.contains("matched") || card === memoryFirst) return;
            const img = card.querySelector("img");
            img.classList.remove("hidden");

            if (!memoryFirst) {
                memoryFirst = card;
            } else {
                memorySecond = card;
                if (memoryFirst.dataset.nom === memorySecond.dataset.nom) {
                    memoryFirst.classList.add("matched");
                    memorySecond.classList.add("matched");
                    memoryFirst = memorySecond = null;
                } else {
                    setTimeout(() => {
                        memoryFirst.querySelector("img").classList.add("hidden");
                        memorySecond.querySelector("img").classList.add("hidden");
                        memoryFirst = memorySecond = null;
                    }, 800);
                }
            }
        }

        function closeMemoryGame() {
            document.getElementById("memory-game-zone").classList.add("hidden");
            memoryFirst = memorySecond = null;
        }
    </script>
</x-app-layout>
