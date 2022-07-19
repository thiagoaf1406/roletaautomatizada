<?php

class Robo extends ActiveRecord {

	public $id;	
	public $nome;
	public $username;
	public $token;
	
	function getTable() {
		return 'robos';
	}
	
	public static function last() {
		$last = self::find(0,null,'nome ASC LIMIT 1');
		return $last[0];
	}
    
	public static function find($id = 0, $conditions = null, $order = 'nome ASC') {
		$conditions = self::treatConditions($id,$conditions);
		$result = self::load('robos','Robo',$conditions,$order);

		if(!empty($id))
			$result = $result[0];

		return $result;
	}

	public static function paginate($page,$quantity,$conditions="0=0",$order='nome ASC') {
		return self::find(0,array($conditions),$order. " LIMIT ".($page*$quantity).",$quantity");
	}

}

?>
