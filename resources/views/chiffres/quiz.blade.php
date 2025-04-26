@extends('components.layouts.app')

@section('title', 'Quiz des chiffres')

@section('styles')
<style>
    .quiz-container {
        max-width: 800px;
        margin: 0 auto;
    }
    .quiz-card {
        background-color: #fff;
        border-radius: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        padding: 30px;
        margin-bottom: 30px;
    }
    .question {
        font-size: 1.5rem;
        margin-bottom: 20px;
    }
    .chiffre-display {
        font-size: 5rem;
        font-weight: bold;
        color: #007bff;
        text-align: center;
        margin: 20px 0;
    }
    .options {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-top: 20px;
    }
    .option-btn {
        padding: 15px;
        font-size: 1.2rem;
        border: 2px solid #dee2e6;
        border-radius: 10px;
        background-color: #f8f9fa;
        transition: all 0.3s;
    }
    .option-btn:hover {
        background-color: #e9ecef;
    }
    .option-btn.correct {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
    }
    .option-btn.incorrect {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }
    .feedback {
        margin-top: 20px;
        padding: 15px;
        border-radius: 10px;
        text-align: center;
        font-size: 1.2rem;
        display: none;
    }
    .feedback.correct {
        background-color: #d4edda;
        color: #155724;
    }
    .feedback.incorrect {
        background-color: #f8d7da;
        color: #721c24;
    }
    .progress-container {
        margin-bottom: 20px;
    }
    .results {
        text-align: center;
        padding: 20px;
        display: none;
    }
    .score {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 20px;
    }
</style>
@endsection

@section('content')
    <h2 class="text-center mb-4">Quiz des chiffres</h2>
    
    <!-- Élément caché contenant les données des chiffres -->
    <div id="chiffres" data-chiffres='@json($chiffres)' style="display: none;"></div>
    
    <div class="quiz-container">
        <div class="progress-container">
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="progress-bar">0%</div>
            </div>
        </div>
        
        <div class="quiz-card" id="quiz-card">
            <div class="question" id="question"></div>
            <div class="chiffre-display" id="chiffre-display"></div>
            <div class="options" id="options-container"></div>
            <div class="feedback" id="feedback"></div>
            <button class="btn btn-primary mt-3 d-none" id="next-question">Question suivante</button>
        </div>
        
        <div class="results" id="results">
            <div class="score" id="score"></div>
            <button class="btn btn-primary" id="restart-quiz">Recommencer le quiz</button>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Données des chiffres - Correction pour récupérer correctement les données JSON
        const allChiffres = JSON.parse(document.getElementById('chiffres').getAttribute('data-chiffres'));
        let chiffres = [...allChiffres]; // Copie pour pouvoir modifier
        let currentQuestionIndex = 0;
        let correctAnswers = 0;
        let totalQuestions = 5;
        
        // Mélanger les chiffres
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }
        
        // Générer des options pour chaque question
        function generateOptions(correctChiffre) {
            let options = [correctChiffre];
            let availableChiffres = allChiffres.filter(c => c.id !== correctChiffre.id);
            shuffleArray(availableChiffres);
            
            // Ajouter 3 options incorrectes
            for (let i = 0; i < 3 && i < availableChiffres.length; i++) {
                options.push(availableChiffres[i]);
            }
            
            return shuffleArray(options);
        }
        
        // Afficher une question
        function showQuestion() {
            if (currentQuestionIndex >= chiffres.length) {
                showResults();
                return;
            }
            
            const currentChiffre = chiffres[currentQuestionIndex];
            const options = generateOptions(currentChiffre);
            
            // Mise à jour de l'UI
            $('#question').text(`Quel est ce chiffre ?`);
            $('#chiffre-display').text(currentChiffre.valeur);
            
            // Créer les boutons d'options
            const optionsContainer = $('#options-container');
            optionsContainer.empty();
            
            options.forEach(option => {
                const button = $('<button>')
                    .addClass('option-btn')
                    .text(option.nom)
                    .attr('data-id', option.id)
                    .click(function() {
                        checkAnswer(option.id, currentChiffre.id);
                    });
                optionsContainer.append(button);
            });
            
            // Mise à jour de la progression
            const progress = (currentQuestionIndex / totalQuestions) * 100;
            $('#progress-bar').css('width', `${progress}%`).text(`${progress}%`);
            
            // Réinitialiser le feedback
            $('#feedback').removeClass('correct incorrect').hide();
            $('#next-question').addClass('d-none');
        }
        
        // Vérifier la réponse
        function checkAnswer(selectedId, correctId) {
            // Désactiver les boutons
            $('.option-btn').prop('disabled', true);
            
            const isCorrect = selectedId === correctId;
            const feedback = $('#feedback');
            
            if (isCorrect) {
                correctAnswers++;
                feedback.text('Correct !').addClass('correct').removeClass('incorrect').show();
                $(`.option-btn[data-id="${selectedId}"]`).addClass('correct');
            } else {
                feedback.text('Incorrect. La bonne réponse est : ' + 
                    chiffres[currentQuestionIndex].nom).addClass('incorrect').removeClass('correct').show();
                $(`.option-btn[data-id="${selectedId}"]`).addClass('incorrect');
                $(`.option-btn[data-id="${correctId}"]`).addClass('correct');
            }
            
            // Afficher le bouton suivant
            $('#next-question').removeClass('d-none');
        }
        
        // Passer à la question suivante
        $('#next-question').click(function() {
            currentQuestionIndex++;
            showQuestion();
        });
        
        // Afficher les résultats
        function showResults() {
            $('#quiz-card').hide();
            $('#results').show();
            $('#score').text(`Score: ${correctAnswers}/${totalQuestions}`);
        }
        
        // Redémarrer le quiz
        $('#restart-quiz').click(function() {
            chiffres = shuffleArray([...allChiffres]).slice(0, totalQuestions);
            currentQuestionIndex = 0;
            correctAnswers = 0;
            $('#quiz-card').show();
            $('#results').hide();
            showQuestion();
        });
        
        // Initialisation
        chiffres = shuffleArray([...allChiffres]).slice(0, totalQuestions);
        showQuestion();
    });
</script>
@endsection