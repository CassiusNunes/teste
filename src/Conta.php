<?php
namespace Moovin\Job\Backend;

/**
 * Classe Conta
 *
 * @author Cassius Nunes <cassius_nunes@yahoo.com>
 */
class Conta
{
    private $saldo;
    private $taxa_saque;
    private $numero_conta;
    private $tipo_conta;
    private $limite_saque;
    
    public function __construct($numero_conta, $tipo_conta){
        $this->numero_conta = $numero_conta;
        $this->tipo_conta = $tipo_conta;
        $this->ContaTipo($tipo_conta);
    }
    
    private function ContaTipo($tipo_conta){
        /*
         * 1 - Conta Corrente
         * 2 - Conta Poupança
         * */
        switch ($tipo_conta){
            case 1:
                $this->taxa_saque = 2.5;
                $this->limite_saque = 600;
                break;                
            case 2:
                $this->taxa_saque = 0.8;
                $this->limite_saque = 1000;
                break;
        }
    }
    
    public function SaldoAtual(){
        return $this->saldo;
    }
    
    private function VerificaSaldo($valor){
        if($this->saldo >= $valor){
            return true;
        }else{
            return false;
        }
    }

    public function Saque($valor){
        $valor = abs($valor);
        $aux_valor = $valor + $this->taxa_saque;
        
        if($valor <= $this->limite_saque){
            if($this->VerificaSaldo($aux_valor)){
                $this->saldo -= $aux_valor;
                
                $mensagem = "Valor sacado: " . $valor . " Saldo Atual: " . $this->SaldoAtual();
                
            }else{
                $mensagem = "Saldo insuficiente! Saldo Atual: " . $this->SaldoAtual();
            }
        }else{
            $mensagem = "Limite de saque: " . $this->limite_saque;
        }
        
        return $mensagem;
        
    }
    
    public function Deposito($valor){
        $this->saldo += abs($valor);
        
        $mensagem = "Valor depositado: " . $valor;
        
        return $mensagem;
        
    }
    
    public function Tranferencia($numero_conta_destino, $tipo_conta, $valor){
        $valor = abs($valor);
        
        if($this->VerificaSaldo($valor)){        
            $this->Saque($valor);
            $conta = new Conta($numero_conta_destino,$tipo_conta);
            $mensagem = $conta->Deposito($valor) . " na conta: " . $numero_conta_destino;
        }else{
            $mensagem = "Saldo Insuficiente";
        }
        
        return $mensagem;
    }
}

