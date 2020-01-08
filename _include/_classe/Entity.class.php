<?php
/**
* classe mère pour gérer les tables de la BDD
* propose les requetes génériques du CRUD
*/

class Entity {
	//connexion PDO à la BDD
	public static $link;	
	//nom de la table
	public $table;	
	//Nom du champ clé primaire
	public $cle;   	
	//tableau représentant un enregistrement
	public $data; 	
	
	/**
	 * Constructeur
	 *
	 * @param string $table        	
	 * @param string $cle        	
	 * @param string $id : si >0 charge un enregistrement depuis la BDD        	
	 */
	public function __construct($table, $cle,$id=0) {
		$this->table = $table;
		$this->cle = $cle;
		$this->data = array ();
		if ($id==0)
			//initialise data[] avec le nom des champs comme clé et des valeurs vide
			$this->init();
		else
			//charge un enregistrement de la base
			$this->charger($id);
	}
	
	/**
	* charge une connexion à la BDD
	*/
	static function setLink($link) {
		self::$link=$link;
	}
	
	/**
	 * Retourne tous les enregistrements de la table
	 * 
	 * @return PDOStatement
	 */
	static function selectAll($table) {
		$sql="select * from $table";
		return self::$link->query($sql);		
	}
	
	/**
	 * Charge un enregistrement depuis la base de données
	 *
	 * @param integer $id        	
	 */
	function charger($id) {
		$sql="select * from $this->table where $this->cle=:id";
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":id",$id,PDO::PARAM_INT);
		if (!$statement->execute())
			exit; //erreur d'execution
		$this->data=$statement->fetch(PDO::FETCH_ASSOC);
	}
	
	/**
	* initialise data[] avec le nom des champs comme clés et des valeurs vide
	*/
	function init() {
		$champs=self::getChamps($this->table);
		foreach($champs as $valeur) {
			$this->data[$valeur]="";
		}		
		$this->data[$this->cle]=0;
	}
	
	/**
	 * Charge un enregistrement depuis un tableau
	 *
	 * @param array $tab
	 */
	function chargerDepuisTableau(array $tab) {
		$champs=self::getChamps($this->table);
		foreach($champs as $valeur) {
			$this->data[$valeur]=$tab[$valeur];
		}		
	}
	
	/**
	 * retourne un tableau contenant le nom des champs de la table
	 *
	 * @return array
	 */
	static function getChamps($table) {
		$sql="show columns from $table";
		$result= self::$link->query($sql);	
		foreach ($result as $row) {
			$champs[]=$row["Field"];
		}
		return $champs;
	}
	
	/**
	 * retourne la chaine SQL de mise a jour d'un enregistrement de $table
	 *
	 * @return string
	 */
	static function updateSql($table, $pk, $champs) {
		foreach($champs as $nom) {
			if ($nom!=$pk)
				$tab[]=$nom . "=:" . $nom;
		}

		$sql="update $table set " . implode(",",$tab) . " where $pk=:" . $pk;
		return $sql;
	}

	/**
	 * retourne la chaine SQL d'insertion d'un enregistrement dans $table :nomchamp
	 *
	 * @return string
	 */
	static function insertSql($table, $pk, $champs) {
		foreach($champs as $nom) {
			if ($nom!=$pk)
				$tab[]=":" . $nom;
		}

		$sql="insert into $table values (null," . implode(",",$tab) . ")";
		return $sql;
	}
	
	
	/**
	 * Enregistre en base de données l'enregistrement $this->data
	 * si id > 0 update SINON insert
	 */
	function sauver() {
		if ($this->data[$this->cle]>0) {
			$sql=self::updateSql($this->table, $this->cle, self::getChamps($this->table));
		} else {
			$sql=self::insertSql($this->table, $this->cle, self::getChamps($this->table));
		}

		$statement = self::$link->prepare($sql);
		foreach($this->data as $cle => $valeur) {
			if ($this->cle!=$cle or $this->data[$this->cle]>0)
				$statement->bindValue(":" . $cle,$valeur);
		}

		if ($statement->execute()===false) {
		    print_r($statement->errorInfo());
			exit; //erreur d'exécution
		}

		if ($this->data[$this->cle]==0)
			$this->data[$this->cle]=self::$link->lastInsertId(); 
	}
	
	/**
	 * retourne la chaine SQL de suppression d'un enregsitrement
	 *
	 * @param string $table 	: Nom de la table
	 * @param string $cle		: Nom de la clé primaire
	 * @param integer $id		: id de l'enregistrement
	 */
	static function supprimer($table,$cle,$id) {
		$sql="delete from $table where $cle=:id";
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":id",$id,PDO::PARAM_INT);
		if (!$statement->execute())
			exit;
	}
	
	/**
	* Fonction g�n�rique g�n�rant une liste d�roulante � partir d'une requete
	* $sql = "select id, label from table"
	*/
	function HTMLselect($sql,$selectionid)
	{	
		$resultat = self::$link->query($sql);
		$s="";				
		//parcours du r�sultat de la requete par ligne 
		foreach($resultat as $row)
		{
			$row=array_map("mhe",$row);
			extract($row);
			$sel = ($selectionid==$id) ? " selected " : "";
			$s=$s . "<option value='$id' $sel>$label</option>";
		}
		return $s;		
	}
}
?>