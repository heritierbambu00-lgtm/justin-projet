<?php
// En-tête interne pour les formulaires en plein écran (sans menu public, avec info utilisateur et bouton retour)
if (!isset($_SESSION['user_id'])) {
    redirect('index.php?action=login');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CENTRE DE SANTÉ CECA 20 LUME - Saisie</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #1e293b; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col justify-between">

    <!-- Top Navbar Interne (Sans menu public) -->
    <nav class="bg-slate-900 text-white shadow-xl border-b border-slate-800 py-4 px-6 md:px-12 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <div class="bg-cyan-500 text-slate-950 rounded-xl p-2.5 shadow-lg">
                <i class="fa-solid fa-hospital fa-lg"></i>
            </div>
            <div>
                <span class="block text-base font-black tracking-wider text-white">CECA 20 LUME</span>
                <span class="block text-xs font-medium text-cyan-400 uppercase tracking-widest">Espace Formulaire Sécurisé</span>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            <div class="bg-slate-800 px-4 py-2 rounded-xl border border-slate-700 flex items-center space-x-3 text-xs">
                <div class="bg-cyan-500 text-slate-950 font-bold w-7 h-7 rounded-lg flex items-center justify-center">
                    <?= strtoupper(substr($_SESSION['user_nom'] ?? 'U', 0, 1)) ?>
                </div>
                <div>
                    <span class="block font-bold text-white"><?= htmlspecialchars($_SESSION['user_nom'] ?? '') ?></span>
                    <span class="text-cyan-400 font-semibold uppercase"><?= htmlspecialchars($_SESSION['user_role'] ?? '') ?></span>
                </div>
            </div>
            <a href="index.php?action=logout" class="bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 px-3.5 py-2 rounded-xl text-xs font-bold transition duration-200 flex items-center space-x-1.5" title="Se déconnecter">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span class="hidden sm:inline">Déconnexion</span>
            </a>
        </div>
    </nav>

    <!-- Main Content Container -->
    <main class="flex-1">
