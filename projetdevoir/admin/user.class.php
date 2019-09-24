<?php
class User
{
	private $id;
	private $nom;
  private $prenom;
  private $login;
  private $password;
  private $role;

	function __construct($id="", $nom="", $prenom="", $login="", $password="", $role="")
	{
	$this->id=$id;
	$this->nom=$nom;
  $this->prenom=$prenom;
  $this->login=$login;
  $this->password=$password;
  $this->role=$role;
}

	
public function create($nom, $prenom, $login, $password, $role){
	include('..\config.php');
	$req = $bdd->prepare("INSERT INTO user (nom, prenom, login, password, role) VALUES (?,?,?,?,?)");
	try{
	$req->execute(array($nom, $prenom, $login, $password, $role));
	}
	catch(Exception $e)
	{
echo $e;
	}
	
echo"cette methode permet de cree un user"."</br>";


}
public function get_user($id){
  include('..\config.php');
  $req1 = $bdd->query("SELECT * FROM user WHERE id=$id");
  echo"<form action=\"updateuser.php\" method=\"POST\">";
  while ($ligne=$req1->fetch()) {
    echo"<input type=\"hidden\" name=\"id\" value=".$ligne['id'].">";
    echo"<input type=\"text\" name=\"nom\" value=".$ligne['nom'].">";
    echo"<input type=\"text\" name=\"prenom\" value=".$ligne['prenom'].">";
    echo"<input type=\"text\" name=\"login\" value=".$ligne['login'].">";
    echo"<input type=\"text\" name=\"password\" value=".$ligne['password'].">";
     echo"<input type=\"text\" name=\"role\" value=".$ligne['role'].">";

    echo"<input type=\"submit\" name=\"ok\">";
    echo"<input type=\"reset\" name=\"Annuler\">";
  }

  echo"</form>";


}
public function update($id, $nom, $prenom, $login, $password, $role){
	include('..\config.php');
	
	try 
        { 
         $update=$bdd->exec("UPDATE user SET nom=\"$nom\",prenom=\"$prenom\", login=\"$login\",password=\"$password\",role=\"rol\" WHERE id = $id");
         
        }
        catch (Exception $e) 
        {
          echo $e;  
        }

	echo "cette methode permet de modifier un menu";

}



		 public function Listuser()
     {
        include('..\config.php');
         echo "<a href=index.php?cle=Nouveau-user>Creation d'un utilisateur</a> &nbsp;&nbsp;&nbsp;";

         $req3=$bdd->query("SELECT * FROM user "); 
         echo "<table>";
           echo "<th>id</th>";
           echo "<th>nom</th>";
           echo "<th>prenom</th>";
           echo "<th>login</th>";
           echo "<th>password</th>";
            echo "<th>role</th>";
           echo "<th>Modifier</th>";
           echo "<th>Supprimer</th>";
   


        while( $reponse = $req3->fetch() )
        {
          
            echo "<tr>";
              echo "<td>";
                     echo $reponse['id'];
              echo "</td>";
              echo "<td>";
                     echo $reponse['nom'];
              echo "</td>";
              echo "<td>";
                     echo $reponse['prenom'];
              echo "</td>";
              echo "<td>";
                     echo $reponse['login'];
              echo "</td>";
              echo "<td>";
                     echo $reponse['password'];
              echo "</td>";
               echo "<td>";
                     echo $reponse['role'];
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
       $delete=$bdd->exec("DELETE FROM user WHERE id=$id");
     }
  	
  	public function readmenu($id)
    {
      include('..\config.php');
        $reqread=$bdd->query("SELECT * FROM user WHERE  id=$id ");
        if( $read = $reqread->fetch() )
        {
            
              
            
        }
    }
}


?>
