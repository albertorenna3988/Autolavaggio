<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Carwash - Autolavaggio a Squinzano</title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<style>
/* Navbar mobile */
.nav-toggle { display: none; }
@media (max-width:768px){
    .nav-toggle { display: block; font-size: 24px; color: #FFD700; cursor: pointer; }
    #nav-menu { display: none; flex-direction: column; background: #111; width: 100%; position: absolute; top: 100%; left:0; padding: 15px 0; z-index: 998; }
    #nav-menu.flex { display: flex !important; }
    #nav-menu li { margin:10px 0; text-align:center; }
}

/* Main padding */
.main-content { padding-top: 100px; }

/* Footer */
.custom-footer { background: #111; padding: 40px 0 20px; color: #fff; }
.footer-flex { display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 20px; }
.footer-logo img { height: 60px; }
.footer-info p { margin-bottom: 8px; color: #ccc; }
.footer-social a { color: #FFD700; font-size: 24px; margin-right: 10px; transition: color 0.3s; }
.footer-social a:hover { color: #fff; }
.footer-bottom { text-align: center; margin-top: 20px; font-size: 14px; color: #777; }

@media (max-width:768px){
    .footer-flex { flex-direction: column; align-items: center; text-align: center; }
}

/* Cookie banner */
.cookie-banner {
    position: fixed; bottom: 20px; left:50%; transform:translateX(-50%);
    background:#111; color:#fff; padding:15px 20px;
    border:2px solid #FFD700; border-radius:25px;
    display:none; align-items:center; gap:15px; max-width:90%; flex-wrap: wrap; z-index:9999;
}
.cookie-banner p { font-size:14px; color:#ccc; }
.cookie-banner .cookie-link { color:#FFD700; text-decoration:underline; }
.cookie-banner .cookie-btn {
    background:#FFD700; color:#000; border:none; padding:8px 16px; border-radius:20px; font-weight:bold; cursor:pointer; transition: background 0.3s;
}
.cookie-banner .cookie-btn:hover { background:#fff200; }
</style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar">
    <div class="nav-container flex justify-between items-center flex-wrap px-4 py-3">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/logo-carwash.jpg') }}" alt="Logo" class="h-12">
        </a>

        <div id="nav-toggle" class="nav-toggle"><i class="fas fa-bars"></i></div>

        <ul id="nav-menu" class="nav-links md:flex gap-6 text-yellow-400 font-bold">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('services') }}">Servizi</a></li>
            <li><a href="{{ route('live') }}">Live</a></li>
            <li><a href="{{ route('fidelity') }}">Fidelity Card</a></li>
            <li><a href="{{ route('location') }}">Dove siamo</a></li>
        </ul>
    </div>
</nav>

{{-- CONTENUTO PAGINA --}}
<main class="main-content">
    <div class="container">
        @yield('content')
    </div>
</main>

{{-- FOOTER --}}
<footer class="custom-footer">
    <div class="container footer-flex">
        <div class="footer-logo">
            <img src="{{ asset('images/logo-carwash.jpg') }}" alt="Logo">
        </div>

       <div class="footer-info">
    <p><i class="fas fa-map-marker-alt"></i> Via dei Muratori, 73018 Squinzano (LE)</p>
    <p><i class="fas fa-envelope"></i> carwashsquinzano@gmail.com</p>
    <p><i class="fas fa-phone-alt"></i> <a href="tel:+39 3793232483" class="text-yellow-400 hover:text-white">+39 3793232483</a></p>

</div>


        <div class="footer-social">
            <a href="https://www.instagram.com/carwash_sq/" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
    </div>

    <div class="footer-bottom">
        <p>Privacy Policy | Cookie Policy</p>
        <p>P.IVA: 05342840757 · N. REA LE - 359962 · Capitale sociale € 10.000,00</p>
    </div>
</footer>

{{-- COOKIE BANNER --}}
<div id="cookie-banner" class="cookie-banner">
    <p>
        Questo sito utilizza cookie tecnici per migliorare l'esperienza utente. Continuando accetti l'utilizzo dei cookie.
        <a href="{{ route('privacy') }}" class="cookie-link">Scopri di più</a>
    </p>
    <button id="accept-cookies" class="cookie-btn">Accetta</button>
</div>

<script>
// Hamburger menu
document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.getElementById('nav-toggle');
    const menu = document.getElementById('nav-menu');
    toggle.addEventListener('click', () => {
        menu.classList.toggle('hidden');
        menu.classList.toggle('flex');
        menu.classList.toggle('flex-col');
        menu.classList.toggle('bg-black');
        menu.classList.toggle('w-full');
        menu.classList.toggle('absolute');
        menu.classList.toggle('top-full');
        menu.classList.toggle('left-0');
        menu.classList.toggle('p-4');
        menu.classList.toggle('z-50');
    });

    // Cookie banner
    if(!localStorage.getItem('cookieAccepted')){
        document.getElementById('cookie-banner').style.display='flex';
    }
    document.getElementById('accept-cookies').addEventListener('click', function(){
        localStorage.setItem('cookieAccepted','true');
        document.getElementById('cookie-banner').style.display='none';
    });
});
</script>

</body>
</html>
