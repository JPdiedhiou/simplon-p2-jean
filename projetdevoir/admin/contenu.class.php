<?php
class Contenu
{
	public $id;
	public $titre;
  public $contenu;
  public $datecreat;
  public $datepub;
  
  

	public function __construct($id="", $titre="", $contenu="", $datecreat="",  $datepub="")
	{
	$this->id=$id;
	$this->titre=$titre;
  $this->contenu=$contenu;
  $this->datecreat=$datecreat;
  $this->datepub=$datepub;


}

	
public function create($titre, $contenu, $datecreat, $datepub){
	include('..\config.php');
	$req = $bdd->prepare("INSERT INTO contenu (titre, contenu, datecreat, datepub) VALUES (?,?,?)");
	try{
	$req->execute(array($titre, $contenu, $datecreat, $datepub));
	}
	catch(Exception $e)
	{
echo $e;
	}
	
echo"cette methode permet de cree un contenu"."</br>";


}
public function get_contenu($id){
  include('..\config.php');
  $req1 = $bdd->query("SELECT * FROM contenu WHERE id=$id");
  echo"<form action=\"updatecontenu.php\" method=\"POST\">";
  while ($ligne=$req1->fetch()) {
    echo"<input type=\"hidden\" name=\"id\" value=".$ligne['id'].">";
    echo"<input type=\"text\" name=\"titre\" value=".$ligne['titre'].">";
    echo"<input type=\"text\" name=\"contenu\" value=".$ligne['contenu'].">";
    echo"<input type=\"text\" name=\"datecreat\" value=".$ligne['datecreat'].">";
    echo"<input type=\"text\" name=\"datepub\" value=".$ligne['datepub'].">";
    echo"<input type=\"submit\" name=\"ok\">";
    echo"<input type=\"reset\" name=\"Annuler\">";
  }

  echo"</form>";


}
public function update($id, $titre, $corps, $auteur){
	include('..\config.php');
	
	try 
        { 
         $update=$bdd->exec("UPDATE contenu SET titre=\"$titre\",corps=\"$corps\", auteur=\"$auteur\" WHERE id = $id");
         
        }
        catch (Exception $e) 
        {
          echo $e;  
        }

	echo "cette methode permet de modifier un contenu";

}



		 public function Listcontenu()
     {
        include('..\config.php');
         echo "<a href=index.php?cle=Nouveau-contenu>Creation d'un contenu</a> &nbsp;&nbsp;&nbsp;";

         $req3=$bdd->query("SELECT * FROM contenu "); 
           echo "<table>";
           echo "<th>id</th>";
           echo "<th>titre</th>";
           echo "<th>corps</th>";
           echo "<th>auteur</th>";
           echo "<th>Modifier</th>";
           echo "<th>Supprimer</th>";
   


        while( $reponse = $req3->fetch() )
        {
          
            echo "<tr>";
              echo "<td>";
                     echo $reponse['id'];
              echo "</td>";
              echo "<td>";
                     echo $reponse['titre'];
              echo "</td>";
              echo "<td>";
                     echo $reponse['corps'];
              echo "</td>";
              echo "<td>";
                     echo $reponse['auteur'];
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
    
  
    public function Deletecontenu($id)
     {
       include('..\config.php');
       $delete=$bdd->exec("DELETE FROM contenu WHERE id=$id");
     }
  	
  	public function readcontenu($id)
    {
      include('..\config.php');
        $reqread=$bdd->query("SELECT * FROM contenu WHERE  id=$id ");
        if( $read = $reqread->fetch() )
        {
            
              
            
        }
    }
}


?>
