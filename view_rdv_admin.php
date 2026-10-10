<?php include 'view_header.php'; ?>

<!-- Top Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center pb-6 mb-8 border-b border-slate-200 gap-4">
    <div>
        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center">
            <div class="bg-cyan-600 text-white p-2.5 rounded-xl mr-3 shadow-md shadow-cyan-600/30">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            Gestion des Rendez-vous (Patient / Externe)
        </h1>
        <p class="text-slate-500 text-sm mt-1">CENTRE DE SANTÉ CECA 20 LUME — Suivi et validation des demandes de rendez-vous en ligne</p>
    </div>
</div>

<?php if (isset($_GET['msg'])): ?>
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl mb-6 shadow-sm flex items-center justify-between">
        <span>Opération effectuée avec succès !</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Liste des Rendez-vous -->
<div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[650px]">
            <thead>
                <tr class="bg-slate-50 text-slate-400 text-xs font-bold uppercase tracking-wider">
                    <th class="py-4 px-6">Date Demandée</th>
                    <th class="py-4 px-6">Patient / Contact</th>
                    <th class="py-4 px-6">Téléphone / Email</th>
                    <th class="py-4 px-6">Motif</th>
                    <th class="py-4 px-6">Statut</th>
                    <th class="py-4 px-6 text-end">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                <?php if (empty($rendezvous)): ?>
                    <tr><td colspan="6" class="text-center py-8 text-slate-400">Aucun rendez-vous enregistré.</td></tr>
                <?php else: ?>
                    <?php foreach ($rendezvous as $rdv): ?>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-4 px-6 font-bold text-slate-900 text-xs"><?= date('d/m/Y H:i', strtotime($rdv['date_rdv'])) ?></td>
                            <td class="py-4 px-6 font-bold text-slate-900"><?= htmlspecialchars($rdv['nom_patient']) ?></td>
                            <td class="py-4 px-6 text-slate-600 text-xs">
                                <div><i class="fa-solid fa-phone text-emerald-600 mr-1"></i> <?= htmlspecialchars($rdv['telephone']) ?></div>
                                <div><i class="fa-solid fa-envelope text-blue-600 mr-1"></i> <?= htmlspecialchars($rdv['email'] ?? 'N/C') ?></div>
                            </td>
                            <td class="py-4 px-6 text-slate-700"><?= htmlspecialchars($rdv['motif']) ?></td>
                            <td class="py-4 px-6">
                                <?php if ($rdv['statut'] === 'confirme'): ?>
                                    <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-3 py-1 rounded-full text-xs font-semibold">Confirmé</span>
                                <?php elseif ($rdv['statut'] === 'annule'): ?>
                                    <span class="bg-rose-50 text-rose-700 border border-rose-200 px-3 py-1 rounded-full text-xs font-semibold">Annulé</span>
                                <?php else: ?>
                                    <span class="bg-amber-50 text-amber-700 border border-amber-200 px-3 py-1 rounded-full text-xs font-semibold">En attente</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-4 px-6 text-end space-x-1">
                                <a href="index.php?action=rdv_admin&sub=update_statut&id=<?= $rdv['id'] ?>&statut=confirme" class="inline-flex items-center justify-center px-3 py-1.5 bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white rounded-xl transition text-xs font-bold text-decoration-none" title="Confirmer"><i class="fa-solid fa-check mr-1"></i> Confirmer</a>
                                <a href="index.php?action=rdv_admin&sub=update_statut&id=<?= $rdv['id'] ?>&statut=annule" class="inline-flex items-center justify-center px-3 py-1.5 bg-amber-50 text-amber-600 hover:bg-amber-600 hover:text-white rounded-xl transition text-xs font-bold text-decoration-none" title="Annuler"><i class="fa-solid fa-ban mr-1"></i> Annuler</a>
                                <a href="index.php?action=rdv_admin&sub=delete&id=<?= $rdv['id'] ?>" class="inline-flex items-center justify-center w-9 h-9 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white rounded-xl transition text-decoration-none" onclick="return confirm('Supprimer ce rendez-vous ?')" title="Supprimer"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'view_footer.php'; ?>
