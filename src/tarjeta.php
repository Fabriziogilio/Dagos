<?php

namespace Fabri

interface Tarjeta{
	public function pagar(Transporte $transporte, $fecha_y_hora);
	public function recargar($monto);
	public function saldo();
	public function viajesRealizados();
}

class TarjetaMovi{
	protected $credito, $historial, $i, $boletoColectivo, $boletoBici, $trasbordo;
	function __construct(){
		$this->credito = 0;
		$this->historial = array();
		$this->i = 0;
		$this->boletoColectivo = 8.50;
		$this->trasbordo = 2.80;
		$this->boletoBici = 12.50;
	}
	function saldo(){
		echo "Su saldo es de: $" . $this->credito . " pesos\n";
	}
	function recargar($monto){
		if($monto == 272){
			$this->credito += 320;
		}
		else if($monto == 320){
			$this->credito += 500;
		}
		else{
			$this->credito += $monto;
		}
	}
	function pagar(Transporte $transporte, $date){ //historial [tipo, numero, monto, saldo, fecha]
		if($transporte->returnTipo() == "Colectivo"){
			if($this->i != 0 && ($this->historial[$this->i - 1][2] == $this->boletoColectivo || $this->historial[$this->i - 1][2] == $this->trasbordo) && ((strtotime($date) - strtotime($this->historial[$this->i - 1][4])) / 3600) < 1){
				if($this->credito < $this->trasbordo){
					echo "Credito insuficiente\n";
				}
				else{
					$this->credito -= $this->trasbordo;
					$this->agregarAlHistorial($transporte->returnTipo(),$transporte->numero(),$this->trasbordo,$this->credito, $date);
				}
			}
			else{
				if($this->credito < $this->boletoColectivo){
					echo "Credito insuficiente\n";
				}
				else{
					$this->credito -= $this->boletoColectivo;
					$this->agregarAlHistorial($transporte->returnTipo(),$transporte->numero(),$this->boletoColectivo,$this->credito, $date);
				}
			}
		}
		if($transporte->returnTipo() == "Bicicleta"){
			if($this->credito < $this->boletoBici){
				echo "Credito insuficiente\n";
			}
			else{
				$this->credito -= $this->boletoBici;
				$this->agregarAlHistorial($transporte->returnTipo(),$transporte->numero(),$this->boletoBici,$this->credito, $date);
			}	
		}
	}
	protected function agregarAlHistorial($tipo,$numero,$monto, $saldoRestante,$date){
		$this->historial[$this->i] = [$tipo,$numero,$monto, $saldoRestante, $date];
		$this->i++;
	}
	function viajesRealizados(){
		echo "Transporte\tNumero\t\tMonto\tSaldo\tFecha\n";
		foreach($this->historial as $viaje){
			if($viaje[0] == "Colectivo"){
				echo $viaje[0];
				echo "\t" . $viaje[1];
				echo "\t$" . $viaje[2];
				echo "\t$" . $viaje[3];
				echo "\t" . $viaje[4] . "\n";
			}
			if($viaje[0] == "Bicicleta"){
				echo $viaje[0];
				echo "\t" . $viaje[1];
				echo "\t\t$" . $viaje[2];
				echo "\t$" . $viaje[3];
				echo "\t" . $viaje[4] . "\n";
			}

		}
		echo "\n";
	}
}

?>
