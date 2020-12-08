-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 08 Gru 2020, 16:31
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
-- Baza danych: `kantmen`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `artykul`
--

CREATE TABLE `artykul` (
  `ID_ARTYKULU` int(10) NOT NULL,
  `ZDJECIE_ARTYKUL` blob NOT NULL,
  `TEMAT` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `TRESC` longtext COLLATE utf8_polish_ci NOT NULL,
  `DATA` timestamp NOT NULL DEFAULT current_timestamp(),
  `AUTOR` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `komentarz`
--

CREATE TABLE `komentarz` (
  `ID_KOMENTARZ` int(10) NOT NULL,
  `ID_WATEK` int(10) NOT NULL,
  `ID_USER` int(10) NOT NULL,
  `DATA` timestamp NOT NULL DEFAULT current_timestamp(),
  `PLUS` int(10) DEFAULT 0,
  `MINUS` int(10) NOT NULL DEFAULT 0,
  `TRESC_KOMENTARZA` longtext COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kruszec`
--

CREATE TABLE `kruszec` (
  `ID_KRUSZEC` int(10) NOT NULL,
  `NAZWA` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `CENA` double NOT NULL,
  `JEDNOSTKA` varchar(30) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kruszec`
--

INSERT INTO `kruszec` (`ID_KRUSZEC`, `NAZWA`, `CENA`, `JEDNOSTKA`) VALUES
(1, 'Pallad', 8613.82, 'PLN/uncja'),
(2, 'Pallad', 8613.82, 'PLN/uncja'),
(3, 'Złoto', 6885.89, 'PLN/uncja'),
(4, 'Cynk', 10301.53, 'PLN/tona'),
(5, 'Aluminium', 7393.68, 'PLN/tona'),
(6, 'Ołów', 7666.66, 'PLN/tona'),
(7, 'Srebro', 90.93, 'PLN/uncja'),
(8, 'Miedź', 28240.22, 'PLN/tona'),
(9, 'Platyna', 3812.58, 'PLN/uncja');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `ID_USER` int(10) NOT NULL,
  `LOGIN` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `HASLO` char(64) COLLATE utf8_polish_ci NOT NULL,
  `IMIE` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `NAZWISKO` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `EMAIL` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `WIEK` int(10) NOT NULL,
  `MIASTO` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `KRAJ` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `OPIS_PROFILU` text COLLATE utf8_polish_ci DEFAULT NULL,
  `ZDJECIE` blob DEFAULT NULL,
  `STW_WATKI` int(10) NOT NULL DEFAULT 0,
  `PLUS` int(10) DEFAULT 0,
  `MINUS` int(10) NOT NULL DEFAULT 0,
  `LICZ_KOMENTARZY` int(10) NOT NULL DEFAULT 0,
  `UPRAWNIENIA` varchar(10) COLLATE utf8_polish_ci NOT NULL DEFAULT 'USER'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `waluta`
--

CREATE TABLE `waluta` (
  `ID_WALUTA` int(11) NOT NULL,
  `KOD_WALUTA` varchar(3) COLLATE utf8_polish_ci NOT NULL,
  `NAZWA` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `KUPNO` double NOT NULL,
  `SPRZEDAZ` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `waluta`
--

INSERT INTO `waluta` (`ID_WALUTA`, `KOD_WALUTA`, `NAZWA`, `KUPNO`, `SPRZEDAZ`) VALUES
(1, 'EUR', 'Euro', 4.4597, 4.4897),
(2, 'USD', 'Dolar amerykański', 3.6775, 3.7075),
(3, 'CHF', 'Frank szwajcarski', 4.1411, 4.1811),
(4, 'GBP', 'Funt brytyjski', 4.9047, 4.9444),
(5, 'AUD', 'Dolar australijski', 2.7233, 2.7533),
(6, 'BGN', 'Lew bułgarski', 2.2758, 2.3008),
(7, 'CAD', 'Dolar kanadyjski', 2.8705, 2.9005),
(8, 'CZK', 'Korona czeska', 0.1683, 0.1703),
(9, 'DKK', 'Korona duńska', 0.5981, 0.6041),
(10, 'HKD', 'Dolar hongkoński', 0.4742, 0.4784),
(11, 'HRK', 'Kuna chorwacka', 0.5903, 0.5963),
(12, 'MXN', 'Peso meksykańskie', 0.1844, 0.187),
(13, 'NOK', 'Korona norweska', 0.4185, 0.4245),
(14, 'NZD', 'Dolar nowozelandzki', 2.5815, 2.6115),
(15, 'RON', 'Lej rumuński', 0.9124, 0.9244),
(16, 'RUB', 'Rubel rosyjski', 0.0494, 0.0514),
(17, 'SEK', 'Korona szwedzka', 0.4354, 0.4404),
(18, 'SGD', 'Dolar singapurski', 2.7473, 2.7743),
(19, 'TRY', 'Lira turecka', 0.464, 0.48),
(20, 'ZAR', 'Rand południowoafrykański', 0.2431, 0.2465);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `watek`
--

CREATE TABLE `watek` (
  `ID_WATEK` int(10) NOT NULL,
  `ID_USER` int(10) NOT NULL,
  `TEMAT` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `DATA` timestamp NOT NULL DEFAULT current_timestamp(),
  `PLUSY` int(10) DEFAULT 0,
  `MINUSY` int(10) NOT NULL DEFAULT 0,
  `TRESC_WATKU` longtext COLLATE utf8_polish_ci NOT NULL,
  `LICZBA_KOMENTARZY` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `artykul`
--
ALTER TABLE `artykul`
  ADD PRIMARY KEY (`ID_ARTYKULU`);

--
-- Indeksy dla tabeli `komentarz`
--
ALTER TABLE `komentarz`
  ADD PRIMARY KEY (`ID_KOMENTARZ`),
  ADD KEY `ID_WATEK` (`ID_WATEK`),
  ADD KEY `ID_USER` (`ID_USER`);

--
-- Indeksy dla tabeli `kruszec`
--
ALTER TABLE `kruszec`
  ADD PRIMARY KEY (`ID_KRUSZEC`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`),
  ADD UNIQUE KEY `LOGIN` (`LOGIN`);

--
-- Indeksy dla tabeli `waluta`
--
ALTER TABLE `waluta`
  ADD PRIMARY KEY (`ID_WALUTA`);

--
-- Indeksy dla tabeli `watek`
--
ALTER TABLE `watek`
  ADD PRIMARY KEY (`ID_WATEK`),
  ADD KEY `ID_USER` (`ID_USER`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `artykul`
--
ALTER TABLE `artykul`
  MODIFY `ID_ARTYKULU` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `komentarz`
--
ALTER TABLE `komentarz`
  MODIFY `ID_KOMENTARZ` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `kruszec`
--
ALTER TABLE `kruszec`
  MODIFY `ID_KRUSZEC` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `waluta`
--
ALTER TABLE `waluta`
  MODIFY `ID_WALUTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `watek`
--
ALTER TABLE `watek`
  MODIFY `ID_WATEK` int(10) NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `komentarz`
--
ALTER TABLE `komentarz`
  ADD CONSTRAINT `komentarz_fk_1` FOREIGN KEY (`ID_WATEK`) REFERENCES `watek` (`ID_WATEK`),
  ADD CONSTRAINT `komentarz_fk_2` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`);

--
-- Ograniczenia dla tabeli `watek`
--
ALTER TABLE `watek`
  ADD CONSTRAINT `watek_fk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
