<?php // using Loop::defer()

require_once('../vendor/autoload.php');

use Amp\Loop;

Loop::run(function () {
    echo "line 1\n";
    Loop::defer(function () {
        echo "line 3\n";
    });
    echo "line 2\n";
});