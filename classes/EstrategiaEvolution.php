<?php

class EstrategiaEvolution extends ActiveRecord {

	public $id;	
	public $nome;
	public $status;
	public $analisa;
	public $confirma;
	public $apostar;
	public $usuario;
	public $numero;
	public $observacao;
	public $gales;
	public $zero;
	public $abortar;
	public $casa;
	
	function getTable() {
		return 'estrategiasEvolution';
	}
	
	public static function last() {
		$last = self::find(0,null,'id ASC LIMIT 1');
		return $last[0];
	}
    
	public static function find($id = 0, $conditions = null, $order = 'id ASC') {
		$conditions = self::treatConditions($id,$conditions);
		$result = self::load('estrategiasEvolution','EstrategiaEvolution',$conditions,$order);

		if(!empty($id))
			$result = $result[0];

		return $result;
	}
    
    public static function campo($id, $campo){
        $param = self::find($id);
		return $param->{$campo};
    }
    
    public static function gerarBotoes($id){
        $grupo = self::find($id);
        $menu = '<div class="dropdown drop-acao dropdown-animated scale-left">';
        $menu .= '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Ações</button>';
        $menu .= '<div class="dropdown-menu">';
        $menu .= '<a href="evolution/estrategias/estrategia?id='.$id.'"><button class="dropdown-item" type="button"><i class="fa fa-edit"></i> Editar</button></a>';
        $menu .= '<button class="dropdown-item" onclick="excluir('.$id.')" type="button"><i class="fa fa-trash"></i> Excluir</button>';
        $menu .= '</div>';
        $menu .= '</div>';
        
        return $menu;
    }
    
	public static function paginate($page,$quantity,$conditions="0=0",$order='id ASC') {
		return self::find(0,array($conditions),$order. " LIMIT ".($page*$quantity).",$quantity");
	}

}

?>
