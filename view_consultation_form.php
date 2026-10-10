<?php
// Page dédiée plein écran sans sidebar - Formulaire Consultation
include 'view_internal_header.php';
?>

<div class="max-w-4xl mx-auto px-4 py-12">
    <!-- Bouton Retour -->
    <div class="mb-6">
        <a href="index.php?action=consultations" class="inline-flex items-center space-x-2 text-slate-600 hover:text-emerald-600 font-bold bg-white px-5 py-2.5 rounded-full shadow-sm border border-slate-200 transition text-decoration-none">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Retour aux consultations</span>
        </a>
    </div>

    <!-- Carte du Formulaire -->
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden">
        <div class="bg-slate-900 text-white px-8 py-6 flex items-center justify-between">
            <h2 class="text-2xl font-black flex items-center">
                <i class="fa-solid fa-stethoscope mr-3 text-emerald-400"></i>
                Enregistrer une Consultation Médicale
            </h2>
            <span class="bg-emerald-500/20 text-emerald-300 px-3 py-1 rounded-full text-xs font-bold uppercase">Nouveau Suivi</span>
        </div>

        <form method="POST" action="index.php?action=consultations" class="p-8 md:p-10 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Patient *</label>
                    <select name="patient_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-emerald-600 transition" required>
                        <option value="">-- Sélectionner un patient --</option>
                        <?php foreach ($patients as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['numero_dossier'] . ' - ' . $p['nom'] . ' ' . $p['prenom']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Médecin *</label>
                    <select name="medecin_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-emerald-600 transition" required>
                        <?php foreach ($medecins as $m): ?>
                            <option value="<?= $m['id'] ?>" <?= ($m['id'] == $_SESSION['user_id']) ? 'selected' : '' ?>><?= htmlspecialchars($m['nom'] . ' (' . $m['role'] . ')') ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Motif de Consultation *</label>
                    <input type="text" name="motif" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-emerald-600 transition" required placeholder="Ex: Fièvre, maux de tête, contrôle...">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Diagnostic Médical *</label>
                    <textarea name="diagnostic" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-emerald-600 transition" rows="4" required placeholder="Résultat de l'examen clinique..."></textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Prescription / Ordonnance</label>
                    <textarea name="prescription" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-emerald-600 transition" rows="3" placeholder="Médicaments prescrits, posologie..."></textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Notes complémentaires</label>
                    <textarea name="notes" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-emerald-600 transition" rows="2" placeholder="Recommandations particulières..."></textarea>
                </div>
            </div>

            <div class="flex justify-end space-x-4 pt-6 border-t border-slate-100">
                <a href="index.php?action=consultations" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold px-8 py-3.5 rounded-xl text-sm transition text-decoration-none">Annuler</a>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold px-8 py-3.5 rounded-xl text-sm shadow-lg shadow-emerald-600/30 transition">
                    Enregistrer la consultation
                </button>
            </div>
        </form>
    </div>
</div>

<?php include 'view_internal_footer.php'; ?>
