<?php
// Page dédiée plein écran sans sidebar - Formulaire Facture
include 'view_internal_header.php';
?>

<div class="max-w-3xl mx-auto px-4 py-12">
    <!-- Bouton Retour -->
    <div class="mb-6">
        <a href="index.php?action=factures" class="inline-flex items-center space-x-2 text-slate-600 hover:text-rose-600 font-bold bg-white px-5 py-2.5 rounded-full shadow-sm border border-slate-200 transition text-decoration-none">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Retour à la facturation</span>
        </a>
    </div>

    <!-- Carte du Formulaire -->
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden">
        <div class="bg-slate-900 text-white px-8 py-6 flex items-center justify-between">
            <h2 class="text-2xl font-black flex items-center">
                <i class="fa-solid fa-file-invoice-dollar mr-3 text-rose-400"></i>
                Établir une Nouvelle Facture
            </h2>
            <span class="bg-rose-500/20 text-rose-300 px-3 py-1 rounded-full text-xs font-bold uppercase"><?= $newNumero ?></span>
        </div>

        <form method="POST" action="index.php?action=factures&sub=create" class="p-8 md:p-10 space-y-6">
            <div class="space-y-6">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Numéro Facture (Auto)</label>
                    <input type="text" class="w-full bg-slate-100 border border-slate-200 rounded-xl px-4 py-3.5 text-sm font-bold text-slate-600" value="<?= $newNumero ?>" readonly>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Patient *</label>
                    <select name="patient_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-rose-600 transition" required>
                        <option value="">-- Sélectionner un patient --</option>
                        <?php foreach ($patients as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['numero_dossier'] . ' - ' . $p['nom'] . ' ' . $p['prenom']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Acte Médical</label>
                    <select name="acte_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-rose-600 transition">
                        <option value="">-- Choisir un acte tarifé --</option>
                        <?php foreach ($actes as $a): ?>
                            <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['libelle'] . ' (' . number_format($a['prix'], 0, ',', ' ') . ' F)') ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Ou Montant Personnalisé (F CFA)</label>
                    <input type="number" step="100" name="montant" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-rose-600 transition" placeholder="Ex: 7500">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Mode de Paiement</label>
                        <select name="mode_paiement" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-rose-600 transition">
                            <option value="Espèces">Espèces</option>
                            <option value="Mobile Money">Mobile Money</option>
                            <option value="Carte Bancaire">Carte Bancaire</option>
                            <option value="Assurance">Assurance</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Statut Initial</label>
                        <select name="statut" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-rose-600 transition">
                            <option value="paye">Payé</option>
                            <option value="impaye" selected>Impayé</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4 pt-6 border-t border-slate-100">
                <a href="index.php?action=factures" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold px-8 py-3.5 rounded-xl text-sm transition text-decoration-none">Annuler</a>
                <button type="submit" class="bg-rose-600 hover:bg-rose-500 text-white font-bold px-8 py-3.5 rounded-xl text-sm shadow-lg shadow-rose-600/30 transition">
                    Créer la facture
                </button>
            </div>
        </form>
    </div>
</div>

<?php include 'view_internal_footer.php'; ?>
