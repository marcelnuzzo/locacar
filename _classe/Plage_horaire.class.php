<?php
class Plage_horaire extends Entity {
	public function __construct($id=0) {
		parent::__construct("plage_horaire", "pla_id",$id);
	}
	
	static public function liste($tri="pla_id") {
		$sql="select * from plage_horaire order by $tri";
		return self::$link->query($sql);
	}
}
?>
