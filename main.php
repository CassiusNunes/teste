<?php

require_once __DIR__ . '/vendor/autoload.php';

use Moovin\Job\Backend;

$exemplo = new Backend\Exemplo;

echo $exemplo->exemplo();

$conta = new Backend\Conta('123456','1');

echo $conta->Deposito('800');
echo ' ';
echo $conta->Saque('500');
echo ' ';
echo $conta->Tranferencia('456', '2', 200);
echo ' ';
echo "Saldo Atual: " . $conta->SaldoAtual();