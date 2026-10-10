<?php
/**
 * Fichier de configuration et connexion PDO
 * CENTRE DE SANTÉ CECA 20 LUME
 * Configurez la connexion avec les variables d'environnement DB_HOST,
 * DB_NAME, DB_USER et DB_PASS.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$db_host = getenv('DB_HOST') ?: 'localhost';
$db_name = getenv('DB_NAME') ?: 'centre_sante_db';
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASS') ?: '';

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    http_response_code(200);
    die("
    <!DOCTYPE html>
    <html lang='fr'>
    <head>
        <meta charset='UTF-8'>
        <title>Erreur de Connexion Base de Données</title>
        <script src='https://cdn.tailwindcss.com'></script>
    </head>
    <body class='bg-slate-900 text-white min-h-screen flex items-center justify-center p-6'>
        <div class='max-w-2xl w-full bg-slate-800 rounded-3xl p-8 border border-rose-500/30 shadow-2xl space-y-6'>
            <div class='flex items-center space-x-3 text-rose-400'>
                <svg class='w-8 h-8' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'></path></svg>
                <h2 class='text-2xl font-black'>Erreur de Connexion MySQL</h2>
            </div>

            <p class='text-slate-300 text-sm leading-relaxed'>
                L'application n'a pas pu se connecter à la base de données MySQL sur InfinityFree.
            </p>

            <div class='bg-slate-950 p-4 rounded-xl font-mono text-xs text-rose-300 space-y-1 overflow-x-auto'>
                <p><b>Hôte :</b> " . htmlspecialchars($db_host) . "</p>
                <p><b>Base :</b> " . htmlspecialchars($db_name) . "</p>
                <p><b>Utilisateur :</b> " . htmlspecialchars($db_user) . "</p>
                <p><b>Détail erreur :</b> " . htmlspecialchars($e->getMessage()) . "</p>
            </div>
        </div>
    </body>
    </html>
    ");
}

/**
 * Classe Singleton optionnelle pour accès POO si nécessaire
 */
class Database {
    private static ?Database $instance = null;
    private PDO $connection;

    private function __construct() {
        global $pdo;
        $this->connection = $pdo;
    }

    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(): PDO {
        return $this->connection;
    }
}

/**
 * Fonction utilitaire de redirection
 */
function redirect($url) {
    header("Location: $url");
    exit();
}

/**
 * Vérification des rôles
 */
function checkRole($allowed_roles = []) {
    if (!isset($_SESSION['user_id'])) {
        redirect('index.php?action=login');
    }
    if (!empty($allowed_roles) && !in_array($_SESSION['user_role'], $allowed_roles)) {
        redirect('index.php?action=dashboard&error=unauthorized');
    }
}
