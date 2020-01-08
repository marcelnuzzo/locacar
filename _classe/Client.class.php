<?php
class Client extends Entity {
	public function __construct($id=0) {
		parent::__construct("client", "cli_id",$id);
	}
	
	static public function liste($tri="cli_id") {
		$sql="select * from client order by $tri";
		return self::$link->query($sql);
	}
	
	//vérifie que $cli_mail est dans client
	static function verification($cli_mail) {
		$sql="select * from client where cli_mail=?";
		$statement = self::$link->prepare($sql);
		$statement->bindValue(1,$cli_mail,PDO::PARAM_STR);
		$statement->execute();
		if ($statement->rowCount()==1)
			return $statement->fetch(PDO::FETCH_ASSOC);
		else
			return false;
	}
	
	static public function inscription($row) {
		extract($row);
		$sql="insert into client values (null,'$cli_nom',' ','$cli_adresse','$cli_mail','$cli_mdp')";				
		return self::$link->query($sql);
	}

}
?>
