<?php
namespace Poli\Tarjeta;

use PHPUnit\Framework\TestCase;

class Test extends TestCase {
  
  public function testCargaSaldo272() {
    $tarjeta = new TarjetaMovi();
    $tarjeta->recargar(272);
    $this->assertEquals($tarjeta->saldo(), 320, "Cuando cargo 272 deberia tener finalmente 320");
  }
  
  public function testCargaSaldo500() {
    $tarjeta = new TarjetaMovi();
    $tarjeta->recargar(500);
    $this->assertEquals($tarjeta->saldo(), 640, "Cuando cargo 500 deberia tener finalmente 640");
  }
  
  public function testCargaSaldo() {
    $tarjeta = new TarjetaMovi();
    $tarjeta->recargar(100);
    $this->assertEquals($tarjeta->saldo(), 100, "Cuando cargo 100 deberia tener finalmente 100");
  }
  
  public function testPagarViaje() {
    $tarjeta = new TarjetaMovi();
    $tarjeta->recargar(20);
    $colectivo = new Colectivo("144 Negro", "Rosario Bus");
    $tarjeta->pagar($colectivo, "2016/10/31 22:00");
    $this->assertEquals($tarjeta->saldo(), 17.36, "Se descontó el pasaje");
  }
  
  public function testPagarViajeSinSaldo() {
    $tarjeta = new TarjetaMovi();
    $colectivo = new Colectivo("144 Negro", "Rosario Bus");
    $tarjeta->pagar($colectivo, "2016/10/29 22:00");
    $tarjeta->pagar($colectivo, "2016/10/30 22:00");
    $this->assertFalse($tarjeta->pagar($colectivo, "2016/10/31 22:00"), "No hay saldo suficiente");
  }
  
  public function testTrasbordo() {
     $tarjeta = new TarjetaMovi();
     $tarjeta->recargar(20);
     $colectivo = new Colectivo("144 Negro", "Rosario Bus");
     $tarjeta->pagar($colectivo, "2016/10/31 22:00");
     $tarjeta->pagar($colectivo, "2016/10/31 22:45");
     $this->assertEquals($tarjeta->saldo(), 12.08, "Trasbordo");
  }
  
  public function testNoTransbordo() {
        $tarjeta = new TarjetaMovi();
        $tarjeta->recargar(20);
        $colectivo = new Colectivo("144 Negro", "Rosario Bus");
        $tarjeta->pagar($colectivo, "2016/10/31 22:00");
        $tarjeta->pagar($colectivo, "2016/10/31 23:30");
        $this->assertEquals($tarjeta->saldo(), 9.44, "No hubo trasbordo");
  }
  
}
