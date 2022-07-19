<?php

class RoletaPragmatic extends ActiveRecord {

	public $id;
	public $nome;
	public $status;
	public $numero;
	public $usuario;
	public $link;
	public $mobile;
	
	function getTable() {
		return 'roleta_pragmatic';
	}

	public static function last() {
		$last = self::find(0,null,'nome ASC LIMIT 1');
		return $last[0];
	}
	
	public static function find($id = 0, $conditions = null, $order = 'nome ASC') {
		$conditions = self::treatConditions($id,$conditions);
		$result = self::load('roleta_pragmatic','RoletaPragmatic',$conditions,$order);

		if(!empty($id))
			$result = $result[0];

		return $result;
	}
	
	public static function nome($id) {
		$conditions = self::find($id);
		return $conditions->nome;
	}
    
	public static function paginate($page,$quantity,$conditions="0=0",$order='nome ASC') {
		return self::find(0,array($conditions),$order. " LIMIT ".($page*$quantity).",$quantity");
	}

}

?>
