-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 13 Mar 2023, 18:28
-- Wersja serwera: 8.0.32-0ubuntu0.20.04.2
-- Wersja PHP: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `kacmichalski`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `loginy`
--

CREATE TABLE `loginy` (
  `id_uzytkownika` int NOT NULL,
  `imie` text NOT NULL,
  `nazwisko` text NOT NULL,
  `login` text NOT NULL,
  `haslo` text NOT NULL,
  `email` text CHARACTER SET utf16 COLLATE utf16_polish_ci NOT NULL,
  `profilowe` text CHARACTER SET utf16 COLLATE utf16_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Zrzut danych tabeli `loginy`
--

INSERT INTO `loginy` (`id_uzytkownika`, `imie`, `nazwisko`, `login`, `haslo`, `email`, `profilowe`) VALUES
(1, 'admin', 'admin', 'admin', '$2y$10$psoOukzRCHsQylNlj2W.tu2ZyGmMhcXGX7h12ZgK9JdO8X/pTs.7m', 'admin@admin.admin', 'prof640ca728d3e2916785508015811006450464652858796.jpg'),
(30, 'kacper', 'michalski', 'kacper', '$2y$10$9U692jU6ubUk0yr78KfkVenIS.A4NDKSMwsMSoeItO.Oi9cPzcNxq', 'bgkdskudsa@kfxgdg.com', 'prof640a0c9ce7978among-us-sus.gif'),
(32, 'adamek', 'czwojdamek', 'czwojda', '$2y$10$eT.3jY4sKetRSvEW1CroCOcbHgAeevwnxG8t9H2COpLqLrF3jWwL.', 'a.czwojdzinski@zset.leszno.pl', 'prof640b5ff62e5fe334965651_1213856322557678_2202048768325745003_n.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posty`
--

CREATE TABLE `posty` (
  `id_posta` int NOT NULL,
  `autor` text CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `tytul` text CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `tresc` text CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `zdjecie` text CHARACTER SET utf16 COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Zrzut danych tabeli `posty`
--

INSERT INTO `posty` (`id_posta`, `autor`, `tytul`, `tresc`, `zdjecie`) VALUES
(81, 'admin', 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis suscipit risus a nulla convallis auctor. Aenean blandit elit eu ante luctus, ac rhoncus odio laoreet. Suspendisse enim magna, imperdiet sed tempor at, tincidunt cursus velit. Morbi aliquet accumsan nisl, a ornare diam vestibulum vitae. Nam vel enim porta, aliquet tellus ut, elementum nulla. Vivamus in purus eros. Vivamus pellentesque malesuada cursus. Aenean rutrum justo sit amet tempor gravida. Quisque nulla mi, mollis sed arcu sed, placerat finibus enim.Integer a arcu dictum ante egestas porttitor. Nullam orci felis, maximus non justo non, egestas ornare metus. Curabitur sed dui accumsan, congue mi non, tristique elit. Morbi bibendum posuere orci mollis convallis. Sed scelerisque vulputate nibh sit amet convallis. Nunc pretium auctor lobortis. Etiam non neque non lacus dapibus tincidunt. Mauris at ante tincidunt, posuere leo in, molestie augue. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut eleifend velit ut porttitor maximus. Morbi a gravida erat, vitae accumsan ante. Nam sed nulla quis ex elementum laoreet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec a congue justo. Donec turpis turpis, feugiat in tellus eu, molestie blandit magna.\r\n\r\nVestibulum eu porttitor dui, at condimentum ipsum. Ut pharetra ultricies tincidunt. Vestibulum metus ante, posuere id viverra vitae, ultricies et ante. Donec congue lectus ac tellus porttitor, eu venenatis sapien sagittis. Duis volutpat augue non lorem iaculis, in efficitur orci varius. Suspendisse vel sapien varius, euismod quam vitae, pulvinar libero. Curabitur lacinia dignissim libero eu blandit. Donec faucibus diam ut nisl imperdiet euismod. Integer felis eros, consectetur vel augue in, aliquam efficitur massa. Nam sed aliquet ipsum, vitae elementum turpis. Etiam faucibus eleifend porta. Curabitur volutpat odio felis, sit amet commodo ipsum lacinia ut. Mauris elit mi, dignissim eget mi quis, luctus posuere massa. Aliquam maximus venenatis pretium. Sed magna magna, finibus et ullamcorper eget, facilisis nec turpis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed fermentum urna accumsan risus luctus volutpat. Donec tristique nibh ante, eu aliquet diam consequat at.\r\n\r\nDonec dictum sapien arcu, sit amet vehicula nunc eleifend quis. Aenean interdum sapien vel tellus sagittis, ut sagittis libero elementum. Sed vel lacus libero. Cras nibh ligula, vehicula eu tincidunt non, cursus dapibus metus. Ut maximus, elit in condimentum consectetur, nisi augue sollicitudin nisl, sit amet consequat lorem quam in leo. Phasellus blandit mi tempus odio suscipit, finibus maximus magna porttitor. Fusce blandit nec sem vitae viverra.\r\n\r\nAenean semper urna massa. Nulla tincidunt sem blandit urna pulvinar, at fermentum enim posuere. Nunc consectetur arcu id maximus faucibus. Sed a molestie est. Vivamus placerat suscipit feugiat. Donec ornare eget lacus luctus ultricies. Etiam in est et massa pellentesque cursus vel ultrices purus. Duis ac venenatis dui. Cras odio augue, vehicula ut laoreet nec, accumsan et leo. Maecenas tempor dolor eget blandit malesuada. Donec in efficitur lacus.\r\n\r\nInteger a arcu dictum ante egestas porttitor. Nullam orci felis, maximus non justo non, egestas ornare metus. Curabitur sed dui accumsan, congue mi non, tristique elit. Morbi bibendum posuere orci mollis convallis. Sed scelerisque vulputate nibh sit amet convallis. Nunc pretium auctor lobortis. Etiam.', 'pic6408b6cf760f6Lorem-Ipsum-alternatives.png'),
(116, 'kacper', 'Cały Sherk', 'Polecam\r\n', 'pic6409eec6dc6fbThe_Entire_Shrek_Movie_but_it_s_a_1_minute_gif.gif'),
(119, 'admin', 'sdf', 'Git', 'pic640ae147ede7creceived_2057416474460279.jpeg'),
(120, 'admin', 'Czwojda', 'Hi hi hi hah', 'pic640afd51665ebcdf31f81-2fb0-4c44-8ceb-9c059e626293photo.jpeg'),
(121, 'czwojda', 'Mix', 'Zmixowało mi Maxa', 'pic640b5ed7b261emix.png'),
(123, 'czwojda', 'Boit what the hell boi', 'BRO WHAT THE HELL ARE YOU DOING YOUR NOT THE THINKER ', 'pic640b613912987324864434_884123782625301_9197138991009912080_n.jpg');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `loginy`
--
ALTER TABLE `loginy`
  ADD PRIMARY KEY (`id_uzytkownika`);

--
-- Indeksy dla tabeli `posty`
--
ALTER TABLE `posty`
  ADD PRIMARY KEY (`id_posta`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `loginy`
--
ALTER TABLE `loginy`
  MODIFY `id_uzytkownika` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT dla tabeli `posty`
--
ALTER TABLE `posty`
  MODIFY `id_posta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
