<?php  
class Menu{
	public $id;
	public $libelle;

	function __construct($id="", $libelle="")
	{
	$this->id=$id;
	$this->libelle=$libelle;
}

	
public function create($libelle){
	include('..\config.php');
	$req = $bdd->prepare("INSERT INTO menu (libelle) VALUES (?)");
	try{
	$req->execute(array($libelle));
	}
	catch(Exception $e)
	{
echo $e;
	}
	
echo"cette methode permet de cree un menu"."</br>";


}
public function get_menu($id){
  include('..\config.php');
  $req1 = $bdd->query("SELECT * FROM menu WHERE id=$id");
  echo"<form action=\"updatemenu.php\" method=\"POST\">";
  while ($ligne=$req1->fetch()) {
    echo"<input type=\"hidden\" name=\"id\" value=".$ligne['id'].">";
    echo"<input type=\"text\" name=\"libelle\" value=".$ligne['libelle'].">";
    echo"<input type=\"submit\" name=\"ok\">";
    echo"<input type=\"reset\" name=\"Annuler\">";
  }

  echo"</form>";


}
public function update($id, $libelle){
	include('..\config.php');
	
	try 
        { 
         $update=$bdd->exec("UPDATE menu SET libelle=\"$libelle\" WHERE id = $id");
         
        }
        catch (Exception $e) 
        {
          echo $e;  
        }

	echo "cette methode permet de modifier un menu";

}



		 public function Listmenu()
     {
        include('..\config.php');
         echo "<a href=index.php?cle=Nouveau-Menu>Creation d'un menu</a> &nbsp;&nbsp;&nbsp;";

         $req3=$bdd->query("SELECT * FROM menu "); 
         echo "<table>";
           echo "<th>id</th>";
           echo "<th>libelle</th>";
           echo "<th>Modifier</th>";
           echo "<th>Supprimer</th>";
   


        while( $reponse = $req3->fetch() )
        {
          
            echo "<tr>";
              echo "<td>";
                     echo $reponse['id'];
              echo "</td>";
              echo "<td>";
                     echo $reponse['libelle'];
              echo "</td>";
              echo "<td>";
                      echo "<a href=index.php?update=".$reponse['id']."> Modifier</a> &nbsp;&nbsp;&nbsp;";
              echo "</td>";
              echo "<td>";
                    echo "<a href=index.php?delete=".$reponse['id'].">Supprimer</a> &nbsp;&nbsp;&nbsp;";
              echo "</td>";
             
              
           echo "</tr>";
          
        }
           echo "</table>";
     }
    
  
    public function Deletemenu($id)
     {
       include('..\config.php');
       $delete=$bdd->exec("DELETE FROM menu WHERE id=$id");
     }
  	
  	public function readmenu($id)
    {
      include('..\config.php');
        $reqread=$bdd->query("SELECT * FROM menu WHERE  id=$id ");
        if( $read = $reqread->fetch() )
        {
            
              
            
        }
    }
}


?>
