<?php
// En-tête public ultra-premium avec Tailwind CSS & Bootstrap Carousel
?>
<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CENTRE DE SANTÉ CECA 20 LUME - Accueil</title>
    <!-- Bootstrap 5 CSS (Inclus pour le bon fonctionnement du Carousel) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #0f172a; }
        .page-header {
            background: linear-gradient(135deg, rgba(11, 25, 44, 0.96) 0%, rgba(29, 91, 121, 0.92) 100%), url('https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&q=80&w=1600') center/cover no-repeat;
            color: white;
            padding: 100px 0 80px 0;
        }
        /* Bootstrap Carousel Fix Override pour éviter tout chevauchement */
        .carousel-item {
            display: none;
        }
        .carousel-item.active {
            display: block;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-cyan-500 selection:text-slate-950">

    <!-- Navbar Public Responsive Tailwind -->
    <nav class="bg-slate-950/95 backdrop-blur-md text-white fixed top-0 left-0 right-0 z-50 shadow-2xl border-b border-slate-800/80 py-3.5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <!-- Brand Logo -->
            <a href="index.php?action=home" class="flex items-center space-x-3 text-white font-extrabold text-xl tracking-wider group text-decoration-none">
                <div class="bg-gradient-to-tr from-cyan-500 to-blue-600 text-slate-950 rounded-2xl p-2.5 shadow-lg shadow-cyan-500/20 group-hover:scale-105 transition duration-300">
                    <i class="fa-solid fa-hospital fa-lg text-slate-950"></i>
                </div>
                <div>
                    <span class="block text-base sm:text-lg font-black tracking-wider text-white leading-tight">CECA 20 LUME</span>
                    <span class="block text-[10px] sm:text-xs font-semibold text-cyan-400 uppercase tracking-widest">Centre de Santé</span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-8 font-medium text-sm">
                <a href="index.php?action=home" class="<?= ($_GET['action'] ?? 'home') === 'home' ? 'text-cyan-400 font-bold' : 'text-slate-300 hover:text-white' ?> transition duration-200 text-decoration-none">Accueil</a>
                <a href="index.php?action=services" class="<?= ($_GET['action'] ?? '') === 'services' ? 'text-cyan-400 font-bold' : 'text-slate-300 hover:text-white' ?> transition duration-200 text-decoration-none">Services</a>
                <a href="index.php?action=apropos" class="<?= ($_GET['action'] ?? '') === 'apropos' ? 'text-cyan-400 font-bold' : 'text-slate-300 hover:text-white' ?> transition duration-200 text-decoration-none">À Propos</a>
                <a href="index.php?action=contact" class="<?= ($_GET['action'] ?? '') === 'contact' ? 'text-cyan-400 font-bold' : 'text-slate-300 hover:text-white' ?> transition duration-200 text-decoration-none">Contact</a>
                <a href="index.php?action=rdv_public" class="<?= ($_GET['action'] ?? '') === 'rdv_public' ? 'text-cyan-400 font-bold' : 'text-emerald-400 hover:text-emerald-300' ?> transition duration-200 flex items-center space-x-1.5 font-bold text-decoration-none">
                    <i class="fa-solid fa-calendar-check"></i>
                    <span>Prendre RDV</span>
                </a>
                <a href="index.php?action=login" class="bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-extrabold px-6 py-2.5 rounded-full shadow-lg shadow-cyan-500/20 transform hover:-translate-y-0.5 transition duration-300 flex items-center space-x-2 text-decoration-none">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span>Connexion Staff</span>
                </a>
            </div>

            <!-- Mobile Menu Toggle Button -->
            <div class="lg:hidden flex items-center space-x-3">
                <a href="index.php?action=rdv_public" class="bg-emerald-500 text-slate-950 px-3 py-1.5 rounded-full font-bold text-xs flex items-center space-x-1 text-decoration-none">
                    <i class="fa-solid fa-calendar-check"></i>
                    <span>RDV</span>
                </a>
                <button id="mobileMenuBtn" onclick="toggleMobileMenu()" class="text-slate-300 hover:text-white p-2 rounded-xl focus:outline-none">
                    <i class="fa-solid fa-bars fa-xl"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Dropdown Menu -->
        <div id="mobileMenu" class="hidden lg:hidden bg-slate-950 border-t border-slate-800 px-6 py-4 space-y-3 font-medium text-sm">
            <a href="index.php?action=home" class="block text-slate-300 hover:text-cyan-400 py-1 text-decoration-none">Accueil</a>
            <a href="index.php?action=services" class="block text-slate-300 hover:text-cyan-400 py-1 text-decoration-none">Services</a>
            <a href="index.php?action=apropos" class="block text-slate-300 hover:text-cyan-400 py-1 text-decoration-none">À Propos</a>
            <a href="index.php?action=contact" class="block text-slate-300 hover:text-cyan-400 py-1 text-decoration-none">Contact</a>
            <a href="index.php?action=rdv_public" class="block text-emerald-400 font-bold py-1 text-decoration-none">Prendre Rendez-vous</a>
            <a href="index.php?action=login" class="block bg-cyan-500 text-slate-950 text-center font-bold py-2.5 rounded-xl mt-2 text-decoration-none">Connexion Staff</a>
        </div>
    </nav>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }
    </script>
    <div style="height: 76px;"></div>
