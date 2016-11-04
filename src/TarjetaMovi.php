<?php

namespace Poli\Tarjeta;


class TarjetaMovi implements InterfaceTarjeta {
  protected $viajes = [];
  protected $saldo = 0;
  protected $descuento;
  protected $plus;
  protected $tarj;
	
  public function __construct() {
    $this->descuento = 1.0;
    $this->plus = 0;
    $this->tarj= "Normal";
  }
	
  public function pagar(Transporte $transporte, $fecha_y_hora) {
    if ($transporte->tipo() == "Colectivo") {
      return $this->pagarColectivo($transporte, $fecha_y_hora);
    }
    else if ($transporte->tipo() == "Bicicleta") {
      if ($this->saldo < 12) return false; 
      $this->saldo -= 12;
      $this->viajes[] = new Boleto($this->tarj(),$transporte->tipo(), 12, $transporte->nombre(), strtotime($fecha_y_hora),$this->saldo());
    }
    return true;
  }
	
  protected function pagarColectivo(Transporte $transporte, $fecha_y_hora) {
    $trasbordo = false;
    if (count($this->viajesRealizados()) > 0) {
      if (strtotime($fecha_y_hora) - end($this->viajes)->tiempo() < 3600) {
        $trasbordo = true;
      }
    }
    $monto = 0;
    if ($trasbordo) {
      $monto = 2.64 * $this->descuento;
    }
    else {
      $monto = 8.50 * $this->descuento;
    }
    if ($this->saldo < $monto){
	    if ($this->plus < 2){
		    $this->plus += 1;
	    }
	    else
	    {
		    return false;
	    }
    }
    $this->saldo -= $monto;
    $this->viajes[] = new Boleto($this->tarj(),$transporte->tipo(), $monto, $transporte, strtotime($fecha_y_hora),$this->saldo());
    return true;
  }
	
  public function recargar($monto) {
	 
    $this->plus=0;
	  
    if ($monto == 272) {
      $this->saldo += 320;
    }
    else if ($monto == 500) {
      $this->saldo += 640;
    }
    else {
      $this->saldo += $monto;
    }
  }
	
  public function saldo() {
    return $this->saldo;
  }
	
  public function viajesRealizados(){
     return $this->viajes;
  }
	
   public function tarj() {
    return $this->tarj;
  }
	
}
