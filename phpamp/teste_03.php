<?php
require_once('../vendor/autoload.php');

use Amp\Loop;

function tick() {
    echo "tick\n";
}

echo "-- before Loop::run()\n";

function teste() {
    Loop::repeat($msInterval = 1000, "tick");
    Loop::delay($msDelay = 5000, "Amp\\Loop::stop");
}

Loop::run("teste");