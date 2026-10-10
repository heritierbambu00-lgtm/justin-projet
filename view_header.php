<?php
if (!isset($_SESSION['user_id'])) return;
?>
<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CENTRE DE SANTÉ CECA 20 LUME - Administration</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #1e293b; }
        .sidebar-desktop { background: #0b192c; width: 320px; min-height: 100vh; flex-shrink: 0; }
        .nav-link-custom {
            transition: all 0.25s ease;
            border-radius: 12px;
            color: #94a3b8;
        }
        .nav-link-custom:hover, .nav-link-custom.active {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: white;
            box-shadow: 0 10px 20px -5px rgba(2, 132, 199, 0.4);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-cyan-500 selection:text-slate-950">

<!-- Top Bar Mobile (Visible uniquement sur mobile / tablette < lg) -->
<div class="lg:hidden bg-slate-950 text-white p-4 flex justify-between items-center sticky top-0 z-50 border-b border-slate-800">
    <div class="flex items-center space-x-3">
        <div class="bg-cyan-500 text-slate-950 rounded-xl p-2">
            <i class="fa-solid fa-hospital fa-md"></i>
        </div>
        <span class="font-black text-sm tracking-wider">CECA 20 LUME</span>
    </div>
    <button onclick="toggleAdminSidebar()" class="text-slate-300 hover:text-white p-2 rounded-xl focus:outline-none">
        <i class="fa-solid fa-bars fa-xl"></i>
    </button>
</div>

<div class="flex min-h-screen overflow-x-hidden">
    <!-- Sidebar Desktop & Mobile -->
    <nav id="adminSidebar" class="sidebar-desktop p-6 text-white flex flex-col justify-between shadow-2xl fixed top-0 bottom-0 left-0 z-50 overflow-y-auto transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
        <div>
            <!-- Brand -->
            <div class="flex items-center space-x-3 mb-8 px-2 pt-2">
                <div class="bg-cyan-500 text-slate-950 rounded-2xl p-3 shadow-lg">
                    <i class="fa-solid fa-hospital fa-xl"></i>
                </div>
                <div>
                    <h1 class="text-white font-black text-base tracking-wide">CECA 20 LUME</h1>
                    <span class="text-xs text-cyan-400 uppercase tracking-widest font-semibold">Espace Interne</span>
                </div>
            </div>

            <!-- User Profile Card -->
            <div class="bg-slate-800/80 backdrop-blur rounded-2xl p-4 mb-8 border border-slate-700/60 shadow-inner">
                <div class="flex items-center space-x-3">
                    <div class="bg-gradient-to-tr from-cyan-500 to-blue-600 text-white rounded-xl w-12 h-12 flex items-center justify-center font-bold text-lg shadow-md">
                        <?= strtoupper(substr($_SESSION['user_nom'] ?? 'U', 0, 1)) ?>
                    </div>
                    <div class="overflow-hidden">
                        <h4 class="text-white font-bold text-sm truncate"><?= htmlspecialchars($_SESSION['user_nom'] ?? '') ?></h4>
                        <span class="inline-block bg-cyan-500/20 text-cyan-300 text-xs px-2.5 py-0.5 rounded-full font-semibold uppercase mt-0.5">
                            <?= htmlspecialchars($_SESSION['user_role'] ?? '') ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <ul class="space-y-2.5 font-medium">
                <li>
                    <a href="index.php?action=dashboard" class="nav-link-custom flex items-center px-4 py-3 <?= (($action ?? '') === 'dashboard') ? 'active' : '' ?>">
                        <i class="fa-solid fa-chart-line w-8 text-lg"></i>
                        <span class="text-sm">Tableau de Bord</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=patients" class="nav-link-custom flex items-center px-4 py-3 <?= (($action ?? '') === 'patients') ? 'active' : '' ?>">
                        <i class="fa-solid fa-users w-8 text-lg"></i>
                        <span class="text-sm">Dossiers Patients</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=consultations" class="nav-link-custom flex items-center px-4 py-3 <?= (($action ?? '') === 'consultations') ? 'active' : '' ?>">
                        <i class="fa-solid fa-stethoscope w-8 text-lg"></i>
                        <span class="text-sm">Consultations</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=factures" class="nav-link-custom flex items-center px-4 py-3 <?= (($action ?? '') === 'factures') ? 'active' : '' ?>">
                        <i class="fa-solid fa-file-invoice-dollar w-8 text-lg"></i>
                        <span class="text-sm">Facturation</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=pharmacie" class="nav-link-custom flex items-center px-4 py-3 <?= (($action ?? '') === 'pharmacie') ? 'active' : '' ?>">
                        <i class="fa-solid fa-pills w-8 text-lg"></i>
                        <span class="text-sm">Pharmacie & Stock</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=rdv_admin" class="nav-link-custom flex items-center px-4 py-3 <?= (($action ?? '') === 'rdv_admin') ? 'active' : '' ?>">
                        <i class="fa-solid fa-calendar-check w-8 text-lg"></i>
                        <span class="text-sm">Rendez-vous</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=contact_admin" class="nav-link-custom flex items-center px-4 py-3 <?= (($action ?? '') === 'contact_admin') ? 'active' : '' ?>">
                        <i class="fa-solid fa-envelope-open-text w-8 text-lg"></i>
                        <span class="text-sm">Messages Contact</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Logout Button -->
        <div class="pt-6 border-t border-slate-800">
            <a href="index.php?action=logout" class="flex items-center px-4 py-3 text-rose-400 hover:bg-rose-500/10 rounded-xl transition duration-200 font-semibold text-sm">
                <i class="fa-solid fa-right-from-bracket w-8 text-lg"></i>
                <span>Déconnexion</span>
            </a>
        </div>
    </nav>

    <script>
        function toggleAdminSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            sidebar.classList.toggle('-translate-x-full');
        }
    </script>

    <!-- Main Content Area with left margin on desktop -->
    <main class="flex-1 lg:ml-[320px] p-4 sm:p-8 md:p-12 min-h-screen bg-slate-50 w-full overflow-x-hidden">
