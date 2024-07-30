<!-- auth check -->
<?php
require_once 'config_session.inc.php';

if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== 1) {
    header('Location: login.php');
    exit;
}
?>