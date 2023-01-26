<?php
use MirazMac\Requirements\Checker;

// An example ruleset.
$serverChecker->checker
    ->requirePhpVersion('>=8.0')
    ->requirePhpExtensions(['pdo', 'mbstring'])
    ->requireFunctions(['random_bytes'])
    ->requireFile('./composer.json', Checker::CHECK_FILE_EXISTS)
    ->requireDirectory('../../public', Checker::CHECK_IS_READABLE)
    ->requireIniValues([
        'allow_url_fopen' => true,
        'memory_limit'  => '>=64M',
    ])
    ->requireApacheModules([
        'mod_rewrite'
    ]);