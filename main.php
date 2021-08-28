<?php

require_once __DIR__ . '/vendor/autoload.php';

use Moovin\Job\Backend\CheckingAccount;
use Moovin\Job\Backend\SavingAccount;

$cc = new CheckingAccount(1000);
$cc2 = new CheckingAccount(400);
$poupanca = new SavingAccount(2000);
$poupanca2 = new SavingAccount(4000);

echo $cc . PHP_EOL;
echo $cc2 . PHP_EOL;
echo $poupanca . PHP_EOL;
echo $poupanca2 . PHP_EOL;
echo PHP_EOL;

$cc->withdraw(100);
echo $cc . PHP_EOL;
echo PHP_EOL;

$cc2->deposit(200);
echo $cc2 . PHP_EOL;
echo PHP_EOL;

$cc2->transfer($cc, 100);
echo $cc . PHP_EOL;
echo $cc2 . PHP_EOL;
echo PHP_EOL;

$poupanca->withdraw(100);
echo $poupanca . PHP_EOL;
echo PHP_EOL;

$poupanca2->deposit(200);
echo $poupanca2 . PHP_EOL;
echo PHP_EOL;

$poupanca2->transfer($poupanca, 100);
echo $poupanca . PHP_EOL;
echo $poupanca2 . PHP_EOL;
echo PHP_EOL;

$cc->transfer($poupanca2, 200);
$poupanca->transfer($cc2, 400);

echo $cc . PHP_EOL;
echo $cc2 . PHP_EOL;
echo $poupanca . PHP_EOL;
echo $poupanca2 . PHP_EOL;
echo PHP_EOL;

echo "Fim do programa" . PHP_EOL;
