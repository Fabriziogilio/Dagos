<?php

namespace Poli\Tarjeta;


class TarjetaMovi implements InterfaceTarjeta {
  private $viajes = [];
  private $saldo = 0;
  protected $descuento;
  private $plus = 0;
	
  public function __construct() {
    $this->descuento = 1.0;
  }
	
  public function pagar(Transporte $transporte, $fecha_y_hora) {
    if ($transporte->tipo() == "colectivo") {
      return $this->pagarColectivo($transporte, $fecha_y_hora);
    }
    else if ($transporte->tipo() == "bici") {
      if ($this->saldo < 12) return false; 
      $this->viajes[] = new Boleto($transporte->tipo(), 12, $transporte->nombre(), strtotime($fecha_y_hora));
      $this->saldo -= 12;
    }
    return true;
  }
	
  protected function pagarColectivo(Transporte $transporte, $fecha_y_hora) {
    $trasbordo = false;
    if (count($this->viajes) > 0) {
      if (strtotime($fecha_y_hora) - end($this->viajes)->tiempo() < 3600) {
        $trasbordo = true;
      }
    }
    $monto = 0;
    if ($trasbordo) {
      $monto = 2.0 * $this->descuento;
    }
    else {
      $monto = 2.64 * $this->descuento;
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
    $this->viajes[] = new Boleto($transporte->tipo(), $monto, $transporte, strtotime($fecha_y_hora));
    $this->saldo -= $monto;
    return true;
  }
	
  public function recargar($monto) {
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
  public function viajesRealizados() {
    return $this->viajes;
  }
	
