@extends('layouts.app')

@section('content')
<section class="live-section py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="section-title text-4xl md:text-5xl font-bold text-yellow-400 mb-4">
            Auto Attualmente Nel Nostro Autolavaggio 
        </h1>

        {{-- Descrizione sintetica --}}
        <p class="text-gray-300 text-lg md:text-xl mb-8">
            
        </p>

        <div id="vehicle-counter" class="relative mx-auto rounded-3xl shadow-xl max-w-full md:max-w-sm overflow-hidden">
            
            {{-- Cerchi animati sul contatore --}}
            <span class="circle circle1"></span>
            <span class="circle circle2"></span>
            <span class="circle circle3"></span>

            {{-- Contatore numerico --}}
            <h3 class="text-2xl md:text-3xl font-semibold mb-4 text-yellow-400">Veicoli rilevati</h3>
            <div class="counter-item text-lg md:text-xl mb-2">
                Auto: <strong id="car-count" class="text-yellow-400">0</strong>
            </div>
            <div class="counter-item text-lg md:text-xl mb-2">
                Camion: <strong id="truck-count" class="text-yellow-400">0</strong>
            </div>
            <div class="counter-item text-lg md:text-xl mb-4">
                Totale: <strong id="total-count" class="text-yellow-400">0</strong>
            </div>
            <small id="last-updated" class="text-gray-300 block">Aggiornato: --:--:--</small>

            {{-- Mini auto animate --}}
            <img src="{{ asset('images/mini-car.png') }}" class="mini-car" alt="Mini Auto">
        </div>

        <p id="availability-message" class="mt-6 font-bold text-lg md:text-xl text-gray-300">
            Per offrirti il miglior servizio senza lunghe attese, consulta il prospetto: l’intelligenza artificiale mostra in tempo reale la coda di lavaggio.
        </p>
    </div>
</section>

<style>
.live-section {
    background: linear-gradient(135deg, #0a0a0a 0%, #111111 100%);
    color: white;
}

/* Contatore compatto e centrato */
#vehicle-counter {
    position: relative;
    margin: 0 auto;
    max-width: 320px;
    width: 90%;
    padding: 45px 25px;
    border-radius: 25px;
    background: linear-gradient(135deg, #111, #1a1a1a);
    border: 2px solid #FFD700;
    box-shadow: 0 15px 25px rgba(255, 215, 0, 0.3);
    text-align: center;
    overflow: hidden;
}

/* Cerchi animati */
.circle {
    position: absolute;
    border: 2px solid rgba(255, 215, 0, 0.3);
    border-radius: 50%;
    animation: rotateCircle 10s linear infinite;
}
.circle1 { width: 200px; height: 200px; top:-50px; left:-50px; }
.circle2 { width: 250px; height: 250px; bottom:-50px; right:-50px; animation-duration: 15s; }
.circle3 { width: 150px; height: 150px; top:-30px; right:-30px; animation-duration: 12s; }

@keyframes rotateCircle {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Mini auto */
.mini-car {
    position: absolute;
    bottom: 10px;
    left: -50px;
    width: 50px;
    animation: moveCar 5s linear infinite;
}
@keyframes moveCar {
    0% { left: -50px; }
    50% { left: calc(100% - 50px); }
    100% { left: -50px; }
}

/* Flash highlight numeri */
.flash { 
    animation: flash 0.5s ease; 
}
@keyframes flash {
    0% { color:#FFD700; }
    50% { color:#fff; }
    100% { color:#FFD700; }
}

/* Fade-in sezioni */
.fade-in-section {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 1s ease-out, transform 1s ease-out;
}
.fade-in-section.visible {
    opacity: 1;
    transform: translateY(0);
}

/* Responsive */
@media (max-width: 768px) {
    .live-section { padding: 10rem 1rem; }
    .section-title { font-size: 2.5rem; }
    #vehicle-counter { padding: 15px 20px; max-width: 90%; }
    .counter-item { font-size: 1rem; }
    #availability-message { font-size: 1rem; }
    .mini-car { width: 35px; }
}
@media (max-width: 480px) {
    .section-title { font-size: 2rem; }
    #vehicle-counter { padding: 12px 15px; }
    .counter-item { font-size: 0.95rem; }
    #availability-message { font-size: 0.95rem; }
    .mini-car { width: 25px; }
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const carCountEl = document.getElementById('car-count');
    const truckCountEl = document.getElementById('truck-count');
    const totalCountEl = document.getElementById('total-count');
    const lastUpdatedEl = document.getElementById('last-updated');
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
            const response = await fetch('/api/car-counter'); 
            const data = await response.json();

            const car = data.scans[0].car_count;
            const truck = data.scans[0].truck_count;
            const total = data.scans[0].total_count;
            const timestamp = new Date(data.scans[0].timestamp);

            carCountEl.textContent = car;
            truckCountEl.textContent = truck;
            totalCountEl.textContent = total;
            lastUpdatedEl.textContent = `Aggiornato: ${timestamp.toLocaleTimeString()}`;

            // Flash numeri
            [carCountEl, truckCountEl, totalCountEl].forEach(el => {
                el.classList.add('flash');
                setTimeout(() => el.classList.remove('flash'), 500);
            });

            // Cambia colore disponibilità
            if(total === 0){
                availabilityEl.textContent = "Lavaggio libero 🚗";
                availabilityEl.style.color = "#00FF00";
            } else if(total < 5){
                availabilityEl.textContent = "Coda leggera ⏳";
                availabilityEl.style.color = "#FFFF00";
            } else {
                availabilityEl.textContent = "Coda presente ⚠️";
                availabilityEl.style.color = "#FF0000";
            }

        } catch (error) {
            console.error('Errore nel fetch dei veicoli:', error);
            lastUpdatedEl.textContent = 'Errore aggiornamento dati';
        }
    }

    fetchVehicleData();
    setInterval(fetchVehicleData, 1000);
});
</script>
@endsection
