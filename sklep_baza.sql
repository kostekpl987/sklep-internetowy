-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 17 Sty 2023, 10:00
-- Wersja serwera: 10.4.17-MariaDB
-- Wersja PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sklep`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` text COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `haslo` text COLLATE utf8mb4_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `haslo`) VALUES
(3, '123', '202cb962ac59075b964b07152d234b70'),
(4, 'asdasdasdasd', '12b12fc5386278208f07d77cabe9ae29'),
(5, '', 'd41d8cd98f00b204e9800998ecf8427e');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `zdjecie` longblob NOT NULL,
  `nazwa` text COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `ilosc` int(11) NOT NULL,
  `kategoria` text COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `cena_z` float DEFAULT NULL,
  `marza` float DEFAULT NULL,
  `promocja` tinyint(1) DEFAULT 0,
  `znizka` float DEFAULT 0,
  `cena_klient` float DEFAULT NULL,
  `data_w` date DEFAULT NULL,
  `kosz` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`id`, `zdjecie`, `nazwa`, `ilosc`, `kategoria`, `cena_z`, `marza`, `promocja`, `znizka`, `cena_klient`, `data_w`, `kosz`) VALUES

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ulubione`
--

CREATE TABLE `ulubione` (
  `id_osoby` int(11) DEFAULT NULL,
  `ulubione` text COLLATE utf8mb4_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `haslo` text COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `zamieszkanie` text COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `telefon` text COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `kod_pocztowy` text COLLATE utf8mb4_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `haslo`, `email`, `zamieszkanie`, `telefon`, `kod_pocztowy`) VALUES
(34, '5ee9ee99ed8d4c48b6d0f8e3d528969c', 'b@c.com', 'roślinna 44', '123', '44-111'),
(35, '5ee9ee99ed8d4c48b6d0f8e3d528969c', 'j.c@o.com', 'asdasda', '123', 'asdasd'),
(36, '5ee9ee99ed8d4c48b6d0f8e3d528969c', 'asdasd@c.com', 'asd', '123', 'dsa'),
(40, '5ee9ee99ed8d4c48b6d0f8e3d528969c', 'baa.c@oyu.com', 'adsdna', '123-123-123', 'asdasdaaa'),
(43, '5ee9ee99ed8d4c48b6d0f8e3d528969c', 'bartek.c1@outlook.com', 'roślinna 44', '123-123-123', '44-111');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wlasciciel`
--

CREATE TABLE `wlasciciel` (
  `id` int(11) NOT NULL,
  `login` varchar(40) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `haslo` text COLLATE utf8mb4_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `wlasciciel`
--

INSERT INTO `wlasciciel` (`id`, `login`, `haslo`) VALUES
(1, 'login', '207023ccb44feb4d7dadca005ce29a64 ');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id` int(11) NOT NULL,
  `id_klient` int(11) DEFAULT NULL,
  `stan` varchar(30) COLLATE utf8mb4_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`id`, `id_klient`, `stan`) VALUES
(9, 43, 'wysłano'),
(10, 43, 'wysłano'),
(11, 43, 'wysłano'),
(12, 43, 'wysłano'),
(13, 43, 'wysłano'),
(14, 40, 'wysłano');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia_produkty`
--

CREATE TABLE `zamowienia_produkty` (
  `id` int(11) NOT NULL,
  `id_produktu` int(11) DEFAULT NULL,
  `ilosc` int(11) DEFAULT NULL,
  `id_zamowienia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `zamowienia_produkty`
--

INSERT INTO `zamowienia_produkty` (`id`, `id_produktu`, `ilosc`, `id_zamowienia`) VALUES
(2, 18, 1, 9),
(3, 19, 1, 9),
(4, 18, 1, 10),
(5, 19, 1, 10),
(6, 19, 1, 11),
(7, 18, 4, 11),
(8, 19, 1, 12),
(9, 18, 3, 12),
(10, 19, 1, 13),
(11, 19, 1, 14);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `wlasciciel`
--
ALTER TABLE `wlasciciel`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zamowienia_produkty`
--
ALTER TABLE `zamowienia_produkty`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT dla tabeli `wlasciciel`
--
ALTER TABLE `wlasciciel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `zamowienia_produkty`
--
ALTER TABLE `zamowienia_produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;