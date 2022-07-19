<?php
abstract class ActiveRecord {
	
	protected function getTable() {
		return strtolower(get_class($this)).'s';
	}
	
	protected function getFields() {
		return array_diff(array_keys(get_object_vars($this)),array('id'));
	}
	
	public function save() {
		if(!empty($this->id)) return $this->update();
		
		foreach($this->getFields() as $field) {
			$fields[] = $field;
			$values[] = "'".$this->$field."'";
		}		
		$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);
		$table = $this->getTable();
		if($table == 'mensagens' || $table == 'mensagensEvolution' || $table == 'mensagensPragmatic' || $table == 'entradasGrupo' || $table == 'entradasGrupoEvolution' || $table == 'entradasGrupoPragmatic'){
		    mysqli_query($con, "SET NAMES 'utf8mb4'");
		} else {
		    mysqli_query($con, "SET NAMES 'utf8'");
		}
		$query = sprintf("INSERT INTO `%s` (%s) VALUES (%s)",$this->getTable(),implode(',',$fields), implode(',',$values));
		$return = mysqli_query($con, $query);
		
		$this->erro = mysqli_error($con); 
		$this->id = mysqli_insert_id($con);
		mysqli_close($con);
		return $return;
	}

	protected static function load($table,$class,$conditions=null,$order='id ASC',$banco=null) {   
	    if($banco == 'SEVEN') {
	        $con = mysqli_connect(HOSTNAMESEVEN, USERNAMESEVEN, PASSWORDSEVEN, DATABASESEVEN);
	    } elseif($banco == 'EVO') {   
	        $con = mysqli_connect(HOSTNAME_EVO, USERNAME_EVO, PASSWORD_EVO, DATABASE_EVO);
	    } elseif($banco == 'PRAG') {   
	        $con = mysqli_connect(HOSTNAME_PRAG, USERNAME_PRAG, PASSWORD_PRAG, DATABASE_PRAG);
	    } else {
	        $con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);
	    }
		if($table == 'mensagens' || $table == 'mensagensEvolution' || $table == 'mensagensPragmatic' || $table == 'entradasGrupo' || $table == 'entradasGrupoEvolution' || $table == 'entradasGrupoPragmatic'){
		    mysqli_query($con, "SET NAMES 'utf8mb4'");
		} else {
		    mysqli_query($con, "SET NAMES 'utf8'");
		}
		
		$query = sprintf('SELECT * FROM `%s`',$table);
		
		if(!empty($conditions)) {
			$query .= ' WHERE '.implode(' AND ',$conditions);
		}
		$query .= ' ORDER BY '.$order;
		
		//print_r($query.'<br/><br/>');
		
		$result = mysqli_query($con, $query); 
		if($result){
		$records = array();
		while(($row = mysqli_fetch_object($result,$class))) {
			$records[] = $row;
		}
		}
		mysqli_close($con);
		return $records;
	}
	
	protected static function query($query,$class=null) {
		$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);
		mysqli_query($con, "SET NAMES 'utf8'");
		$result = mysqli_query($con, $query);
		
		$records = array();
		while(($row = mysqli_fetch_object($result,$class))) {
			$records[] = $row;
		}
		mysqli_close($con);
		return $records;
	}
	
	protected static function treatConditions($id,$conditions) {
		if(empty($conditions) and !empty($id)) {
			$conditions = array();
		}
		
		if(!empty($id)) {
			$conditions[] = sprintf("id='%d'",$id);
		}
		return $conditions;
	}
	
	public function destroy() {	
		$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);
		mysqli_query($con, "SET NAMES 'utf8'");	
		$query = sprintf("DELETE FROM `%s` WHERE id='%d'",$this->getTable(),$this->id);
		return mysqli_query($con, $query);
		mysqli_close($con);
	}
	
	private function update() {		
		foreach($this->getFields() as $field) {
			$fields[] = $field."='".$this->$field."'";
		}		
		$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);
		$table = $this->getTable();
		if($table == 'mensagens' || $table == 'mensagensEvolution' || $table == 'mensagensPragmatic' || $table == 'entradasGrupo' || $table == 'entradasGrupoEvolution' || $table == 'entradasGrupoPragmatic'){
		    mysqli_query($con, "SET NAMES 'utf8mb4'");
		} else {
		    mysqli_query($con, "SET NAMES 'utf8'");
		}
		$query = sprintf("UPDATE `%s` SET %s WHERE id='%d'",$this->getTable(),implode(', ',$fields), $this->id);
		return mysqli_query($con, $query);
		mysqli_close($con);
	}
	
	protected function increment_field($field) {	
		$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);
		mysqli_query($con, "SET NAMES 'utf8'");
		$query = sprintf("UPDATE `%s` SET $field = $field + 1 WHERE id='%d'",$this->getTable(), $this->id);
		return mysqli_query($con, $query);
		mysqli_close($con);
	}
	
	protected function change_field($table, $field, $value, $conditions='0=0') {	
		$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);
		if($table == 'mensagens' || $table == 'mensagensEvolution' || $table == 'mensagensPragmatic' || $table == 'entradasGrupo' || $table == 'entradasGrupoEvolution' || $table == 'entradasGrupoPragmatic'){
		    mysqli_query($con, "SET NAMES 'utf8mb4'");
		} else {
		    mysqli_query($con, "SET NAMES 'utf8'");
		}
		$query = sprintf("UPDATE `%s` SET `%s` = '%s' WHERE %s", $table, $field, $value, $conditions);
		echo $query;
		return mysqli_query($con, $query);
		mysqli_close($con);
	}
	
	public function fetch($params) {
		foreach($params as $k=>$v) {
			if(in_array($k,$this->getFields())) {
				$this->$k = trim($v);	
			}
		}
	}
	
	public static function count($conditions='0=0',$table=null) {
		if($table==null) throw new Exception();		
		$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);
		mysqli_query($con, "SET NAMES 'utf8'");
		$query = sprintf("SELECT count(id) as qntd FROM `%s` WHERE %s",$table,$conditions);
		$result = mysqli_query($con, $query);
		$r = mysqli_fetch_array($result);
		mysqli_close($con);
		return $r['qntd'];
	}
}
?>