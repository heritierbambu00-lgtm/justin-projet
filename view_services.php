<?php include 'view_public_header.php'; ?>

<!-- Page Header -->
<header class="page-header text-center">
    <div class="max-w-4xl mx-auto px-4">
        <span class="bg-cyan-500/20 text-cyan-300 border border-cyan-500/30 px-4 py-1.5 rounded-full font-bold text-xs uppercase tracking-widest inline-block mb-4">Prestations Médicales</span>
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-black mb-4">Nos Services de Santé de Pointe</h1>
        <p class="text-slate-300 text-base sm:text-lg">Au CENTRE DE SANTÉ CECA 20 LUME, nous offrons une prise en charge globale, rigoureuse et informatisée pour chaque patient.</p>
    </div>
</header>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
        <!-- Service 1 -->
        <div class="bg-white rounded-3xl shadow-xl p-8 border border-slate-100 hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
            <div>
                <div class="bg-blue-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-blue-600/30 group-hover:scale-105 transition duration-300">
                    <i class="fa-solid fa-folder-medical fa-2x"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-3">Dossier Patient Numérique</h3>
                <p class="text-slate-600 text-sm mb-6 leading-relaxed">Centralisation sécurisée de l'état civil, des antécédents médicaux, des groupes sanguins et de l'historique complet des consultations pour un suivi sans faille.</p>
            </div>
            <ul class="space-y-2.5 text-slate-700 text-sm pt-4 border-t border-slate-100">
                <li class="flex items-center"><i class="fa-solid fa-check text-emerald-500 mr-2"></i> Numérotation automatique</li>
                <li class="flex items-center"><i class="fa-solid fa-check text-emerald-500 mr-2"></i> Recherche instantanée</li>
                <li class="flex items-center"><i class="fa-solid fa-check text-emerald-500 mr-2"></i> Alertes antécédents</li>
            </ul>
        </div>

        <!-- Service 2 -->
        <div class="bg-white rounded-3xl shadow-xl p-8 border border-slate-100 hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
            <div>
                <div class="bg-emerald-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-emerald-600/30 group-hover:scale-105 transition duration-300">
                    <i class="fa-solid fa-stethoscope fa-2x"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-3">Consultations & Soins</h3>
                <p class="text-slate-600 text-sm mb-6 leading-relaxed">Enregistrement par le corps médical des motifs de consultation, des diagnostics approfondis et des ordonnances pharmaceutiques associées.</p>
            </div>
            <ul class="space-y-2.5 text-slate-700 text-sm pt-4 border-t border-slate-100">
                <li class="flex items-center"><i class="fa-solid fa-check text-emerald-500 mr-2"></i> Médecin traitant dédié</li>
                <li class="flex items-center"><i class="fa-solid fa-check text-emerald-500 mr-2"></i> Historique des visites</li>
                <li class="flex items-center"><i class="fa-solid fa-check text-emerald-500 mr-2"></i> Ordonnances informatisées</li>
            </ul>
        </div>

        <!-- Service 3 -->
        <div class="bg-white rounded-3xl shadow-xl p-8 border border-slate-100 hover:shadow-2xl transition duration-300 flex flex-col justify-between group">
            <div>
                <div class="bg-amber-500 text-slate-950 w-16 h-16 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-amber-500/30 group-hover:scale-105 transition duration-300">
                    <i class="fa-solid fa-pills fa-2x"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-3">Pharmacie & Stock</h3>
                <p class="text-slate-600 text-sm mb-6 leading-relaxed">Contrôle rigoureux des entrées et sorties de médicaments, suivi des lots et alertes automatiques en cas de stock critique ou de rupture.</p>
            </div>
            <ul class="space-y-2.5 text-slate-700 text-sm pt-4 border-t border-slate-100">
                <li class="flex items-center"><i class="fa-solid fa-check text-emerald-500 mr-2"></i> Alertes de stock bas</li>
                <li class="flex items-center"><i class="fa-solid fa-check text-emerald-500 mr-2"></i> Traçabilité des lots</li>
                <li class="flex items-center"><i class="fa-solid fa-check text-emerald-500 mr-2"></i> Catalogue certifié</li>
            </ul>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Service 4 -->
        <div class="bg-white rounded-3xl shadow-xl p-8 border border-slate-100 flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-6">
            <div class="bg-rose-600 text-white w-16 h-16 rounded-2xl flex-shrink-0 flex items-center justify-center shadow-lg shadow-rose-600/30">
                <i class="fa-solid fa-file-invoice-dollar fa-2x"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Facturation & Actes Médicaux</h3>
                <p class="text-slate-600 text-sm leading-relaxed">Établissement instantané des factures, gestion des règlements (espèces, mobile money, assurance) et édition de reçus imprimables.</p>
            </div>
        </div>

        <!-- Service 5 -->
        <div class="bg-white rounded-3xl shadow-xl p-8 border border-slate-100 flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-6">
            <div class="bg-cyan-600 text-white w-16 h-16 rounded-2xl flex-shrink-0 flex items-center justify-center shadow-lg shadow-cyan-600/30">
                <i class="fa-solid fa-chart-line fa-2x"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Tableau de Bord Intelligent</h3>
                <p class="text-slate-600 text-sm leading-relaxed">Indicateurs clés en temps réel pour l'administration : nombre de patients, factures impayées, alertes pharmacie et statistiques globales.</p>
            </div>
        </div>
    </div>
</div>

<?php include 'view_public_footer.php'; ?>
