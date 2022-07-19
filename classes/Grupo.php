<?php

class Grupo extends ActiveRecord {

	public $id;	
	public $nome;
	public $grupoID;
	public $status;
	public $usuario;
	public $horario_min;
	public $horario_max;
	public $playtech;
	public $evolution;
	public $pragmatic;
	
	function getTable() {
		return 'grupos';
	}
	
	public static function last() {
		$last = self::find(0,null,'nome ASC LIMIT 1');
		return $last[0];
	}
    
	public static function find($id = 0, $conditions = null, $order = 'nome ASC') {
		$conditions = self::treatConditions($id,$conditions);
		$result = self::load('grupos','Grupo',$conditions,$order);

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
        $menu .= '<a href="grupos/grupo?id='.$id.'"><button class="dropdown-item" type="button"><i class="fa fa-edit"></i> Editar</button></a>';
        //$menu .= '<button class="dropdown-item" onclick="dadosGrupo('.$grupo->grupoID.')" type="button"><i class="fab fa-telegram"></i> Dados Telegram</button>';
        $menu .= '<button class="dropdown-item" onclick="excluir('.$id.')" type="button"><i class="fa fa-trash"></i> Excluir</button>';
        $menu .= '</div>';
        $menu .= '</div>';
        
        return $menu;
    }

	public static function paginate($page,$quantity,$conditions="0=0",$order='nome ASC') {
		return self::find(0,array($conditions),$order. " LIMIT ".($page*$quantity).",$quantity");
	}

}

?>
