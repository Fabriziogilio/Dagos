<?php
include_once("tarjeta.php");
include_once("transporte.php");
include_once("medio&pase.php");


$bici = new Bici(9424);
$colectivo144Negro = new Colectivo('144 Negro');
$colectivo128Rojo = new Colectivo('128 Rojo');

$tarjeta = new TarjetaMovi;
$tarjeta->recargar(272);
$tarjeta->saldo();
echo "\n";


$tarjeta->pagar($bici, '24-05-2016 13:04');
$tarjeta->pagar($colectivo144Negro, '24-06-2016 22:50');
$tarjeta->pagar($colectivo144Negro, '24-06-2016 23:00');
$tarjeta->pagar($colectivo128Rojo, '25-06-2016 23:15');
$tarjeta->viajesRealizados();
echo "\n";


$medio = new medioBoleto;
$medio->recargar(320);
$medio->saldo();
echo "\n";


$medio->pagar($bici, '22-05-2016 09:45');
$medio->pagar($colectivo144Negro, '30-06-2016 22:50');
$medio->pagar($colectivo144Negro, '30-06-2016 23:00');
$medio->pagar($colectivo128Rojo, '26-07-2016 23:15');
$medio->viajesRealizados();
echo "\n";


$pase = new Pase;
$pase->pagar($colectivo144Negro, '22-06-2016 17:47');
$pase->viajesRealizados();


?>