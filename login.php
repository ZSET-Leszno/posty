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

<body style='background-image:url("pictures/site_pictures/background_image.jpg");background-size:cover;'>
    <a class="button-50" href="index.php">Powrót</a>
    <center>
        <div class="login_card">

            <form name="logowanie" class="login_form" method="post">
                <input class="button-50" type="submit" value="ZALOGUJ"></a><br><br>
                Login<br><input required class="logreg_input" placeholder="Login..." type="text" name="login"><br><br>
                Hasło<br><input required class="logreg_input" placeholder="Hasło..." type="password" name="haslo"><br><br>
                <?php
                include "connect.php";
                $polaczenie = mysqli_connect($serwer, $user, $password, $basename) or die("spróbuj później");
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    mysqli_query($polaczenie, "SET CHARACTER SET utf8;");
                    $login = strtolower($_POST['login']);
                    $haslo = $_POST['haslo'];
                    $zapytanie = "SELECT * FROM loginy WHERE `login` = '$login';";
                    $wynik = mysqli_query($polaczenie, $zapytanie);
                    $count = mysqli_num_rows($wynik);

                    while ($verify = mysqli_fetch_assoc($wynik)) {
                        if ($count == 1 && password_verify($haslo, $verify['haslo']) == TRUE) {
                            session_start();
                            $_SESSION['logged_user'] = $login;
                            header("location: main.php");
                        } else {
                            echo "Twój login lub hasło są niezgodne!";
                        }
                    }
                }
                mysqli_close($polaczenie);
                ?>

            </form>
        </div>
    </center>
</body>

</html>