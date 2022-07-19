<?php

class EntradaPragmatic extends ActiveRecord {

	public $id;	
	public $estrategia;
	public $confirmada;
	public $status;
	public $analisado_id;
	public $confirmado_id;
	public $green_id;
	public $data_cadastro;
    public $numero;
    public $roleta_id;
    public $msg_analisa_id;
    public $msg_confirma_id;
    
    function getTable() {
		return 'entradasPragmatic';
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
		$result = self::load('entradasPragmatic','EntradaPragmatic',$conditions,$order);

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
