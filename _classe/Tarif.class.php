<?php
class Tarif extends Entity {
	public function __construct($id=0) {
		parent::__construct("tarif", "tar_id",$id);
	}
	
	static function liste($tri="tar_id") {
		$sql="select tar_thj,tar_id,tar_thj,pla_hmin,pla_hmax,cat_nom from plage_horaire,tarif,categorie where tar_pla=pla_id and tar_categorie=cat_id order by $tri";
		return self::$link->query($sql);
	}
	
	function getData($tar_id) {
		$sql="select * from plage_horaire,tarif,categorie where tar_pla=pla_id and tar_categorie=cat_id and tar_id=:tar_id order by tar_id";
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":tar_id",$tar_id,PDO::PARAM_INT);
		$statement->execute();
		$this->data=$statement->fetch(PDO::FETCH_ASSOC);
		return $this->data;
	}
	
	
}
?>
