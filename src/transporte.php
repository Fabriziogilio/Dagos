<?php
namespace Poli\Tarjeta;
abstract class Transporte {
  protected $tipo;
	
  public function Tipo() {
    return $this->tipo;
  }
	
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
class Bici extends Transporte {
  private $numero;
  public function __construct($numero) {
    $this->tipo = "Bicicleta";
    $this->numero = $numero;
  }
  public function Nombre() {
    return $this->numero;
  }
?>
