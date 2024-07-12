<?php
if(isset($_POST['username']) and isset($_POST['email'])and isset($_POST['password']))
{
	if($_POST['username']=='ad5146' and $_POST['email']=='user@gmail.com' and $_POST['password']=='123')
	         header( "location: demande.html");
	else	
	{
	
		echo "<center> Mot de passe incorrect</center>";
	}
}
?>