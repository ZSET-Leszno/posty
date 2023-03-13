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
    }
    if ($_SESSION['logged_user'] != 'admin') {
        header("Location: main.php");
        die();
    } ?>
    <div class="topnav">
        <a href="main.php">Strona Główna</a>
        <?php
        echo "<a href='add_post.php?user=" . $_SESSION['logged_user'] . "'>Dodaj Post</a>";
        echo "<a href='profil.php?user=" . $_SESSION['logged_user'] . "'>Profil</a>";

        if ($_SESSION['logged_user'] == "admin") {
            echo "<a class='active' href='admin_site.php'>Administracja</a>";
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
                <?php
                include "connect.php";
                $polaczenie = mysqli_connect($serwer, $user, $password, $basename);
                mysqli_query($polaczenie, "SET CHARACTER SET utf8;");
                $autor = $_GET['login'];
                $podane_id = $_GET['id'];
                $edit_login = $_GET['login'];
                $dzialanie = mysqli_query($polaczenie, "SELECT * FROM `loginy` WHERE `id_uzytkownika` = $podane_id");
                while ($info = mysqli_fetch_assoc($dzialanie)) {
                    echo "<form class='edit_form' method='post'>" .
                        "<b style='color:white;'>ID edytowanego: " . $info['id_uzytkownika'] . "</b><br><br>" .
                        "<b style='color:white;'>Imię: </b><input class='edit_info_input' name='imie' type='text' value='" . $info['imie'] . "'><br>" .
                        "<b style='color:white;'>Nazwisko: </b><input class='edit_info_input' name='nazwisko' type='text' value='" . $info['nazwisko'] . "'><br>" .
                        "<b style='color:white;'>E-mail: </b><input class='edit_info_input' name='email' type='text' value='" . $info['email'] . "'><br>" .
                        "<b style='color:white;'>Login: </b><input class='edit_info_input' name='login' type='text' value='" . $info['login'] . "'><br><br><input class='button-admin' type='submit' value='Zatwierdź Zmiany'></form>";
                    $autor = $info['login'];
                }
                mysqli_close($polaczenie);
                ?><?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        include "connect.php";
                        $autor = $_GET['login'];
                        $polaczenie = mysqli_connect($serwer, $user, $password, $basename);
                        mysqli_query($polaczenie, "SET CHARACTER SET utf8;");
                        $imie = $_POST['imie'];
                        $nazwisko = $_POST['nazwisko'];
                        $email = $_POST['email'];
                        $login = $_POST['login'];
                        $edit = mysqli_query($polaczenie, "SELECT * FROM `posty` WHERE posty.autor = '$autor'");
                        
                        if (mysqli_query($polaczenie, "UPDATE `posty` SET `autor` = '$login' WHERE posty.autor = '$autor'")) {
                            echo "<b style='color;white;>Zmieniono autora postów</b>'";
                        } else {
                            echo "<b style='color;red;>Nie zmieniono autora postów</b>";
                        }
                        if (mysqli_query($polaczenie, "UPDATE `loginy` SET `imie` = N'$imie', `nazwisko` = N'$nazwisko', `email` = N'$email', `login` = N'$login' WHERE loginy.id_uzytkownika = $podane_id;")) {
                            rename("pictures/posts_pictures/$autor", "pictures/posts_pictures/$login");
                            rename("profiles_pictures/$autor", "profiles_pictures/$login");
                            echo "<b style='color;white;>Zmieniono dane. Przenoszenie w ciągu 2 sekund.</b>'";
                            header('refresh: 2');
                        } else {
                            echo "<b style='color;red;>Nie zmieniono danych</b>";
                        }
                    }
                    mysqli_close($polaczenie);
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