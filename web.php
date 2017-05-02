<?php

require __DIR__ . '/vendor/autoload.php';
$gen = new \dovbysh\Fibonacci\Numbers\Generator((int)$_REQUEST['n']);

header("Content-type: text/plain");

foreach ($gen->calc() as $v) {
    print $v . "\n";
}