<x-app-layout>
<x-slot name="header">
        <div class="bg-gradient-to-r from-pink-100 to-blue-100 p-6 rounded-xl shadow-md">
            <div class="flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="px-6 py-2 bg-gray-400 text-white rounded-full hover:bg-gray-500 transition">
                    ⬅️ Retour à l'accueil
                </a>

                <h1 class="text-3xl font-bold text-pink-800">
                    🎉 Apprends l'Alphabet 
                    <span class="ml-2 inline-block bg-blue-400 text-white px-2 py-1 rounded-lg text-sm">abc</span>
                </h1>
            </div>
        </div>
    </x-slot>


    <div class="flex flex-col items-center space-y-6 bg-gradient-to-br from-green-100 to-blue-100 min-h-screen py-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4">
            @foreach ($alphabets as $alphabet)
                <div class="bg-white rounded-2xl shadow-md p-4 text-center hover:scale-105 transition">
                    <h2 class="text-2xl font-bold text-green-600">{{ $alphabet->lettre }}</h2>
                    <img src="{{ asset('images/alphabet/' . $alphabet->image) }}" class="w-24 h-24 mx-auto my-2 object-contain" />
                    
                    <button onclick="playSound('{{ asset('sons/' . $alphabet->son) }}')" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600">
                        🔊 Écouter
                    </button>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $alphabets->links() }}
            <button onclick="startImageGame()" class="mt-4 px-6 py-3 bg-fuchsia-500 text-white font-semibold rounded-full shadow-md hover:bg-fuchsia-600 transition-all">
                🧠 Jeu : Trouve la lettre !
            </button>
            <!-- Nouveau jeu : Deviner le son -->
<button onclick="startSoundGame()" class="mt-4 px-6 py-3 bg-indigo-500 text-white font-semibold rounded-full shadow-md hover:bg-indigo-600 transition-all">
    🎧 Jeu : Devine le son !
</button>
<!-- Nouveau mode d'apprentissage -->
<button onclick="startLearnMode()" class="mt-4 px-6 py-3 bg-orange-500 text-white font-semibold rounded-full shadow-md hover:bg-orange-600 transition-all">
    📖 Apprendre les lettres
</button>

        </div>
    </div>

    <!-- Modal du mini-jeu -->
    <div id="image-game-modal" class="fixed inset-0 bg-black bg-opacity-70 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-8 text-center shadow-2xl max-w-md w-full">
            <h2 class="text-2xl font-bold text-pink-600 mb-4">Quelle lettre est-ce ? 🤔</h2>
            <img id="game-letter-image" src="" alt="Lettre à deviner" class="w-32 h-32 mx-auto mb-4 rounded-xl shadow-md border border-gray-300">
            <div id="image-game-options" class="grid grid-cols-2 gap-4 mb-4"></div>
            <div id="game-result-message" class="text-lg font-semibold mb-2"></div>
            <div class="flex justify-between mt-2 space-x-4">
                <button onclick="closeImageGame()" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-full">Quitter</button>
                <button id="next-button" onclick="nextImageGameRound()" class="px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 hidden">Suivant</button>
            </div>
        </div>
    </div>
<!-- Modal du jeu : Deviner le son -->
<div id="sound-game-modal" class="fixed inset-0 bg-black bg-opacity-70 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-8 text-center shadow-2xl max-w-md w-full">
        <h2 class="text-2xl font-bold text-indigo-600 mb-4">Quel son as-tu entendu ? 👂</h2>
        <div id="sound-game-options" class="grid grid-cols-2 gap-4 mb-4"></div>
        <div id="sound-game-result-message" class="text-lg font-semibold mb-2"></div>
        <div class="flex justify-between mt-2 space-x-4">
            <button onclick="closeSoundGame()" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-full">Quitter</button>
            <button id="next-sound-button" onclick="nextSoundGameRound()" class="px-4 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 hidden">Suivant</button>
            <button onclick="loopSound('/sons/' + currentSonFile)" class="px-4 py-2 bg-yellow-400 text-white rounded-full hover:bg-yellow-500">🔁 Réécouter</button>

        </div>
    </div>
</div>

<script>
    let currentAnswer = null;
    let currentLoopAudio = null;
    let currentSonFile = null;
    let currentLearnSonFile = null;
    let currentLearnIndex = 0;
    let alphabets = @json($alphabets->items());

    function playSound(url) {
        const audio = new Audio(url);
        audio.play();
    }

    function loopSound(url) {
        if (currentLoopAudio) {
            currentLoopAudio.pause();
            currentLoopAudio = null;
        }
        currentLoopAudio = new Audio(url);
        currentLoopAudio.play();
    }

    // 🎮 Jeu avec image
    function startImageGame() {
        document.getElementById('image-game-modal').classList.remove('hidden');
        document.getElementById('image-game-modal').classList.add('flex');
        loadNewGameRound();
    }

    function loadNewGameRound() {
        const imageElement = document.getElementById('game-letter-image');
        const optionsContainer = document.getElementById('image-game-options');
        const messageDiv = document.getElementById('game-result-message');
        const nextBtn = document.getElementById('next-button');

        messageDiv.textContent = '';
        nextBtn.classList.add('hidden');

        const correct = alphabets[Math.floor(Math.random() * alphabets.length)];
        currentAnswer = correct.lettre;

        imageElement.src = "/images/alphabet/" + correct.image;

        let options = [correct.lettre];
        while (options.length < 4) {
            const rand = alphabets[Math.floor(Math.random() * alphabets.length)].lettre;
            if (!options.includes(rand)) {
                options.push(rand);
            }
        }

        options.sort(() => Math.random() - 0.5);
        optionsContainer.innerHTML = '';

        options.forEach(letter => {
            const btn = document.createElement('button');
            btn.className = "bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded-xl transition-all";
            btn.innerText = letter;
            btn.onclick = () => {
                if (letter === currentAnswer) {
                    messageDiv.textContent = "✅ Bravo !";
                    messageDiv.className = "text-green-600 font-bold mb-2";
                    nextBtn.classList.remove('hidden');
                } else {
                    messageDiv.textContent = "❌ Essaie encore !";
                    messageDiv.className = "text-red-600 font-bold mb-2";
                }
            };
            optionsContainer.appendChild(btn);
        });
    }

    function closeImageGame() {
        document.getElementById('image-game-modal').classList.add('hidden');
    }

    function nextImageGameRound() {
        loadNewGameRound();
    }

    // 🔊 Jeu sonore
    function startSoundGame() {
        document.getElementById('sound-game-modal').classList.remove('hidden');
        document.getElementById('sound-game-modal').classList.add('flex');
        loadNewSoundGameRound();
    }

    function loadNewSoundGameRound() {
        const optionsContainer = document.getElementById('sound-game-options');
        const messageDiv = document.getElementById('sound-game-result-message');
        const nextBtn = document.getElementById('next-sound-button');

        messageDiv.textContent = '';
        nextBtn.classList.add('hidden');

        const correct = alphabets[Math.floor(Math.random() * alphabets.length)];
        currentAnswer = correct.lettre;
        currentSonFile = correct.son;

        loopSound("/sons/" + currentSonFile);

        let options = [correct.lettre];
        while (options.length < 4) {
            const rand = alphabets[Math.floor(Math.random() * alphabets.length)].lettre;
            if (!options.includes(rand)) {
                options.push(rand);
            }
        }

        options.sort(() => Math.random() - 0.5);
        optionsContainer.innerHTML = '';

        options.forEach(letter => {
            const btn = document.createElement('button');
            btn.className = "bg-purple-400 hover:bg-purple-500 text-white font-bold py-2 px-4 rounded-xl transition-all";
            btn.innerText = letter;
            btn.onclick = () => {
                if (letter === currentAnswer) {
                    messageDiv.textContent = "✅ Bravo !";
                    messageDiv.className = "text-green-600 font-bold mb-2";
                    nextBtn.classList.remove('hidden');
                } else {
                    messageDiv.textContent = "❌ Mauvaise réponse !";
                    messageDiv.className = "text-red-600 font-bold mb-2";
                }
            };
            optionsContainer.appendChild(btn);
        });
    }

    function closeSoundGame() {
        document.getElementById('sound-game-modal').classList.add('hidden');
        if (currentLoopAudio) {
            currentLoopAudio.pause();
            currentLoopAudio = null;
        }
    }

    function nextSoundGameRound() {
        loadNewSoundGameRound();
    }

    // 🧠 Mode Apprentissage
    function startLearnMode() {
        currentLearnIndex = 0;
        document.getElementById('learn-mode-modal').classList.remove('hidden');
        document.getElementById('learn-mode-modal').classList.add('flex');
        showLearnLetter();
    }

    function showLearnLetter() {
        const letterData = alphabets[currentLearnIndex];
        if (!letterData) return;

        document.getElementById('learn-letter').textContent = letterData.lettre;
        document.getElementById('learn-image').src = "/images/alphabet/" + letterData.image;

        currentLearnSonFile = letterData.son;
        loopSound("/sons/" + currentLearnSonFile);
    }

    function nextLearnLetter() {
        currentLearnIndex++;
        if (currentLearnIndex >= alphabets.length) currentLearnIndex = 0;
        showLearnLetter();
    }

    function closeLearnMode() {
        document.getElementById('learn-mode-modal').classList.add('hidden');
        if (currentLoopAudio) {
            currentLoopAudio.pause();
            currentLoopAudio = null;
        }
    }
</script>

    <!-- Modal du mode apprentissage -->
<div id="learn-mode-modal" class="fixed inset-0 bg-black bg-opacity-70 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-8 text-center shadow-2xl max-w-md w-full">
        <h2 class="text-2xl font-bold text-orange-500 mb-4">Découvre la lettre 🧠</h2>
        <h3 id="learn-letter" class="text-5xl text-green-600 mb-4 font-bold">A</h3>
        <img id="learn-image" src="" alt="Image de la lettre" class="w-32 h-32 mx-auto mb-4 rounded-xl shadow border border-gray-300">
        <div class="flex justify-between mt-4 space-x-4">
            <button onclick="closeLearnMode()" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-full">Quitter</button>
            <button onclick="nextLearnLetter()" class="px-4 py-2 bg-orange-500 text-white rounded-full hover:bg-orange-600">Suivant</button>
            <button onclick="loopSound('/sons/' + currentLearnSonFile)" class="px-4 py-2 bg-yellow-400 text-white rounded-full hover:bg-yellow-500">🔁 Réécouter</button>

        </div>
    </div>
</div>

</x-app-layout> 