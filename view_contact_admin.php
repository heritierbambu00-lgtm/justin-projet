<?php include 'view_header.php'; ?>

<!-- Top Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center pb-6 mb-8 border-b border-slate-200 gap-4">
    <div>
        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center">
            <div class="bg-blue-600 text-white p-2.5 rounded-xl mr-3 shadow-md shadow-blue-600/30">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>
            Messages de Contact (Site Public)
        </h1>
        <p class="text-slate-500 text-sm mt-1">CENTRE DE SANTÉ CECA 20 LUME — Suivi des questions et messages envoyés par les visiteurs</p>
    </div>
</div>

<?php if (isset($_GET['msg'])): ?>
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl mb-6 shadow-sm flex items-center justify-between">
        <span>Opération effectuée avec succès !</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Liste des Messages -->
<div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[700px]">
            <thead>
                <tr class="bg-slate-50 text-slate-400 text-xs font-bold uppercase tracking-wider">
                    <th class="py-4 px-6">Date</th>
                    <th class="py-4 px-6">Expéditeur</th>
                    <th class="py-4 px-6">Sujet</th>
                    <th class="py-4 px-6">Message</th>
                    <th class="py-4 px-6">Statut</th>
                    <th class="py-4 px-6 text-end">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                <?php if (empty($messages)): ?>
                    <tr><td colspan="6" class="text-center py-8 text-slate-400">Aucun message de contact reçu.</td></tr>
                <?php else: ?>
                    <?php foreach ($messages as $msg): ?>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-4 px-6 text-slate-500 text-xs font-semibold"><?= date('d/m/Y H:i', strtotime($msg['created_at'])) ?></td>
                            <td class="py-4 px-6">
                                <b class="text-slate-900"><?= htmlspecialchars($msg['nom']) ?></b><br>
                                <span class="text-xs text-slate-500"><?= htmlspecialchars($msg['email']) ?></span><br>
                                <span class="text-xs text-emerald-600 font-medium"><?= htmlspecialchars($msg['telephone'] ?? '') ?></span>
                            </td>
                            <td class="py-4 px-6 font-bold text-slate-800"><?= htmlspecialchars($msg['sujet']) ?></td>
                            <td class="py-4 px-6 text-slate-600 text-xs max-w-xs truncate"><?= htmlspecialchars($msg['message']) ?></td>
                            <td class="py-4 px-6">
                                <?php if ($msg['statut'] === 'traite'): ?>
                                    <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-3 py-1 rounded-full text-xs font-semibold">Traité</span>
                                <?php elseif ($msg['statut'] === 'lu'): ?>
                                    <span class="bg-blue-50 text-blue-700 border border-blue-200 px-3 py-1 rounded-full text-xs font-semibold">Lu</span>
                                <?php else: ?>
                                    <span class="bg-rose-50 text-rose-700 border border-rose-200 px-3 py-1 rounded-full text-xs font-semibold">Non lu</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-4 px-6 text-end space-x-1">
                                <a href="index.php?action=contact_admin&sub=update_statut&id=<?= $msg['id'] ?>&statut=lu" class="inline-flex items-center justify-center px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white rounded-xl transition text-xs font-bold text-decoration-none" title="Marquer lu"><i class="fa-solid fa-eye mr-1"></i> Lu</a>
                                <a href="index.php?action=contact_admin&sub=update_statut&id=<?= $msg['id'] ?>&statut=traite" class="inline-flex items-center justify-center px-3 py-1.5 bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white rounded-xl transition text-xs font-bold text-decoration-none" title="Traité"><i class="fa-solid fa-check mr-1"></i> Traité</a>
                                <a href="index.php?action=contact_admin&sub=delete&id=<?= $msg['id'] ?>" class="inline-flex items-center justify-center w-9 h-9 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white rounded-xl transition text-decoration-none" onclick="return confirm('Supprimer ce message ?')" title="Supprimer"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'view_footer.php'; ?>
