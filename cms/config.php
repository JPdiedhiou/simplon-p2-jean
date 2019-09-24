<?php 
                      try{
                      $bdd= new PDO('mysql:host=localhost;dbname=cms','root','');}catch (PDOException $e) {die($e->getMessage());} ?>