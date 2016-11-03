<?php

namespace Poli\Tarjeta;

class PaseLibre extends TarjetaMovi {
  public function __construct() {
    $this->descuento = 0;
    $this->plus = 0;
  }
}
