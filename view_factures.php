<?php
include 'view_header.php';
require_once 'model_dashboard.php';
$finStats = getDashboardStats($pdo);
?>

<!-- Top Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center pb-6 mb-8 border-b border-slate-200 gap-4">
    <div>
        <h1 class="text-3xl font-black text-slate-900 tracking-tight flex items-center">
            <div class="bg-rose-600 text-white p-2.5 rounded-xl mr-3 shadow-md shadow-rose-600/30">
                <i class="fa-solid fa-file-invoice-dollar"></i>
            </div>
            Facturation des Actes Médicaux (Franc Congolais)
        </h1>
        <p class="text-slate-500 text-sm mt-1">CENTRE DE SANTÉ CECA 20 LUME — Émission de factures, encaissements et reçus</p>
    </div>
    <a href="index.php?action=factures&sub=create_form" class="bg-rose-600 hover:bg-rose-500 text-white font-bold px-6 py-3 rounded-xl shadow-lg shadow-rose-600/30 transition duration-300 flex items-center space-x-2 text-decoration-none">
        <i class="fa-solid fa-plus"></i>
        <span>Établir une Facture</span>
    </a>
</div>

<!-- Synthèse Financière (Recettes Encaissées FC vs Impayés) -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-emerald-600 text-white p-6 rounded-2xl shadow-xl flex items-center justify-between">
        <div>
            <p class="text-xs font-bold text-emerald-200 uppercase tracking-wider mb-1">Recettes Encaissées (Gains)</p>
            <h3 class="text-2xl sm:text-3xl font-black"><?= number_format($finStats['recettes_totales_montant'], 0, ',', ' ') ?> FC</h3>
            <p class="text-xs text-emerald-100 mt-1"><?= $finStats['recettes_totales_count'] ?> facture(s) réglée(s)</p>
        </div>
        <div class="bg-white/20 p-4 rounded-2xl">
            <i class="fa-solid fa-coins fa-2x"></i>
        </div>
    </div>

    <div class="bg-rose-600 text-white p-6 rounded-2xl shadow-xl flex items-center justify-between">
        <div>
            <p class="text-xs font-bold text-rose-200 uppercase tracking-wider mb-1">Reste à Recouvrer (Impayés)</p>
            <h3 class="text-2xl sm:text-3xl font-black"><?= number_format($finStats['factures_impayees_montant'], 0, ',', ' ') ?> FC</h3>
            <p class="text-xs text-rose-100 mt-1"><?= $finStats['factures_impayees_count'] ?> facture(s) en attente</p>
        </div>
        <div class="bg-white/20 p-4 rounded-2xl">
            <i class="fa-solid fa-hand-holding-dollar fa-2x"></i>
        </div>
    </div>
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

<!-- Liste des Factures -->
<div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-400 text-xs font-bold uppercase tracking-wider">
                    <th class="py-4 px-6">N° Facture</th>
                    <th class="py-4 px-6">Date</th>
                    <th class="py-4 px-6">Patient</th>
                    <th class="py-4 px-6">Montant Total</th>
                    <th class="py-4 px-6">Statut</th>
                    <th class="py-4 px-6">Mode Paiement</th>
                    <th class="py-4 px-6 text-end">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                <?php if (empty($factures)): ?>
                    <tr><td colspan="7" class="text-center py-8 text-slate-400">Aucune facture enregistrée.</td></tr>
                <?php else: ?>
                    <?php foreach ($factures as $f): ?>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-4 px-6"><span class="bg-slate-100 text-slate-700 font-bold px-3 py-1 rounded-lg text-xs"><?= htmlspecialchars($f['numero_facture']) ?></span></td>
                            <td class="py-4 px-6 text-slate-500 text-xs font-semibold"><?= date('d/m/Y H:i', strtotime($f['date_facture'])) ?></td>
                            <td class="py-4 px-6 font-bold text-slate-900"><?= htmlspecialchars($f['patient_prenom'] . ' ' . $f['patient_nom']) ?></td>
                            <td class="py-4 px-6 font-black text-slate-900"><?= number_format($f['montant_total'], 0, ',', ' ') ?> FC</td>
                            <td class="py-4 px-6">
                                <?php if ($f['statut'] === 'paye'): ?>
                                    <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-3 py-1 rounded-full text-xs font-semibold">Payé</span>
                                <?php else: ?>
                                    <span class="bg-rose-50 text-rose-700 border border-rose-200 px-3 py-1 rounded-full text-xs font-semibold">Impayé</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-4 px-6 text-slate-600 text-xs font-medium"><?= htmlspecialchars($f['mode_paiement']) ?></td>
                            <td class="py-4 px-6 text-end space-x-2">
                                <a href="index.php?action=factures&sub=print&id=<?= $f['id'] ?>" target="_blank" class="inline-flex items-center justify-center w-9 h-9 bg-slate-100 text-slate-700 hover:bg-slate-900 hover:text-white rounded-xl transition shadow-sm text-decoration-none" title="Imprimer reçu"><i class="fa-solid fa-print"></i></a>
                                <a href="index.php?action=factures&sub=edit_form&id=<?= $f['id'] ?>" class="inline-flex items-center justify-center w-9 h-9 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white rounded-xl transition shadow-sm text-decoration-none" title="Mettre à jour le statut"><i class="fa-solid fa-wallet"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'view_footer.php'; ?>
