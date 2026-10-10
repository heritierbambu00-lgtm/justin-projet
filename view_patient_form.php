<?php
// Page dédiée plein écran sans sidebar - Formulaire Patient (Création / Modification)
include 'view_internal_header.php';
$isEdit = isset($patient) && !empty($patient);
?>

<div class="max-w-4xl mx-auto px-4 py-12">
    <!-- Bouton Retour -->
    <div class="mb-6">
        <a href="index.php?action=patients" class="inline-flex items-center space-x-2 text-slate-600 hover:text-blue-600 font-bold bg-white px-5 py-2.5 rounded-full shadow-sm border border-slate-200 transition text-decoration-none">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Retour à la liste des patients</span>
        </a>
    </div>

    <!-- Carte du Formulaire -->
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden">
        <div class="bg-slate-900 text-white px-8 py-6 flex items-center justify-between">
            <h2 class="text-2xl font-black flex items-center">
                <i class="fa-solid fa-user-pen mr-3 text-cyan-400"></i>
                <?= $isEdit ? 'Modifier le Dossier Patient : ' . htmlspecialchars($patient['nom'] . ' ' . $patient['prenom']) : 'Enregistrer un Nouveau Patient' ?>
            </h2>
            <span class="bg-cyan-500/20 text-cyan-300 px-3 py-1 rounded-full text-xs font-bold uppercase">
                <?= $isEdit ? 'Édition' : 'Nouveau Dossier' ?>
            </span>
        </div>

        <form method="POST" action="index.php?action=patients&sub=<?= $isEdit ? 'edit' : 'create' ?>" class="p-8 md:p-10 space-y-6">
            <?php if ($isEdit): ?>
                <input type="hidden" name="id" value="<?= $patient['id'] ?>">
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Numéro de Dossier</label>
                    <input type="text" name="numero_dossier" class="w-full bg-slate-100 border border-slate-200 rounded-xl px-4 py-3.5 text-sm font-bold text-slate-600" value="<?= $isEdit ? htmlspecialchars($patient['numero_dossier']) : $newDossier ?>" readonly>
                </div>
                <div></div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Nom *</label>
                    <input type="text" name="nom" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-blue-600 transition" required placeholder="Ex: Kouassi" value="<?= $isEdit ? htmlspecialchars($patient['nom']) : '' ?>">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Prénom *</label>
                    <input type="text" name="prenom" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-blue-600 transition" required placeholder="Ex: Jean" value="<?= $isEdit ? htmlspecialchars($patient['prenom']) : '' ?>">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Date de Naissance *</label>
                    <input type="date" name="date_naissance" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-blue-600 transition" required value="<?= $isEdit ? $patient['date_naissance'] : '' ?>">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Sexe *</label>
                    <select name="sexe" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-blue-600 transition">
                        <option value="M" <?= ($isEdit && $patient['sexe'] === 'M') ? 'selected' : '' ?>>Masculin</option>
                        <option value="F" <?= ($isEdit && $patient['sexe'] === 'F') ? 'selected' : '' ?>>Féminin</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Groupe Sanguin</label>
                    <select name="groupe_sanguin" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-blue-600 transition">
                        <?php foreach(['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'Inconnu'] as $gs): ?>
                            <option value="<?= $gs ?>" <?= ($isEdit && $patient['groupe_sanguin'] === $gs) ? 'selected' : ($gs === 'Inconnu' ? 'selected' : '') ?>><?= $gs ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Téléphone</label>
                    <input type="text" name="telephone" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-blue-600 transition" placeholder="+225 ..." value="<?= $isEdit ? htmlspecialchars($patient['telephone']) : '' ?>">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Adresse</label>
                    <input type="text" name="adresse" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-blue-600 transition" placeholder="Ville, Quartier" value="<?= $isEdit ? htmlspecialchars($patient['adresse']) : '' ?>">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Antécédents Médicaux / Allergies</label>
                    <textarea name="antecedents" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-blue-600 transition" rows="4" placeholder="Ex: Asthme, Allergie pénicilline..."><?= $isEdit ? htmlspecialchars($patient['antecedents']) : '' ?></textarea>
                </div>
            </div>

            <div class="flex justify-end space-x-4 pt-6 border-t border-slate-100">
                <a href="index.php?action=patients" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold px-8 py-3.5 rounded-xl text-sm transition text-decoration-none">Annuler</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold px-8 py-3.5 rounded-xl text-sm shadow-lg shadow-blue-600/30 transition">
                    <?= $isEdit ? 'Enregistrer les modifications' : 'Créer le dossier patient' ?>
                </button>
            </div>
        </form>
    </div>
</div>

<?php include 'view_internal_footer.php'; ?>
