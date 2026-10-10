<?php include 'view_header.php'; ?>

<!-- Top Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center pb-6 mb-8 border-b border-slate-200 gap-4">
    <div>
        <h1 class="text-3xl font-black text-slate-900 tracking-tight flex items-center">
            <div class="bg-emerald-600 text-white p-2.5 rounded-xl mr-3 shadow-md shadow-emerald-600/30">
                <i class="fa-solid fa-stethoscope"></i>
            </div>
            Suivi des Consultations Médicales
        </h1>
        <p class="text-slate-500 text-sm mt-1">CENTRE DE SANTÉ CECA 20 LUME — Diagnostics, examens et prescriptions</p>
    </div>
    <a href="index.php?action=consultations&sub=create_form" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold px-6 py-3 rounded-xl shadow-lg shadow-emerald-600/30 transition duration-300 flex items-center space-x-2 text-decoration-none">
        <i class="fa-solid fa-plus"></i>
        <span>Nouvelle Consultation</span>
    </a>
</div>

<?php if (!empty($message)): ?>
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl mb-6 shadow-sm flex items-center justify-between">
        <span><?= htmlspecialchars($message) ?></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<?php if (!empty($error)): ?>
    <div class="bg-rose-50 border border-rose-200 text-rose-800 px-5 py-4 rounded-2xl mb-6 shadow-sm flex items-center justify-between">
        <span><?= htmlspecialchars($error) ?></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Liste des Consultations -->
<div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-400 text-xs font-bold uppercase tracking-wider">
                    <th class="py-4 px-6">Date & Heure</th>
                    <th class="py-4 px-6">Dossier / Patient</th>
                    <th class="py-4 px-6">Médecin Traitant</th>
                    <th class="py-4 px-6">Motif</th>
                    <th class="py-4 px-6">Diagnostic</th>
                    <th class="py-4 px-6">Prescription</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                <?php if (empty($consultations)): ?>
                    <tr><td colspan="6" class="text-center py-8 text-slate-400">Aucune consultation enregistrée.</td></tr>
                <?php else: ?>
                    <?php foreach ($consultations as $c): ?>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-4 px-6 text-slate-500 text-xs font-semibold"><?= date('d/m/Y H:i', strtotime($c['date_consultation'])) ?></td>
                            <td class="py-4 px-6">
                                <span class="bg-slate-100 text-slate-700 font-bold px-3 py-1 rounded-lg text-xs"><?= htmlspecialchars($c['numero_dossier']) ?></span><br>
                                <b class="text-slate-900"><?= htmlspecialchars($c['patient_prenom'] . ' ' . $c['patient_nom']) ?></b>
                            </td>
                            <td class="py-4 px-6 text-slate-600"><?= htmlspecialchars($c['medecin_nom']) ?></td>
                            <td class="py-4 px-6 font-bold text-slate-800"><?= htmlspecialchars($c['motif']) ?></td>
                            <td class="py-4 px-6">
                                <span class="bg-cyan-50 text-cyan-700 border border-cyan-200 px-3 py-1 rounded-full text-xs font-semibold">
                                    <?= htmlspecialchars($c['diagnostic']) ?>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-emerald-600 font-medium text-xs"><?= htmlspecialchars($c['prescription'] ?? '-') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'view_footer.php'; ?>
