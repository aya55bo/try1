@extends('components.layouts.app')

@section('title', 'Apprendre les chiffres')

@section('styles')
<style>
    .learning-container {
        max-width: 800px;
        margin: 0 auto;
    }
    .chiffre-display {
        text-align: center;
        padding: 30px;
        background-color: #fff;
        border-radius: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }
    .chiffre-value {
        font-size: 10rem;
        font-weight: bold;
        color: #007bff;
        line-height: 1;
    }
    .chiffre-name {
        font-size: 3rem;
        margin-bottom: 20px;
        color: #6c757d;
    }
    .controls {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
    }
    .control-btn {
        font-size: 1.5rem;
        padding: 10px 30px;
    }
    .dots-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        gap: 10px;
    }
    .dot {
        width: 15px;
        height: 15px;
        border-radius: 50%;
        background-color: #dee2e6;
        cursor: pointer;
    }
    .dot.active {
        background-color: #007bff;
    }
    .chiffre-description {
        margin-top: 20px;
        font-size: 1.2rem;
    }
</style>
@endsection

@section('content')
    <h2 class="text-center mb-4">Apprendre les chiffres</h2>
    
    <!-- Élément caché pour stocker les données des chiffres -->
    <div id="chiffres-data" data-chiffres="{{ json_encode($chiffres) }}" style="display: none;"></div>
    
    <div class="learning-container">
        <div class="chiffre-display">
            <div class="chiffre-value" id="current-value"></div>
            <div class="chiffre-name" id="current-name"></div>
            <div class="chiffre-description" id="current-description"></div>
            
            <div class="text-center my-4">
                <button class="btn btn-success btn-lg play-sound" id="play-sound">
                    <i class="fas fa-volume-up"></i> Écouter
                </button>
                <audio id="audio-player"></audio>
            </div>
            
            <div class="controls">
                <button class="btn btn-primary control-btn" id="prev-btn">« Précédent</button>
                <button class="btn btn-primary control-btn" id="next-btn">Suivant »</button>
            </div>
            
            <div class="dots-container" id="dots-container"></div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Récupérer les données des chiffres depuis l'élément HTML caché
        const chiffres = JSON.parse($('#chiffres-data').attr('data-chiffres'));
        let currentIndex = 0;
        
        // Initialisation de la page
        function showCurrentChiffre() {
            const chiffre = chiffres[currentIndex];
            $('#current-value').text(chiffre.valeur);
            $('#current-name').text(chiffre.nom);
            $('#current-description').text(chiffre.description);
            $('#audio-player').attr('src', '/' + chiffre.son_path);
            
            // Mise à jour des points de navigation
            $('.dot').removeClass('active');
            $(`.dot[data-index="${currentIndex}"]`).addClass('active');
        }
        
        // Création des points de navigation
        function createDots() {
            const dotsContainer = $('#dots-container');
            dotsContainer.empty();
            
            chiffres.forEach((_, index) => {
                const dot = $('<div>').addClass('dot').attr('data-index', index);
                if (index === currentIndex) {
                    dot.addClass('active');
                }
                dot.click(function() {
                    currentIndex = parseInt($(this).attr('data-index'));
                    showCurrentChiffre();
                });
                dotsContainer.append(dot);
            });
        }
        
        // Événements des boutons
        $('#next-btn').click(function() {
            currentIndex = (currentIndex + 1) % chiffres.length;
            showCurrentChiffre();
        });
        
        $('#prev-btn').click(function() {
            currentIndex = (currentIndex - 1 + chiffres.length) % chiffres.length;
            showCurrentChiffre();
        });
        
        $('#play-sound').click(function() {
            const audio = document.getElementById('audio-player');
            audio.play();
        });
        
        // Initialisation
        createDots();
        showCurrentChiffre();
    });
</script>
@endsection