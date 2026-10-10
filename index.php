<?php
/**
 * Point d'entrée unique (Routeur MVC)
 * Centre de Santé Intelligent
 */
require_once 'config.php';

$action = $_GET['action'] ?? 'home';

// Si non connecté et action restreinte, redirection vers login
$public_actions = ['home', 'services', 'apropos', 'contact', 'rdv_public', 'login'];
if (!isset($_SESSION['user_id']) && !in_array($action, $public_actions)) {
    $action = 'login';
}

switch ($action) {
    case 'home':
        include 'view_home.php';
        break;

    case 'services':
        include 'view_services.php';
        break;

    case 'apropos':
        include 'view_apropos.php';
        break;

    case 'contact':
        include 'view_contact.php';
        break;

    case 'rdv_public':
        include 'view_rdv_public.php';
        break;

    case 'login':
        if (isset($_SESSION['user_id'])) {
            redirect('index.php?action=dashboard');
        }
        require_once 'controller_auth.php';
        break;

    case 'logout':
        session_destroy();
        redirect('index.php?action=home');
        break;

    case 'dashboard':
        require_once 'controller_dashboard.php';
        break;

    case 'patients':
        require_once 'controller_patient.php';
        break;

    case 'consultations':
        require_once 'controller_consultation.php';
        break;

    case 'factures':
        require_once 'controller_facture.php';
        break;

    case 'pharmacie':
        require_once 'controller_pharmacie.php';
        break;

    case 'rdv_admin':
        require_once 'controller_rdv.php';
        break;

    case 'contact_admin':
        require_once 'controller_contact_admin.php';
        break;

    default:
        http_response_code(404);
        echo "<div style='text-align:center; margin-top:50px;'><h1>404 - Page introuvable</h1><p>La page demandée n'existe pas.</p><a href='index.php?action=home'>Retour à l'accueil</a></div>";
        break;
}
