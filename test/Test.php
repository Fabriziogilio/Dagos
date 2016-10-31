<?php
namespace Poli\Tarjeta;
use PHPUnit\Framework\TestCase;
class TarjetaTest extends TestCase {
  public function testCargaSaldo() {
    $tarjeta = new TarjetaMovi;
    $tarjeta->recargar(272);
    $this->assertEquals($tarjeta->saldo(), 320, "Cuando cargo 272 deberia tener finalmente 320");
  }
  public function testPagarViaje() {
    $tarjeta = new TarjetaMovi;
    $tarjeta->recargar(20);
    $colectivo = new Colectivo("144 Negro", "Rosario Bus");
    $tarjeta->pagar($colectivo, "2016/10/31 22:00");
    $this->assertEquals($tarjeta->saldo(), 20 - 2.64, "Se descontó el pasaje");
  }
  public function testPagarViajeSinSaldo() {
    $tarjeta = new TarjetaMovi;
    $colectivo = new Colectivo("144 Negro", "Rosario Bus");
    $this->assertFalse($tarjeta->pagar($colectivo, "2016/10/31 22:00"), "No hay saldo suficiente");
  }
  public function testTrasbordo() {
     $tarjeta = new TarjetaMovi;
     $tarjeta->recargar(20);
     $colectivo = new Colectivo("144 Negro", "Rosario Bus");
     $tarjeta->pagar($colectivo, "2016/10/31 22:00");
     $tarjeta->pagar($colectivo, "2016/10/31 22:45");
     $this->assertEquals($tarjeta->saldo(), 20 - 7.92, "Trasbordo");
  }
  public function testNoTransbordo() {
        $tarjeta = new TarjetaMovi;
        $tarjeta->recargar(20);
        $colectivo = new Colectivo("144 Negro", "Rosario Bus");
        $tarjeta->pagar($colectivo, "2016/10/31 22:00");
        $tarjeta->pagar($colectivo, "2016/10/31 23:30");
        $this->assertEquals($tarjeta->saldo(), 20 - 10.56, "No hubo trasbordo");
  }
}
