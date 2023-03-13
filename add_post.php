<!DOCTYPE html>
<html lang="pl">

<head>
  <link rel="Shortcut icon" href="pictures/site_pictures/icon.png" />
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nowy post</title>
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
    echo "<a class='active' href='add_post.php?user=" . $_SESSION['logged_user'] . "'>Dodaj Post</a>";
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
    echo "Witaj $_SESSION[logged_user] <img style='height:19px;' src='profiles_pictures/$_SESSION[logged_user]/$profilowe[profilowe]'></a>";
    if ($login != $_GET['user'])
      header("Location: add_post.php?user=$login");
    ?>


  </div>
  <div class="wyp2">
    <p></p>
  </div>
  <main class="main">
    <div class="left_banner">
      <p></p>
    </div>
    <div style="height:1227px;" class="middle_banner">
      <center>
        <form style="height:1150px;" name="nowy_post" class="post_txt" method="post" enctype="multipart/form-data">
          <input class="button-50" type="submit" name="dodaj" value="DODAJ POST"><br><br>
          Tytuł<br><input required class="logreg_input" type="text" placeholder="Tytuł..." name="tytul" minlength="2" maxlength="50"><br><br>
          Treść<br><textarea required style="width:99.2%;height:900px;" class="logreg_input" type="text" placeholder="Treść..." name="tresc" minlength="2" maxlength="2000"></textarea><br><br>
          Obraz<br><input class="button-50" type="file" accept="image/png, image/jpeg" name="fileToUpload" value="DODAJ ZAŁĄCZNIK">

          <?php
          include "connect.php";
          $polaczenie = mysqli_connect($serwer, $user, $password, $basename) or die("spróbuj później");
          $nazwa = "";
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            mysqli_query($polaczenie, "SET CHARACTER SET utf8;");
            $autor = $_GET['user'];
            $tytul = $_POST['tytul'];
            $tresc = $_POST['tresc'];
            $uniqid = uniqid("pic");

            if (($_FILES["fileToUpload"]["name"]) != "") {
              $target_dir = "pictures/posts_pictures/$autor/";
              $target_file = $target_dir . $uniqid .  basename($_FILES["fileToUpload"]["name"]);
              $uploadOk = 1;
              $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
              $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
              if ($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
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
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "jfif"
                && $imageFileType != "gif"
              ) {
                echo "<br>Przyjmowane rozszerzenia to JPG, JPEG, PNG , GIF i JFIF.";
                $uploadOk = 0;
              }
              if ($uploadOk == 0) {
                echo "<br>Coś poszło nie tak.";
              } else {
                $nazwa = $uniqid . htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
              }
            }

            if (mysqli_query($polaczenie, "INSERT INTO `posty` (`id_posta`, `autor`, `tytul`, `tresc`, `zdjecie`) VALUES (NULL, N'$autor', N'$tytul', N'$tresc', N'$nazwa');")) {
              header('refresh:1;url=main.php');
            } else {
              echo "Wystąpił błąd.";
            }
          }
          mysqli_close($polaczenie);
          ?>

        </form>
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