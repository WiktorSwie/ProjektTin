-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 06 Kwi 2021, 19:46
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `projekt_przychodni`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admini`
--

CREATE TABLE `admini` (
  `id_admina` int(11) NOT NULL,
  `login` text NOT NULL,
  `hasło` text NOT NULL,
  `id_użytkownika` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lekarze`
--

CREATE TABLE `lekarze` (
  `id_lekarza` int(11) NOT NULL,
  `imie` text NOT NULL,
  `nazwisko` text NOT NULL,
  `numer_telefonu` int(11) NOT NULL,
  `email` text NOT NULL,
  `specjalizacja` text NOT NULL,
  `id_użytkownika` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `lekarze`
--

INSERT INTO `lekarze` (`id_lekarza`, `imie`, `nazwisko`, `numer_telefonu`, `email`, `specjalizacja`, `id_użytkownika`) VALUES
(1, 'Marek', 'Grechuta', 231333442, 'Marek.G@o2.pl', 'Laryngolog', 3),
(2, 'David', 'Pawulon', 321231213, 'David2137@o2.pl', 'okulista', 4),
(3, 'Damian', 'Molecki', 232123543, 'DamianMa@wp.pl', 'Lekarz_Rodzinny', 5),
(4, 'Kasia', 'Ołęcka', 232342243, 'KasiaKasiulka@wp.pl', 'Pediatra', 6),
(5, 'Paweł', 'Olipski', 666555444, 'PawełO@onet.pl', 'laryngolog', 0),
(7, 'Grzegorz', 'Zamiejski', 444222111, 'GrzegorzZam@o2.pl', 'laryngolog', 8),
(8, 'Wiktor', 'Świerczyński', 999888777, 'dzban@wp.pl', 'okulista', 9),
(9, 'Marcin', 'Iksdecki', 666777888, 'iksde@onet.pl', 'okulista', 10),
(10, 'Marta', 'Kobieta', 234765980, 'Wemen@onet.pl', 'lekarz_rodzinny', 7),
(11, 'Oliwia', 'Splatter', 98765432, 'Splat@wp.pl', 'lekarz_rodzinny', 14),
(12, 'Marek', 'Pieczarek', 113331444, 'Grzib@wp.pl', 'pediatra', 15),
(13, 'Mateusz', 'Morawiecki', 555222111, 'Premier@onet.pl', 'pediatra', 16);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pacjenci`
--

CREATE TABLE `pacjenci` (
  `id_pacjenta` int(11) NOT NULL,
  `imie` text NOT NULL,
  `nazwisko` text NOT NULL,
  `numer_telefonu` varchar(9) NOT NULL,
  `pesel` varchar(11) NOT NULL,
  `id_użytkownika` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `pacjenci`
--

INSERT INTO `pacjenci` (`id_pacjenta`, `imie`, `nazwisko`, `numer_telefonu`, `pesel`, `id_użytkownika`) VALUES
(0, 'Paweł', 'Dobry', '123321123', '42244254676', 0),
(10, 'Wiktor', 'Bobrzych', '444444444', '33322211134', 11),
(11, 'Bartek', 'Biernut', '123123123', '32132132144', 12),
(12, 'Bartosz', 'Kowalski', '222333444', '11211212233', 13);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `użytkownicy`
--

CREATE TABLE `użytkownicy` (
  `id_użytkownika` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `hasło` varchar(255) NOT NULL,
  `rola` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `użytkownicy`
--

INSERT INTO `użytkownicy` (`id_użytkownika`, `login`, `hasło`, `rola`) VALUES
(3, 'MarekG12', 'MojeHaslo12', 0),
(11, 'Bombelek3', 'ZAQ12wsx', 1),
(12, 'Donaron', 'xd1234567', 1),
(13, 'Gruby102', 'Pawel123', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wizyty`
--

CREATE TABLE `wizyty` (
  `id_wizyty` int(11) NOT NULL,
  `data` date NOT NULL,
  `id_lekarza` int(11) NOT NULL,
  `id_pacjenta` int(11) NOT NULL,
  `godzina` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `wizyty`
--

INSERT INTO `wizyty` (`id_wizyty`, `data`, `id_lekarza`, `id_pacjenta`, `godzina`) VALUES
(1, '2021-04-14', 1, 0, '12:12:00'),
(2, '2021-04-15', 2, 13, '11:12:00');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admini`
--
ALTER TABLE `admini`
  ADD PRIMARY KEY (`id_admina`);

--
-- Indeksy dla tabeli `lekarze`
--
ALTER TABLE `lekarze`
  ADD PRIMARY KEY (`id_lekarza`);

--
-- Indeksy dla tabeli `pacjenci`
--
ALTER TABLE `pacjenci`
  ADD PRIMARY KEY (`id_pacjenta`);

--
-- Indeksy dla tabeli `użytkownicy`
--
ALTER TABLE `użytkownicy`
  ADD PRIMARY KEY (`id_użytkownika`);

--
-- Indeksy dla tabeli `wizyty`
--
ALTER TABLE `wizyty`
  ADD PRIMARY KEY (`id_wizyty`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `lekarze`
--
ALTER TABLE `lekarze`
  MODIFY `id_lekarza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `pacjenci`
--
ALTER TABLE `pacjenci`
  MODIFY `id_pacjenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `użytkownicy`
--
ALTER TABLE `użytkownicy`
  MODIFY `id_użytkownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `wizyty`
--
ALTER TABLE `wizyty`
  MODIFY `id_wizyty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
