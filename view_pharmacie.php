<?php include 'view_header.php'; ?>

<!-- Top Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center pb-6 mb-8 border-b border-slate-200 gap-4">
    <div>
        <h1 class="text-3xl font-black text-slate-900 tracking-tight flex items-center">
            <div class="bg-amber-500 text-slate-950 p-2.5 rounded-xl mr-3 shadow-md shadow-amber-500/30">
                <i class="fa-solid fa-pills"></i>
            </div>
            Gestion de la Pharmacie & Stocks
        </h1>
        <p class="text-slate-500 text-sm mt-1">CENTRE DE SANTÉ CECA 20 LUME — Catalogue, alertes de rupture et mouvements</p>
    </div>
    <div class="flex items-center space-x-3">
        <a href="index.php?action=pharmacie&sub=mouvement_form" class="bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold px-5 py-3 rounded-xl shadow-lg shadow-amber-500/30 transition duration-300 flex items-center space-x-2 text-decoration-none">
            <i class="fa-solid fa-arrows-rotate"></i>
            <span>Mouvement de Stock</span>
        </a>
        <a href="index.php?action=pharmacie&sub=create_form" class="bg-blue-600 hover:bg-blue-500 text-white font-bold px-5 py-3 rounded-xl shadow-lg shadow-blue-600/30 transition duration-300 flex items-center space-x-2 text-decoration-none">
            <i class="fa-solid fa-plus"></i>
            <span>Nouveau Médicament</span>
        </a>
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

<!-- Alertes Stock -->
<?php if (!empty($medicamentsAlerte)): ?>
    <div class="bg-rose-50 border border-rose-200 rounded-2xl p-6 mb-8 shadow-sm">
        <h4 class="font-bold text-rose-900 text-lg mb-2 flex items-center">
            <i class="fa-solid fa-triangle-exclamation mr-2"></i> Attention : Rupture ou Stock Critique Détecté !
        </h4>
        <ul class="list-disc list-inside space-y-1 text-rose-800 text-sm">
            <?php foreach ($medicamentsAlerte as $ma): ?>
                <li><b><?= htmlspecialchars($ma['nom']) ?> (<?= htmlspecialchars($ma['dosage']) ?>)</b> : Stock actuel = <span class="bg-rose-200 text-rose-900 font-bold px-2 py-0.5 rounded"><?= $ma['stock_actuel'] ?></span> (Seuil d'alerte : <?= $ma['stock_alerte'] ?>)</li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- Catalogue Médicaments -->
<div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden mb-10">
    <div class="px-6 py-5 border-b border-slate-100">
        <h3 class="font-bold text-slate-900 text-lg flex items-center">
            <i class="fa-solid fa-box-archive text-amber-500 mr-2"></i> Catalogue & Stocks Actuels
        </h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-400 text-xs font-bold uppercase tracking-wider">
                    <th class="py-4 px-6">Nom du Médicament</th>
                    <th class="py-4 px-6">Dosage</th>
                    <th class="py-4 px-6">Forme</th>
                    <th class="py-4 px-6">Prix Unitaire</th>
                    <th class="py-4 px-6">Stock Actuel</th>
                    <th class="py-4 px-6">Seuil Alerte</th>
                    <th class="py-4 px-6">État Stock</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                <?php if (empty($medicaments)): ?>
                    <tr><td colspan="7" class="text-center py-8 text-slate-400">Aucun médicament dans le catalogue.</td></tr>
                <?php else: ?>
                    <?php foreach ($medicaments as $med): ?>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-4 px-6 font-bold text-slate-900"><?= htmlspecialchars($med['nom']) ?></td>
                            <td class="py-4 px-6 text-slate-600"><?= htmlspecialchars($med['dosage']) ?></td>
                            <td class="py-4 px-6 text-slate-600"><?= htmlspecialchars($med['forme']) ?></td>
                            <td class="py-4 px-6 font-semibold text-slate-800"><?= number_format($med['prix_unitaire'], 0, ',', ' ') ?> F</td>
                            <td class="py-4 px-6"><span class="bg-slate-100 text-slate-800 font-black px-3 py-1 rounded-lg text-xs"><?= $med['stock_actuel'] ?></span></td>
                            <td class="py-4 px-6 text-slate-500 text-xs"><?= $med['stock_alerte'] ?></td>
                            <td class="py-4 px-6">
                                <?php if ($med['stock_actuel'] <= 0): ?>
                                    <span class="bg-rose-50 text-rose-700 border border-rose-200 px-3 py-1 rounded-full text-xs font-semibold">Rupture</span>
                                <?php elseif ($med['stock_actuel'] <= $med['stock_alerte']): ?>
                                    <span class="bg-amber-50 text-amber-700 border border-amber-200 px-3 py-1 rounded-full text-xs font-semibold">Stock Bas</span>
                                <?php else: ?>
                                    <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-3 py-1 rounded-full text-xs font-semibold">Normal</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Historique des mouvements de stock -->
<div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
    <div class="px-6 py-5 border-b border-slate-100">
        <h3 class="font-bold text-slate-900 text-lg flex items-center">
            <i class="fa-solid fa-clock-rotate-left text-slate-500 mr-2"></i> Historique Récent des Mouvements de Stock
        </h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-400 text-xs font-bold uppercase tracking-wider">
                    <th class="py-4 px-6">Date</th>
                    <th class="py-4 px-6">Médicament</th>
                    <th class="py-4 px-6">Type</th>
                    <th class="py-4 px-6">Quantité</th>
                    <th class="py-4 px-6">Motif / Rémunération</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                <?php if (empty($mouvements)): ?>
                    <tr><td colspan="5" class="text-center py-8 text-slate-400">Aucun mouvement récent.</td></tr>
                <?php else: ?>
                    <?php foreach ($mouvements as $mouv): ?>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-4 px-6 text-slate-500 text-xs font-semibold"><?= date('d/m/Y H:i', strtotime($mouv['date_mouvement'])) ?></td>
                            <td class="py-4 px-6 font-bold text-slate-900"><?= htmlspecialchars($mouv['medicament_nom'] . ' (' . $mouv['dosage'] . ')') ?></td>
                            <td class="py-4 px-6">
                                <?php if ($mouv['type_mouvement'] === 'ENTREE'): ?>
                                    <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-3 py-1 rounded-full text-xs font-semibold">ENTRÉE</span>
                                <?php else: ?>
                                    <span class="bg-rose-50 text-rose-700 border border-rose-200 px-3 py-1 rounded-full text-xs font-semibold">SORTIE</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-4 px-6 font-black text-slate-900"><?= $mouv['quantite'] ?></td>
                            <td class="py-4 px-6 text-slate-600"><?= htmlspecialchars($mouv['motif']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'view_footer.php'; ?>
