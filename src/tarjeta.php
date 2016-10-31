<?php
namespace Poli\Tarjeta;
interface Tarjeta{
	public function pagar(Transporte $transporte, $fecha_y_hora);
	public function recargar($monto);
	public function saldo();
	public function viajesRealizados();
}
class TarjetaMovi implements Tarjeta {
  private $viajes = [];
  private $saldo = 0;
  protected $descuento;
  public function __construct() {
    $this->descuento = 1.0;
  }
  public function pagar(Transporte $transporte, $fecha_y_hora) {
    if ($transporte->tipo() == "colectivo") {
      return $this->pagarColectivo($transporte, $fecha_y_hora);
    }
    else if ($transporte->tipo() == "bici") {
      if ($this->saldo < 12) return false; 
      $this->viajes[] = new Viaje($transporte->tipo(), 12, $transporte, strtotime($fecha_y_hora));
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
    if ($this->saldo < $monto) return false;
    $this->viajes[] = new Viaje($transporte->tipo(), $monto, $transporte, strtotime($fecha_y_hora));
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
	
	
	
class Viaje {
  private $tipo;
  private $monto;
  private $transporte;
  private $tiempo;
  public function __construct($tipo, $monto, $transporte, $tiempo) {
    $this->tipo = $tipo;
    $this->monto = $monto;
    $this->transporte = $transporte;
    $this->tiempo = $tiempo;
  }
  public function tipo() {
    return $this->tipo;
  }
  public function monto() {
    return $this->monto;
  }
  public function transporte() {
    return $this->transporte;
  }
  public function tiempo() {
    return $this->tiempo;
  }
?>
