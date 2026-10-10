<?php include 'view_public_header.php'; ?>

<div class="min-h-[70vh] flex items-center justify-center py-12 sm:py-16 px-4">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl p-6 sm:p-10 border border-slate-100">
        <div class="text-center mb-8">
            <div class="bg-blue-600 text-white w-16 h-16 sm:w-20 sm:h-20 rounded-3xl mx-auto flex items-center justify-content-center shadow-xl shadow-blue-600/30 mb-4 transform hover:scale-105 transition duration-300">
                <i class="fa-solid fa-user-doctor fa-2x"></i>
            </div>
            <h2 class="text-xl sm:text-2xl font-black text-slate-900">Connexion Staff</h2>
            <p class="text-slate-500 text-xs sm:text-sm mt-1">Accès sécurisé au personnel soignant et admin</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl text-xs sm:text-sm mb-6 flex items-center space-x-2">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span><?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php?action=login" class="space-y-6">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Adresse Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input type="email" name="email" class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-11 pr-4 py-3.5 text-slate-800 text-sm focus:outline-none focus:border-blue-600 transition" required placeholder="nom@exemple.com">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Mot de passe</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input type="password" name="password" class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-11 pr-4 py-3.5 text-slate-800 text-sm focus:outline-none focus:border-blue-600 transition" required placeholder="••••••••">
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-600/30 transition duration-300 flex items-center justify-center space-x-2">
                <span>Se Connecter</span>
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>

        <div class="mt-8 text-center text-xs text-slate-400 border-t border-slate-100 pt-6">
            <p>Comptes démo : admin, medecin, pharma, reception</p>
        </div>
    </div>
</div>

<?php include 'view_public_footer.php'; ?>
