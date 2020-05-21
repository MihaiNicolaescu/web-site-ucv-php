<?php
require_once "connect.php";
session_start();
if(isset($_POST['anulare-btn'])):
    header("location: pages/anunturi.php");
endif;

if(isset($_POST['editare-anunt'])):
    $id = $_GET['id'];
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
        $query = " UPDATE anunturi SET titlu = '$titlu', descriere = '$continut', data = '$date', jobs = '$jobs', prezentari = '$prezentari', internship = '$internship', informatica = '$informatica', tehnologie = '$tehnologie', studenti = '$studenti',diverse = '$diverse' WHERE id='$id'";
        $result = mysqli_query($connect, $query);
        if(!$result):
            echo "Anuntul nu a putut fi introdus in baza de date! " . $connect->connect_error;
        else:
            header("location: pages/anunturi.php");
        endif;
    else:
        echo "Anuntul trebuie sa contina titlu si continut obligatoriu!";
    endif;
endif;

if(isset($_POST['delete-btn'])){
    $id = $_GET['id'];
    $query = "DELETE FROM anunturi WHERE id='$id'";
    $result = mysqli_query($connect, $query);
    if($result):
        header("location: pages/anunturi.php");
    else:
        echo "A aparut o eroare! " . $connect->connect_error;
    endif;
}
if($_SESSION['loggedIn']):?>
    <html xmlns:color="http://www.w3.org/1999/xhtml" xmlns:font-size="http://www.w3.org/1999/xhtml">
    <head>
        <title>Editare</title>
        <link rel="stylesheet" href="src/style.css" type="text/css">
    </head>
    <body>
    <div class="container-edit-anunt" id="overlay-editare">
        <div class="adaugare-overlay" style="height: 545px;">
            <form method="post" enctype="multipart/form-data" >
                <?php
                $id = $_GET['id'];
                $query = "SELECT * FROM anunturi WHERE id='$id'";
                $result = mysqli_query($connect, $query);
                if($result):
                    while($row = mysqli_fetch_assoc($result)):
                        ?>
                            <input id="titlu" type="text" name="titlu" placeholder="Titlu anunt" value="<?php echo $row['titlu']; ?>">
                            <br>
                            <textarea style="width: 363px; height: 100px;" id="descriere" type="text" name="continut" placeholder="Continut"><?php echo $row['descriere']; ?></textarea>
                            <br>
                            <p style="color:white; font-size: 20px;">Categorii anunt: </p>
                            <label for="jobs">Jobs</label>
                            <input type="checkbox" id="jobs" name="jobs" value="1" <?php if($row['jobs'] == true): ?> checked="checked"<?php endif; ?>>     <br>
                            <label for="jobs">Prezentare</label>
                            <input type="checkbox" id="prezentari" name="prezentari" value="1" <?php if($row['prezentari'] == true): ?> checked="checked"<?php endif; ?>><br>
                            <label for="jobs">Internship</label>
                            <input type="checkbox" id="internship" name="internship" value="1" <?php if($row['internship'] == true): ?> checked="checked"<?php endif; ?>><br>
                            <label for="jobs">Informatica</label>
                            <input type="checkbox" id="infromatica" name="informatica" value="1" <?php if($row['informatica'] == true): ?> checked="checked"<?php endif; ?>><br>
                            <label for="jobs">Tehnologie</label>
                            <input type="checkbox" id="tehnologie" name="tehnologie" value="1" <?php if($row['tehnologie'] == true): ?> checked="checked"<?php endif; ?>><br>
                            <label for="jobs">Studenti</label>
                            <input type="checkbox" id="studenti" name="studenti" value="1" <?php if($row['studenti'] == true): ?> checked="checked"<?php endif; ?>><br>
                            <label for="jobs">Diverse</label>
                            <input type="checkbox" id="diverse" name="diverse" value="1" <?php if($row['diverse'] == true): ?> checked="checked"<?php endif; ?>><br>
                        <p id="overlay-buttons"">
                        <form method="post" action="editare-anunt.php">
                            <button type="submit" name="editare-anunt">Editeaza</button>
                            <button style="margin-left: 80px" type="submit" name="delete-btn">Sterge anunt</button>
                            <button style="margin-left: 80px" name="anulare-btn" type="submit">Anulare</button>
                        </form></p>
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