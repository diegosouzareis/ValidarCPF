<?php

class Documento{

	private $numero;

	public function getNumero(){
		return $this->numero;
	}
	public function setNumero($value){
		$resultado = Documento::validarCPF($value);
		if ($resultado === false){

			 throw new Exception("CPF não valido", 1);
			 
		}

		$this->numero = $value;
	}

	public static function validarCPF($cpf){

		if(empty($cpf)){
			return false;
		}

		elseif (preg_match('/(\d)\1{10}/', $cpf)) {
			return false;
		}

		else if (strlen($cpf) != 11) {
			return false;
		}

     	else {   
         
	        for ($t = 9; $t < 11; $t++) {
	             
	            for ($d = 0, $c = 0; $c < $t; $c++) {
	                $d += $cpf{$c} * (($t + 1) - $c);
	            }
	            $d = ((10 * $d) % 11) % 10;
	            if ($cpf{$c} != $d) {
	                return false;
	            }
	        }
 
        return true;

    	}
	}

}

$cpf = new Documento;
$cpf->setNumero(48363457825);

echo "Seu CPF é: " . $cpf->getNumero(). " e está correto!";

?>