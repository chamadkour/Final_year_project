<?php
$message = "";
if (count($_POST) > 0) {
    $isSuccess = 0;
    $conn = mysqli_connect("127.0.0.1", "root", "123", "authentification");
    $userName = $_POST['userName'];
    $sql = "SELECT * FROM users WHERE userName= ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('s', $userName);
    $statement->execute();
    $result = $statement->get_result();
    while ($row = $result->fetch_assoc()) {
        if (! empty($row)) {
            $hashedPassword = $row["password"];
            if (password_verify($_POST["password"], $hashedPassword)) {
                $isSuccess = 1;
            }
        }
    }
    if ($isSuccess == 0) {
        $message = "Invalid Username or Password!";
    } else {
        header("Location: table.php");
    }
}
?>