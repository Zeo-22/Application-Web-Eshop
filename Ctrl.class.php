<?php
require 'model.class.php';

class ctrl{
	private $m;

	public function __construct(){
		$this->m=new model();
	}

	public function allProductsAction(){

		//Si la session n'est pas ouverte : renvoyer vers la page d'authentification
		session_start();
		if(!isset($_SESSION['user']))
			header('location:VAuth.php');

		//Déterminer un temps maximum d'inactivité pour la session
		require 'ponom.php';
		if(time()-$_SESSION['lat']>$ttl)
			$this->disconnectAction();
		else
			$_SESSION['lat']=time();


		$nbp=$this->m->nombreProduits();

		//Si il y a des produits dans la base de données
		if($nbp[0]){

			$produits=$this->m->allproducts();

			//Si un critère de recherche est donné
			if(isset($_POST['critere'])){

				$critere=$_POST['critere'];
				$produits=$this->m->searchprod($critere);
				$nbp=$this->m->nbProdApresRecherche($critere);

				//Si ce critère convient à un produit
				if($nbp[0])
					require 'Vallproducts.php';

				//Si ce critère ne convient à aucun produit
				else
					require 'VNoProductAfterResearch.php';
			}

			//Si aucun critère de recherche n'est donné
			else
				require 'Vallproducts.php';
		}

		//Si il n'y a aucun produit dans la base de données
		else
			require 'VNoProduct.php';
	}

	public function formProductAction(){
		$categories=$this->m->allCategories();
		require 'Vformprod.php';
	}

	public function addProductAction(){

		//Si la taille de la photo est supérieure à 400Ko, Alors ne pas insérer le produit
		require 'ponom.php';
		if($_FILES['photo']['size']>$maxfilesize){
			echo "Vous avez dépassé la taille de photo autorisée. Veuillez cliquer sur le lien ci-dessous pour ajouter à nouveau votre produit.<br>";
			echo "<a href=formprod.php>Revenir au formulaire</a>";
		}

		//Si l'extension de la photo n'est ni jpeg ni jpg, Alors ne pas insérer le produit
		elseif($_FILES['photo']['type']!='image/jpeg' and $_FILES['photo']['type']!='image/jpg'){
			echo "Le format de la photo n'est pas autorisé. Veuillez cliquer sur le lien ci-dessous pour ajouter à nouveau votre produit.<br>";
			echo "<a href=formprod.php>Revenir au formulaire</a>";
		}

		//Sinon, déplacer la photo vers le répertoire photos, et insérer le produit
		else{
			$path=uniqid();
			move_uploaded_file($_FILES['photo']['tmp_name'],'photos/'.$path.'.jpeg');
			$prod=array(null,$_POST['des'],$_POST['desc'],$_POST['prix'],$_POST['fabri'],$_POST['type'],'',$_POST['cat'],$path);
			$this->m->addprod($prod);
		}
	}

	public function deleteProductAction(){
		$num=$_GET['num'];
		$this->m->delprod($num);
	}

	public function editProductAction(){
		$num=$_GET['num'];
		$prod=$this->m->oneproduct($num);
		$categories=$this->m->allCategories();
		require 'VEditProduct.php';
	}

	public function updateProductAction(){
		$prod=array($_POST['des'],$_POST['desc'],$_POST['prix'],$_POST['fabri'],$_POST['type'],$_POST['cat'],$_POST['num']);
		$this->m->updateprod($prod);
	}

	public function formSearchAction(){
		require 'VSearchProd.php';
	}

	public function verifAuthAction(){
		$log=$_POST['log'];
		$mdp=md5($_POST['mdp']);
		$user=array($log,$mdp);
		$nbp=$this->m->areLogMdpExist($user);
		if($nbp[0]==1){
			session_start();
			$_SESSION['user']=$log;
			$_SESSION['lat']=time();
			header('location:Ctrl.class.php');
		}
		else
			header('location:VAuth.php');
	}

	public function disconnectAction(){
		session_start();
		session_destroy();
		header('location:VAuth.php');
	}

	public function action(){
		$action="allprods";
		if(isset($_GET['action']))
			$action=$_GET['action'];
		switch($action){
			case 'allprods':$this->allProductsAction();break;
			case 'formprod':$this->formProductAction();break;
			case 'addprod':$this->addProductAction();break;
			case 'delprod':$this->deleteProductAction();break;
			case 'editprod':$this->editProductAction();break;
			case 'updateprod':$this->updateProductAction();break;
			case 'searchprod':$this->formSearchAction();break;
			case 'verifauth':$this->verifAuthAction();break;
			case 'disconnect':$this->disconnectAction();break;
		}
	}
} 

$c=new ctrl();
$c->action();
?>
