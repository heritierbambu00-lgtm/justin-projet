/**
 * Scripts front-end pour l'application SantéPro
 */
document.addEventListener('DOMContentLoaded', function() {
    // Auto-disparition des alertes après 5 secondes
    setTimeout(function() {
        let alerts = document.querySelectorAll('.alert-dismissible');
        alerts.forEach(function(alert) {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);

    console.log("SantéPro - Application Web Intelligente chargée avec succès.");
});
