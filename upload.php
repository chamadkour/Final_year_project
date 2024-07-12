<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $db_host = "127.0.0.1";
    $db_user = "root";
    $db_pass = "123";
    $db_name = "fileuploaddownload";

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert into requests table
    $nom = $_POST['NOM'];
    $prenom = $_POST['PRENOM'];
    $montant = $_POST['montant'];
    $insert_request_sql = "INSERT INTO requests (nom, prenom,montant) VALUES (?, ?, ?)";
    $stmt_request = $conn->prepare($insert_request_sql);
    $stmt_request->bind_param("ss", $nom, $prenom,$montant);

    if ($stmt_request->execute()) {
        $request_id = $stmt_request->insert_id; // Get the ID of the inserted request
        $stmt_request->close();

        // Insert into files table
        $insert_file_sql = "INSERT INTO files (request_id, filename, filesize, filetype) VALUES (?, ?, ?, ?)";
        $stmt_file = $conn->prepare($insert_file_sql);
        $stmt_file->bind_param("isss", $request_id, $filename, $filesize, $filetype);

        // Process each uploaded file
        for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
            $filename = $_FILES['file']['name'][$i];
            $filesize = $_FILES['file']['size'][$i];
            $filetype = $_FILES['file']['type'][$i];
            $tmp_name = $_FILES['file']['tmp_name'][$i];

            // Move the uploaded file to the specified directory
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($filename);

            if (move_uploaded_file($tmp_name, $target_file)) {
                // Execute the prepared statement to insert file details into the database
                if ($stmt_file->execute()) {
                    echo "The file $filename and related information have been uploaded and stored in the database.<br>";
                } else {
                    echo "Sorry, there was an error uploading $filename and related information to the database.<br>";
                }
            } else {
                echo "Sorry, there was an error uploading $filename.<br>";
            }
        }

        $stmt_file->close();
    } else {
        echo "Sorry, there was an error inserting request information into the database.<br>";
    }

    // Close connection
    $conn->close();
}
?>
