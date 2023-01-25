<?php
namespace App;

use MirazMac\Requirements\Checker;


class ServerChecker
{
    public Checker $checker;
    public string $choice;

    public function __construct(string $choice) {
        $this->checker = new Checker;
        $this->choice = $_GET['check'] ?? '';
    }

    /**
     * Run the application and display the result.
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

    private function showResults(){
        $output = $this->checker->check();

        if ($this->checker->isSatisfied()) {
            echo "<span style='color:#00aa00;font-weight:bold;font-size:1.2em;'>&#x2705; Requirements are met.</span>";
        } else {
            echo "<span style='color:#cc0000;font-weight:bold;font-size:1.2em;'>&#x274c; Requirements are NOT met:</span><br><br>&bull; ";
            echo join("<br>\n&bull; ", $this->checker->getErrors());
        }
    }
}