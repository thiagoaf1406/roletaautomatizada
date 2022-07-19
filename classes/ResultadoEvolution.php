<?php

class ResultadoEvolution extends ActiveRecord {

	public $resultado_id;	
	public $roleta_id;
	public $numero;
	public $duzia;
	public $cor;
	public $parte;
	public $data_cadastro;
	public $traficante;
	
	function getTable() {
		return 'resultadoEvolution';
	}

	public static function last() {
		$last = self::find(0,null,'resultado_id DESC LIMIT 1');
		return $last[0];
	}
    
	public static function find($id = 0, $conditions = null, $order = 'resultado_id DESC') {
		$conditions = self::treatConditions($id,$conditions);
		$result = self::load('resultadoEvolution','ResultadoEvolution',$conditions,$order, 'EVO');

		if(!empty($id))
			$result = $result[0];

		return $result;
	}
    
    public static function campo($id, $campo){
        $param = self::find(0, array("resultado_id = '".$id."'"));
		return $param[0]->{$campo};
    }

	public static function paginate($page,$quantity,$conditions="0=0",$order='resultado_id DESC') {
		return self::find(0,array($conditions),$order. " LIMIT ".($page*$quantity).",$quantity");
	}

}

?>
