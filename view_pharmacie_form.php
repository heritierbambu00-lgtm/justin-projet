<?php
// Page dédiée plein écran sans sidebar - Formulaire Pharmacie (Ajout Médicament ou Mouvement de Stock)
include 'view_internal_header.php';
$isMouvement = ($formType ?? 'med') === 'mouvement';
?>

<div class="max-w-3xl mx-auto px-4 py-12">
    <!-- Bouton Retour -->
    <div class="mb-6">
        <a href="index.php?action=pharmacie" class="inline-flex items-center space-x-2 text-slate-600 hover:text-amber-600 font-bold bg-white px-5 py-2.5 rounded-full shadow-sm border border-slate-200 transition text-decoration-none">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Retour à la pharmacie</span>
        </a>
    </div>

    <!-- Carte du Formulaire -->
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden">
        <div class="bg-slate-900 text-white px-8 py-6 flex items-center justify-between">
            <h2 class="text-2xl font-black flex items-center">
                <i class="fa-solid fa-pills mr-3 text-amber-400"></i>
                <?= $isMouvement ? 'Enregistrer un Mouvement de Stock' : 'Ajouter un Nouveau Médicament' ?>
            </h2>
            <span class="bg-amber-500/20 text-amber-300 px-3 py-1 rounded-full text-xs font-bold uppercase">
                <?= $isMouvement ? 'Stock' : 'Catalogue' ?>
            </span>
        </div>

        <?php if ($isMouvement): ?>
            <form method="POST" action="index.php?action=pharmacie&sub=mouvement" class="p-8 md:p-10 space-y-6">
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Médicament *</label>
                        <select name="medicament_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-amber-600 transition" required>
                            <option value="">-- Choisir un médicament --</option>
                            <?php foreach ($medicaments as $med): ?>
                                <option value="<?= $med['id'] ?>"><?= htmlspecialchars($med['nom'] . ' (' . $med['dosage'] . ') - Stock actuel : ' . $med['stock_actuel']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Type de Mouvement *</label>
                            <select name="type_mouvement" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-amber-600 transition">
                                <option value="ENTREE">ENTRÉE (Approvisionnement)</option>
                                <option value="SORTIE">SORTIE (Délivrance / Vente)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Quantité *</label>
                            <input type="number" name="quantite" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-amber-600 transition" required min="1" value="1">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Motif / Référence</label>
                        <input type="text" name="motif" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-amber-600 transition" placeholder="Ex: Ordonnance patient ou Commande fournisseur">
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-6 border-t border-slate-100">
                    <a href="index.php?action=pharmacie" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold px-8 py-3.5 rounded-xl text-sm transition text-decoration-none">Annuler</a>
                    <button type="submit" class="bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold px-8 py-3.5 rounded-xl text-sm shadow-lg shadow-amber-500/30 transition">
                        Valider le mouvement
                    </button>
                </div>
            </form>
        <?php else: ?>
            <form method="POST" action="index.php?action=pharmacie&sub=add_med" class="p-8 md:p-10 space-y-6">
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Nom du Médicament *</label>
                        <input type="text" name="nom" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-amber-600 transition" required placeholder="Ex: Paracétamol">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Dosage</label>
                            <input type="text" name="dosage" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-amber-600 transition" placeholder="Ex: 500mg">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Forme</label>
                            <select name="forme" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-amber-600 transition">
                                <option value="Comprimé">Comprimé</option>
                                <option value="Gélule">Gélule</option>
                                <option value="Sirop">Sirop</option>
                                <option value="Injection">Injection</option>
                                <option value="Pommade">Pommade</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Prix Unitaire (F) *</label>
                            <input type="number" step="50" name="prix_unitaire" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-amber-600 transition" required value="500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Stock Initial</label>
                            <input type="number" name="stock_actuel" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-amber-600 transition" value="50">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Seuil Alerte</label>
                            <input type="number" name="stock_alerte" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:border-amber-600 transition" value="10">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-6 border-t border-slate-100">
                    <a href="index.php?action=pharmacie" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold px-8 py-3.5 rounded-xl text-sm transition text-decoration-none">Annuler</a>
                    <button type="submit" class="bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold px-8 py-3.5 rounded-xl text-sm shadow-lg shadow-amber-500/30 transition">
                        Ajouter le médicament
                    </button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>

<?php include 'view_internal_footer.php'; ?>
