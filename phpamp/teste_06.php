<?php
require_once('../vendor/autoload.php');

use Amp\Loop;
use Amp\Promise;

// quero gerar 10 valores aleatorios de forma assincrona
// sempre que eles forem divisiveis por 5,
// quero esperar 5 segundos para retornar

$i = 0;

function make_seed()
{
  list($usec, $sec) = explode(' ', microtime());
  return $sec + $usec * 1000000;
}


function executar($i)
{
    // Create a new promisor
    $deferred = new Amp\Deferred;

    // Resolve the async result one second from now
    Loop::delay($msDelay = 500, function () use ($deferred, $i) {
        $nr_random = rand(0, 100);

        if ($nr_random % 5 == 0) {
            sleep(5);
        }

        $deferred->resolve($i . " = " . $nr_random);
    });

    return $deferred->promise();
}



echo "-- before Loop::run()\n";

function teste() {
    srand(make_seed());

    for ($i=1; $i<11; $i++) {
        $promises[] = executar($i);
    }

    $result = Amp\Promise\wait(Amp\Promise\all($promises));
    var_dump($result);
}

$nr_start = Loop::now();
Loop::run("teste");
$nr_fim = Loop::now();
echo ($nr_fim - $nr_start) / 1000;
echo " segundos";