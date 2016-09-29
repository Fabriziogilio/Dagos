<?php

abstract class Transporte{
	protected $tipo, $numero;
	function returnTipo(){
		return $this->tipo;
	}
	function numero(){
		return $this->numero;
	}
}

class Colectivo extends Transporte{
	function __construct($numero){
		$this->numero = $numero;
		$this->tipo = "Colectivo";
	}
}


class Bici extends Transporte{
	function __construct($numero){
		$this->numero = $numero;
		$this->tipo = "Bicicleta";
	}
}

?>