<?php

namespace Poli\Tarjeta;

class MedioBoleto extends TarjetaMovi {
  public function __construct() {
    $this->descuento = 0.5;
  }

}
