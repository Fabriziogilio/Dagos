<?php

namespace Poli\Tarjeta;

class Bici extends Transporte {
  private $numero;
  public function __construct($numero) {
    $this->tipo = "Bicicleta";
    $this->numero = $numero;
  }
  public function nombre() {
    return $this->numero;
  }
