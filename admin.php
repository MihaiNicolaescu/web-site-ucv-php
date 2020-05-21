<?php
require_once "connect.php";
if(isset($_POST['register-btn'])):
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $username = stripcslashes($username);
    $password = stripcslashes($password);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO admins(username, password) VALUES ('$username', '$password_hash')";
    $result = mysqli_query($connect, $query);
    if($result):
        echo "Contul a fost inregistrat cu succes!";
    else:
        echo "Contul nu a putut fi inregistrat. " .$connect->connect_error;
    endif;
endif;
?>

<html>
<head>
    <title>Adaugare admin</title>
</head>
<body>
<form method="post" action="admin.php">
    <input type="text" name="username" placeholder="Username">
    <input type="text" name="password" placeholder="Password">
    <button type="submit" name="register-btn">Adauga</button>
</form>
</body>
</html>
