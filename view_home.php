<?php
// Page d'accueil ultra-premium & 100% Responsive - CENTRE DE SANTÉ CECA 20 LUME
include 'view_public_header.php';
?>

<!-- Hero Section avec Carousel Responsive & Professionnel -->
<header class="bg-gradient-to-br from-slate-950 via-slate-900 to-blue-950 text-white py-12 md:py-20 border-b border-slate-800 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div id="seriousCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
            <div class="carousel-indicators mb-0">
                <button type="button" data-bs-target="#seriousCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
                <button type="button" data-bs-target="#seriousCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#seriousCarousel" data-bs-slide-to="2"></button>
            </div>

            <div class="carousel-inner pb-10">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                        <div class="lg:col-span-7 text-center lg:text-start space-y-6">
                            <span class="inline-block bg-cyan-500/20 text-cyan-300 border border-cyan-500/30 px-4 py-1.5 rounded-full font-bold text-xs uppercase tracking-widest">Excellence & Dévouement Médical</span>
                            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black tracking-tight leading-tight text-white">Votre Santé, Notre Mission Sacrée à CECA 20 LUME</h1>
                            <p class="text-slate-300 text-base sm:text-lg max-w-2xl mx-auto lg:mx-0">Une prise en charge humaine d'exception, rigoureuse et personnalisée pour chaque patient franchissant nos portes.</p>
                            <div class="flex flex-wrap justify-center lg:justify-start gap-4 pt-2">
                                <a href="index.php?action=services" class="bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-extrabold px-8 py-4 rounded-full shadow-lg shadow-cyan-500/20 transition duration-300">
                                    <i class="fa-solid fa-stethoscope mr-2"></i>Nos Services
                                </a>
                                <a href="index.php?action=rdv_public" class="border border-slate-700 hover:bg-slate-800 text-white font-bold px-8 py-4 rounded-full transition duration-300">
                                    <i class="fa-solid fa-calendar-check mr-2"></i>Prendre RDV
                                </a>
                            </div>
                        </div>
                        <div class="lg:col-span-5">
                            <div class="rounded-3xl overflow-hidden shadow-2xl border-4 border-slate-800/80">
                                <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&q=80&w=1000" class="w-full h-64 sm:h-80 md:h-96 object-cover" alt="Équipe Médicale Professionnelle">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                        <div class="lg:col-span-7 text-center lg:text-start space-y-6">
                            <span class="inline-block bg-cyan-500/20 text-cyan-300 border border-cyan-500/30 px-4 py-1.5 rounded-full font-bold text-xs uppercase tracking-widest">Plateau Technique Innovant</span>
                            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black tracking-tight leading-tight text-white">Dossiers Numérisés & Gestion Intelligente</h1>
                            <p class="text-slate-300 text-base sm:text-lg max-w-2xl mx-auto lg:mx-0">Zéro attente inutile. Suivi rigoureux des consultations, facturation transparente et pharmacie connectée en temps réel.</p>
                            <div class="flex flex-wrap justify-center lg:justify-start gap-4 pt-2">
                                <a href="index.php?action=services" class="bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-extrabold px-8 py-4 rounded-full shadow-lg shadow-cyan-500/20 transition duration-300">
                                    <i class="fa-solid fa-folder-medical mr-2"></i>Découvrir le Système
                                </a>
                                <a href="index.php?action=apropos" class="border border-slate-700 hover:bg-slate-800 text-white font-bold px-8 py-4 rounded-full transition duration-300">
                                    <i class="fa-solid fa-hospital mr-2"></i>À Propos
                                </a>
                            </div>
                        </div>
                        <div class="lg:col-span-5">
                            <div class="rounded-3xl overflow-hidden shadow-2xl border-4 border-slate-800/80">
                                <img src="https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&q=80&w=1000" class="w-full h-64 sm:h-80 md:h-96 object-cover" alt="Consultation Médicale">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                        <div class="lg:col-span-7 text-center lg:text-start space-y-6">
                            <span class="inline-block bg-cyan-500/20 text-cyan-300 border border-cyan-500/30 px-4 py-1.5 rounded-full font-bold text-xs uppercase tracking-widest">Permanence 24h/24 & 7j/7</span>
                            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black tracking-tight leading-tight text-white">Une Équipe de Confiance Toujours à Vos Côtés</h1>
                            <p class="text-slate-300 text-base sm:text-lg max-w-2xl mx-auto lg:mx-0">Médecins qualifiés et pharmaciens dévoués pour assurer votre sécurité sanitaire à tout instant au CENTRE DE SANTÉ CECA 20 LUME.</p>
                            <div class="flex flex-wrap justify-center lg:justify-start gap-4 pt-2">
                                <a href="index.php?action=contact" class="bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-extrabold px-8 py-4 rounded-full shadow-lg shadow-cyan-500/20 transition duration-300">
                                    <i class="fa-solid fa-location-dot mr-2"></i>Nous Trouver
                                </a>
                                <a href="index.php?action=login" class="border border-slate-700 hover:bg-slate-800 text-white font-bold px-8 py-4 rounded-full transition duration-300">
                                    <i class="fa-solid fa-user-doctor mr-2"></i>Espace Staff
                                </a>
                            </div>
                        </div>
                        <div class="lg:col-span-5">
                            <div class="rounded-3xl overflow-hidden shadow-2xl border-4 border-slate-800/80">
                                <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&q=80&w=1000" class="w-full h-64 sm:h-80 md:h-96 object-cover" alt="Soins et Clinique Moderne">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Section Confiance & Valeurs avec Cartes Responsive -->
<section class="py-16 sm:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-cyan-600 font-extrabold uppercase tracking-widest text-xs">Pourquoi Choisir CECA 20 LUME</span>
            <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mt-2 mb-4">Une Nouvelle Ère pour la Santé Communautaire</h2>
            <p class="text-slate-600 text-base sm:text-lg">Nous mettons l'innovation technologique et l'expertise humaine au service de votre guérison pour vous garantir des soins d'excellence.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Carte 1 -->
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100 flex flex-col hover:shadow-2xl transition duration-300 group">
                <div class="overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&q=80&w=600" class="w-full h-56 object-cover group-hover:scale-105 transition duration-500" alt="Médecins et Soignants">
                </div>
                <div class="p-8 text-center flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Équipe Médicale d'Élite</h3>
                        <p class="text-slate-600 text-sm mb-6">Des praticiens passionnés, expérimentés et équipés (matériel stérile, seringues de pointe) formés aux meilleures méthodes thérapeutiques.</p>
                    </div>
                    <div>
                        <a href="index.php?action=apropos" class="inline-block bg-slate-100 hover:bg-cyan-500 hover:text-slate-950 text-slate-800 font-bold px-6 py-2.5 rounded-full transition duration-300 text-sm">En savoir plus</a>
                    </div>
                </div>
            </div>

            <!-- Carte 2 -->
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100 flex flex-col hover:shadow-2xl transition duration-300 group">
                <div class="overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&q=80&w=600" class="w-full h-56 object-cover group-hover:scale-105 transition duration-500" alt="Prise en charge des patients">
                </div>
                <div class="p-8 text-center flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Dossiers & Soins Patients</h3>
                        <p class="text-slate-600 text-sm mb-6">Un suivi attentif de chaque patient avec des dossiers médicaux 100% sécurisés et un accompagnement de qualité à chaque étape.</p>
                    </div>
                    <div>
                        <a href="index.php?action=services" class="inline-block bg-slate-100 hover:bg-cyan-500 hover:text-slate-950 text-slate-800 font-bold px-6 py-2.5 rounded-full transition duration-300 text-sm">Nos prestations</a>
                    </div>
                </div>
            </div>

            <!-- Carte 3 -->
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100 flex flex-col hover:shadow-2xl transition duration-300 group">
                <div class="overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&q=80&w=600" class="w-full h-56 object-cover group-hover:scale-105 transition duration-500" alt="Pharmacie et Hôpital Moderne">
                </div>
                <div class="p-8 text-center flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Hôpital & Pharmacie Intégrée</h3>
                        <p class="text-slate-600 text-sm mb-6">Un plateau hospitalier moderne et une pharmacie dotée de tous les médicaments et produits essentiels disponibles immédiatement.</p>
                    </div>
                    <div>
                        <a href="index.php?action=services" class="inline-block bg-slate-100 hover:bg-cyan-500 hover:text-slate-950 text-slate-800 font-bold px-6 py-2.5 rounded-full transition duration-300 text-sm">Voir la pharmacie</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Appel à l'Action Immersif -->
<section class="py-12 sm:py-16 bg-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-slate-950 via-slate-900 to-slate-800 rounded-3xl p-8 sm:p-12 md:p-16 text-center text-white shadow-2xl relative overflow-hidden border border-slate-800">
            <div class="relative z-10 max-w-3xl mx-auto">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-black mb-4 text-cyan-400">Besoin d'une Consultation ou d'un Soin Urgent ?</h2>
                <p class="text-slate-300 text-base sm:text-lg mb-8">Notre personnel soignant vous accueille 24h/24 au sein du CENTRE DE SANTÉ CECA 20 LUME.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="index.php?action=rdv_public" class="inline-flex items-center space-x-2 bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-extrabold px-8 py-4 rounded-full shadow-lg transition duration-300">
                        <i class="fa-solid fa-calendar-check"></i>
                        <span>Prendre RDV en Ligne</span>
                    </a>
                    <a href="index.php?action=contact" class="inline-flex items-center space-x-2 bg-cyan-500 hover:bg-cyan-400 text-slate-950 font-extrabold px-8 py-4 rounded-full shadow-lg transition duration-300">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>Nous Contacter</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'view_public_footer.php'; ?>
