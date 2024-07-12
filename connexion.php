<?php
  //connexion à la base de données
  $con = mysqli_connect("127.0.0.1","root","123","P7IODS");
  if(!$con){
     echo "Vous n'êtes pas connecté à la base de donnée";
  }
?>