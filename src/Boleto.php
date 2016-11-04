<?php

namespace Poli\Tarjeta;


class Boleto {
  private $tipo;
  private $monto;
  private $transporte;
  private $tiempo;
  private $tarj;
  private $saldo;
  
  public function __construct($tarj, $tipo, $monto, $transporte, $tiempo, $saldo) {
    $this->tipo = $tipo;
    $this->monto = $monto;
    $this->transporte = $transporte;
    $this->tiempo = $tiempo;
    $this->tarj = $tarj;
    $this->saldo= $saldo;
  }
  
  public function tiempo(){
    return $this->tiempo;
  }
 
  
}
