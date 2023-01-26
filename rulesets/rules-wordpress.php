<?php
use MirazMac\Requirements\Checker;

// Check for WordPress basic requirements.
$serverChecker->checker
    ->requirePhpVersion('>=8.0')
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
