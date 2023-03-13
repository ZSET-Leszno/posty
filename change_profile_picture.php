<!DOCTYPE html>
<html lang="pl">

<head>
    <link rel="Shortcut icon" href="pictures/site_pictures/icon.png" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zdjęcie Profilowe</title>
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
                header("Location: change_profile_picture.php?id=$idu[id_uzytkownika]");
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
        echo "Witaj $_SESSION[logged_user] <img style='height:19px;' src='profiles_pictures/$_SESSION[logged_user]/$profilowe[profilowe]'></a>";
        mysqli_close($polaczenie); ?>


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
                <form class='post_txt' method='post' enctype="multipart/form-data">
                    <b style='color:black;'>Nowe Zdjęcie Profilowe:<br> </b>
                    <input class='edit_info_input' name='fileToUpload' type='file'><br><br>
                    <input class='button-50' type='submit' name='submit' value='Zatwierdź Zmiany'><br>
                </form>
                <?php
                include "connect.php";
                $polaczenie = mysqli_connect($serwer, $user, $password, $basename) or die("spróbuj później");
                if (($_FILES["fileToUpload"]["name"]) != "") {
                    mysqli_query($polaczenie, "SET CHARACTER SET utf8;");
                    $uniqid = uniqid("prof");
                    $target_dir = "profiles_pictures/$_SESSION[logged_user]/";
                    $target_file = $target_dir . $uniqid .  basename($_FILES["fileToUpload"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if ($check !== false) {
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                    if ($_FILES["fileToUpload"]["size"] > 10000000) {
                        echo "<br>Plik jest zbyt duży. Maksymalny rozmiar to 10MB";
                        $uploadOk = 0;
                    }
                    if (
                        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "jfif" && $imageFileType != "gif"
                    ) {
                        echo "<br>Przyjmowane rozszerzenia to JPG, JPEG, PNG , GIF i  JFIF .";
                        $uploadOk = 0;
                    }
                    if ($uploadOk == 0) {
                        echo "<br>Coś poszło nie tak.";
                    } else {
                        $nazwa = $uniqid . htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));
                        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
                        $login = $_SESSION['logged_user'];

                        $kwerenda = mysqli_query($polaczenie, "SELECT `profilowe` FROM `loginy` WHERE `loginy`.`login` = \"$login\"");
                        $pict = mysqli_fetch_array($kwerenda);
                        $fullname = [$target_dir . $pict['profilowe']];
                        if (array_map("unlink", $fullname)) {
                            mysqli_query($polaczenie, "UPDATE `loginy` SET `profilowe` = '$nazwa' WHERE `loginy`.`login` = '$_SESSION[logged_user]'");
                            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
                            header('refresh:1;url=main.php');
                        } else {
                            echo "<br>Coś poszło nie tak.";
                        }
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