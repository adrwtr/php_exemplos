<?php
require_once('../vendor/autoload.php');

use Amp\Loop;
use function Amp\asyncCall;


$sinaleira = false;
$contador = 0;

$contador2 = 0;
$sinaleira2 = false;




function getNumerosPrimos($array) {
    global $sinaleira;
    global $contador;

    // if ($sinaleira == true) {
    //     return 0;
    // }

    $contador = $contador + 1;
    echo "Execucao rapida - " . $contador;
    $arrPrimos = [];

    foreach ($array as $valor) {
        $sn_divisivel = false;

        for ($i = 2; $i < $valor; $i++) {
            if ($valor % $i == 0) {
                $sn_divisivel = true;
            }
        }

        if ($sn_divisivel == false) {
            $arrPrimos[] = $valor;
        }
    }


    $sinaleira = false;
    echo "\nfinalizou a execucao RAPIDA\n";

    return $arrPrimos;
}


function getNumerosPrimos2($array) {
    global $sinaleira2;
    global $contador2;

    // if ($sinaleira2 == true) {
    //     return 0;
    // }

    $contador2 = $contador2 + 1;
    echo "execucao lenta - " . $contador2;
    $arrPrimos = [];

    foreach ($array as $valor) {
        $sn_divisivel = false;

        for ($i = 2; $i < $valor; $i++) {
            if ($valor % $i == 0) {
                $sn_divisivel = true;
            }
        }

        if ($sn_divisivel == false) {
            $arrPrimos[] = $valor;
        }
    }


    $sinaleira2 = false;
    echo "\nfinalizou a execucao lenta\n";

    return $arrPrimos;
}

function teste()
{
    asyncCall(function () {
        $arrNovo = [];

        for ($i = 100; $i <= 5000; $i++) {
            $arrNovo[] = $i;
        }

        getNumerosPrimos($arrNovo);
    });
}

function teste2()
{
    asyncCall(function () {
        $arrNovo = [];

        for ($i = 100; $i <= 10000; $i++) {
            $arrNovo[] = $i;
        }

        getNumerosPrimos2($arrNovo);
    });
}


// getNumerosPrimos($arrNovo);

echo "-- before Loop::run()\n";

function run() {
    $watcherIdToDisable1 = Loop::repeat($msInterval = 10000, "teste");
    $watcherIdToDisable2 = Loop::repeat($msInterval = 50000, "teste2");
    Loop::delay($msDelay = 60000, function() use ($watcherIdToDisable1) {
         Loop::disable($watcherIdToDisable1);
    });
}

Loop::run("run");