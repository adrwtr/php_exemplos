<?php
require_once('../vendor/autoload.php');

use Amp\Loop;

// quero gerar 10 valores aleatorios
// sempre que eles forem divisiveis por 5,
// quero esperar 5 segundos para retornar

$i = 0;

function make_seed()
{
  list($usec, $sec) = explode(' ', microtime());
  return $sec + $usec * 1000000;
}

// $example = function () use ($message) {

$funcao = function ($watcherId)
{
    $nr_random = rand(0, 100);

    if ($nr_random % 5 == 0) {
        // sleep(5);
    }

    global $i;
    $i++;

    if ($i == 10) {
        Loop::cancel($watcherId);
    }

    echo $i . " = " . $nr_random;
    echo "\n";

    return $nr_random;
};


function tick() {
    echo "tick\n";
}

echo "-- before Loop::run()\n";

function teste() {
    srand(make_seed());
    Loop::repeat($msInterval = 500, $GLOBALS['funcao']);
    // Loop::delay($msDelay = 5000, "Amp\\Loop::stop");
}

$nr_start = Loop::now();
Loop::run("teste");
$nr_fim = Loop::now();
echo ($nr_fim - $nr_start) / 1000;
echo " segundos";