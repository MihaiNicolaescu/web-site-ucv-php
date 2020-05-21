<?php
require_once "../connect.php";
session_start();
if(!(isset($_SESSION['loggedIn']))):
    header("location: ../index.php");
endif;
if(isset($_GET['id'])):
    $tipAnunt = $_GET['id'];
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

if(isset($_POST['deconnect-btn'])):
    $_SESSION['loggedIn'] = false;
    header("location: anunturi.php");
endif;

if(isset($_POST['adauga-anunt'])):
    $titlu = mysqli_real_escape_string($connect, $_POST['titlu']);
    $titlu = stripcslashes($titlu);
    $continut = mysqli_real_escape_string($connect, $_POST['continut']);
    $continut = stripcslashes($continut);
    $date = date("Y/m/d");
    if(isset($_POST['jobs']) && $_POST['jobs'] == '1'):
        $jobs = true;
    else:
        $jobs = false;
    endif;
    if(isset($_POST['prezentari']) && $_POST['prezentari'] == '1'):
        $prezentari = true;
    else:
        $prezentari = false;
    endif;
    if(isset($_POST['internship']) && $_POST['internship'] == '1'):
        $internship = true;
    else:
        $internship = false;
    endif;
    if(isset($_POST['informatica']) && $_POST['informatica'] == '1'):
        $informatica = true;
    else:
        $informatica = false;
    endif;
    if(isset($_POST['tehnologie']) && $_POST['tehnologie'] == '1'):
        $tehnologie = true;
    else:
        $tehnologie = false;
    endif;
    if(isset($_POST['studenti']) && $_POST['studenti'] == '1'):
        $studenti = true;
    else:
        $studenti = false;
    endif;
    if(isset($_POST['diverse']) && $_POST['diverse'] == '1'):
        $diverse = true;
    else:
        $diverse = false;
    endif;
    if($jobs == false && $prezentari == false && $internship == false && $informatica == false && $tehnologie == false && $studenti == false && $studenti == false):
        $diverse = true;
    endif;
    if(!(empty($titlu) && empty($continut))):
        $query = "INSERT INTO anunturi(titlu, descriere, data, jobs, prezentari, internship, informatica, tehnologie, studenti, diverse ) values ('$titlu', '$continut', '$date', '$jobs', '$prezentari', '$internship', '$informatica', '$tehnologie', '$studenti','$diverse')";
        $result = mysqli_query($connect, $query);
        if(!$result):
            echo "Anuntul nu a putut fi introdus in baza de date! " . $connect->connect_error;
        else:
            header("location: anunturi.php");
        endif;
    else:
        echo "Anuntul trebuie sa contina titlu si continut obligatoriu!";
    endif;
endif;
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <title>Anunturi</title>
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
            <button onclick="document.getElementById('overlay').style.display='block'">Adauga anunt</button>
            <form method="post" action="anunturi.php">
                <button name="deconnect-btn" type="submit">Deconectare</button>
            </form>
        <?php else:?>
            <div class="conectare">
                <form method="post" action="anunturi.php">
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
        <p id="bar-tags"><a href="anunturi.php?id=jobs">jobs</a> <a href="anunturi.php?id=prezentari">prezentari</a> <a href="anunturi.php?id=internship">internship</a> <a href="anunturi.php?id=informatica">informatica</a> <a href="anunturi.php?id=tehnologie">tehnologie</a> <a href="anunturi.php?id=studenti">studenti</a> <a href="anunturi.php?id=diverse">diverse</a></p>
        <?php
        if(isset($_GET['id'])):
            $query = "SELECT * FROM anunturi WHERE " .$tipAnunt ." = 1";
        else:
            $query = "SELECT * FROM anunturi";
        endif;
        $result = mysqli_query($connect, $query);
        if($result):
            while($row = mysqli_fetch_assoc($result)):
            $lista_tag = "";
                if($row['jobs'] == true):
                    $lista_tag .= "Jobs ";
                endif;
                if($row['prezentari'] == true):
                    $lista_tag .= "Prezentare ";
                endif;
                if($row['internship'] == true):
                    $lista_tag .= "Internship ";
                endif;
                if($row['informatica'] == true):
                    $lista_tag .= "Informatica ";
                endif;
                if($row['tehnologie'] == true):
                    $lista_tag .= "Tehnologie ";
                endif;
                if($row['studenti'] == true):
                    $lista_tag .= "Studenti ";
                endif;
                if($row['diverse'] == true):
                    $lista_tag .= "Diverse ";
                endif;
        ?>
        <div class="anunt" style="border: 1px solid;">
            <p style="font-size: 20px; padding-left: 20px;"><b><?php echo $row['titlu']; ?></b></p>
            <p style="font-size: 15px;"><?php echo $row['descriere']; ?></p>
            <p style="font-size: 15px; padding-left: 20px;"><b><?php echo "-" . $lista_tag; ?></b><b style="float: right; padding-right: 20px;">Data: <?php echo $row['data'];?></b></p>
            <?php if($_SESSION['loggedIn'] == true): ?>
            <form method="post" action="../editare-anunt.php?id=<?php echo $row['id']; ?>">
                <button style="width: 75px; height: 50px;" type="submit" name="modificare-anunt">Editare</button>
            </form>
            <?php endif; ?>
        </div>
        <?php
            endwhile;
        endif;
        ?>
    </div>
    <div class="container-adaugare" id="overlay">
        <div class="adaugare-overlay" style="height: 500px;">
            <form method="post" enctype="multipart/form-data" >
                <input id="titlu" type="text" name="titlu" placeholder="Titlu anunt">
                <br>
                <textarea style="width: 363px; height: 100px;" id="descriere" type="text" name="continut" placeholder="Continut"></textarea>
                <br>
                <p style="color:white; font-size: 20px;">Categorii anunt: </p>
                <label for="jobs">Jobs</label>
                <input type="checkbox" id="jobs" name="jobs" value="1">     <br>
                <label for="jobs">Prezentare</label>
                <input type="checkbox" id="prezentari" name="prezentari" value="1"><br>
                <label for="jobs">Internship</label>
                <input type="checkbox" id="internship" name="internship" value="1"><br>
                <label for="jobs">Informatica</label>
                <input type="checkbox" id="infromatica" name="informatica" value="1"><br>
                <label for="jobs">Tehnologie</label>
                <input type="checkbox" id="tehnologie" name="tehnologie" value="1"><br>
                <label for="jobs">Studenti</label>
                <input type="checkbox" id="studenti" name="studenti" value="1"><br>
                <label for="jobs">Diverse</label>
                <input type="checkbox" id="diverse" name="diverse" value="1"><br>
                <p id="overlay-buttons""><button type="submit" name="adauga-anunt">Adauga</button>
                <button style="margin-left: 240px" onclick="document.getElementById('overlay').style.display='hidden'">Anulare</button></p>
            </form>
        </div>
    </div>
</div>
</body>
</html>