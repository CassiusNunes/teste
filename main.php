<?php

require_once __DIR__ . '/vendor/autoload.php';

use Moovin\Job\Backend;
/*
$exemplo = new Backend\Exemplo;

echo $exemplo->exemplo();*/

$conta = new Backend\Conta('123456','1');

echo $conta->Deposito('800').PHP_EOL;
echo $conta->Saque('500').PHP_EOL;
echo $conta->Tranferencia('456', '2', 200).PHP_EOL;
echo "Saldo Atual: " . $conta->SaldoAtual().PHP_EOL;