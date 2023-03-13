<!DOCTYPE html>
<html lang="pl">

<head>
    <link rel="Shortcut icon" href="pictures/site_pictures/icon.png" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="style.css">
</head>

<body style='background-image:url("pictures/site_pictures/background_image.jpg");background-size:cover;'>
    <a class="button-50" href="index.php">Powrót</a>
    <center>
        <div class="register_card">
            <form name="rejestracja" class="register_form" method="post">
                <input class="button-50" type="submit" name="rejestruj" value="ZAREJESTRUJ"><br><br>
                Imię<br><input required class="logreg_input" pattern="[A-Za-z]{1,30}" title="Tylko litery!" type="text" placeholder="Imię..." name="imie"><br><br>
                Nazwisko<br><input required class="logreg_input" pattern="[A-Za-z]{1,30}" title="Tylko litery!" type="text" placeholder="Nazwisko..." name="nazwisko"><br><br>
                E-mail<br><input required class="logreg_input" type="email" placeholder="E-mail..." name="email"><br><br>
                Nazwa użytkownika<br><input required class="logreg_input" pattern="[A-Za-z0-9]{3,30}" title="Tylko litery i cyfry!" placeholder="Login..." type="text" name="login" minlength="3" maxlength="30"><br><br>
                Hasło<br><input required class="logreg_input" type="password" placeholder="Hasło..." name="haslo" minlength="8">

                <?php
                include "connect.php";
                $polaczenie = mysqli_connect($serwer, $user, $password, $basename) or die("spróbuj później");
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $login = strtolower($_POST['login']);
                    $email = $_POST['email'];
                    mysqli_query($polaczenie, "SET CHARACTER SET utf8;");
                    $zapytanie = "SELECT id_uzytkownika FROM loginy WHERE `login` = '$login' OR `email` = '$email';";
                    $wynik = mysqli_query($polaczenie, $zapytanie);
                    $count = mysqli_num_rows($wynik);
                    if ($count == 1) {
                        echo "<br><br><p class='alert_p'>Konto o podanej nazwie lub<br> e-mailu już istnieje!</p>";
                    } else {
                        $imie = strtolower($_POST['imie']);
                        $nazwisko = strtolower($_POST['nazwisko']);
                        $haslo = $_POST['haslo'];
                        $haslo = password_hash($haslo, PASSWORD_DEFAULT);
                        $obraz = "default_user.png";
                        if (mkdir("pictures/posts_pictures/$login/") && (mkdir("profiles_pictures/$login/"))){
                            copy("profiles_pictures/default_user.png", "profiles_pictures/$login/default_user.png");
                            $zapis = mysqli_query($polaczenie, "INSERT INTO `loginy` (`id_uzytkownika`, `imie`, `nazwisko`, `login`, `haslo`, `email`,`profilowe`) VALUES (NULL, N'$imie', N'$nazwisko', '$login', '$haslo', '$email', '$obraz');");
                            header('location: login.php');
                        } else {
                            echo "<br><br><text style='color:red;background-color:black;border:solid 10px black;border-radius:15px;'>Błąd w tworzeniu folderu!<text>";
                        }
                    }
                    mysqli_close($polaczenie);
                }
                ?>
            </form>
        </div>
    </center>
</body>

</html>