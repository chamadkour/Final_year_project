<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des clients/prospects</title>
    <link rel="stylesheet" href="styleportals.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
</head>
<body>
<div class="container">
        <aside class="sidebar" id="sidebar">
            <div class="menu">
            <button class="menu-toggle" id="sidebarToggle">
        <span></span>
        <span></span>
        <span></span>
    </button>
            </div>
            <ul class="sidebar-menu">
    
  <li><a href="table.php" class="active" >
  <i class='bx bx-line-chart'></i>
  <span>Liste</span>
  </a>
</li>
<li><a href="portail.html" >
  <i class='bx bx-table'></i>
    <span>Dashboards</span>
  </a></li>
  <li ><a href="download.php">
  <i class='bx bxs-dashboard' ></i>
  <span>Demandes</span>
  </a>
  </li>
  <li ><a href="#" >
  <i class='bx bx-log-out-circle' ></i>
  <span>Log out</span>
  </a> </ul>
        </aside>
</div>
        <main class="main-content">
            <header class="header">
                <div class="logo">
                    <img src="img\Logo_AWB.svg.png" alt="Company Logo" class="company-logo">
                </div>
            </header>

    <div class="container2">
        <a href="ajouter.php" class="Btn_add"> <img src="img/plus.png"> Ajouter</a>
        <form action="/search/" method="post" >
    <input type="search" name="search" id="Search" placeholder="Search" />
    <input type="submit" name="search" value="Search" />
</form>
        
        <table id="clientsTable">
            <tr id="items">
                <th>ID</th>
                <th>Profession</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Employeur</th>
                <th>Date de naissance/création</th>
                <th>RC</th>
                <th>Categorie</th>
                <th>Forme juridique</th>
                <th>Marché</th>
                <th>Niveau de service</th>
                <th>Pays</th>
                <th>Adresse</th>
                <th>Ville</th>
                <th>Code postal</th>
                <th>Téléphone professionnel</th>
                <th>GSM</th>
                <th>Email</th>

            </tr>
            <?php 
                //inclure la page de connexion
                include_once "connexion.php";
                //requête pour afficher la liste des employés
                $req = mysqli_query($con , "SELECT IDTFCL, DET_ACTIV_PROF, RAISOC1_NOM, RAISOC2_PRENOM, 
                EMPLOYEUR, DT_NAICONS, NO_RGCOM, CATEG, FORM_JUR, MARCHE, 
                NIVEAU_SRV, PAYSADR, P1ADR, CD_VILLE, CD_POST, TEL_BUR, TEL_GSM, EMAIL FROM to_pers");
                if(mysqli_num_rows($req) == 0){
                    //s'il n'existe pas d'employé dans la base de donné , alors on affiche ce message :
                    echo "Il n'y a pas encore de client ajouté !" ;
                    
                }else {
                    //si non , affichons la liste de tous les employés
                    while($row=mysqli_fetch_assoc($req)){
                        ?>
                        <tr>
                            <td><?=$row['IDTFCL']?></td>
                            <td><?=$row['DET_ACTIV_PROF']?></td>
                            <td><?=$row['RAISOC1_NOM']?></td>
                            <td><?=$row['RAISOC2_PRENOM']?></td>
                            <td><?=$row['EMPLOYEUR']?></td>
                            <td><?=$row['DT_NAICONS']?></td>
                            <td><?=$row['NO_RGCOM']?></td>
                            <td><?=$row['CATEG']?></td>
                            <td><?=$row['FORM_JUR']?></td>
                            <td><?=$row['MARCHE']?></td>
                            <td><?=$row['NIVEAU_SRV']?></td>
                            <td><?=$row['PAYSADR']?></td>
                            <td><?=$row['P1ADR']?></td>
                            <td><?=$row['CD_VILLE']?></td>
                            <td><?=$row['CD_POST']?></td>
                            <td><?=$row['TEL_BUR']?></td>
                            <td><?=$row['TEL_GSM']?></td>
                            <td><?=$row['EMAIL']?></td>
                            
                            <td><a href="modifier.php?id=<?=$row['id']?>"> <i class='bx bxs-edit-alt'></i></a></td>
                            <td><a href="supprimer.php?id=<?=$row['id']?>"> <i class='bx bxs-trash' style='color:#ff0003'  ></i></a></td>
                        </tr>
                        <?php
                    }
                    
                }
            ?>
      
         
        </table>
   
    </div>
    <script src="button_menu.js" ></script> 
 
 </script>
</body>
</html>