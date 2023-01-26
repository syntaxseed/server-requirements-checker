<?php
/**
 * Configuration for ServerRequirementsChecker.
 * ------------------------------------------------------
 */

 $config = [
    'rulesets' => [
        // List of rulesets to make available.
        // (ruleset filename part (a-z0-9_) => text description of ruleset)
        'example' => 'Example ruleset',
        'wordpress' => 'Basic WordPress requirements',
        'php' => 'Check PHP version only'
    ],
    'db' => [
        'testdb' => true,                       // Whether or not to run a database connection test.
        'host' => 'localhost',
        'port' => null,
        'dbname' => 'mydatabase',
        'user' => 'user1',
        'password' => 'password'
    ]
];