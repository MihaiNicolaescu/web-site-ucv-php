<?php
require_once "../connect.php";
session_start();
if(!(isset($_SESSION['loggedIn']))):
    header("location: ../index.php");
endif;
if(isset($_POST['login-btn'])):
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $username = stripslashes($username);
    $password = stripcslashes($password);
    $query = "SELECT * FROM admins WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) > 0):
        while($row = mysqli_fetch_assoc($result)):
            $usernameDB = $row['username'];
            $passwordDB = $row['password'];
            $idDB = $row['id'];
        endwhile;
        if(password_verify($password, $passwordDB)):
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $idDB;
            $_SESSION['loggedIn'] = true;
        endif;
    endif;
endif;

if(isset($_POST['adauga-profesor'])):
    $nume = $_POST['nume-profesor'];
    $grad = $_POST['grad'];
    $titlu = $_POST['titlu'];
    $pagina = $_POST['pagina-web'];
    $telefon = $_POST['telefon-prof'];
    $fax = $_POST['fax-prof'];
    $email = $_POST['email-prof'];
    $profil_name = $_FILES['profil-prof']['name'];
    $folder = "images/".basename($profil_name);
    if($profil_name == NULL):
        $query = "INSERT INTO cadre_didactice (nume, grad, titlu, pagina, telefon, fax, email, image) values ('$nume', '$grad', '$titlu', '$pagina', '$telefon', '$fax', '$email', 'default.png')";
    else:
        $folder = "images/".basename($profil_name);
        $query = "INSERT INTO cadre_didactice (nume, grad, titlu, pagina, telefon, fax, email, image) values ('$nume', '$grad', '$titlu', '$pagina', '$telefon', '$fax', '$email', '$profil_name')";
        move_uploaded_file($_FILES['edit-profil-prof']['tmp_name'], $folder);
    endif;
    //$query = "INSERT INTO cadre_didactice (nume, grad, titlu, pagina, telefon, fax, email, image) values ('$nume', '$grad', '$titlu', '$pagina', '$telefon', '$fax', '$email', '$profil_name')";
    $result = mysqli_query($connect, $query);
    if(!$result):
        echo "Inserarea in baza de date a esuat! Va rugam reincercati.";
    else:
        move_uploaded_file($_FILES['profil-prof']['tmp_name'], $folder);
        header("location: cadre-didactice.php");
    endif;
endif;

if(isset($_POST['deconnect-btn'])):
    $_SESSION['loggedIn'] = false;
    header("location: cadre-didactice.php");
endif;
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <title>Cadre didactice</title>
    <link rel="stylesheet" href="../src/style.css" type="text/css">
</head>
<body>
<div class="nav-bar">
    <ul>
        <li><p>Departamentul de Informatica</p></li>
        <li><a style="margin-right:50px;" href="../home.php">Acasă</a></li>
        <li><a style="margin-right:130px" href="contact.php">Contact</a></li>
    </ul>
</div>
<div id="leftSide">
    <div class="meniu-linkuri">
        <ul>
            <li><a href="admitere.php">Admitere</a></li>
            <li><a href="cadre-didactice.php">Cadre didactice</a></li>
            <li><a href="programe-studi.php">Programe studii</a></li>
            <li><a href="anunturi.php">Anunturi</a></li>

        </ul>
    </div>
    <div class="panou-administrare">
        <?php if($_SESSION['loggedIn']): ?>
        <button onclick="document.getElementById('overlay').style.display='block'">Adauga Profesor</button>
        <form method="post" action="cadre-didactice.php">
            <button name="deconnect-btn" type="submit">Deconectare</button>
        </form>
        <?php else:?>
        <div class="conectare">
            <form method="post" action="cadre-didactice.php">
                <p style="font-size: 20px">Conectare administrator</p>
                <input autocomplete="off" type="text" name="username" placeholder="Username">
                <input type="password" autocomplete="off" name="password" placeholder="Password">
                <button type="submit" name="login-btn">Conectare</button>
            </form>
        </div>
        <?php endif;?>
    </div>
</div>
<div id="right-side">
    <div class="content">
        <h1>Cadre didactice</h1>
        <table>
            <?php
                $query = "SELECT * FROM cadre_didactice";
                $result = mysqli_query($connect, $query);
                if($result):
                    while($row = mysqli_fetch_assoc($result)):
                        $id_prof = $row['id'];
            ?>
            <tr>
                <td style="width:100px;">
                    <img style="height: 140px; width: 130px;" src="images/<?php echo $row['image'];?>" alt="<?php echo $row['name']; ?>">
                </td>
                <td style="width:250px;">
                    <p>Nume: <b><?php echo $row['nume']; ?></b></p>
                    <p>Grad: <b><?php echo $row['grad']; ?> </b>Titlu: <b><?php echo $row['titlu']; ?></b></p>
                    <p>Pagina web: <a href="<?php echo $row['pagina']; ?>"><?php echo $row['pagina']; ?></a></p>
                </td>
                <td>
                    <p>Telefon de serviciu: <b><?php echo $row['telefon']; ?></b></p>
                    <p>Fax de serviciu: <b><?php echo $row['fax']; ?></b></p>
                    <p>E-mail: <b><?php echo $row['email']; ?></b></p>
                    <?php if($_SESSION['loggedIn'] == true): ?>
                    <form method="post" action="../edit.php?id=<?php echo $row['id']; ?>"><button name="edit-button" type="submit">Editeaza</button></form>
                    <?php endif;?>
                </td>
            </tr>
            <?php
                endwhile;
            endif;?>
        </table>
    </div>
    <div class="container-adaugare" id="overlay">
        <div class="adaugare-overlay">
            <form method="post" enctype="multipart/form-data" >
                <input id="nume-profesor" type="text" name="nume-profesor" placeholder="Nume">
                <br>
                <label for="grad">Grad</label>
                <select id="grad" name="grad">
                    <option value="Prof">Prof</option>
                    <option value="Conf">Conf</option>
                    <option value="Lect">Lect</option>
                    <option value="Asist">Asist</option>
                </select>
                <label for="titlu">Titlu</label>
                <select id="titlu" name="titlu">
                    <option value="Dr">Dr</option>
                </select>
                <br>
                <input id="pagina-web" type="text" name="pagina-web" placeholder="Pagina web">
                <br>
                <input id="telefon-prof" type="text" name="telefon-prof" placeholder="Tel. serviciu">
                <br>
                <input id="fax-prof" type="text" name="fax-prof" placeholder="Fax serviciu">
                <br>
                <input id="email-prof" type="text" name="email-prof" placeholder="E-mail">
                <br>

                <label for="profil-prof">Imagine Profil</label>
                <input type="file" id="profil-prof" name="profil-prof">
                <br>
                <p id="overlay-buttons""><button type="submit" name="adauga-profesor">Adauga</button>
                    <button style="margin-left: 240px" onclick="document.getElementById('overlay').style.display='hidden'">Anulare</button></p>
            </form>
        </div>
    </div>
</div>
</body>
</html>
