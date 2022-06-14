<?php 
class produit
{
	//Attributs
	private $num;
	private $designation;
	private $description;
	private $prix;
	private $date;
	private $type;
	private $path;
	private $numcat;

	//Méthodes

	public function getDescription(){
		return $this->description;
	}

	public function getPrix(){
		return $this->prix;
	}


	public function setPrix($prix){
		$this->prix=$prix;
	}

	public function __construct($num,$des,$desc,$prix,$date,$type,$numcat){
		$this->num=$num;
		$this->designation=$des;
		$this->description=$desc;
		$this->prix=$prix;
		$this->date=$date;
		$this->type=$type;
		$this->numcat=$numcat;
	}

	public function __toString(){
		return "Numéro Produit : ".$this->num."<br>Désignation : ".$this->designation."<br>Description : ".$this->getDescription()."<br>Prix : ".$this->getPrix()."<br>Date de Fabrication : ".$this->date."<br>Type : ".$this->type;
	}

	public function display(){
		echo $this;
	}

}

$P=new produit(1000,"TV","FULL HD",8999,"19 Mai 2022","A l'unité",1);
$P->display();
?>