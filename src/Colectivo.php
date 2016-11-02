<?php

namespace Poli\Tarjeta;

class Colectivo extends Transporte {
  private $linea;
  private $empresa;
  public function __construct($linea, $empresa) {
    $this->tipo = "colectivo";
    $this->linea = $linea;
    $this->empresa = $empresa;
  }
  public function Nombre() {
    return $this->linea;
  }
