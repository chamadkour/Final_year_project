<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
    <link rel="stylesheet" href="styleportals.css">
</head>
<body>
    <?php
       //vérifier que le bouton ajouter a bien été cliqué
       if(isset($_POST['button'])){
           //extraction des informations envoyé dans des variables par la methode POST
           extract($_POST);
           //verifier que tous les champs ont été remplis
           if(isset($IDTFCL) && isset($RAISOC1_NOM) && isset($RAISOC2_PRENOM) && isset($NO_RGCOM) && isset($TEL_GSM)
           && isset($DET_ACTIV_PROF) && isset($EMPLOYEUR) && isset($DT_NAICONS) && isset($CATEG)
           && isset($FORM_JUR) && isset($MARCHE)
           && isset($NIVEAU_SRV) && isset($PAYSADR) && isset($CD_VILLE) && isset($CD_POST) 
           && isset($EMAIL)){
                //connexion à la base de donnée
                include_once "connexion.php";
                //requête d'ajout
                $req = mysqli_query($con , "INSERT INTO to_pers VALUES('$IDTFCL' , '$DET_ACTIV_PROF' , '$RAISOC1_NOM',
                '$RAISOC2_PRENOM' , '$EMPLOYEUR' , '$DT_NAICONS', 
                '$NO_RGCOM' , '$CATEG' , '$FORM_JUR', '$MARCHE',
                 '$NIVEAU_SRV' , '$PAYSADR' , '$P1ADR', 
                '$CD_VILLE' , '$CD_POST' , '$TEL_BUR', '$TEL_GSM',
                 '$EMAIL')");
                if($req){//si la requête a été effectuée avec succès , on fait une redirection
                    header("location: table.php");
                }else {//si non
                    $message = "Client non ajouté";
                }

           }else {
               //si non
               $message = "Veuillez remplir tous les champs !";
           }
       }
    
    ?>
    <div class="form">
        <a href="table.php" class="back_btn"><img src="img/back.png"> Retour</a>
        <h2>Ajouter un employé</h2>
        <p class="erreur_message">
            <?php 
            // si la variable message existe , affichons son contenu
            if(isset($message)){
                echo $message;
            }
            ?>

        </p>
        <form action="" method="POST">
        <label>ID</label>
            <input type="text" name="ID">
            <label>Profession</label>
            <input type="text" name="prof">
            <label>Nom</label>
            <input type="text" name="NOM">
            <label>Prénom</label>
            <input type="text" name="PRENOM">
            <label>Employeur</label>
            <input type="text" name="emp">
            <label>Date de naissance/création</label>
            <input type="date" name="dt_naiss">
            <label>RC</label>
            <input type="text" name="RC">
            <label>Categorie</label>
            <input type="number" name="CATEG">
            <label>Forme juridique</label>
            <input type="text" name="form_jur">
            <label>Marché</label>
            <input type="text" name="MAR">
            <label>Niveau de service</label>
            <input type="text" name="nv_serv">
            <label>Pays</label>
            <input type="text" name="Pays">
            <label>Adresse</label>
            <input type="text" name="Adresse">
            <label>Ville</label>
            <input type="text" name="Ville">
            <label>Code postal</label>
            <input type="text" name="cd_post">
            <label>Téléphone professionnel</label>
            <input type="number" name="tel">
            <label>GSM</label>
            <input type="number" name="gsm">
            <label>Email</label>
            <input type="text" name="email">
            <input type="submit" value="Ajouter" name="button">
        </form>
    </div>
</body>
</html>