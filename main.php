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
        <a class="active" href="main.php">Strona Główna</a>
        <?php
        echo "<a href='add_post.php?user=" . $_SESSION['logged_user'] . "'>Dodaj Post</a>";
        echo "<a href='profil.php?user=" . $_SESSION['logged_user'] . "'>Profil</a>";

        if ($_SESSION['logged_user'] == "admin") {
            echo "<a href='admin_site.php'>Administracja</a>";
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
            <?php
            include "connect.php";
            $polaczenie = mysqli_connect($serwer, $user, $password, $basename) or die("spróbuj później");
            mysqli_query($polaczenie, "SET CHARACTER SET utf8;");
            $zapytanie2 = "SELECT * FROM `posty` ORDER BY `id_posta` DESC;";
            $wynik2 = mysqli_query($polaczenie, $zapytanie2);
            while ($post = mysqli_fetch_assoc($wynik2)) {
                $login2 = $post['autor'];
                $zapytanie = "SELECT * FROM loginy WHERE `login` = '$login2';";
                $kwr = mysqli_query($polaczenie, $zapytanie);
                $profilowe = mysqli_fetch_array($kwr);
                echo "<div class='post_card'><div class='post_title'><h5 style='color:white;'>Udostępnione przez: ";
                echo "<a class='view-profile' href='view_profil.php?viewuser=$post[autor]'>" . $post['autor'] . " <img style='height:19px;margin-bottom:-3px;' src='profiles_pictures/$login2/$profilowe[profilowe]'></a></h5></div>";
                echo "<div class='post_txt'>";
                if ($_SESSION['logged_user'] == $post['autor']) {
                    echo "<a class='button-del' href='del_post.php?id=" . $post['id_posta'] . "'>Usuń Post</a>";
                }
                if ($_SESSION['logged_user'] == 'admin') {
                    echo "<a class='button-admin' href='del_post.php?id=" . $post['id_posta'] . "'>Usuń Post jako Admin</a>";
                }
                echo "<p style='text-decoration: underline;font-weight: bold;font-size: 24px;' class='title'>" . $post['tytul'] . "</p>";
                if ($post['zdjecie'] != '') {
                    echo "<center><img style='max-height:600px;max-width:50%;border:solid black 5px;' src='pictures/posts_pictures/$post[autor]/" . $post['zdjecie'] . "' alt='Tu powinno być zdjęcie!'></center><hr>";
                }
                echo $post['tresc']  . "</div></div>";
            }
            ?>

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