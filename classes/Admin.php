<?php

class Admin extends ActiveRecord {

	public $id;
	public $nome;
	public $email;
	public $senha;
	public $data_cadastro;
    public $imagem;
    public $super;
    public $playtech;
	public $pragmatic;
	public $evolution;
    
	public function save() {
	    if(!empty($this->senha)) $this->senha = base64_encode($this->senha);
		if(empty($this->data_cadastro)) $this->data_cadastro = date("Y-m-d H:i:s");
		return parent::save();
	}

	public static function last() {
		$last = self::find(0,null,'nome ASC LIMIT 1');
		return $last[0];
	}

	public static function find($id = 0, $conditions = null, $order = 'nome ASC') {
		$conditions = self::treatConditions($id,$conditions);
		$result = self::load('admins','Admin',$conditions,$order);

		if(!empty($id))
			$result = $result[0];

		return $result;
	}
    
    public static function gerarBotoes($id){
        
        $menu = '<div class="dropdown drop-acao dropdown-animated scale-left">';
        $menu .= '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Ações</button>';
        $menu .= '<div class="dropdown-menu">';
        $menu .= '<a href="admins/admin?id='.$id.'"><button class="dropdown-item" type="button"><i class="fa fa-edit"></i> Editar</button></a>';
        $menu .= '<button class="dropdown-item" onclick="excluir('.$id.')" type="button"><i class="fa fa-trash"></i> Excluir</button>';
        $menu .= '</div>';
        $menu .= '</div>';
        
        return $menu;
    }
    
    public static function campo($id, $campo){
        $param = self::find($id);
		return $param->{$campo};
    }
    
	public static function paginate($page,$quantity,$conditions="0=0",$order='nome ASC') {
		return self::find(0,array($conditions),$order. " LIMIT ".($page*$quantity).",$quantity");
	}

}

?>
