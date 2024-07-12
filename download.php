<?php
// Database connection
$db_host = "127.0.0.1";
$db_user = "root";
$db_pass = "123";
$db_name = "fileuploaddownload";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch uploaded files and related request information from the database
$sql = "SELECT r.nom, r.prenom, f.filename, f.filesize, f.filetype 
        FROM files f
        INNER JOIN requests r ON f.request_id = r.request_id";
$result = $conn->query($sql);

?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Uploaded files</title>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <link rel="stylesheet" href="styleportals.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  
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
    
  <li><a href="table.php"  >
  <i class='bx bx-line-chart'></i>
  <span>Liste</span>
  </a>
    </li>
    <li><a href="portail.html" >
  <i class='bx bx-table'></i>
    <span>Dashboards</span>
  </a></li>
  <li ><a href="download.php" class="active">
  <i class='bx bxs-dashboard' ></i>
  <span>Demandes</span>
  </a>
  </li>
  <li ><a href="#" >
  <i class='bx bx-log-out-circle' ></i>
  <span>Log out</span>
  </a> </ul>
        </aside>

        <main class="main-content">
            <header class="header">
                <div class="logo">
                    <img src="img\Logo_AWB.svg.png" alt="Company Logo" class="company-logo">
                </div>
            </header>
            <div class="container2">
                <h3>Consultez les demandes de crédit</h2>
                <span>Veuillez n'ajouter le client qu'après vérification de la présence de tous les documents</span>
                <table>
               
                    <tr>
                        <th> Nom</th>
                        <th>Prénom</th>
                        <th>Montant</th>
                        <th>Nom du document</th>
                        <th>Taille</th>
                        <th>Type</th>
                        <th>Télécharger</th>
                    </tr>
               
                <?php
                // Display the uploaded files and download links
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $file_path = "uploads/" . $row['filename'];
                        ?>
                        <tr>
                            <td><?php echo $row['nom']; ?></td>
                            <td><?php echo $row['prenom']; ?></td>
                            <td><?php echo $row['montant']; ?></td>
                            <td><?php echo $row['filename']; ?></td>
                            <td><?php echo $row['filesize']; ?> bytes</td>
                            <td><?php echo $row['filetype']; ?></td>
                            <td><a href="<?php echo $file_path; ?>" class="btn btn-primary" download>Télécharger</a></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="6">No files uploaded yet.</td>
                    </tr>
                    <?php
                }
                ?>
           
            </table>
            </div>
        </main> 
        </div> 
             <script src="button_menu.js" ></script>

</body>
</html>

<?php
$conn->close();
?>
