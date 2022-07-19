<?php

class EntradaGrupoEvolution extends ActiveRecord {

	public $id;	
	public $entrada;
	public $grupo;
	public $tipo;
	public $msg_id;
	public $data_cadastro;
    
    function getTable() {
		return 'entradasGrupoEvolution';
	}
    
    public function save() {
		if(empty($this->data_cadastro)) $this->data_cadastro = date("Y-m-d H:i:s");
		return parent::save();
	}

    
	public static function last() {
		$last = self::find(0,null,'id DESC LIMIT 1');
		return $last[0];
	}
    
	public static function find($id = 0, $conditions = null, $order = 'id DESC') {
		$conditions = self::treatConditions($id,$conditions);
		$result = self::load('entradasGrupoEvolution','EntradaGrupoEvolution',$conditions,$order);

		if(!empty($id))
			$result = $result[0];

		return $result;
	}
    
    public static function campo($id, $campo){
        $param = self::find($id);
		return $param->{$campo};
    }

	public static function paginate($page,$quantity,$conditions="0=0",$order='id DESC') {
		return self::find(0,array($conditions),$order. " LIMIT ".($page*$quantity).",$quantity");
	}

}

?>
