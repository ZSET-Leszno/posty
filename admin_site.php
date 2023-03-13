<!DOCTYPE html>
<html lang="pl">

<head>
    <link rel="Shortcut icon" href="pictures/site_pictures/icon.png" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracja</title>
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

            <table class="userstable">
                <tr>
                    <th>LP.</th>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                    <th>E-mail</th>
                    <th>Login</th>
                    <th>Zarządzanie</th>
                </tr>

                <?php
                include "connect.php";
                $polaczenie = mysqli_connect($serwer, $user, $password, $basename) or die("spróbuj później");

                mysqli_query($polaczenie, "SET CHARACTER SET utf8;");
                $zapytanie1 = "SELECT * FROM `loginy`;";
                $wynik = mysqli_query($polaczenie, $zapytanie1);
                $lp = 1;
                while ($info = mysqli_fetch_assoc($wynik)) {
                    echo "<tr>";
                    echo "<td>" . $lp++ . "</td><td>" . $info['imie'] . "</td><td>" . $info['nazwisko'] . "</td><td>" . $info['email'] . "</td><td>" . $info['login'] . "</td><td class='td'><a class='button-admin' href='admin_del_user.php?login=" . $info['login'] ."'>Usuń Konto</a> <a class='button-admin' href='edit_users.php?id=" . $info['id_uzytkownika'] . "&login=".$info['login']. "'>Edytuj Dane</a> <a class='button-admin' href='users_posts.php?id=" . $info['login'] . "'>Posty</a> <a class='button-admin' href='admin_del_profile_picture.php?id=" . $info['login'] . "'>Usuń zdjęcie profilowe</a>";
                    echo "</tr>";
                }

                mysqli_close($polaczenie);
                ?>
            </table>
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