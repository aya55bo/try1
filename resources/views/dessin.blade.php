<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeu de Dessin pour Enfants</title>
    <style>
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            background-color:rgb(236, 208, 234);
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        h1 {
            color: #FF6B6B;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        .canvas-container {
            display: flex;
            justify-content: center;
            margin: 20px auto;
        }
        #drawing-board {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            cursor: crosshair;
        }
        .tools {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 20px;
        }
        .tool-section {
            margin: 0 20px;
        }
        .color-picker {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 10px 0;
        }
        .color-option {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin: 5px;
            cursor: pointer;
            border: 2px solid #ddd;
            transition: transform 0.2s;
        }
        .color-option:hover {
            transform: scale(1.2);
        }
        .color-option.selected {
            border: 3px solid #333;
        }
        .size-slider {
            width: 200px;
            margin: 10px 0;
        }
        button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
        .eraser-button {
            background-color: #f44336;
        }
        .eraser-button:hover {
            background-color: #d32f2f;
        }
        .clear-button {
            background-color: #ff9800;
        }
        .clear-button:hover {
            background-color: #f57c00;
        }
        .download-button {
            background-color: #2196F3;
        }
        .download-button:hover {
            background-color: #0b7dda;
        }
        .stamp-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 10px 0;
        }
        .stamp {
            width: 50px;
            height: 50px;
            margin: 5px;
            cursor: pointer;
            border: 2px solid transparent;
            border-radius: 5px;
            transition: transform 0.2s;
        }
        .stamp:hover {
            transform: scale(1.1);
        }
        .stamp.selected {
            border: 2px solid #333;
        }
        .message {
            background-color: #ffe0b2;
            color: #e65100;
            padding: 10px;
            border-radius: 5px;
            margin: 10px auto;
            max-width: 400px;
            font-weight: bold;
            display: none;
        }
    </style>
</head>
<body>
    <h1>🎨 Ma Toile de Dessin 🎨</h1>
    
    <div class="tools">
        <div class="tool-section">
            <h3>Couleurs</h3>
            <div class="color-picker">
                <div class="color-option selected" style="background-color: #000000;" data-color="#000000"></div>
                <div class="color-option" style="background-color: #FF0000;" data-color="#FF0000"></div>
                <div class="color-option" style="background-color: #008000;" data-color="#008000"></div>
                <div class="color-option" style="background-color: #0000FF;" data-color="#0000FF"></div>
                <div class="color-option" style="background-color: #FFFF00;" data-color="#FFFF00"></div>
                <div class="color-option" style="background-color: #FFA500;" data-color="#FFA500"></div>
                <div class="color-option" style="background-color: #800080;" data-color="#800080"></div>
                <div class="color-option" style="background-color: #FFC0CB;" data-color="#FFC0CB"></div>
            </div>
        </div>
        
        <div class="tool-section">
            <h3>Taille du pinceau</h3>
            <input type="range" min="1" max="20" value="5" class="size-slider" id="brush-size">
            <span id="size-value">5px</span>
        </div>
    </div>
    
    <div class="tools">
        <div class="tool-section">
            <h3>Outils</h3>
            <button id="pencil-button">Crayon</button>
            <button id="eraser-button" class="eraser-button">Gomme</button>
            <button id="clear-button" class="clear-button">Tout effacer</button>
            <button id="download-button" class="download-button">Sauvegarder mon dessin</button>
        </div>
    </div>
    
    <div class="tools">
        <div class="tool-section">
        <h3>Tampons</h3>
<div class="stamp-container">
    <img src="/images/etoile.png" alt="Étoile" class="stamp" data-stamp="star">
    <img src="/images/heart.png" alt="Cœur" class="stamp" data-stamp="heart">
    <img src="/images/sun.png" alt="Soleil" class="stamp" data-stamp="sun">
    <img src="/images/lune.png" alt="Lune" class="stamp" data-stamp="moon">
</div>

        </div> 
    </div>
    
    <div class="message" id="message">Ton dessin a été sauvegardé!</div>
    
    <div class="canvas-container">
        <canvas id="drawing-board" width="800" height="500"></canvas>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const canvas = document.getElementById('drawing-board');
            const ctx = canvas.getContext('2d');
            const brushSizeSlider = document.getElementById('brush-size');
            const sizeValueDisplay = document.getElementById('size-value');
            const clearButton = document.getElementById('clear-button');
            const eraserButton = document.getElementById('eraser-button');
            const pencilButton = document.getElementById('pencil-button');
            const downloadButton = document.getElementById('download-button');
            const message = document.getElementById('message');
            
            // Variables pour le dessin
            let isDrawing = false;
            let lastX = 0;
            let lastY = 0;
            let brushColor = '#000000';
            let brushSize = 5;
            let isEraser = false;
            let activeStamp = null;
            
            // Charger l'image de fond blanc
            ctx.fillStyle = 'white';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            
            // Mise à jour de la taille du pinceau
            brushSizeSlider.addEventListener('input', function() {
                brushSize = this.value;
                sizeValueDisplay.textContent = brushSize + 'px';
            });
            
            // Sélection de couleur
            document.querySelectorAll('.color-option').forEach(option => {
                option.addEventListener('click', function() {
                    document.querySelector('.color-option.selected').classList.remove('selected');
                    this.classList.add('selected');
                    brushColor = this.getAttribute('data-color');
                    isEraser = false;
                    eraserButton.style.fontWeight = 'normal';
                    pencilButton.style.fontWeight = 'bold';
                });
            });
            
            // Fonctions de dessin
            function startDrawing(e) {
                isDrawing = true;
                [lastX, lastY] = [
                    e.clientX - canvas.getBoundingClientRect().left, 
                    e.clientY - canvas.getBoundingClientRect().top
                ];
                
                // Si un tampon est actif, l'appliquer
                if (activeStamp) {
                    applyStamp(lastX, lastY);
                    return;
                }
            }
            
            function draw(e) {
                if (!isDrawing) return;
                
                // Si un tampon est actif, ne pas dessiner
                if (activeStamp) return;
                
                const x = e.clientX - canvas.getBoundingClientRect().left;
                const y = e.clientY - canvas.getBoundingClientRect().top;
                
                ctx.beginPath();
                ctx.moveTo(lastX, lastY);
                ctx.lineTo(x, y);
                ctx.strokeStyle = isEraser ? 'white' : brushColor;
                ctx.lineWidth = brushSize;
                ctx.lineCap = 'round';
                ctx.lineJoin = 'round';
                ctx.stroke();
                
                [lastX, lastY] = [x, y];
            }
            
            function stopDrawing() {
                isDrawing = false;
            }
            
            // Application de tampons
            function applyStamp(x, y) {
                const tempImg = new Image();
                
                // Dessiner un placeholder basé sur le type de tampon
                switch(activeStamp) {
                    case 'star':
                        drawStar(x, y);
                        break;
                    case 'heart':
                        drawHeart(x, y);
                        break;
                    case 'sun':
                        drawSun(x, y);
                        break;
                    case 'moon':
                        drawMoon(x, y);
                        break;
                }
            }
            
            function drawStar(x, y) {
                ctx.save();
                ctx.translate(x, y);
                ctx.beginPath();
                ctx.fillStyle = brushColor;
                
                for (let i = 0; i < 5; i++) {
                    ctx.lineTo(Math.cos((18 + i * 72) * Math.PI / 180) * 25,
                              Math.sin((18 + i * 72) * Math.PI / 180) * 25);
                    ctx.lineTo(Math.cos((54 + i * 72) * Math.PI / 180) * 12,
                              Math.sin((54 + i * 72) * Math.PI / 180) * 12);
                }
                
                ctx.closePath();
                ctx.fill();
                ctx.restore();
            }
            
            function drawHeart(x, y) {
                const width = 50;
                const height = 50;
                
                ctx.save();
                ctx.translate(x - width/2, y - height/2);
                ctx.beginPath();
                ctx.fillStyle = brushColor;
                
                ctx.moveTo(width / 2, height / 5);
                ctx.bezierCurveTo(width / 2, 0, width, 0, width, height / 3);
                ctx.bezierCurveTo(width, height / 2, width / 2, height, width / 2, height);
                ctx.bezierCurveTo(width / 2, height, 0, height / 2, 0, height / 3);
                ctx.bezierCurveTo(0, 0, width / 2, 0, width / 2, height / 5);
                
                ctx.closePath();
                ctx.fill();
                ctx.restore();
            }
            
            function drawSun(x, y) {
                ctx.save();
                ctx.translate(x, y);
                ctx.beginPath();
                ctx.arc(0, 0, 20, 0, Math.PI * 2);
                ctx.fillStyle = brushColor;
                ctx.fill();
                
                // Rayons
                for (let i = 0; i < 12; i++) {
                    ctx.beginPath();
                    ctx.moveTo(22, 0);
                    ctx.lineTo(35, 0);
                    ctx.lineWidth = 3;
                    ctx.strokeStyle = brushColor;
                    ctx.stroke();
                    ctx.rotate(Math.PI / 6);
                }
                
                ctx.restore();
            }
            
            function drawMoon(x, y) {
                ctx.save();
                ctx.translate(x, y);
                ctx.beginPath();
                ctx.arc(0, 0, 25, 0, Math.PI * 2);
                ctx.fillStyle = brushColor;
                ctx.fill();
                
                // Créer l'effet de croissant
                ctx.beginPath();
                ctx.arc(10, 0, 22, 0, Math.PI * 2);
                ctx.fillStyle = 'white';
                ctx.fill();
                
                ctx.restore();
            }
            
            // Sélection de tampons
            document.querySelectorAll('.stamp').forEach(stamp => {
                stamp.addEventListener('click', function() {
                    const currentSelected = document.querySelector('.stamp.selected');
                    if (currentSelected) {
                        currentSelected.classList.remove('selected');
                    }
                    
                    if (currentSelected === this) {
                        activeStamp = null;
                    } else {
                        this.classList.add('selected');
                        activeStamp = this.getAttribute('data-stamp');
                    }
                });
            });
            
            // Gestionnaires d'événements de dessin
            canvas.addEventListener('mousedown', startDrawing);
            canvas.addEventListener('mousemove', draw);
            canvas.addEventListener('mouseup', stopDrawing);
            canvas.addEventListener('mouseout', stopDrawing);
            
            // Bouton de nettoyage
            clearButton.addEventListener('click', function() {
                ctx.fillStyle = 'white';
                ctx.fillRect(0, 0, canvas.width, canvas.height);
            });
            
            // Bouton gomme
            eraserButton.addEventListener('click', function() {
                isEraser = true;
                eraserButton.style.fontWeight = 'bold';
                pencilButton.style.fontWeight = 'normal';
                activeStamp = null;
                document.querySelector('.stamp.selected')?.classList.remove('selected');
            });
            
            // Bouton crayon
            pencilButton.addEventListener('click', function() {
                isEraser = false;
                pencilButton.style.fontWeight = 'bold';
                eraserButton.style.fontWeight = 'normal';
                activeStamp = null;
                document.querySelector('.stamp.selected')?.classList.remove('selected');
            });
            
            // Bouton de téléchargement
            downloadButton.addEventListener('click', function() {
                const link = document.createElement('a');
                link.download = 'mon-dessin.png';
                link.href = canvas.toDataURL();
                link.click();
                
                // Afficher le message
                message.style.display = 'block';
                setTimeout(() => {
                    message.style.display = 'none';
                }, 2000);
            });
            
            // Style initial
            pencilButton.style.fontWeight = 'bold';
        });
    </script>
</body>
</html>