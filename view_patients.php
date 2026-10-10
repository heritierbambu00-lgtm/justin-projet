<?php include 'view_header.php'; ?>

<!-- Top Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center pb-6 mb-8 border-b border-slate-200 gap-4">
    <div>
        <h1 class="text-3xl font-black text-slate-900 tracking-tight flex items-center">
            <div class="bg-blue-600 text-white p-2.5 rounded-xl mr-3 shadow-md shadow-blue-600/30">
                <i class="fa-solid fa-users"></i>
            </div>
            Gestion des Dossiers Patients
        </h1>
        <p class="text-slate-500 text-sm mt-1">CENTRE DE SANTÉ CECA 20 LUME — Inscription, recherche et suivi des dossiers</p>
    </div>
    <a href="index.php?action=patients&sub=create_form" class="bg-blue-600 hover:bg-blue-500 text-white font-bold px-6 py-3 rounded-xl shadow-lg shadow-blue-600/30 transition duration-300 flex items-center space-x-2 text-decoration-none">
        <i class="fa-solid fa-user-plus"></i>
        <span>Nouveau Patient</span>
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

<!-- Barre de recherche -->
<div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 mb-8">
    <form method="GET" action="index.php" class="grid grid-cols-1 md:grid-cols-12 gap-4">
        <input type="hidden" name="action" value="patients">
        <div class="md:col-span-10">
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                    <i class="fa-solid fa-search"></i>
                </span>
                <input type="text" name="search" class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-11 pr-4 py-3.5 text-slate-800 focus:outline-none focus:border-blue-600 transition" placeholder="Rechercher par nom, prénom, numéro de dossier ou téléphone..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            </div>
        </div>
        <div class="md:col-span-2">
            <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-3.5 rounded-xl shadow-md transition duration-300">Rechercher</button>
        </div>
    </form>
</div>

<!-- Liste des Patients -->
<div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-400 text-xs font-bold uppercase tracking-wider">
                    <th class="py-4 px-6">N° Dossier</th>
                    <th class="py-4 px-6">Nom & Prénom</th>
                    <th class="py-4 px-6">Sexe</th>
                    <th class="py-4 px-6">Date Naissance</th>
                    <th class="py-4 px-6">Téléphone</th>
                    <th class="py-4 px-6">Groupe Sanguin</th>
                    <th class="py-4 px-6 text-end">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                <?php if (empty($patients)): ?>
                    <tr><td colspan="7" class="text-center py-8 text-slate-400">Aucun patient trouvé.</td></tr>
                <?php else: ?>
                    <?php foreach ($patients as $p): ?>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-4 px-6"><span class="bg-slate-100 text-slate-700 font-bold px-3 py-1 rounded-lg text-xs"><?= htmlspecialchars($p['numero_dossier']) ?></span></td>
                            <td class="py-4 px-6 font-bold text-slate-900"><?= htmlspecialchars($p['nom'] . ' ' . $p['prenom']) ?></td>
                            <td class="py-4 px-6 text-slate-600"><?= htmlspecialchars($p['sexe']) ?></td>
                            <td class="py-4 px-6 text-slate-600"><?= date('d/m/Y', strtotime($p['date_naissance'])) ?></td>
                            <td class="py-4 px-6 text-slate-600"><?= htmlspecialchars($p['telephone'] ?? 'N/C') ?></td>
                            <td class="py-4 px-6"><span class="bg-cyan-50 text-cyan-700 border border-cyan-200 px-3 py-1 rounded-full text-xs font-semibold"><?= htmlspecialchars($p['groupe_sanguin']) ?></span></td>
                            <td class="py-4 px-6 text-end space-x-2">
                                <a href="index.php?action=patients&sub=detail&id=<?= $p['id'] ?>" class="inline-flex items-center justify-center w-9 h-9 bg-cyan-50 text-cyan-600 hover:bg-cyan-600 hover:text-white rounded-xl transition shadow-sm" title="Dossier médical"><i class="fa-solid fa-folder-open"></i></a>
                                <a href="index.php?action=patients&sub=edit_form&id=<?= $p['id'] ?>" class="inline-flex items-center justify-center w-9 h-9 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white rounded-xl transition shadow-sm text-decoration-none" title="Modifier"><i class="fa-solid fa-pen"></i></a>
                                <a href="index.php?action=patients&sub=delete&id=<?= $p['id'] ?>" class="inline-flex items-center justify-center w-9 h-9 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white rounded-xl transition shadow-sm text-decoration-none" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce patient ?')" title="Supprimer"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'view_footer.php'; ?>
