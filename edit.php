<?php
require_once "connect.php";
session_start();
if(isset($_POST['anulare-btn'])):
    header("location: pages/cadre-didactice.php");
endif;

if(isset($_POST['editare-profesor'])):
    $nume = mysqli_real_escape_string($connect, $_POST['editare-nume-profesor']);
    $grad = mysqli_real_escape_string($connect, $_POST['grad']);
    $titlu = mysqli_real_escape_string($connect, $_POST['titlu']);
    $pagina = mysqli_real_escape_string($connect, $_POST['editare-pagina-web']);
    $telefon = mysqli_real_escape_string($connect, $_POST['editare-telefon-prof']);
    $fax = mysqli_real_escape_string($connect, $_POST['editare-fax-prof']);
    $email = mysqli_real_escape_string($connect, $_POST['editare-email-prof']);


    $nume = stripcslashes($nume);
    $grad = stripcslashes($grad);
    $titlu = stripcslashes($titlu);
    $pagina = stripcslashes($pagina);
    $telefon = stripcslashes($telefon);
    $fax = stripcslashes($fax);
    $email = stripcslashes($email);
    $id = $_GET['id'];
    $profil_name = $_FILES['edit-profil-prof']['name'];
    if($profil_name == NULL):
    $query = "UPDATE cadre_didactice SET nume='$nume', grad='$grad', titlu='$titlu', pagina='$pagina', telefon='$telefon', fax='$fax', email='$email' WHERE id='$id'";
    else:
        $folder = "pages/images/".basename($profil_name);
        $query = "UPDATE cadre_didactice SET nume='$nume', grad='$grad', titlu='$titlu', pagina='$pagina', telefon='$telefon', fax='$fax', email='$email', image='$profil_name' WHERE id='$id'";
        move_uploaded_file($_FILES['edit-profil-prof']['tmp_name'], $folder);
    endif;
    $result = mysqli_query($connect, $query);
    if($result):
        header("location: pages/cadre-didactice.php");
    else:
        echo "A aparut o eroare! " . $connect->connect_error;
    endif;
endif;

if(isset($_POST['delete-btn'])){
    $id = $_GET['id'];
    $query = "DELETE FROM cadre_didactice WHERE id='$id'";
    $result = mysqli_query($connect, $query);
    if($result):
        header("location: pages/cadre-didactice.php");
    else:
        echo "A aparut o eroare! " . $connect->connect_error;
    endif;
}
if($_SESSION['loggedIn']):?>
    <html>
    <head>
        <title>Editare</title>
        <link rel="stylesheet" href="src/style.css" type="text/css">
    </head>
    <body>
    <div class="container-edit" id="overlay-editare">
        <div class="adaugare-overlay">
            <form method="post" enctype="multipart/form-data" >
                <?php
                $id = $_GET['id'];
                $query = "SELECT * FROM cadre_didactice WHERE id='$id'";
                $result = mysqli_query($connect, $query);
                if($result):
                    while($row = mysqli_fetch_assoc($result)):
                        $nume = $row['nume'];
                        $grad = $row['grad'];
                        $titlu = $row['titlu'];
                        $pagina = $row['pagina'];
                        $telefon = $row['telefon'];
                        $fax = $row['fax'];
                        $email = $row['email'];
                        $profil_name = $row['image'];
                        $folder = "images/".basename($profil_name);
                        ?>
                        <input id="nume-profesor" type="text" name="editare-nume-profesor" placeholder="Nume" value="<?php echo $nume?>">
                        <br>
                        <label for="grad">Grad</label>
                        <select id="grad" name="grad" value="<?php echo $grad?>">
                            <option value="Prof">Prof</option>
                            <option value="Conf">Conf</option>
                            <option value="Lect">Lect</option>
                            <option value="Asist">Asist</option>
                        </select>
                        <label for="titlu">Titlu</label>
                        <select id="titlu" name="titlu" value="<?php echo $titlu?>">
                            <option value="Dr">Dr</option>
                        </select>
                        <br>
                        <input id="pagina-web" type="text" name="editare-pagina-web" placeholder="Pagina web" value="<?php echo $pagina?>">
                        <br>
                        <input id="telefon-prof" type="text" name="editare-telefon-prof" placeholder="Tel. serviciu" value="<?php echo $telefon?>">
                        <br>
                        <input id="fax-prof" type="text" name="editare-fax-prof" placeholder="Fax serviciu" value="<?php echo $fax?>">
                        <br>
                        <input id="email-prof" type="text" name="editare-email-prof" placeholder="E-mail" value="<?php echo $email?>">
                        <br>
                        <label for="profil-prof">Imagine Profil</label>
                        <input type="file" id="profil-prof" name="edit-profil-prof">
                        <p id="overlay-buttons"">
                        <form method="post" action="edit.php">
                        <button type="submit" name="editare-profesor">Editeaza</button>
                        <button style="margin-left: 80px" type="submit" name="delete-btn">Sterge profesor</button>
                        <button style="margin-left: 80px" name="anulare-btn" type="submit">Anulare</button>
                    </form>
                        </p>
                    <?php endwhile;
                endif; ?>
            </form>
        </div>
    </div>
    </body>
    </html>
    <?php
else:
    echo "Acces interzis!";
endif;