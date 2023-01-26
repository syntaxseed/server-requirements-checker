<?php
namespace App;

use MirazMac\Requirements\Checker;

class ServerChecker
{
    public Checker $checker;
    public string $choice;
    private array $config;

    public function __construct(string $choice, array $config) {
        $this->checker = new Checker;
        $this->choice = $this->cleanChoice($choice);
        $this->config = $config;
    }

    /**
     * Run the application and perform the checking steps.
     */
    public function init()
    {
        if (empty($this->choice)) {
            echo('<b>Please select an option.</b>');
            exit();
        }

        echo('<h2>Checking ruleset "' . $this->choice . '":</h2>');

        $this->printRules();

        $this->showResults();

        $this->checkDB();
    }

    /**
     * Test the database connection if set in the config.
     */
    private function checkDB()
    {
        if (!$this->config['db']['testdb']) {
            return;
        }

        $mysqli = new \mysqli($this->config['db']['host'], $this->config['db']['user'], $this->config['db']['password'], $this->config['db']['dbname'], $this->config['db']['port']);
        if ($mysqli->connect_error) {
            $this->failure('Could not connect to database "'.$this->config['db']['dbname'].'" at "'.$this->config['db']['user'].'@'.$this->config['db']['host'].'".');
        }else{
            $this->success('Connected to database "'.$this->config['db']['dbname'].'" at "'.$this->config['db']['user'].'@'.$this->config['db']['host'].'" successfully.');
        }
    }

    /**
     * Clean the string key for the ruleset. Alphanumeric and underscores only.
     */
    public function cleanChoice(string $choice): string
    {
        return preg_replace('/a-z0-9_/i', '', $choice);
    }

    /**
     * Display the currently set rules in a nicely formatted block.
     */
    private function printRules()
    {
        $ruleset = $this->checker->getRequirements();
        //var_dump($ruleset);
        $printAsArray = ['extensions', 'functions', 'apache_modules']; // Display these as just an array not key-value pairs.
        echo('<div style="padding:10px 20px;background-color:#eee;display:inline-block;"><ul>');
            foreach ($ruleset as $key => $required) {
                echo('<li><b>'.$key.':</b>');
                if (in_array($key, $printAsArray)) {
                    echo(json_encode(array_values($required)));
                } else {
                    echo('<ul>');
                    foreach ($required as $name => $rule) {
                        echo('<li><b>'.$name.'</b>&nbsp;&nbsp;' . json_encode($rule) . '</li>');
                    }
                    echo('</ul>');
                }
                echo('</li>');
            }
        echo('</ul></div><br clear="all" /><br>');
    }

    /**
     * Perform the check and output the results.
     */
    private function showResults(){
        $output = $this->checker->check();

        if ($this->checker->isSatisfied()) {
            $this->success('Requirements are met.');

        } else {
            $this->failure('Requirements are NOT met:');
            echo ('&bull; ' . join("<br>\n&bull; ", $this->checker->getErrors()).'<br>');
        }
    }

    private function success(string $message)
    {
        echo('<br><div style="display:inline-block;color:#00aa00;font-weight:bold;font-size:1.2em;">&#x2705; '.$message.'</div><br>');
    }

    private function failure(string $message)
    {
        echo ('<br><div style="display:inline-block;color:#cc0000;font-weight:bold;font-size:1.2em;">&#x274c; '.$message.'</div><br>');
    }
}