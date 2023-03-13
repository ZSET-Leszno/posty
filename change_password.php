<!DOCTYPE html>
<html lang="pl">

<head>
    <link rel="Shortcut icon" href="pictures/site_pictures/icon.png" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsy</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['logged_user'])) {
        header("Location: index.php");
        die();
    } ?>
    <div class="topnav">
        <a href="main.php">Strona Główna</a>
        <?php
        echo "<a href='add_post.php?user=" . $_SESSION['logged_user'] . "'>Dodaj Post</a>";
        echo "<a class='active' href='profil.php?user=" . $_SESSION['logged_user'] . "'>Profil</a>";

        if ($_SESSION['logged_user'] == "admin") {
            echo "<a href='admin_site.php'>Administracja</a>";
        }
        include "connect.php";
        $polaczenie = mysqli_connect($serwer, $user, $password, $basename) or die("spróbuj później");
        $zapytanie = "SELECT `id_uzytkownika` FROM `loginy` WHERE `login` = '$_SESSION[logged_user]';";

        $kwr = mysqli_query($polaczenie, $zapytanie);
        $idu = mysqli_fetch_array($kwr);
        $idus = $idu['id_uzytkownika'];
        $idnow = $_GET['id'];
        if ($login != "admin") {
            if ($idnow != $idus)
                header("Location: change_password.php?id=$idu[id_uzytkownika]");
        } else {
            mysqli_close($polaczenie);
        }
        ?>
        <a class="user_info, button-logout" style="float:right;margin-right:10px;" class="button-logout" href="logout.php">WYLOGUJ</a>
        <?php session_start();
        include "connect.php";
        $polaczenie = mysqli_connect($serwer, $user, $password, $basename) or die("spróbuj później");
        mysqli_query($polaczenie, "SET CHARACTER SET utf8;");
        echo "<a class='user_info' style='float:right;' href='profil.php?user=" . $_SESSION['logged_user'] . "'>";
        $login = $_SESSION['logged_user'];
        $zapytanie = "SELECT * FROM loginy WHERE `login` = '$login';";
        $kwr = mysqli_query($polaczenie, $zapytanie);
        $profilowe = mysqli_fetch_array($kwr);
        echo "Witaj $_SESSION[logged_user] <img style='height:19px;' src='profiles_pictures/$_SESSION[logged_user]/$profilowe[profilowe]'></a>"; ?>


    </div>
    <div class="wyp2">
        <p></p>
    </div>
    <main class="main">
        <div class="left_banner">
            <p></p>
        </div>
        <div class="middle_banner">
            <center>
                <form class='edit_form' method='post'>
                    <b style='color:white;'>Nowe Hasło: </b>
                    <input class='edit_info_input' name='haslo' type='password' placeholder='Nowe Hasło...'><br><br>
                    <input class='button-admin' type='submit' value='Zatwierdź Zmiany'><br>
                </form>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    include "connect.php";
                    $polaczenie = mysqli_connect($serwer, $user, $password, $basename);
                    mysqli_query($polaczenie, "SET CHARACTER SET utf8;");
                    $podane_id = $_GET['id'];
                    $new_passwd = $_POST['haslo'];
                    $new_passwd = password_hash($new_passwd, PASSWORD_DEFAULT);
                    if (mysqli_query($polaczenie, "UPDATE `loginy` SET `haslo` = '$new_passwd' WHERE loginy.id_uzytkownika = '$podane_id';")) {
                        echo "<p style='color:white;'>Hasło zostało zmienione.</p>";
                        header("refresh:2;url=profil.php?user=" . $_SESSION['logged_user']);
                    } else {
                        echo "Coś poszło nie tak...";
                    }
                    mysqli_close($polaczenie);
                }
                ?>
            </center>
        </div>
        <div class="right_banner">
            <p></p>
        </div>
    </main>
    <div class="wyp1">
        <p></p>
    </div>
    <div class="footer">
        <hr>
        <center>
        <div class='footer-normal'>
        <p>Autorzy: K Michalski, G Wełyczko, T Piwoński 4TI2</p>
      </div>
        </center>
    </div>
</body>

</html>