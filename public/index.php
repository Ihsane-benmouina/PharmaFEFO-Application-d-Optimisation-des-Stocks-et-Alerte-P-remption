<?php
session_start(); 

require_once __DIR__ . '/../src/Controller/StockController.php';
require_once __DIR__ . '/../src/Controller/DashboardController.php';
require_once __DIR__ . '/../src/Controller/AuthController.php';

$action = $_GET['action'] ?? 'dashboard';

$stockController = new StockController();
$dashboardController = new DashboardController();
$authController = new AuthController();

if (!isset($_SESSION['user_id']) && $action !== 'login') {
    header("Location: index.php?action=login");
    exit;
}

switch ($action) {
    case 'login':
        $authController->login();
        break;

    case 'logout':
        $authController->logout();
        break;

    case 'dashboard':
        $dashboardController->index();
        break;

    case 'add-batch':
        $stockController->addBatch();
        break;

    case 'dispense':
        $stockController->dispense();
        break;

    case 'expire':
        if ($_SESSION['user_role'] === 'pharmacien' || $_SESSION['user_role'] === 'admin') {
            $stockController->expireBatch();
        } else {
            die("Erreur de sécurité : Droits insuffisants (Pharmacien requis).");
        }
        break;

    case 'report':
        if ($_SESSION['user_role'] === 'admin') {
            $stockController->financialReport();
        } else {
            die("Erreur de sécurité : Réservé à l'Administrateur.");
        }
        break;
    case 'users':
        if ($_SESSION['user_role'] === 'admin') {
            $dashboardController->manageUsers();
        } else {
            die("Erreur de sécurité : Réservé à l'Administrateur.");
        }
        break;

    default:
        $dashboardController->index();
        break;
}