<?php

class Sistema extends ActiveRecord {

	public $id;	
	public $logo;
	public $status;
	public $username;
	public $token;
	public $webhook;
    
    function getTable() {
		return 'sistema';
	}
    
    public static function find($id = 0, $conditions = null, $order = 'id ASC') {
		$conditions = self::treatConditions($id,$conditions);
		$result = self::load('sistema','Sistema',$conditions,$order);

		if(!empty($id))
			$result = $result[0];

		return $result;
	}

	public static function last() {
		$last = self::find(0,null,'id DESC LIMIT 1');
		return $last[0];
	}

	public static function paginate($page,$quantity,$conditions="0=0",$order='id DESC') {
		return self::find(0,array($conditions),$order. " LIMIT ".($page*$quantity).",$quantity");
	}

}

?>