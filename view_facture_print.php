<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu Facture - <?= htmlspecialchars($facture['numero_facture']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: white; color: #333; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body class="p-5">
    <div class="container border p-4 shadow-sm" style="max-width: 800px;">
        <div class="row border-bottom pb-4 mb-4">
            <div class="col-6">
                <h3 class="fw-bold text-primary">CENTRE DE SANTÉ SANTEPRO</h3>
                <p class="text-muted small mb-0">123 Boulevard de la Santé, Abidjan<br>Tél : +225 27 00 00 00 00<br>Email : contact@santegestion.com</p>
            </div>
            <div class="col-6 text-end">
                <h4 class="fw-bold text-dark">FACTURE / REÇU</h4>
                <p class="text-muted small mb-0">N° : <b><?= htmlspecialchars($facture['numero_facture']) ?></b><br>Date : <?= date('d/m/Y H:i', strtotime($facture['date_facture'])) ?></p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-6">
                <h6 class="text-uppercase text-muted small fw-bold">Informations Patient :</h6>
                <h5 class="fw-bold"><?= htmlspecialchars($facture['prenom'] . ' ' . $facture['nom']) ?></h5>
                <p class="small mb-0">N° Dossier : <?= htmlspecialchars($facture['numero_dossier']) ?><br>Téléphone : <?= htmlspecialchars($facture['telephone'] ?? 'N/C') ?></p>
            </div>
            <div class="col-6 text-end">
                <h6 class="text-uppercase text-muted small fw-bold">Détails de Paiement :</h6>
                <p class="small mb-0">Statut : <b><?= strtoupper($facture['statut']) ?></b><br>Mode : <?= htmlspecialchars($facture['mode_paiement']) ?></p>
            </div>
        </div>

        <table class="table table-bordered mb-4">
            <thead class="table-light">
                <tr>
                    <th>Désignation / Acte Médical</th>
                    <th class="text-end">Montant (F CFA)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Acte Médical / Prestation de Soins (Réf: <?= htmlspecialchars($facture['numero_facture']) ?>)</td>
                    <td class="text-end fw-bold"><?= number_format($facture['montant_total'], 0, ',', ' ') ?></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-end">TOTAL À PAYER :</th>
                    <th class="text-end text-primary fs-5"><?= number_format($facture['montant_total'], 0, ',', ' ') ?> F CFA</th>
                </tr>
            </tfoot>
        </table>

        <div class="row mt-5 pt-4 border-top">
            <div class="col-6 text-muted small">
                <p>Arrêtée la présente facture à la somme de : <b><?= number_format($facture['montant_total'], 0, ',', ' ') ?> Francs CFA</b>.</p>
            </div>
            <div class="col-6 text-end">
                <p class="mb-5">Cachet et Signature</p>
                <b>La Caisse / Administration</b>
            </div>
        </div>

        <div class="text-center mt-5 no-print">
            <button onclick="window.print()" class="btn btn-primary px-4"><i class="fa-solid fa-print me-2"></i> Imprimer ce Reçu</button>
            <a href="index.php?action=factures" class="btn btn-secondary px-4 ms-2">Retour</a>
        </div>
    </div>
</body>
</html>
