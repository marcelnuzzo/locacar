<?php
class Categorie extends Entity {
	public function __construct($id=0) {
		parent::__construct("categorie", "cat_id",$id);
	}
	
	static function liste($tri="cat_id") {
		$sql="select * from categorie order by $tri";
		return self::$link->query($sql);
	}
	
	static function listeCat() {
		$sql="select * from categorie";
		return self::$link->query($sql);
	}
}
?>
