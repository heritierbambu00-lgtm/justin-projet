<?php include 'view_header.php'; ?>

<!-- Top Welcome Banner & Header -->
<div class="bg-gradient-to-r from-slate-950 via-slate-900 to-blue-950 rounded-3xl p-6 sm:p-8 md:p-10 text-white shadow-2xl mb-8 md:mb-10 relative overflow-hidden border border-slate-800">
    <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <span class="bg-cyan-500/20 text-cyan-300 border border-cyan-500/30 px-3.5 py-1.5 rounded-full font-bold text-xs uppercase tracking-widest inline-block mb-3">CENTRE DE SANTÉ CECA 20 LUME</span>
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-black tracking-tight mb-2">
                Bienvenue, <?= htmlspecialchars($_SESSION['user_nom'] ?? 'Utilisateur') ?> 👋
            </h1>
            <p class="text-slate-300 text-sm max-w-xl">
                Suivi financier et pilotage médical en temps réel. Devise principale : <span class="text-emerald-400 font-bold">Franc Congolais (FC)</span>.
            </p>
        </div>
        <div class="bg-white/10 backdrop-blur-md px-5 py-3.5 rounded-2xl border border-white/10 flex items-center space-x-4 shadow-inner">
            <div class="w-3.5 h-3.5 bg-emerald-400 rounded-full animate-ping"></div>
            <div>
                <p class="text-[10px] sm:text-xs text-slate-300 font-semibold uppercase tracking-wider">Date & Heure</p>
                <p class="text-white font-black text-sm"><?= date('d/m/Y H:i') ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Section Cartes Financières & Recettes (Gains en FC) -->
<div class="mb-10">
    <h2 class="text-lg font-black text-slate-900 mb-4 flex items-center">
        <i class="fa-solid fa-wallet text-emerald-600 mr-2"></i> Bilan Financier & Recettes Encaissées (Gains Soins)
    </h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Carte 1 : Recettes Totales Encaissées -->
        <a href="index.php?action=factures" class="bg-gradient-to-br from-emerald-600 to-teal-700 text-white rounded-2xl p-6 shadow-xl relative overflow-hidden flex items-center justify-between group hover:scale-[1.02] transition duration-300 text-decoration-none">
            <div class="relative z-10">
                <p class="text-xs font-bold text-emerald-200 uppercase tracking-wider mb-1">Recettes Encaissées (Gains)</p>
                <h3 class="text-2xl sm:text-3xl font-black text-white mb-1"><?= number_format($stats['recettes_totales_montant'], 0, ',', ' ') ?> FC</h3>
                <span class="text-xs text-emerald-100 bg-emerald-800/40 px-2.5 py-0.5 rounded-full font-medium"><?= $stats['recettes_totales_count'] ?> facture(s) payée(s)</span>
            </div>
            <div class="bg-white/20 text-white w-14 h-14 rounded-2xl flex items-center justify-center shadow-inner group-hover:rotate-6 transition duration-300">
                <i class="fa-solid fa-coins fa-xl"></i>
            </div>
        </a>

        <!-- Carte 2 : Chiffre d'Affaires du Mois -->
        <a href="index.php?action=factures" class="bg-gradient-to-br from-cyan-600 to-blue-700 text-white rounded-2xl p-6 shadow-xl relative overflow-hidden flex items-center justify-between group hover:scale-[1.02] transition duration-300 text-decoration-none">
            <div class="relative z-10">
                <p class="text-xs font-bold text-cyan-200 uppercase tracking-wider mb-1">Recettes du Mois en Cours</p>
                <h3 class="text-2xl sm:text-3xl font-black text-white mb-1"><?= number_format($stats['recettes_mois'], 0, ',', ' ') ?> FC</h3>
                <span class="text-xs text-cyan-100 bg-cyan-800/40 px-2.5 py-0.5 rounded-full font-medium">Mois de <?= date('F Y') ?></span>
            </div>
            <div class="bg-white/20 text-white w-14 h-14 rounded-2xl flex items-center justify-center shadow-inner group-hover:rotate-6 transition duration-300">
                <i class="fa-solid fa-chart-line fa-xl"></i>
            </div>
        </a>

        <!-- Carte 3 : Impayés à Recouvrer -->
        <a href="index.php?action=factures" class="bg-gradient-to-br from-rose-600 to-red-700 text-white rounded-2xl p-6 shadow-xl relative overflow-hidden flex items-center justify-between group hover:scale-[1.02] transition duration-300 text-decoration-none">
            <div class="relative z-10">
                <p class="text-xs font-bold text-rose-200 uppercase tracking-wider mb-1">Reste à Recouvrer (Impayés)</p>
                <h3 class="text-2xl sm:text-3xl font-black text-white mb-1"><?= number_format($stats['factures_impayees_montant'], 0, ',', ' ') ?> FC</h3>
                <span class="text-xs text-rose-100 bg-rose-800/40 px-2.5 py-0.5 rounded-full font-medium"><?= $stats['factures_impayees_count'] ?> facture(s) en attente</span>
            </div>
            <div class="bg-white/20 text-white w-14 h-14 rounded-2xl flex items-center justify-center shadow-inner group-hover:rotate-6 transition duration-300">
                <i class="fa-solid fa-hand-holding-dollar fa-xl"></i>
            </div>
        </a>
    </div>
</div>

<!-- Cartes Statistiques Activités -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <!-- Card Patients -->
    <a href="index.php?action=patients" class="bg-white rounded-2xl p-6 shadow-xl border border-slate-100 flex items-center justify-between group hover:shadow-2xl transition duration-300 text-decoration-none">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Patients Inscrits</p>
            <h3 class="text-2xl sm:text-3xl font-black text-slate-900"><?= $stats['total_patients'] ?></h3>
        </div>
        <div class="bg-blue-600 text-white w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-600/30">
            <i class="fa-solid fa-users fa-lg"></i>
        </div>
    </a>

    <!-- Card Consultations -->
    <a href="index.php?action=consultations" class="bg-white rounded-2xl p-6 shadow-xl border border-slate-100 flex items-center justify-between group hover:shadow-2xl transition duration-300 text-decoration-none">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Consultations</p>
            <h3 class="text-2xl sm:text-3xl font-black text-slate-900"><?= $stats['total_consultations'] ?></h3>
        </div>
        <div class="bg-cyan-600 text-white w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg shadow-cyan-600/30">
            <i class="fa-solid fa-stethoscope fa-lg"></i>
        </div>
    </a>

    <!-- Card RDV en Attente -->
    <a href="index.php?action=rdv_admin" class="bg-white rounded-2xl p-6 shadow-xl border border-slate-100 flex items-center justify-between group hover:shadow-2xl transition duration-300 text-decoration-none">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">RDV en Attente</p>
            <h3 class="text-2xl sm:text-3xl font-black text-amber-600"><?= $stats['rdv_en_attente'] ?></h3>
        </div>
        <div class="bg-amber-500 text-slate-950 w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg shadow-amber-500/30">
            <i class="fa-solid fa-calendar-check fa-lg"></i>
        </div>
    </a>

    <!-- Card Messages Non Lus -->
    <a href="index.php?action=contact_admin" class="bg-white rounded-2xl p-6 shadow-xl border border-slate-100 flex items-center justify-between group hover:shadow-2xl transition duration-300 text-decoration-none">
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Messages Non Lus</p>
            <h3 class="text-2xl sm:text-3xl font-black text-rose-600"><?= $stats['messages_non_lus'] ?></h3>
        </div>
        <div class="bg-rose-600 text-white w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg shadow-rose-600/30">
            <i class="fa-solid fa-envelope fa-lg"></i>
        </div>
    </a>
</div>

<!-- Grid Principal -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Consultations Récentes -->
    <div class="lg:col-span-8">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-bold text-slate-900 text-base sm:text-lg flex items-center">
                    <i class="fa-solid fa-clock-rotate-left text-blue-600 mr-2"></i> Dernières Consultations Médicales
                </h3>
                <a href="index.php?action=consultations" class="text-xs font-bold text-blue-600 hover:text-blue-800">Voir tout</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[500px]">
                    <thead>
                        <tr class="bg-slate-50 text-slate-400 text-xs font-bold uppercase tracking-wider">
                            <th class="py-4 px-6">Date</th>
                            <th class="py-4 px-6">Patient</th>
                            <th class="py-4 px-6">Médecin</th>
                            <th class="py-4 px-6">Diagnostic</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <?php if (empty($recentConsultations)): ?>
                            <tr><td colspan="4" class="text-center py-6 text-slate-400">Aucune consultation récente.</td></tr>
                        <?php else: ?>
                            <?php foreach ($recentConsultations as $c): ?>
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="py-4 px-6 text-slate-500 text-xs font-semibold"><?= date('d/m/Y H:i', strtotime($c['date_consultation'])) ?></td>
                                    <td class="py-4 px-6 font-bold text-slate-900"><?= htmlspecialchars($c['patient_prenom'] . ' ' . $c['patient_nom']) ?></td>
                                    <td class="py-4 px-6 text-slate-600"><?= htmlspecialchars($c['medecin_nom']) ?></td>
                                    <td class="py-4 px-6">
                                        <span class="bg-blue-50 text-blue-700 border border-blue-200 px-3 py-1 rounded-full text-xs font-semibold">
                                            <?= htmlspecialchars($c['diagnostic']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Actions Rapides -->
    <div class="lg:col-span-4">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6">
            <h3 class="font-bold text-slate-900 text-base sm:text-lg mb-6 flex items-center">
                <i class="fa-solid fa-bolt text-amber-500 mr-2"></i> Actions Rapides
            </h3>
            <div class="space-y-3">
                <a href="index.php?action=patients&sub=create_form" class="flex items-center justify-between p-4 rounded-xl border border-slate-200 hover:border-blue-600 hover:bg-blue-50/50 group transition duration-200 text-decoration-none">
                    <div class="flex items-center space-x-3">
                        <div class="bg-blue-100 text-blue-600 p-2.5 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition">
                            <i class="fa-solid fa-user-plus"></i>
                        </div>
                        <span class="font-bold text-slate-800 text-sm">Enregistrer un Patient</span>
                    </div>
                    <i class="fa-solid fa-chevron-right text-slate-300 group-hover:text-blue-600 transition"></i>
                </a>

                <a href="index.php?action=consultations&sub=create_form" class="flex items-center justify-between p-4 rounded-xl border border-slate-200 hover:border-emerald-600 hover:bg-emerald-50/50 group transition duration-200 text-decoration-none">
                    <div class="flex items-center space-x-3">
                        <div class="bg-emerald-100 text-emerald-600 p-2.5 rounded-xl group-hover:bg-emerald-600 group-hover:text-white transition">
                            <i class="fa-solid fa-stethoscope"></i>
                        </div>
                        <span class="font-bold text-slate-800 text-sm">Nouvelle Consultation</span>
                    </div>
                    <i class="fa-solid fa-chevron-right text-slate-300 group-hover:text-emerald-600 transition"></i>
                </a>

                <a href="index.php?action=factures&sub=create_form" class="flex items-center justify-between p-4 rounded-xl border border-slate-200 hover:border-rose-600 hover:bg-rose-50/50 group transition duration-200 text-decoration-none">
                    <div class="flex items-center space-x-3">
                        <div class="bg-rose-100 text-rose-600 p-2.5 rounded-xl group-hover:bg-rose-600 group-hover:text-white transition">
                            <i class="fa-solid fa-file-invoice"></i>
                        </div>
                        <span class="font-bold text-slate-800 text-sm">Établir une Facture</span>
                    </div>
                    <i class="fa-solid fa-chevron-right text-slate-300 group-hover:text-rose-600 transition"></i>
                </a>

                <a href="index.php?action=pharmacie&sub=mouvement_form" class="flex items-center justify-between p-4 rounded-xl border border-slate-200 hover:border-amber-600 hover:bg-amber-50/50 group transition duration-200 text-decoration-none">
                    <div class="flex items-center space-x-3">
                        <div class="bg-amber-100 text-amber-600 p-2.5 rounded-xl group-hover:bg-amber-600 group-hover:text-white transition">
                            <i class="fa-solid fa-pills"></i>
                        </div>
                        <span class="font-bold text-slate-800 text-sm">Gérer les Stocks de Pharmacie</span>
                    </div>
                    <i class="fa-solid fa-chevron-right text-slate-300 group-hover:text-amber-600 transition"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<?php include 'view_footer.php'; ?>
