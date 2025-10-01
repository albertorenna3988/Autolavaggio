@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 relative">

    {{-- Cerchi decorativi --}}
    <span class="circle-deco circle1"></span>
    <span class="circle-deco circle2"></span>
    <span class="circle-deco circle3"></span>
    <span class="circle-deco circle4"></span>
    <span class="circle-deco circle5"></span>

    {{-- HERO --}}
    <section class="hero-logo text-center py-16 relative z-10">
        <img src="{{ asset('images/logo-carwash.jpg') }}" alt="Carwash Logo" class="hero-logo-img mx-auto mb-4 max-w-[200px] rounded-full shadow-lg">
        <p class="hero-subtext text-gray-300 text-lg md:text-xl">
            Qualità, professionalità e tecnologia al servizio della tua auto.
        </p>
    </section>

    {{-- CONTATORE AUTO --}}
    <section class="live-section py-16 text-center relative z-10">
        <h2 class="section-title text-3xl md:text-4xl font-bold text-yellow-400 mb-8">Live dal nostro autolavaggio</h2>

        <div id="vehicle-counter" class="relative mx-auto max-w-[320px] overflow-hidden p-6 rounded-2xl bg-gradient-to-br from-[#111] to-[#1a1a1a] border-2 border-yellow-400 shadow-xl">
            <img src="{{ asset('images/animated-car.gif') }}" alt="" class="absolute inset-0 w-full h-full object-cover opacity-15 rounded-2xl z-0">
            
            <div id="vehicle-counter-content" class="relative z-10 text-gray-100">
                <h3 class="text-xl mb-2">🚘 Auto rilevate</h3>
                <p id="car-count" class="text-2xl"> <strong>0</strong></p>
            </div>
        </div>

        <p id="availability-message" class="font-bold text-lg md:text-xl mt-6 text-green-500">
            Verifica in tempo reale la disponibilità dell’impianto.
        </p>
    </section>

    {{-- SEZIONE RULLO --}}
    <section id="rullo" class="rullo-section py-16 grid grid-cols-1 md:grid-cols-2 gap-8 items-center relative z-10">
        <div class="rullo-text text-gray-300 text-lg leading-relaxed">
            <h2 class="section-title text-3xl md:text-4xl font-bold text-yellow-400 mb-4">Nuovo portale Stargate S7</h2>
            <p>Presentiamo il <strong>Stargate S7</strong>, un impianto all’avanguardia che garantisce risultati impeccabili su ogni veicolo.</p>
            <p class="mt-2">Sensori intelligenti e spazzole delicate assicurano lavaggi precisi, riducendo i tempi di attesa e migliorando la qualità complessiva.</p>
            <p class="mt-2">Eco-sostenibile, grazie all’uso ottimizzato dell’acqua e prodotti biodegradabili.</p>
            <p class="mt-2">Inoltre, il sistema offre un <strong>gioco di luci LED</strong> che trasforma il lavaggio in un’esperienza visiva unica.</p>
        </div>
        <div class="rullo-img text-center">
            <img src="{{ asset('images/rullo-s7.jpg') }}" alt="Portale Acquarama S7" class="mx-auto rounded-2xl shadow-lg w-full max-w-md">
        </div>
    </section>

    {{-- SEZIONE MA-FRA --}}
    <section id="ma-fra" class="py-16 relative z-10 text-center">
        <h2 class="section-title text-3xl md:text-4xl font-bold text-yellow-400 mb-6">I Nostri Prodotti</h2>
        <p class="text-gray-300 text-lg md:text-xl max-w-3xl mx-auto mb-8">
            Utilizziamo solo prodotti di alta qualità del marchio <strong>Ma Fra</strong>, per garantire una pulizia impeccabile e la massima cura della tua auto.
        </p>
        <div class="flex justify-center">
            <img src="{{ asset('images/ma-fra-logo.jpg') }}" alt="Ma Fra Logo" class="max-w-[280px] w-full rounded-xl shadow-md">
        </div>
    </section>
</div>
@endsection

@section('scripts')
<style>
/* Fade-in */
.fade-in-section { opacity:0; transform:translateY(30px); transition:opacity 1s ease, transform 1s ease; }
.fade-in-section.visible { opacity:1; transform:translateY(0); }

/* Hover */
.hero-logo-img:hover, .rullo-img img:hover, #ma-fra img:hover {
    transform: scale(1.05);
    transition: transform 0.4s ease;
}

/* Flash */
.flash { animation: flashHighlight 0.5s ease-in-out; }
@keyframes flashHighlight {
    0%   { color:#FFD700; background:transparent; }
    50%  { color:#111; background:#FFD700; }
    100% { color:#FFD700; background:transparent; }
}

/* Cerchi sfondo */
.circle-deco { position:absolute; border-radius:50%; border:2px solid rgba(255,215,0,0.15); animation: rotateCircle 25s linear infinite; z-index:0; }
.circle1 { width:120px; height:120px; top:8%; left:5%; }
.circle2 { width:180px; height:180px; top:35%; right:10%; animation-duration:30s; }
.circle3 { width:90px; height:90px; bottom:18%; left:15%; animation-duration:22s; }
.circle4 { width:160px; height:160px; bottom:10%; right:12%; animation-duration:28s; }
.circle5 { width:100px; height:100px; top:55%; left:50%; animation-duration:32s; }
@keyframes rotateCircle { from{transform:rotate(0deg);} to{transform:rotate(360deg);} }

/* Responsive */
@media (max-width:768px){
    .hero-logo{padding:5rem 1rem;}
    .live-section{padding:6rem 1rem;}
    .rullo-section{grid-template-columns:1fr; text-align:center;}
    .rullo-text{font-size:1rem;}
}
@media (max-width:480px){
    .section-title{font-size:2rem;}
    .rullo-text, #ma-fra p{font-size:0.9rem;}
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    let lastCarCount = null;

    async function updateCounter() {
        try {
            const res = await fetch("https://techlavaggio-fe-878215580597.europe-west1.run.app/api/scans?limit=1");
            const data = await res.json();
            const latestScan = data.results && data.results[0] ? data.results[0] : null;
            const carElem = document.querySelector("#car-count strong");
            const availability = document.getElementById("availability-message");

            const carCount = latestScan ? latestScan.car_count : 0;
            carElem.textContent = carCount;

            if(lastCarCount !== null && carCount !== lastCarCount){
                carElem.classList.add("flash");
                setTimeout(()=>carElem.classList.remove("flash"),500);
            }

            // Aggiorna messaggio in base al numero di auto
            if(carCount === 0){
                availability.textContent = "Lavaggio libero 🚗";
                availability.style.color = "#00FF00";
            } else if(carCount > 0 && carCount <= 3){
                availability.textContent = "Coda leggera ⏳";
                availability.style.color = "#FFD700";
            } else {
                availability.textContent = "Coda presente ⚠️";
                availability.style.color = "#FF0000";
            }

            lastCarCount = carCount;
        } catch(err){
            document.querySelector("#car-count strong").textContent = "0";
            const availability = document.getElementById("availability-message");
            availability.textContent = "Contatore non disponibile.";
            availability.style.color = "#FFD700";
        }
    }

    updateCounter();
    setInterval(updateCounter, 60000);

    // Fade-in
    const sections = document.querySelectorAll('.hero-logo, .live-section, .rullo-section, #ma-fra');
    sections.forEach(sec => sec.classList.add('fade-in-section'));
    const observer = new IntersectionObserver((entries)=>entries.forEach(e=>{ if(e.isIntersecting){ e.target.classList.add('visible'); }}),{threshold:0.1});
    sections.forEach(sec => observer.observe(sec));
});
</script>
@endsection
