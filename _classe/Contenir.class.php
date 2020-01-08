<?php
class Contenir extends Entity {
	public function __construct($id=0) {
		parent::__construct("contenir", "con_id",$id);
	}
	static function listecon($tri="con_id") {
		$sql="select * from contenir, options where con_options=opt_id order by $tri";
		return self::$link->query($sql);
	}
	
}
?>
