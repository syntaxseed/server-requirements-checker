<?php
require 'vendor/autoload.php';

use MirazMac\Requirements\Checker;
use App\ServerChecker;


$serverChecker = new ServerChecker($_GET['check'] ?? '');

// CONFIG:  Define requirements

switch ($serverChecker->choice) {
    case 'example':
        $serverChecker->checker->requirePhpVersion('>=8.0')
            ->requirePhpExtensions(['pdo', 'mbstring'])
            ->requireFunctions(['random_bytes'])
            ->requireFile('./composer.json', Checker::CHECK_FILE_EXISTS)
            ->requireDirectory('./src', Checker::CHECK_IS_READABLE)
            ->requireDirectory('./public', Checker::CHECK_IS_READABLE)
            ->requireIniValues([
                'allow_url_fopen' => true,
                'memory_limit'  => '>=64M',
            ])
            ->requireApacheModules([
                'mod_rewrite'
            ]);
        break;
    case 'wordpress':
        $serverChecker->checker->requirePhpVersion('>=8.0')
            ->requirePhpExtensions([
                'Core', 'curl', 'dom', 'exif', 'fileinfo', 'hash', 'imagick', 'json', 'mbstring', 'mysqli', 'openssl', 'pcre', 'pdo', 'sodium', 'xml', 'zip'
            ])
            ->requireFunctions([
                'set_time_limit', 'ignore_user_abort'
            ])
            ->requireIniValues([
                'allow_url_fopen' => true,
                'memory_limit'  => '>=64M',
            ])
            ->requireApacheModules([
                'mod_alias', 'mod_authz_host', 'mod_deflate', 'mod_dir', 'mod_expires', 'mod_headers', 'mod_mime', 'mod_rewrite', 'mod_log_config', 'mod_autoindex', 'mod_negotiation', 'mod_setenvif'
            ]);
        break;
    case 'basic':
            $serverChecker->checker->requirePhpVersion('>=8.0');
            break;
    default:
        $serverChecker->choice = ''; // No valid option.
}


echo <<<EOF
<h1>Server Requirements Checker</h1>
<ul>
    <li><a href="index.php?check=wordpress">WordPress</a></li>
    <li><a href="index.php?check=basic">Basic PHP v8.0+</a></li>
    <li><a href="index.php?check=example">Example</a></li>
</ul>
EOF;

// Run it!
$serverChecker->init();
