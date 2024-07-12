<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
    <link rel="stylesheet" href="styleportals.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php

         //connexion à la base de donnée
          include_once "connexion.php";
         //on récupère le id dans le lien
          $id = $_GET['id'];
          //requête pour afficher les infos d'un employé
          $req = mysqli_query($con , "SELECT IDTFCL, DET_ACTIV_PROF, RAISOC1_NOM, RAISOC2_PRENOM, 
                EMPLOYEUR, DT_NAICONS, NO_RGCOM, CATEG, FORM_JUR, MARCHE, 
                NIVEAU_SRV, PAYSADR, P1ADR, CD_VILLE, CD_POST, TEL_BUR, TEL_GSM, EMAIL FROM to_pers
              WHERE $id = $id");
          $row = mysqli_fetch_assoc($req);


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
               //requête de modification
               $req = mysqli_query($con, "UPDATE to_pers SET ID = '$IDTFCL' , prof = '$DET_ACTIV_PROF' , NOM = '$RAISOC1_NOM',
                PRENOM = '$RAISOC2_PRENOM' , emp = '$EMPLOYEUR' , dt_naiss = '$DT_NAICONS', 
                RC = '$NO_RGCOM' , CATEG = '$CATEG' , form_jur = '$FORM_JUR', MAR = '$MARCHE',
                nv_serv = '$NIVEAU_SRV' , Pays = '$PAYSADR' , Adresse = '$P1ADR', 
                Ville = '$CD_VILLE' , cd_post = '$CD_POST' , tel = '$TEL_BUR', gsm = '$TEL_GSM',
                email = '$EMAIL' WHERE ID = $IDTFCL");
                if($req){//si la requête a été effectuée avec succès , on fait une redirection
                    header("location: table.php");
                }else {//si non
                    $message = "Client non modifié";
                }

           }else {
               //si non
               $message = "Veuillez remplir tous les champs !";
           }
       }
    
    ?>

    <div class="form">
        <a href="table.php" class="back_btn"><img src="img/back.png"> Retour</a>
        <h2>Modifier les informations client : <?=$row['IDTFCL']?> </h2>
        <p class="erreur_message">
           <?php 
              if(isset($message)){
                  echo $message ;
              }
           ?>
        </p>
        <form action="" method="POST">
            <label>ID</label>
            <input type="text" name="ID" value="<?=$row['IDTFCL']?>">
            <label>Profession</label>
            <input type="text" name="prof" value="<?=$row['DET_ACTIV_PROF']?>">
            <label>Nom</label>
            <input type="text" name="NOM" value="<?=$row['RAISOC1_NOM']?>">
            <label>Prénom</label>
            <input type="text" name="PRENOM" value="<?=$row['RAISOC2_PRENOM']?>">
            <label>Employeur</label>
            <input type="text" name="emp" value="<?=$row['EMPLOYEUR']?>">
            <label>Date de naissance/création</label>
            <input type="date" name="dt_naiss" value="<?=$row['DT_NAICONS']?>">
            <label>RC</label>
            <input type="text" name="RC" value="<?=$row['NO_RGCOM']?>">
            <label>Categorie</label>
            <input type="number" name="CATEG" value="<?=$row['CATEG']?>">
            <label>Forme juridique</label>
            <input type="text" name="form_jur" value="<?=$row['FORM_JUR']?>">
            <label>Marché</label>
            <input type="text" name="MAR" value="<?=$row['MARCHE']?>">
            <label>Niveau de service</label>
            <input type="text" name="nv_serv" value="<?=$row['NIVEAU_SRV']?>">
            <label>Pays</label>
            <input type="text" name="Pays" value="<?=$row['PAYSADR']?>">
            <label>Adresse</label>
            <input type="text" name="Adresse" value="<?=$row['P1ADR']?>">
            <label>Ville</label>
            <input type="text" name="Ville" value="<?=$row['CD_VILLE']?>">
            <label>Code postal</label>
            <input type="text" name="cd_post" value="<?=$row['CD_POST']?>">
            <label>Téléphone professionnel</label>
            <input type="number" name="tel" value="<?=$row['TEL_BUR']?>">
            <label>GSM</label>
            <input type="number" name="gsm" value="<?=$row['TEL_GSM']?>">
            <label>Email</label>
            <input type="text" name="email" value="<?=$row['EMAIL']?>">
            <input type="submit" value="Modifier" name="button">
        </form>
    </div>
</body>
</html>