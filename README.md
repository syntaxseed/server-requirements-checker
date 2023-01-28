# Server Requirements Checker

<div align="center">
    <img src="https://img.shields.io/github/tag/syntaxseed/server-requirements-checker.svg" alt="GitHub tag (latest SemVer)">&nbsp;&nbsp;
    <img src="https://img.shields.io/github/license/syntaxseed/templateseed" alt="License: MIT">
    &nbsp;&nbsp;<a href="https://github.com/syntaxseed#donatecontribute"><img src="https://img.shields.io/badge/Sponsor-Project-blue" alt="Sponsor Project" /></a>
</div>

* Version: 0.2.0
* Author: Sherri Wheeler
* License: MIT
* Uses: https://github.com/MirazMac/php-requirements-checker

## Usage

* **Pre-requisites:** This tool assumes that you have PHP installed and your webserver configured and a webpage accessible in your webapp. Checking the setup of these basics is beyond the scope of this tool.

1. Clone this repo into a directory inside your project's public web app directory.
   * `git clone git@github.com:syntaxseed/server-requirements-checker.git checker`
2. Create your own rulesets in the `rulesets/` directory.
   * Copy and edit: `rulesets/rules-example.php`.
   * Extra docs about defining rules see: https://github.com/MirazMac/php-requirements-checker
3. Create a new config file by copying `config-sample.php` to `config.php` or run: `composer run-script setup`.
   * Edit the config.php file and define which rulesets to make available in the menu and whether to do a DB test.
4. Visit the `checker/index.php` file in a browser to run the checks.
5. When satisfied, delete this directory.

## ToDo

* Make it work as a command line tool as well.
* Nicer formatting/basic stylesheet.