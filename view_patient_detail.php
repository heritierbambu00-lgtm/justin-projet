<?php include 'view_header.php'; ?>

<!-- Top Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center pb-6 mb-8 border-b border-slate-200 gap-4">
    <div>
        <h1 class="text-3xl font-black text-slate-900 tracking-tight flex items-center">
            <div class="bg-blue-600 text-white p-2.5 rounded-xl mr-3 shadow-md shadow-blue-600/30">
                <i class="fa-solid fa-folder-open"></i>
            </div>
            Dossier Médical : <?= htmlspecialchars($patient['nom'] . ' ' . $patient['prenom']) ?>
        </h1>
        <p class="text-slate-500 text-sm mt-1">CENTRE DE SANTÉ CECA 20 LUME — Consultation complète du dossier</p>
    </div>
    <a href="index.php?action=patients" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold px-5 py-2.5 rounded-xl text-sm transition flex items-center space-x-2 text-decoration-none">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Retour aux patients</span>
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Infos Patient -->
    <div class="lg:col-span-4">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 space-y-4">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <h3 class="font-bold text-slate-900 text-lg flex items-center">
                    <i class="fa-solid fa-user-circle text-blue-600 mr-2"></i> Fiche Patient
                </h3>
                <span class="bg-blue-50 text-blue-700 font-bold px-3 py-1 rounded-full text-xs"><?= htmlspecialchars($patient['numero_dossier']) ?></span>
            </div>

            <div class="space-y-3 text-sm">
                <p class="flex justify-between"><span class="text-slate-500 font-medium">Nom & Prénom :</span> <b class="text-slate-900"><?= htmlspecialchars($patient['nom'] . ' ' . $patient['prenom']) ?></b></p>
                <p class="flex justify-between"><span class="text-slate-500 font-medium">Naissance :</span> <span class="text-slate-800 font-semibold"><?= date('d/m/Y', strtotime($patient['date_naissance'])) ?> (<?= date_diff(date_create($patient['date_naissance']), date_create('today'))->y ?> ans)</span></p>
                <p class="flex justify-between"><span class="text-slate-500 font-medium">Sexe :</span> <span class="text-slate-800 font-semibold"><?= $patient['sexe'] === 'M' ? 'Masculin' : 'Féminin' ?></span></p>
                <p class="flex justify-between"><span class="text-slate-500 font-medium">Téléphone :</span> <span class="text-slate-800 font-semibold"><?= htmlspecialchars($patient['telephone'] ?? 'N/C') ?></span></p>
                <p class="flex justify-between"><span class="text-slate-500 font-medium">Adresse :</span> <span class="text-slate-800 font-semibold"><?= htmlspecialchars($patient['adresse'] ?? 'N/C') ?></span></p>
                <p class="flex justify-between"><span class="text-slate-500 font-medium">Groupe Sanguin :</span> <span class="bg-cyan-50 text-cyan-700 font-bold px-2.5 py-0.5 rounded-full text-xs"><?= htmlspecialchars($patient['groupe_sanguin']) ?></span></p>
            </div>

            <div class="pt-4 border-t border-slate-100">
                <h4 class="font-bold text-rose-600 text-xs uppercase tracking-wider mb-2 flex items-center">
                    <i class="fa-solid fa-triangle-exclamation mr-1.5"></i> Antécédents / Allergies
                </h4>
                <div class="bg-rose-50 border border-rose-200 text-rose-800 p-3 rounded-xl text-xs leading-relaxed">
                    <?= nl2br(htmlspecialchars($patient['antecedents'] ?? 'Aucun antécédent particulier signalé.')) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Historique Consultations -->
    <div class="lg:col-span-8">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100">
                <h3 class="font-bold text-slate-900 text-lg flex items-center">
                    <i class="fa-solid fa-stethoscope text-emerald-600 mr-2"></i> Historique des Consultations
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[500px]">
                    <thead>
                        <tr class="bg-slate-50 text-slate-400 text-xs font-bold uppercase tracking-wider">
                            <th class="py-4 px-6">Date</th>
                            <th class="py-4 px-6">Médecin</th>
                            <th class="py-4 px-6">Motif</th>
                            <th class="py-4 px-6">Diagnostic & Prescription</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <?php if (empty($consultations)): ?>
                            <tr><td colspan="4" class="text-center py-8 text-slate-400">Aucune consultation enregistrée pour ce patient.</td></tr>
                        <?php else: ?>
                            <?php foreach ($consultations as $c): ?>
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="py-4 px-6 text-slate-500 text-xs font-semibold"><?= date('d/m/Y H:i', strtotime($c['date_consultation'])) ?></td>
                                    <td class="py-4 px-6 text-slate-800 font-semibold"><?= htmlspecialchars($c['medecin_nom']) ?></td>
                                    <td class="py-4 px-6 font-bold text-slate-900"><?= htmlspecialchars($c['motif']) ?></td>
                                    <td class="py-4 px-6 space-y-1">
                                        <div class="text-xs font-bold text-blue-700">Diag : <?= htmlspecialchars($c['diagnostic']) ?></div>
                                        <div class="text-xs text-emerald-600">Ordo : <?= htmlspecialchars($c['prescription'] ?? 'Aucune') ?></div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'view_footer.php'; ?>
