<?php
class Gestionnaire extends Entity {
	public function __construct($id=0) {
		parent::__construct("gestionnaire", "ges_id",$id);
	}
	
		static public function liste($tri="ges_id") {
		$sql="select * from gestionnaire left join agence on ges_agence=age_id order by $tri";
		return self::$link->query($sql);
	}
	
	//vérifie que $ges_mail est dans gestionnaire
	static function verification($ges_mail) {
		$sql="select * from gestionnaire where ges_mail=?";
		$statement = self::$link->prepare($sql);
		$statement->bindValue(1,$ges_mail,PDO::PARAM_STR);
		$statement->execute();
		if ($statement->rowCount()==1)
			return $statement->fetch(PDO::FETCH_ASSOC);
		else
			return false;
	}
}
?>
