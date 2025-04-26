<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quiz des chiffres') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl mb-6 text-center">Trouvez le bon chiffre !</h1>
                    
                    <div id="quiz-container">
                        <div class="mb-8 text-center">
                            <div id="score" class="text-lg font-bold mb-4">Score: 0</div>
                            <div id="question" class="text-xl mb-2">Quel est ce chiffre ?</div>
                            <div id="current-number" class="text-6xl font-bold mb-6">?</div>
                            
                            <div id="options" class="grid grid-cols-2 md:grid-cols-3 gap-4 max-w-lg mx-auto">
                                <!-- Les options seront générées en JS -->
                            </div>
                            
                            <div id="feedback" class="mt-6 text-2xl font-bold hidden"></div>
                            
                            <button id="next-btn" class="mt-8 bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg hidden">
                                Question suivante
                            </button>
                        </div>
                    </div>
                    
                    <div id="final-score" class="text-center hidden">
                        <h2 class="text-2xl mb-4">Quiz terminé !</h2>
                        <p class="text-xl mb-6">Votre score final est : <span id="final-score-value">0</span>/5</p>
                        <button id="restart-btn" class="bg-green-500 hover:bg-green-600 text-white py-2 px-6 rounded-lg">
                            Recommencer le quiz
                        </button>
                        <a href="{{ route('chiffres.index') }}" class="inline-block mt-4 bg-gray-500 hover:bg-gray-600 text-white py-2 px-6 rounded-lg">
                            Retour aux chiffres
                        </a>
                    </div>
                    
                    <audio id="correct-sound" src="{{ asset('sons/correct.mp3') }}"></audio>
                    <audio id="wrong-sound" src="{{ asset('sons/wrong.mp3') }}"></audio>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chiffres = [
                { valeur: 0, nom: 'Zéro' },
                { valeur: 1, nom: 'Un' },
                { valeur: 2, nom: 'Deux' },
                { valeur: 3, nom: 'Trois' },
                { valeur: 4, nom: 'Quatre' },
                { valeur: 5, nom: 'Cinq' },
                { valeur: 6, nom: 'Six' },
                { valeur: 7, nom: 'Sept' },
                { valeur: 8, nom: 'Huit' },
                { valeur: 9, nom: 'Neuf' },
                { valeur: 10, nom: 'Dix' },
                { valeur: 11, nom: 'Onze' },
                { valeur: 12, nom: 'Douze' },
                { valeur: 13, nom: 'Treize' },
                { valeur: 14, nom: 'Quatorze' },
                { valeur: 15, nom: 'Quinze' },
                { valeur: 16, nom: 'seize' },
                { valeur: 17, nom: 'Dix-sept' },
                { valeur: 18, nom: 'Dix-huit' },
                { valeur: 19, nom: 'Dix-Neuf' },
                { valeur: 20, nom: 'Vingt' }
            ];
            
            let currentQuestion = 0;
            let score = 0;
            let questions = [];
            
            // Générer 5 questions aléatoires
            function generateQuestions() {
                // Mélanger le tableau des chiffres
                const shuffled = [...chiffres].sort(() => 0.5 - Math.random());
                
                // Prendre les 5 premiers
                questions = shuffled.slice(0, 5);
                
                currentQuestion = 0;
                score = 0;
                document.getElementById('score').textContent = `Score: ${score}`;
                showQuestion();
            }
            
            function showQuestion() {
                const questionObj = questions[currentQuestion];
                const optionsDiv = document.getElementById('options');
                
                // Effacer le contenu précédent
                optionsDiv.innerHTML = '';
                
                // Générer des options
                let options = generateOptions(questionObj.valeur);
                
                // Afficher la question
                document.getElementById('current-number').textContent = questionObj.nom;
                
                // Créer les boutons d'options
                options.forEach(option => {
                    const button = document.createElement('button');
                    button.className = 'bg-gray-200 hover:bg-gray-300 py-3 px-4 rounded text-2xl font-bold';
                    button.textContent = option;
                    button.addEventListener('click', () => checkAnswer(option, questionObj.valeur));
                    optionsDiv.appendChild(button);
                });
                
                // Cacher le bouton suivant et le feedback
                document.getElementById('next-btn').classList.add('hidden');
                document.getElementById('feedback').classList.add('hidden');
            }
            
            function generateOptions(correctAnswer) {
                let options = [correctAnswer];
                
                // Générer 3 options différentes
                while (options.length < 4) {
                    const rnd = Math.floor(Math.random() * 11); // 0 à 10
                    if (!options.includes(rnd)) {
                        options.push(rnd);
                    }
                }
                
                // Mélanger les options
                return options.sort(() => 0.5 - Math.random());
            }
            
            function checkAnswer(selectedAnswer, correctAnswer) {
                const feedbackDiv = document.getElementById('feedback');
                const nextBtn = document.getElementById('next-btn');
                const isCorrect = parseInt(selectedAnswer) === correctAnswer;
                
                // Désactiver tous les boutons
                const buttons = document.querySelectorAll('#options button');
                buttons.forEach(button => {
                    button.disabled = true;
                    
                    // Mettre en évidence la bonne réponse et la mauvaise
                    if (parseInt(button.textContent) === correctAnswer) {
                        button.className = 'bg-green-500 text-white py-3 px-4 rounded text-2xl font-bold';
                    } else if (button.textContent === selectedAnswer.toString()) {
                        button.className = 'bg-red-500 text-white py-3 px-4 rounded text-2xl font-bold';
                    }
                });
                
                // Afficher le feedback
                feedbackDiv.textContent = isCorrect ? 'Bravo ! 🎉' : 'Essaie encore ! 😢';
                feedbackDiv.className = `mt-6 text-2xl font-bold ${isCorrect ? 'text-green-500' : 'text-red-500'}`;
                feedbackDiv.classList.remove('hidden');
                
                // Jouer le son
                const audio = document.getElementById(isCorrect ? 'correct-sound' : 'wrong-sound');
                audio.play();
                
                // Mettre à jour le score
                if (isCorrect) {
                    score++;
                    document.getElementById('score').textContent = `Score: ${score}`;
                }
                
                // Afficher le bouton suivant
                nextBtn.classList.remove('hidden');
            }
            
            function nextQuestion() {
                currentQuestion++;
                
                if (currentQuestion < questions.length) {
                    showQuestion();
                } else {
                    // Quiz terminé
                    document.getElementById('quiz-container').classList.add('hidden');
                    document.getElementById('final-score').classList.remove('hidden');
                    document.getElementById('final-score-value').textContent = score;
                }
            }
            
            // Configurer les événements
            document.getElementById('next-btn').addEventListener('click', nextQuestion);
            document.getElementById('restart-btn').addEventListener('click', function() {
                document.getElementById('quiz-container').classList.remove('hidden');
                document.getElementById('final-score').classList.add('hidden');
                generateQuestions();
            });
            
            // Démarrer le quiz
            generateQuestions();
        });
    </script>
</x-app-layout>