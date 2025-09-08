@extends('layouts.app')

@section('content')
<div class="container text-white py-16 px-4">

    <h1 class="text-yellow-400 text-4xl md:text-5xl font-bold mb-12 text-center">I nostri Servizi</h1>

    {{-- SEZIONE RULLO --}}
    <div class="service-box bg-gray-900 border-2 border-yellow-400 p-6 md:p-8 rounded-2xl shadow-xl mb-12 hover:scale-105 transition-transform duration-300 max-w-5xl mx-auto">
        <h2 class="text-yellow-300 text-3xl md:text-4xl font-semibold mb-4">Acquarama S7</h2>
        <p class="mb-6 text-gray-300 text-lg md:text-xl">
            Il nostro nuovissimo Portale Acquarama S7 garantisce un lavaggio impeccabile e rapido. 
            Dotato di illuminazione LED dinamica, offre un'esperienza visiva unica durante ogni lavaggio.
        </p>

        {{-- IMMAGINE RULLO --}}
        <img src="{{ asset('images/rullo.jpg') }}" alt="" class="rounded-2xl shadow-lg mb-6 mx-auto w-full max-w-4xl">

        {{-- BOTTONE PREZZI --}}
        <div class="text-center">
            <a href="{{ route('prezzi') }}" class="inline-block bg-yellow-400 text-black font-bold py-3 px-8 rounded-xl hover:bg-yellow-500 transition duration-300">
                Visualizza Prezzi
            </a>
        </div>
    </div>

    {{-- SEZIONE AREA LAVAGGIO MANUALE --}}
    <div class="service-box bg-gray-900 border-2 border-yellow-400 p-6 md:p-8 rounded-2xl shadow-xl mb-12 hover:scale-105 transition-transform duration-300 max-w-5xl mx-auto">
        <h2 class="text-yellow-300 text-3xl md:text-4xl font-semibold mb-4">Area Lavaggio Manuale</h2>
        <p class="text-gray-300 text-lg md:text-xl">
            Nell’area dedicata ai lavaggi manuali potrai prenderti cura della tua auto con precisione e attenzione. Grazie alle nostre lance ad alta pressione professionali e ai prodotti selezionati di prima qualità, ogni dettaglio della tua vettura verrà trattato con la massima cura. Questa sezione ti consente di ottenere una pulizia profonda, efficace e senza compromessi, garantendo risultati impeccabili su ogni superficie.
        </p>
    </div>

    {{-- SEZIONE AREA ASPIRAZIONE --}}
    <div class="service-box bg-gray-900 border-2 border-yellow-400 p-6 md:p-8 rounded-2xl shadow-xl mb-12 hover:scale-105 transition-transform duration-300 max-w-5xl mx-auto">
        <h2 class="text-yellow-300 text-3xl md:text-4xl font-semibold mb-4">Area Aspirazione</h2>
        <p class="text-gray-300 text-lg md:text-xl">
            Un’area attrezzata con aspirapolveri professionali e macchine per la pulizia dei tappetini, ideale per completare la pulizia interna della tua auto in piena autonomia.
        </p>
    </div>

</div>

<style>
.service-box {
    transition: all 0.3s ease;
}
.service-box:hover {
    box-shadow: 0 20px 40px rgba(255, 215, 0, 0.3);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .service-box { padding: 4rem 2rem; }
    .service-box h2 { font-size: 2rem; }
    .service-box p { font-size: 1rem; }
    h1.section-title { font-size: 2.5rem; }
}

@media (max-width: 480px) {
    .service-box { padding: 3rem 1.5rem; }
    .service-box h2 { font-size: 1.75rem; }
    .service-box p { font-size: 0.95rem; }
    h1.section-title { font-size: 2rem; }
}
</style>
@endsection
