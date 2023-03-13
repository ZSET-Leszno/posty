<!DOCTYPE html>
<html lang="pl">

<head>
    <link rel="Shortcut icon" href="pictures/site_pictures/icon.png" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
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
        if ($_SESSION['logged_user'] != "$_GET[user]")
        header("Location: profil.php?user=$_SESSION[logged_user]");
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
                $polaczenie = mysqli_connect($serwer, $user, $password, $basename) or die("spróbuj później");
                $user = $_GET['user'];
                mysqli_query($polaczenie, "SET CHARACTER SET utf8;");
                $zapytanie = "SELECT * FROM `loginy` WHERE `login`='$user';";
                $wynik = mysqli_query($polaczenie, $zapytanie);
                while ($info = mysqli_fetch_assoc($wynik)) {
                    echo "<a style='margin:auto;margin-top:5%;' class='button-del' href='del_user.php?login=" . $info['login'] . "'>Usuń Konto</a>";
                    echo "<div class='display_profile_info'><img style='max-height:700px;width:70%;' src='profiles_pictures/$info[login]/$info[profilowe]'><br><br>";
                    echo "Imię: " . $info['imie'] . "<br><br>Nazwisko: " . $info['nazwisko'] . "<br><br>Adres E-mail:<br>" . $info['email'] . "<br><br>Login: " . $info['login'] . "</div><br>";
                    echo "<a class='button-50' href='user_posts.php?id=" . $info['id_uzytkownika'] . "'>Posty</a> ";
                    echo "<a style='color:white;' class='button-50' href='edit_user.php?id=" . $info['id_uzytkownika'] . "'>Zmień Dane</a> ";
                    echo "<a style='color:white;' class='button-50' href='change_password.php?id=" . $info['id_uzytkownika'] . "'>Zmień Hasło</a>";
                    echo "<a style='color:white;' class='button-50' href='change_profile_picture.php?id=" . $info['id_uzytkownika'] . "'>Zmień Zdjęcie Profilowe</a>";
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
            <?php
            include 'footer.php';
            echo "$footer";
            ?>
        </center>
    </div>
</body>

</html>