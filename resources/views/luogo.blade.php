@extends('layouts.app')

@section('content')
<section class="location-section py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="location-title text-4xl md:text-5xl font-bold text-yellow-400 mb-6">Dove ci trovi</h1>
        <p class="location-description text-lg md:text-xl text-gray-300 max-w-3xl mx-auto mb-10">
            Il nostro autolavaggio <strong>Carwash</strong> si trova in <strong>Via dei Muratori, Squinzano (LE)</strong>.  
            Passa a trovarci per un lavaggio rapido, moderno e spettacolare con il nostro nuovo Portale Acquarama S7!
        </p>

        <div class="map-wrapper mx-auto max-w-5xl rounded-3xl overflow-hidden border-2 border-yellow-400 shadow-2xl">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1271.8373015788778!2d18.053523792066586!3d40.404135033212146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13445d1d0fa7a5d1%3A0x59a9ed50a7ea909e!2sVia%20dei%20Muratori%2C%2073018%20Squinzano%20LE!5e0!3m2!1sit!2sit!4v1720871833005!5m2!1sit!2sit" 
                width="100%" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>
    </div>
</section>

<style>
.location-section {
    background: linear-gradient(135deg, #000000 0%, #111111 100%);
    color: white;
}

/* Wrapper mappa con bordi tondeggianti e ombra */
.map-wrapper {
    border-radius: 30px;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(255, 215, 0, 0.3);
    transition: transform 0.3s ease;
}

.map-wrapper iframe {
    border-radius: 30px;
    transition: transform 0.3s ease;
}

.map-wrapper iframe:hover {
    transform: scale(1.02);
}

/* Responsive adjustments */
@media (max-width: 1024px) {
    .location-section { padding: 10rem 2rem; }
    .location-title { font-size: 3rem; }
    .location-description { font-size: 1.1rem; }
}

@media (max-width: 768px) {
    .location-section { padding: 8rem 1.5rem; }
    .location-title { font-size: 2.5rem; }
    .location-description { font-size: 1rem; }
}

@media (max-width: 480px) {
    .location-section { padding: 6rem 1rem; }
    .location-title { font-size: 2rem; }
    .location-description { font-size: 0.95rem; }
    .map-wrapper iframe { height: 300px; }
}
</style>
@endsection
