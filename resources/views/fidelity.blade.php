@extends('layouts.app')

@section('content')
<section class="fidelity-section py-16">
    <div class="container mx-auto px-4">
        <h1 class="section-title text-4xl font-bold text-center text-yellow-400 mb-8">Fidelity Card</h1>
        <p class="fidelity-description text-lg text-center text-gray-300 max-w-3xl mx-auto mb-12">
            Con la nostra Fidelity Card ogni visita al nostro autolavaggio diventa ancora più vantaggiosa. Approfitta di sconti esclusivi sui servizi, promozioni dedicate e condizioni speciali pensate per i clienti più fedeli. La card ti consente di rendere ogni lavaggio più conveniente, con la certezza di ottenere sempre il massimo valore dai nostri servizi. Richiedila direttamente in sede e scopri tutti i benefici riservati a chi sceglie di affidarsi regolarmente al nostro autolavaggio.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            <div class="fidelity-card bg-gray-900 rounded-2xl shadow-lg p-6 text-center border-2 border-yellow-400 hover:scale-105 transition-transform duration-300">
                <div class="icon mb-4 text-yellow-400 text-5xl">
                    <i class="fas fa-percent"></i>
                </div>
                <h3 class="font-semibold text-xl mb-2 text-yellow-400">Sconti Esclusivi</h3>
                <p class="text-gray-300">Accedi a tariffe vantaggiose riservate ai possessori della Fidelity Card, ogni volta che utilizzi i nostri servizi.</p>
            </div>

            <div class="fidelity-card bg-gray-900 rounded-2xl shadow-lg p-6 text-center border-2 border-yellow-400 hover:scale-105 transition-transform duration-300">
                <div class="icon mb-4 text-yellow-400 text-5xl">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3 class="font-semibold text-xl mb-2 text-yellow-400">Promozioni Dedicati</h3>
                <p class="text-gray-300">Approfitta di offerte speciali e promozioni pensate esclusivamente per i clienti più fedeli del nostro autolavaggio.</p>
            </div>

            <div class="fidelity-card bg-gray-900 rounded-2xl shadow-lg p-6 text-center border-2 border-yellow-400 hover:scale-105 transition-transform duration-300">
                <div class="icon mb-4 text-yellow-400 text-5xl">
                    <i class="fas fa-car"></i>
                </div>
                <h3 class="font-semibold text-xl mb-2 text-yellow-400">Vantaggi Continuativi</h3>
                <p class="text-gray-300">Rendi ogni lavaggio più conveniente, con vantaggi pensati per chi sceglie di tornare regolarmente da noi.</p>
            </div>
        </div>
    </div>
</section>

<style>
.fidelity-section {
    background: linear-gradient(135deg, #000000 0%, #111111 100%);
}

.fidelity-card i {
    display: inline-block;
}

/* Responsive miglioramenti */
@media (max-width: 1024px) {
    .fidelity-section { padding: 12rem 1rem; }
}

@media (max-width: 768px) {
    .fidelity-section { padding: 10rem 1rem; }
    .fidelity-card { padding: 4rem 2rem; }
    .section-title { font-size: 2.5rem; }
    .fidelity-description { font-size: 1rem; }
}

@media (max-width: 480px) {
    .fidelity-card { padding: 3rem 1.5rem; }
    .section-title { font-size: 2rem; }
    .fidelity-description { font-size: 0.95rem; }
}
</style>
@endsection
