@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 relative">

    {{-- Cerchi decorativi sparsi (sfondo) --}}
    <span class="circle-deco circle1"></span>
    <span class="circle-deco circle2"></span>
    <span class="circle-deco circle3"></span>
    <span class="circle-deco circle4"></span>
    <span class="circle-deco circle5"></span>

    {{-- HERO LOGO --}}
    <section class="hero-logo text-center py-16 relative" style="z-index:2;">
        <img src="{{ asset('images/logo-carwash.jpg') }}" alt="Carwash Logo" class="hero-logo-img mx-auto mb-4" style="max-width:200px;">
        <p class="hero-subtext text-gray-300 text-lg md:text-xl">
            Qualità, professionalità e tecnologia al servizio della tua auto.
        </p>
    </section>

    {{-- LIVE SECTION / CONTATORE --}}
    <section class="live-section py-16 text-center relative" style="z-index:2;">
        <h2 class="section-title text-3xl md:text-4xl font-bold text-yellow-400 mb-8">Live dal nostro autolavaggio</h2>

        <div id="vehicle-counter" class="vehicle-counter relative mx-auto" 
             style="max-width:320px; overflow:hidden; padding:35px 25px; border-radius:25px; 
                    background: linear-gradient(135deg, #111, #1a1a1a); 
                    border:2px solid #FFD700; box-shadow:0 15px 25px rgba(255,215,0,0.3); 
                    text-align:center; z-index:3; display:inline-block;">
            
            {{-- GIF background --}}
            <img src="{{ asset('images/animated-car.gif') }}" alt="" 
                 style="position:absolute; top:0; left:0; width:100%; height:100%; object-fit:cover; 
                        opacity:0.15; z-index:0; border-radius:30px;">

            {{-- Contenuto dei numeri --}}
            <div id="vehicle-counter-content" style="position:relative; z-index:2;">
                <h3 style="margin-bottom:10px;">🚘 Veicoli rilevati</h3>
                <p id="car-count">Auto: <strong>0</strong></p>
                <p id="truck-count">Camion: <strong>0</strong></p>
                <p id="total-count">Totale: <strong>0</strong></p>
                <small id="last-updated">Aggiornato: --:--:--</small>
            </div>
        </div>

        <p id="availability-message" class="font-bold text-lg md:text-xl text-green-500 mt-6" style="z-index:2;">
            Verifica in tempo reale la disponibilità dell’impianto.
        </p>
    </section>

    {{-- RULLO SECTION --}}
    <section id="rullo" class="rullo-section py-16 grid grid-cols-1 md:grid-cols-2 gap-8 items-center relative" style="z-index:2;">
        <div class="rullo-text text-gray-300 text-lg">
            <h2 class="section-title text-3xl md:text-4xl font-bold text-yellow-400 mb-4">Nuovo portale Stargate S7</h2>
            <p>Siamo entusiasti di presentarti la nostra ultima innovazione: il <strong>Stargate S7</strong>, un impianto all’avanguardia che garantisce risultati impeccabili su ogni tipo di veicolo.</p>
            <p>Dotato di sensori intelligenti e spazzole delicate, il sistema assicura un lavaggio preciso e sicuro, riducendo i tempi di attesa e migliorando la qualità complessiva del servizio.</p>
            <p>Il nuovo S7 offre inoltre un lavaggio eco-sostenibile grazie all'utilizzo ottimizzato dell'acqua e prodotti biodegradabili.</p>
            <p>Una delle novità più sorprendenti è lo <strong>splendido gioco di colori</strong> che accompagna ogni lavaggio, grazie agli <strong>innovativi LED integrati</strong>, per un'esperienza visiva unica e moderna.</p>
        </div>
        <div class="rullo-img text-center">
            <img src="{{ asset('images/rullo-s7.jpg') }}" alt="Portale Acquarama S7" class="mx-auto rounded-2xl shadow-lg" style="max-width:100%; height:auto;">
        </div>
    </section>

    {{-- MA-FRA SECTION --}}
    <section id="ma-fra" class="py-16 relative" style="z-index:2;">
        <h2 class="section-title text-3xl md:text-4xl font-bold text-yellow-400 mb-4 text-center">I Nostri Prodotti</h2>
        <p class="text-gray-300 text-lg md:text-xl max-w-3xl mx-auto mb-6 text-center">
            Utilizziamo esclusivamente prodotti di alta qualità del marchio <strong>Ma Fra</strong>, per garantire una pulizia impeccabile e la massima cura della tua auto.
        </p>
        <div class="ma-fra-logo-wrapper" style="display:flex; justify-content:center; align-items:center; width:100%;">
            <img src="{{ asset('images/ma-fra-logo.jpg') }}" alt="Ma Fra Logo" style="max-width:300px; width:100%; display:block;">
        </div>
    </section>
</div>
@endsection

@section('scripts')
<style>
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

/* Hover immagini */
.hero-logo-img:hover, .rullo-img img:hover, .ma-fra-logo-wrapper img:hover {
    transform: scale(1.05);
    transition: transform 0.5s ease;
}

/* Flash contatore */
.flash {
    animation: flashHighlight 0.5s ease-in-out;
}
@keyframes flashHighlight {
    0%   { color: #FFD700; background-color: transparent; }
    50%  { color: #111; background-color: #FFD700; }
    100% { color: #FFD700; background-color: transparent; }
}

/* Mini auto animata */
@keyframes moveCar { 0% { left:-50px;} 50% { left:calc(100% - 50px);} 100% { left:-50px;} }

/* Cerchi decorativi sfondo */
.circle-deco {
    position: absolute;
    border-radius: 50%;
    border: 2px solid rgba(255,215,0,0.2);
    animation: rotateCircle 20s linear infinite;
    z-index:0; /* sempre sotto */
}
.circle1 { width: 150px; height: 150px; top: 10%; left: 5%; }
.circle2 { width: 200px; height: 200px; top: 30%; right: 10%; animation-duration: 25s; }
.circle3 { width: 100px; height: 100px; bottom: 15%; left: 20%; animation-duration: 22s; }
.circle4 { width: 180px; height: 180px; bottom: 5%; right: 15%; animation-duration: 28s; }
.circle5 { width: 120px; height: 120px; top: 50%; left: 50%; animation-duration: 30s; }

@keyframes rotateCircle { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

/* Responsive */
@media (max-width:768px) {
    .hero-logo { padding:6rem 1rem; }
    .live-section { padding:8rem 1rem; }
    .rullo-section { grid-template-columns:1fr; padding:6rem 1rem; }
    .rullo-text { text-align:center; }
    .ma-fra-logo img { max-width:250px; }
}
@media (max-width:480px) {
    .hero-logo { padding:4rem 1rem; }
    .live-section h2, .rullo-section h2, #ma-fra h2 { font-size:2rem; }
    .rullo-text, .ma-fra p { font-size:0.95rem; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {

    // ---------------------------
    // CONTATORE VEICOLI LIVE
    // ---------------------------
    let lastCounts = { car: null, truck: null, total: null };

    function updateCounter() {
        fetch('/api/carwash/latest')
            .then(res => res.json())
            .then(data => {
                const scan = data.scan;
                const containerContent = document.getElementById('vehicle-counter-content');
                const availabilityElem = document.getElementById('availability-message');

                if(scan) {
                    containerContent.innerHTML = `
                        <h3 style="margin-bottom:10px;">🚘 Veicoli rilevati</h3>
                        <p id="car-count">Auto: <strong>${scan.car_count}</strong></p>
                        <p id="truck-count">Camion: <strong>${scan.truck_count}</strong></p>
                        <p id="total-count">Totale: <strong>${scan.total_count}</strong></p>
                        <small id="last-updated">Aggiornato: ${new Date(scan.timestamp).toLocaleTimeString()}</small>
                    `;

                    ['car','truck','total'].forEach(key => {
                        if(lastCounts[key] !== null && scan[`${key}_count`] !== lastCounts[key]){
                            document.querySelector(`#${key}-count strong`).classList.add("flash");
                            setTimeout(()=>document.querySelector(`#${key}-count strong`).classList.remove("flash"),500);
                        }
                    });

                    if(scan.total_count === 0){
                        availabilityElem.textContent = "Lavaggio libero 🚗";
                        availabilityElem.style.color = "#00FF00";
                    } else if(scan.total_count < 5){
                        availabilityElem.textContent = "Coda leggera ⏳";
                        availabilityElem.style.color = "#FFFF00";
                    } else {
                        availabilityElem.textContent = "Coda presente ⚠️";
                        availabilityElem.style.color = "#FF0000";
                    }

                    lastCounts = { car: scan.car_count, truck: scan.truck_count, total: scan.total_count };
                } else {
                    containerContent.innerHTML = '<p>Nessun dato disponibile al momento.</p>';
                    availabilityElem.textContent = "Verifica in tempo reale la disponibilità dell’impianto.";
                    availabilityElem.style.color = "#00FF00";
                }
            })
            .catch(() => {
                document.getElementById('vehicle-counter-content').innerHTML = '<p>Contatore non disponibile.</p>';
                document.getElementById('availability-message').textContent = "Verifica in tempo reale la disponibilità dell’impianto.";
                document.getElementById('availability-message').style.color = "#00FF00";
            });
    }

    updateCounter();
    setInterval(updateCounter, 1000);

    // ---------------------------
    // FADE-IN SEZIONI
    // ---------------------------
    const sections = document.querySelectorAll('.hero-logo, .live-section, .rullo-section, #ma-fra');
    sections.forEach(section => section.classList.add('fade-in-section'));

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if(entry.isIntersecting){
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    sections.forEach(section => observer.observe(section));
});
</script>
@endsection
