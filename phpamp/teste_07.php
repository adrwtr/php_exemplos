<?php
require_once('../vendor/autoload.php');

use Amp\Loop;

function asyncMultiply($x, $y)
{
    // Create a new promisor
    $deferred = new Amp\Deferred;

    // Resolve the async result one second from now
    Loop::delay($msDelay = 1000, function () use ($deferred, $x, $y) {
        $deferred->resolve($x * $y);
    });

    return $deferred->promise();
}

$promise = asyncMultiply(6, 7);
$result = Amp\Promise\wait($promise);

var_dump($result); // int(42)