<?php
class Options extends Entity {
	public function __construct($id=0) {
		parent::__construct("options", "opt_id",$id);
	}
	
	static public function liste($tri="opt_id") {
		$sql="select * from options order by $tri";
		return self::$link->query($sql);
	}
}
?>
