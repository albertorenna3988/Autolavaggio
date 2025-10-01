@extends('layouts.app')

@section('content')
<section class="live-section py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="section-title text-4xl md:text-5xl font-bold text-yellow-400 mb-8">
            Auto in Coda in Tempo Reale
        </h1>

        <div id="vehicle-counter" class="relative mx-auto rounded-3xl shadow-xl max-w-sm w-full overflow-hidden">
            
            {{-- Cerchi animati di sfondo --}}
            <span class="circle circle1"></span>
            <span class="circle circle2"></span>
            <span class="circle circle3"></span>

            {{-- Contatore numerico principale --}}
            <div class="relative z-10">
                <p class="text-gray-300 text-2xl mb-2">Auto in attesa</p>
                <div id="car-count" class="text-8xl md:text-9xl font-bold text-yellow-400 leading-none">0</div>
            </div>

            {{-- Mini auto animata --}}
            <img src="{{ asset('images/mini-car.png') }}" class="mini-car" alt="Mini Auto">
        </div>

        <p id="availability-message" class="mt-8 font-bold text-xl md:text-2xl text-gray-300">
            Verifica la disponibilità per un servizio rapido!
        </p>
        
        <div class="mt-8 max-w-2xl mx-auto px-2">
            <p class="text-gray-400 text-lg md:text-xl">
                Grazie a un software innovativo collegato alle nostre telecamere, il numero che vedi è sempre aggiornato in tempo reale. 
                Controlla la coda comodamente da casa e scegli il momento perfetto per venire a trovarci, senza attese!
            </p>
        </div>
    </div>
</section>

<style>
.live-section {
    background: linear-gradient(135deg, #0a0a0a 0%, #111111 100%);
    color: white;
}

#vehicle-counter {
    position: relative;
    margin: 0 auto;
    max-width: 340px;
    width: 100%;
    padding: 3rem 2rem;
    border-radius: 25px;
    background: linear-gradient(135deg, #111, #1a1a1a);
    border: 2px solid #FFD700;
    box-shadow: 0 15px 35px rgba(255, 215, 0, 0.2);
    text-align: center;
    overflow: hidden;
}

.circle {
    position: absolute;
    border: 2px solid rgba(255, 215, 0, 0.2);
    border-radius: 50%;
    animation: rotateCircle 12s linear infinite;
    z-index: 0;
}
.circle1 { width: 220px; height: 220px; top:-50px; left:-50px; }
.circle2 { width: 280px; height: 280px; bottom:-60px; right:-60px; animation-duration: 18s; }
.circle3 { width: 170px; height: 170px; top:-40px; right:-40px; animation-duration: 15s; }

@keyframes rotateCircle {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.mini-car {
    position: absolute;
    bottom: 15px;
    left: -60px;
    width: 50px;
    animation: moveCar 6s linear infinite;
    z-index: 20;
}
@keyframes moveCar {
    0% { transform: translateX(0); }
    100% { transform: translateX(450px); }
}

.flash { 
    animation: flash 0.5s ease-out; 
}
@keyframes flash {
    0%, 100% { color: #FFD700; text-shadow: 0 0 10px #FFD700; }
    50% { color: #fff; text-shadow: none; }
}

.fade-in-section {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 1s ease-out, transform 1s ease-out;
}
.fade-in-section.visible {
    opacity: 1;
    transform: translateY(0);
}

@media (max-width: 1024px) {
    .section-title { font-size: 3rem; }
    #car-count { font-size: 7rem; }
}
@media (max-width: 768px) {
    .live-section { padding: 4rem 1rem; }
    .section-title { font-size: 2.5rem; }
    #vehicle-counter { padding: 2.5rem 1.5rem; }
    #car-count { font-size: 5rem; }
    #availability-message { font-size: 1.25rem; }
}
@media (max-width: 480px) {
    .section-title { font-size: 2rem; }
    #car-count { font-size: 3.5rem; }
    #availability-message { font-size: 1.1rem; }
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const carCountEl = document.getElementById('car-count');
    const availabilityEl = document.getElementById('availability-message');
    const section = document.querySelector('.live-section');
    section.classList.add('fade-in-section');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if(entry.isIntersecting){
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });
    observer.observe(section);

    async function fetchVehicleData() {
        try {
            const response = await fetch("https://techlavaggio-fe-878215580597.europe-west1.run.app/api/scans?limit=1");
            const data = await response.json();

            // L'ultima scansione
            const latestScan = data.results && data.results[0] ? data.results[0] : null;
            const carCount = latestScan ? latestScan.car_count : 0;

            if(carCountEl.textContent !== carCount.toString()){
                carCountEl.textContent = carCount;
                carCountEl.classList.add('flash');
                setTimeout(() => carCountEl.classList.remove('flash'), 500);
            }

            if(carCount === 0){
                availabilityEl.innerHTML = "Lavaggio libero, entra pure! 🚗💨";
                availabilityEl.style.color = "#22c55e";
            } else if(carCount < 4){
                availabilityEl.innerHTML = "Poca attesa, è il momento giusto! ⏳";
                availabilityEl.style.color = "#facc15";
            } else {
                availabilityEl.innerHTML = "Coda presente, potresti attendere un po' ⚠️";
                availabilityEl.style.color = "#ef4444";
            }

        } catch (error) {
            console.error('Errore nel recupero dei dati:', error);
            availabilityEl.textContent = 'Errore durante l\'aggiornamento.';
            availabilityEl.style.color = "#ef4444";
        }
    }

    fetchVehicleData();
    setInterval(fetchVehicleData, 60000); // Aggiornamento ogni 60 secondi
});
</script>
@endsection
