<?php
session_start();
$_SESSION['loggedIn'] = false;
?>
<!DOCTYPE html>
<html lang="ro">
    <head>
        <title>Departamentul de informatica</title>
        <link href="src/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="nav-bar">
            <ul>
                <li><p>Departamentul de Informatica</p></li>
                <li><a style="margin-right:50px;" href="home.php">Acasă</a></li>
                <li><a style="margin-right:130px" href="pages/contact.php">Contact</a></li>
            </ul>
        </div>
        <div id="leftSide">
            <ul>
                <li><a href="pages/admitere.php">Admitere</a></li>
                <li><a href="pages/cadre-didactice.php">Cadre didactice</a></li>
                <li><a href="pages/programe-studi.php">Programe studii</a></li>
                <li><a href="pages/anunturi.php">Anunturi</a></li>

            </ul>
        </div>
        <!--<h2>Home <a href="pages/admitere.html">Admitere</a> <a href="pages/cadre-didactice.html">Cadre didactice</a> <a href="pages/programe-studi.html">Programe studii</a> <a href="pages/anunturi.html">Anunturi</a> <a href="pages/contact.html">Contact</a></h2>-->
        <div id="right-side">
        <div class="content">
            <h1>Admitere 2019</h1>
            <p><b>Departamentul de informatica</b> al Facultatii de Stiinte organizeaza concurs de admitere pentru urmatoarele programe de studii:</p>
            <p><b>Ciclul 1: Licenta (Facultate)</b> - Locuri libere pentru sesiune de admitere septembrie 2019:</p>
            <table class="table-ed">
                <tr>
                    <th rowspan="2" style="width:150px">Domeniul de Licenta</th>
                    <th rowspan="2" style="width:50px">Specializarea</th>
                    <th rowspan="1" colspan="2" style="width:50px">Numar de locuri</th>
                    <th rowspan="2" style="width:50px">Inscrieri</th>
                </tr>
                <tr>
                    <th style="width:70px;">Buget</th>
                    <th style="width:70px;">Taxa</th>
                </tr>
                <tr>
                    <th>Informatica (3 ani)</th>
                    <th>Informatica</th>
                    <th>10</th>
                    <th>21</th>
                    <th>9 - 16 septembrie 2019</th>
                </tr>
            </table>
            <pre>Taxa de scolarizare este de 3000 RON/an, platibil in transe</pre>
            <pre>Pentru detalii suplimentare consultati sectiunea <a href="pages/admitere.html">Admitere licenta 2019</a></pre>
            <p><b>Ciclul 2: Master</b> - Locuri libere pentru sesiune de admitere septembrie 2019:</p>
            <table class="table-ed">
                <tr>
                    <th rowspan="2" style="width:150px; height:60px;">Domeniul de Master</th>
                    <th rowspan="2" style="width:50px;">Specializarea</th>
                    <th rowspan="1" colspan="2" style="width:50px;">Numar de locuri</th>
                    <th rowspan="2" style="width:50px;">Inscrieri</th>
                </tr>
                <tr>
                    <th style="width:70px;">Buget</th>
                    <th style="width:70px;">Taxa</th>
                </tr>
                <tr>
                    <th>Informatica (2 ani)</th>
                    <th style="width:50px;">Metode si modele in inteligenta artificiala</th>
                    <th>3</th>
                    <th>28</th>
                    <th>13 - 18 septembrie 2019</th>
                </tr>
            </table>
            <pre>Pentru detalii suplimentare consultati sectiunea <a href="pages/admitere.html">Admitere Master 2019</a></pre>
            <table style="border-top:1px solid">
                <tr>
                    <th style="text-align: left;">
                        <h3>Domeniul de Licenta si Specializari</h3>
                        <h5>INFORMATICA</h5>
                        <ul style="text-align: left;">
                            <li>Durata studiilor: 3 ani</li>
                            <li>Diploma obtinuta: licenta in informatica</li>
                            <li>Specializari:
                                <ul>
                                    <li>Informatica</li>
                                </ul>
                            </li>
                        </ul>
                        <h5>MASTER IN INFORMATICA:</h5>
                        <pre>Tehnici avansate de prelucrare a infromatiei(in limba <br>engleza)</pre>
                        <ul style="text-align: left;">
                            <li>Durata studiilor: 2 ani</li>
                            <li>Diploma obtinuta: master in infromatica</li>
                        </ul>
                    </th>
                    <th style="text-align: left;">
                        <h3>Planuri de invatamant</h3>
                        <h5>Ciclul I - Licenta (3 ani)</h5>
                        <i>Informatica:</i>
                        <ul style="text-align: left;">
                            <li>
                                <p><a href="src/plan-invatamant-licenta-2018-2019-I.pdf">Anul I</a>, promotia 2018-2021</p>
                            </li>
                            <li>
                                <p><a href="src/plan-invatamant-licenta-2018-2019-II.pdf">Anul II</a>, promotia 2017-2020</p>
                            </li>
                            <li>
                                <p><a href="src/plan-invatamant-licenta-2018-2019-III.pdf">Anul III</a>, promotia 2016-2019</p>
                            </li>
                        </ul>
                        <p>Ciclul II Master:</p>
                        <i>Informatica - Metode si Modele ale Inteligentei Artificiale</i>
                        <ul style="text-align: left;">
                            <li>
                                <p><a href="http://cis01.central.ucv.ro/evstud/planuri/index.php?an_univ=2017&facultate=500013&ciclu=4&forma=2&specializare=500784&an_stud=1&cmdExecuta=Execut%C4%83">Anul I</a>, promotia 2015-2017</p>
                            </li>
                            <li>
                                <p><a href="http://cis01.central.ucv.ro/evstud/planuri/index.php?an_univ=2014&facultate=500013&ciclu=4&forma=2&specializare=500784&an_stud=2&cmdExecuta=Execut%C4%83">Anul II</a>, promotia 2014-2016</p>
                            </li>
                        </ul>
                        <i>Informatica - Tehnici avansate pentru prelucrarea<br>informatiei</i>
                        <ul>
                            <li>Anul I, promotia 2018-2020</li>
                        </ul>
                    </th>
                </tr>
            </table>
        </div>
        </div>
    </body>
</html>