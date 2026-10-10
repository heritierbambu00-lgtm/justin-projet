<?php
// Page dédiée plein écran sans sidebar - Modification Statut Facture
include 'view_internal_header.php';
?>

<div class="max-w-2xl mx-auto px-4 py-12">
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
                <i class="fa-solid fa-wallet mr-3 text-rose-400"></i>
                Mettre à jour la Facture : <?= htmlspecialchars($facture['numero_facture']) ?>
            </h2>
            <span class="bg-rose-500/20 text-rose-300 px-3 py-1 rounded-full text-xs font-bold uppercase">Paiement</span>
        </div>

        <form method="POST" action="index.php?action=factures&sub=update_statut" class="p-8 md:p-10 space-y-6">
            <input type="hidden" name="facture_id" value="<?= $facture['id'] ?>">

            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200 mb-6 space-y-1">
                <p class="text-xs text-slate-500 font-bold uppercase">Patient : <span class="text-slate-900"><?= htmlspecialchars($facture['prenom'] . ' ' . $facture['nom']) ?></span></p>
                <p class="text-xs text-slate-500 font-bold uppercase">Montant : <span class="text-slate-900 font-black"><?= number_format($facture['montant_total'], 0, ',', ' ') ?> F CFA</span></p>
            </div>

            <div class="space-y-6">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Statut de Paiement</label>
                    <select name="statut" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-rose-600 transition">
                        <option value="impaye" <?= $facture['statut'] === 'impaye' ? 'selected' : '' ?>>Impayé</option>
                        <option value="paye" <?= $facture['statut'] === 'paye' ? 'selected' : '' ?>>Payé</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Mode de Paiement</label>
                    <select name="mode_paiement" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-rose-600 transition">
                        <option value="Espèces" <?= $facture['mode_paiement'] === 'Espèces' ? 'selected' : '' ?>>Espèces</option>
                        <option value="Carte Bancaire" <?= $facture['mode_paiement'] === 'Carte Bancaire' ? 'selected' : '' ?>>Carte Bancaire</option>
                        <option value="Mobile Money" <?= $facture['mode_paiement'] === 'Mobile Money' ? 'selected' : '' ?>>Mobile Money</option>
                        <option value="Assurance" <?= $facture['mode_paiement'] === 'Assurance' ? 'selected' : '' ?>>Assurance</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end space-x-4 pt-6 border-t border-slate-100">
                <a href="index.php?action=factures" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold px-8 py-3.5 rounded-xl text-sm transition text-decoration-none">Annuler</a>
                <button type="submit" class="bg-rose-600 hover:bg-rose-500 text-white font-bold px-8 py-3.5 rounded-xl text-sm shadow-lg shadow-rose-600/30 transition">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>

<?php include 'view_internal_footer.php'; ?>
