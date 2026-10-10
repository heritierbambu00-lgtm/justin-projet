<?php
// Page publique de prise de rendez-vous en ligne - CENTRE DE SANTÉ CECA 20 LUME
require_once 'model_rdv.php';
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom_patient'] ?? '');
    $tel = trim($_POST['telephone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $date = trim($_POST['date_rdv'] ?? '');
    $motif = trim($_POST['motif'] ?? '');

    if (!empty($nom) && !empty($tel) && !empty($date) && !empty($motif)) {
        if (createRendezVous($pdo, $nom, $tel, $email, $date, $motif)) {
            $success = "Votre demande de rendez-vous a été envoyée avec succès ! Notre secrétariat vous contactera pour confirmation.";
        } else {
            $error = "Erreur lors de l'enregistrement de votre demande.";
        }
    } else {
        $error = "Veuillez remplir tous les champs obligatoires.";
    }
}

include 'view_public_header.php';
?>

<!-- Page Header -->
<header class="page-header text-center">
    <div class="max-w-4xl mx-auto px-4">
        <span class="bg-cyan-500/20 text-cyan-300 border border-cyan-500/30 px-4 py-1.5 rounded-full font-bold text-xs uppercase tracking-widest inline-block mb-4">Espace Patients Externes</span>
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-black mb-4">Prendre un Rendez-vous en Ligne</h1>
        <p class="text-slate-300 text-base sm:text-lg">Réservez votre consultation au CENTRE DE SANTÉ CECA 20 LUME en quelques clics.</p>
    </div>
</header>

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden p-6 sm:p-10 md:p-12">
        <h3 class="text-xl sm:text-2xl font-black text-slate-900 mb-2 flex items-center">
            <i class="fa-solid fa-calendar-days text-cyan-600 mr-3"></i> Formulaire de Réservation
        </h3>
        <p class="text-slate-600 text-sm mb-8">Remplissez les informations ci-dessous pour planifier votre visite médicale.</p>

        <?php if (!empty($success)): ?>
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-2xl mb-6 text-sm flex items-center space-x-3">
                <i class="fa-solid fa-circle-check fa-lg text-emerald-600"></i>
                <span><?= htmlspecialchars($success) ?></span>
            </div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="bg-rose-50 border border-rose-200 text-rose-800 p-4 rounded-2xl mb-6 text-sm flex items-center space-x-3">
                <i class="fa-solid fa-triangle-exclamation fa-lg text-rose-600"></i>
                <span><?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php?action=rdv_public" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Nom & Prénom *</label>
                    <input type="text" name="nom_patient" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-slate-800 focus:outline-none focus:border-cyan-600 transition text-sm" required placeholder="Ex: Kouassi Jean">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Téléphone *</label>
                    <input type="text" name="telephone" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-slate-800 focus:outline-none focus:border-cyan-600 transition text-sm" required placeholder="+225 07...">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Adresse Email</label>
                    <input type="email" name="email" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-slate-800 focus:outline-none focus:border-cyan-600 transition text-sm" placeholder="nom@exemple.com">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Date & Heure Souhaitées *</label>
                    <input type="datetime-local" name="date_rdv" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-slate-800 focus:outline-none focus:border-cyan-600 transition text-sm" required>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Motif de Consultation *</label>
                <textarea name="motif" rows="4" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-slate-800 focus:outline-none focus:border-cyan-600 transition text-sm" required placeholder="Précisez la raison de votre visite (ex: Fièvre, consultation générale, pédiatrie...)"></textarea>
            </div>

            <button type="submit" class="w-full bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-bold py-4 rounded-xl shadow-lg shadow-cyan-500/20 transition duration-300">
                Confirmer la Demande de Rendez-vous
            </button>
        </form>
    </div>
</div>

<?php include 'view_public_footer.php'; ?>
