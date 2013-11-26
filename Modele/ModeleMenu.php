<?php

	require_once("LienModele.php");

	class Menu {

		private $nom;
		private $ingredients;
		private $tmpPreparation;
		private $prix;
		
		function Menu ($nom, $ingredients, $tmpPreparation, $prix) {
			$this->nom=$nom;
			$this->ingredients=$ingredients;
			$this->tmpPreparation=$tmpPreparation;
			$this->prix=$prix;
			
		}

		function getNom ()
        {
            return $this->nom;
        }
        function getIngredients ()
        {
            return $this->prenom;
        }
        function getTmpPreparation ()
        {
            return $this->tmpPreparation;
        }
        function getPrix()
        {
            return $this->prix;
        }
    
	}


	class ModeleMenu {

		static function CreateDataBaseMenu () {
			$req = "create table if not exists MENU(nom varchar(32), ingredients varchar(32), tmpPreparation integer, 
                                            prix integer, 
                                            constraint pk_Menu PRIMARY KEY (nom),
                                            constraint pk_Menu FOREIGN KEY (ingredients) REFERENCES INGREDIENTS (Numero));

					

					INSERT INTO MENU (nom, ingredients, tmpPreparation, prix) VALUES ('Potage', ['4', '6'], '20', '10'),
																					('Couscous', ['3', '4', '6'], '10', '15')
                                                                                    ('Kebab', ['1', '5', '6'], '5', '7')
                                                                                    ('Pates Carbonara', ['2', '7', '8'], '10', '12')
                                                                                    ('Risotto', ['2', '4', '9'], '10', '12')   ;";


                                                                                 

					
			global $connection;
            $creation= $connection->prepare($req);                              
            $creation->execute();

                    
		}

		static function convertionTableMenu($m){
            $menu=new Menu($m->nom, $m->ingredients, $m->tmpPreparation, $m->prix);
            return $menu;
        }
        
         static function getListeMenu ()
        {
            global $connection;
            $req="select * from MENU;";
            $creation= $connection->prepare($req);
            $creation->execute();
            while ($menu=$creation->fetch(PDO::FETCH_OBJ)){
                $liste_menu[] = convertionTableMenu($menu);
            }
            return $liste_menu;
        }


         static function getNom ($n)
        {
            global $connection;
            $req="select * from MENU where nom=$n;";
            $creation= $connection->prepare($req);      
            $creation->execute();
            $menu=$creation->fetch(PDO::FETCH_OBJ);
            if($menu){
                $menu = convertionTableMenu($n);
                return $menu;
            }
            else{
                return NULL;
            }

         static function getIngredients ($i)
        {
            global $connection;
            $req="select * from MENU where ingredients=$i;";
            $creation= $connection->prepare($req);      
            $creation->execute();
            $ingr=$creation->fetch(PDO::FETCH_OBJ);
            if($ingr){
                $ingr = convertionTableMenu($i);
                return $ingr;
            }
            else{
                return NULL;
            }

        static function getTmpPreparation ($t) {

            global $connection;
            $req="select * from MENU where tmpPreparation=$t;";
            $creation= $connection->prepare($req);      
            $creation->execute();
            $tmp=$creation->fetch(PDO::FETCH_OBJ);
            if($tmp){
                $tmp = convertionTableMenu($t);
                return $tmp;
            }
            else{
                return NULL;
        }

        static function getPrix ($p) {

            global $connection;
            $req="select * from MENU where prix=$p;";
            $creation= $connection->prepare($req);      
            $creation->execute();
            $prix=$creation->fetch(PDO::FETCH_OBJ);
            if($prix){
                $prix = convertionTableMenu($p);
                return $prix;
            }
            else{
                return NULL;
        }


       
	}


?>


