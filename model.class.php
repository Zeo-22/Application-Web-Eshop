<?php
class model{
	private $db;

	public function __construct(){
		define('USER','root');
		define('PASS','');
		$this->db=new PDO('mysql:host=localhost;dbname=eshop',USER,PASS);
	}

	public function allproducts(){
		$query=$this->db->prepare('select produits.id, produits.designation, produits.description, prix, dateFabrication, type, photo, categories.designation, path from produits, categories where categories.id=produits.numcat');
		$query->execute();
		return $query->fetchAll();
	}

	public function allCategories(){
		$query=$this->db->prepare('select * from categories');
		$query->execute();
		return $query->fetchAll();
	}

	public function oneproduct($num){
		$query=$this->db->prepare('select * from produits where id=?');
		$query->execute(array($num));
		return $query->fetch();
	}

	public function nombreProduits(){
		$query=$this->db->prepare('select count(*) from produits');
		$query->execute();
		return $query->fetch();
	}

	public function addprod($prod){
		$query=$this->db->prepare('insert into produits values(?,?,?,?,?,?,?,?,?)');
		$query->execute($prod);
		header('location:Ctrl.class.php');
	}

	public function delprod($num){
		$query=$this->db->prepare('delete from produits where id=?');
		$query->execute(array($num));
		header('location:Ctrl.class.php');
	}

	public function updateprod($prod){
		$query=$this->db->prepare('update produits set designation=?, description=?, prix=?, dateFabrication=?, type=?, numcat=? where id=?');
		$query->execute($prod);
		header('location:Ctrl.class.php');
	}

	public function searchprod($critere){
		$query=$this->db->prepare("select produits.id, produits.designation, produits.description, prix, dateFabrication, type, photo, categories.designation, path from produits, categories where categories.id=produits.numcat and (produits.designation like :critere or produits.description like :critere)");
		$query->bindValue(':critere',"%$critere%");
		$query->execute();
		return $query->fetchAll();
	}

	public function nbProdApresRecherche($critere){
		$query=$this->db->prepare("select count(*) from produits where designation like :critere or description like :critere");
		$query->bindValue(':critere',"%$critere%");
		$query->execute();
		return $query->fetch();
	}

	public function areLogMdpExist($user){
		$query=$this->db->prepare("select count(*) from users where login=? and pass=?");
		$query->execute($user);
		return $query->fetch();
	}

}
?>