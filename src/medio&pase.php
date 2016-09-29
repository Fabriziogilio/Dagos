<?php

class MedioBoleto extends TarjetaMovi implements tarjeta{
	function __construct(){
		parent :: __construct();
		$this->boletoColectivo = 4.25;
		$this->trasbordo = 1.40;
	}
}


class Pase extends TarjetaMovi{
	function __construct(){
		parent :: __construct();
		$this->boletoColectivo = 0;
		$this->boletoBici = 0;
	}
	function saldo(){}
	function recargar(){}
}

?>