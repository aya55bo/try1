<x-app-layout>
    <div class="p-6 max-w-4xl mx-auto">
        <h2 class="text-2xl font-bold mb-4">🎨 Coloriage Interactif</h2>
        <div class="flex space-x-4 mb-4">
            <button onclick="setColor('red')" class="w-10 h-10 rounded-full bg-red-500"></button>
            <button onclick="setColor('green')" class="w-10 h-10 rounded-full bg-green-500"></button>
            <button onclick="setColor('blue')" class="w-10 h-10 rounded-full bg-blue-500"></button>
            <button onclick="setColor('yellow')" class="w-10 h-10 rounded-full bg-yellow-400"></button>
            <button onclick="setColor('black')" class="w-10 h-10 rounded-full bg-black"></button>
        </div>
        <canvas id="colorCanvas" width="500" height="400" class="border-2 border-gray-400 rounded"></canvas>
    </div>

    <script>
        let color = 'black';
        const canvas = document.getElementById('colorCanvas');
        const ctx = canvas.getContext('2d');
        let painting = false;

        canvas.addEventListener('mousedown', () => painting = true);
        canvas.addEventListener('mouseup', () => painting = false);
        canvas.addEventListener('mousemove', draw);

        function draw(e) {
            if (!painting) return;
            ctx.fillStyle = color;
            ctx.beginPath();
            ctx.arc(e.offsetX, e.offsetY, 5, 0, Math.PI * 2);
            ctx.fill();
        }

        function setColor(newColor) {
            color = newColor;
        }
    </script>
</x-app-layout>
