<?php
require_once 'model_contact_admin.php';
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telephone = trim($_POST['telephone'] ?? '');
    $sujet = trim($_POST['sujet'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (!empty($nom) && !empty($email) && !empty($message)) {
        if (createMessageContact($pdo, $nom, $email, $telephone, $sujet, $message)) {
            $success = "Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.";
        } else {
            $error = "Erreur lors de l'envoi du message.";
        }
    } else {
        $error = "Veuillez remplir les champs obligatoires (Nom, Email, Message).";
    }
}

include 'view_public_header.php';
?>

<!-- Page Header -->
<header class="page-header text-center">
    <div class="max-w-4xl mx-auto px-4">
        <span class="bg-cyan-500/20 text-cyan-300 border border-cyan-500/30 px-4 py-1.5 rounded-full font-bold text-xs uppercase tracking-widest inline-block mb-4">Contactez-nous</span>
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-black mb-4">Nous Sommes à Votre Écoute</h1>
        <p class="text-slate-300 text-base sm:text-lg">Une question, une urgence ou une demande de rendez-vous ? Notre équipe du CENTRE DE SANTÉ CECA 20 LUME vous répond immédiatement.</p>
    </div>
</header>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
        <!-- Coordonnées -->
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-xl border border-slate-100 space-y-6">
                <h3 class="text-xl sm:text-2xl font-black text-slate-900 mb-6 flex items-center">
                    <i class="fa-solid fa-map-location-dot text-blue-600 mr-3"></i> Nos Coordonnées
                </h3>
                <p class="text-slate-600 text-sm">Notre centre est idéalement situé et ouvert 7j/7 pour vous accueillir dans les meilleures conditions.</p>

                <div class="flex items-start space-x-4">
                    <div class="bg-blue-600 text-white p-3.5 rounded-2xl flex-shrink-0 shadow-md shadow-blue-600/30">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 text-base">Adresse Principale</h4>
                        <p class="text-slate-600 text-sm">Boulevard Principal, CECA 20 LUME</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="bg-emerald-600 text-white p-3.5 rounded-2xl flex-shrink-0 shadow-md shadow-emerald-600/30">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 text-base">Téléphone / Urgences</h4>
                        <p class="text-slate-600 text-sm">+243 997 372 697<br>+243 997 372 697</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="bg-cyan-600 text-white p-3.5 rounded-2xl flex-shrink-0 shadow-md shadow-cyan-600/30">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 text-base">Email Officiel</h4>
                        <p class="text-slate-600 text-sm">contact@ceca20lume.com</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="bg-amber-500 text-slate-950 p-3.5 rounded-2xl flex-shrink-0 shadow-md shadow-amber-500/30">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 text-base">Horaires d'Ouverture</h4>
                        <p class="text-slate-600 text-sm">Lundi - Samedi : 08h00 - 20h00<br>Urgences : 24h/24 et 7j/7</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulaire -->
        <div class="lg:col-span-7">
            <div class="bg-white p-6 sm:p-10 rounded-3xl shadow-xl border border-slate-100">
                <h3 class="text-xl sm:text-2xl font-black text-slate-900 mb-2 flex items-center">
                    <i class="fa-solid fa-paper-plane text-blue-600 mr-3"></i> Laissez-nous un Message
                </h3>
                <p class="text-slate-600 text-sm mb-8">Remplissez ce formulaire et notre secrétariat médical vous recontactera dans les plus brefs délais.</p>

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

                <form method="POST" action="index.php?action=contact" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Votre Nom *</label>
                            <input type="text" name="nom" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-slate-800 focus:outline-none focus:border-blue-600 transition text-sm" placeholder="Nom complet" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Votre Téléphone *</label>
                            <input type="text" name="telephone" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-slate-800 focus:outline-none focus:border-blue-600 transition text-sm" placeholder="+225 07..." required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Votre Email *</label>
                        <input type="email" name="email" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-slate-800 focus:outline-none focus:border-blue-600 transition text-sm" placeholder="nom@exemple.com" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Sujet / Motif</label>
                        <select name="sujet" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-slate-800 focus:outline-none focus:border-blue-600 transition text-sm">
                            <option>Demande de rendez-vous médical</option>
                            <option>Renseignements sur les tarifs</option>
                            <option>Disponibilité pharmacie</option>
                            <option>Autre demande</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Votre Message *</label>
                        <textarea name="message" rows="4" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-slate-800 focus:outline-none focus:border-blue-600 transition text-sm" placeholder="Écrivez votre message ici..." required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-600/30 transition duration-300">
                        Envoyer le Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'view_public_footer.php'; ?>
