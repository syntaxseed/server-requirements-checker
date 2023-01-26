<?php
require 'vendor/autoload.php';
require 'config.php';

use MirazMac\Requirements\Checker;
use App\ServerChecker;

$serverChecker = new ServerChecker($_GET['check'] ?? '', $config);

// Display menu:
echo ('<h1>Server Requirements Checker</h1><ul>');
foreach ($config['rulesets'] as $ruleid => $description) {
    echo ('<li><a href="index.php?check=' . $ruleid . '">' . htmlspecialchars($description) . '</a></li>');
}
echo ('</ul>');

// Load chosen rules:
if (!empty($serverChecker->choice)) {
    require('rulesets/rules-' . $serverChecker->choice . '.php');
}

// Run it:
$serverChecker->init();
