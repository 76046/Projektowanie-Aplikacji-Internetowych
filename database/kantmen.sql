-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 13 Gru 2020, 22:42
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `ZDJECIE_ARTYKUL` blob DEFAULT NULL,
  `TEMAT` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `TRESC` longtext COLLATE utf8_polish_ci NOT NULL,
  `DATA` timestamp NOT NULL DEFAULT current_timestamp(),
  `ID_AUTOR` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `artykul`
--

INSERT INTO `artykul` (`ID_ARTYKULU`, `ZDJECIE_ARTYKUL`, `TEMAT`, `TRESC`, `DATA`, `ID_AUTOR`) VALUES
(1, NULL, 'temat1', 'blablabla', '2020-12-11 18:52:02', 1),
(2, NULL, 'temat2', 'blablabla', '2020-12-11 18:52:06', 4),
(3, NULL, 'temat3', 'blablabla', '2020-12-11 18:53:04', 4),
(4, NULL, 'temat4', 'blablablabla', '2020-12-11 18:53:36', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `komentarz`
--

CREATE TABLE `komentarz` (
  `ID_KOMENTARZ` int(10) NOT NULL,
  `ID_WATEK` int(10) NOT NULL,
  `ID_USER` int(10) NOT NULL,
  `DATA` timestamp NOT NULL DEFAULT current_timestamp(),
  `TRESC_KOMENTARZA` longtext COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `komentarz`
--

INSERT INTO `komentarz` (`ID_KOMENTARZ`, `ID_WATEK`, `ID_USER`, `DATA`, `TRESC_KOMENTARZA`) VALUES
(1, 2, 1, '2020-12-13 12:40:31', 'To prawda to będzie Tanieć'),
(2, 2, 4, '2020-12-13 12:40:31', 'Tak tak napewno'),
(3, 2, 1, '2020-12-13 12:40:31', 'To prawda '),
(4, 2, 4, '2020-12-13 12:40:31', 'Tak tak ');

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
  `LICZ_KOMENTARZY` int(10) NOT NULL DEFAULT 0,
  `UPRAWNIENIA` varchar(10) COLLATE utf8_polish_ci NOT NULL DEFAULT 'USER'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`ID_USER`, `LOGIN`, `HASLO`, `IMIE`, `NAZWISKO`, `EMAIL`, `WIEK`, `MIASTO`, `KRAJ`, `OPIS_PROFILU`, `ZDJECIE`, `STW_WATKI`, `LICZ_KOMENTARZY`, `UPRAWNIENIA`) VALUES
(1, 'login1', 'haslo1', 'imie1', 'nazwisko1', 'email1@wp.pl', 11, 'Białystok', 'Polska', 'Tak', NULL, 24, 3090, 'USER'),
(4, 'jakislogin', 'haslo1', 'imie1', 'nazwisko1', 'email@wp.pl', 11, 'Białystok', 'Polska', 'Nie', NULL, 17, 50, 'USER');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `waluta`
--

CREATE TABLE `waluta` (
  `ID_WALUTA` int(11) NOT NULL,
  `KOD_WALUTA` varchar(3) COLLATE utf8_polish_ci DEFAULT NULL,
  `NAZWA` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `KUPNO` double NOT NULL DEFAULT 0,
  `SPRZEDAZ` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `waluta`
--

INSERT INTO `waluta` (`ID_WALUTA`, `KOD_WALUTA`, `NAZWA`, `KUPNO`, `SPRZEDAZ`) VALUES
(24, 'CAD', 'Dolar kanadyjski', 0, 0),
(25, 'HKD', 'Dolar hongkoński', 0, 0),
(26, 'ISK', 'Korona islandzka', 0, 0),
(27, 'PHP', 'Peso filipińskie', 0, 0),
(28, 'DKK', 'Korona duńska', 0, 0),
(29, 'HUF', 'Forint węgierski', 0, 0),
(30, 'CZK', 'Korona czeska', 0, 0),
(31, 'AUD', 'Dolar australijski', 0, 0),
(32, 'RON', 'Lej rumuński', 0, 0),
(33, 'SEK', 'Korona szwedzka', 0, 0),
(34, 'IDR', 'Rupia indonezyjska', 0, 0),
(35, 'INR', 'Rupia indyjska', 0, 0),
(36, 'BRL', 'Real brazylijski', 0, 0),
(37, 'RUB', 'Rubel rosyjski', 0, 0),
(38, 'HRK', 'Kuna chorwacka', 0, 0),
(39, 'JPY', 'Jen japoński', 0, 0),
(40, 'THB', 'Bat tajlandzki', 0, 0),
(41, 'CHF', 'Frank szwajcarski', 0, 0),
(42, 'SGD', 'Dolar singapurski', 0, 0),
(43, 'BGN', 'Lew bułgarski', 0, 0),
(44, 'TRY', 'Lira turecka', 0, 0),
(45, 'CNY', 'Yuan chiński', 0, 0),
(46, 'NOK', 'Korona norweska', 0, 0),
(47, 'NZD', 'Dolar nowozelandzki', 0, 0),
(48, 'ZAR', 'Rand południowoafrykański', 0, 0),
(49, 'USD', 'Dolar amerykański', 0, 0),
(50, 'MXN', 'Peso meksykańskie', 0, 0),
(51, 'ILS', 'Szekel izraelski', 0, 0),
(52, 'GBP', 'Funt brytyjski', 0, 0),
(53, 'KRW', 'Won południowokoreański', 0, 0),
(54, 'MYR', 'Ringgit malezyjski', 0, 0),
(56, 'EUR', 'Euro', 0, 0),
(57, 'PLN', 'Polski złoty', 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `watek`
--

CREATE TABLE `watek` (
  `ID_WATEK` int(10) NOT NULL,
  `ID_USER` int(10) NOT NULL,
  `TEMAT` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `DATA` timestamp NOT NULL DEFAULT current_timestamp(),
  `TRESC_WATKU` longtext COLLATE utf8_polish_ci NOT NULL,
  `LICZBA_KOMENTARZY` int(10) NOT NULL DEFAULT 0,
  `ILOSC_ODWIEDZIN` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `watek`
--

INSERT INTO `watek` (`ID_WATEK`, `ID_USER`, `TEMAT`, `DATA`, `TRESC_WATKU`, `LICZBA_KOMENTARZY`, `ILOSC_ODWIEDZIN`) VALUES
(2, 1, 'temattemattemat', '2020-12-11 18:41:17', 'tresctresctre sctresctresctresctresctresctr esctresctresc tresctresctresctre sctresctresctr esctresctresctresctr esctresctresctresctresctresc tresctresctresctr esctresctresc tresctresctres ctresctresctresct resctresctresctresc tresctresctresctresctres ctresctresctre sctresctresctre sctresctresctr esctresctresctresctr esctresctresctresctresctresctresctresc tresctresctresctresctresct resctresctresct resctres ctres ctresctresctr esctresctresctresct resctresc tresc tresctre \r\n sctresctre sctresctre tresctresctre sctresctresctresctresctresctr esctresctresc tresctresctresctre sctresctresctr esctresctresctresctr esctresctresctresctresctresc tresctresctresctr esctresctresc tresctresctres ctresctresctresct resctresctresctresc tresctresctresctresctres ctresctresctre sctresctresctre sctresctresctr esctresctresctresctr esctresctresctresctresctresctresctresc tresctresctresctresctresct resctresctresct resctres ctres ctresctresctr esctresctresctresct resctresc tresc tresctre \r\n sctresctre sctresctre tresctresctre sctresctresctresctresctresctr esctresctresc tresctresctresctre sctresctresctr esctresctresctresctr esctresctresctresctresctresc tresctresctresctr esctresctresc tresctresctres ctresctresctresct resctresctresctresc tresctresctresctresctres ctresctresctre sctresctresctre sctresctresctr esctresctresctresctr esctresctresctresctresctresctresctresc tresctresctresctresctresct resctresctresct resctres ctres ctresctresctr esctresctresctresct resctresc tresc tresctre \r\n sctresctre sctresctre tresctresctre sctresctresctresctresctresctr esctresctresc tresctresctresctre sctresctresctr esctresctresctresctr esctresctresctresctresctresc tresctresctresctr esctresctresc tresctresctres ctresctresctresct resctresctresctresc tresctresctresctresctres ctresctresctre sctresctresctre sctresctresctr esctresctresctresctr esctresctresctresctresctresctresctresc tresctresctresctresctresct resctresctresct resctres ctres ctresctresctr esctresctresctresct resctresc tresc tresctre \r\n sctresctre sctresctre tresctresctre sctresctresctresctresctresctr esctresctresc tresctresctresctre sctresctresctr esctresctresctresctr esctresctresctresctresctresc tresctresctresctr esctresctresc tresctresctres ctresctresctresct resctresctresctresc tresctresctresctresctres ctresctresctre sctresctresctre sctresctresctr esctresctresctresctr esctresctresctresctresctresctresctresc tresctresctresctresctresct resctresctresct resctres ctres ctresctresctr esctresctresctresct resctresc tresc tresctre \r\n sctresctre sctresctre tresctresctre sctresctresctresctresctresctr esctresctresc tresctresctresctre sctresctresctr esctresctresctresctr esctresctresctresctresctresc tresctresctresctr esctresctresc tresctresctres ctresctresctresct resctresctresctresc tresctresctresctresctres ctresctresctre sctresctresctre sctresctresctr esctresctresctresctr esctresctresctresctresctresctresctresc tresctresctresctresctresct resctresctresct resctres ctres ctresctresctr esctresctresctresct resctresc tresc tresctre \r\n sctresctre sctresctre tresctresctre sctresctresctresctresctresctr esctresctresc tresctresctresctre sctresctresctr esctresctresctresctr esctresctresctresctresctresc tresctresctresctr esctresctresc tresctresctres ctresctresctresct resctresctresctresc tresctresctresctresctres ctresctresctre sctresctresctre sctresctresctr esctresctresctresctr esctresctresctresctresctresctresctresc tresctresctresctresctresct resctresctresct resctres ctres ctresctresctr esctresctresctresct resctresc tresc tresctre \r\n sctresctre sctresctre  ', 0, 62),
(3, 1, 'temattemattemat', '2020-12-11 18:42:57', 'tresctresctresctresctresctresctresctresc', 0, 8);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `artykul`
--
ALTER TABLE `artykul`
  MODIFY `ID_ARTYKULU` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `komentarz`
--
ALTER TABLE `komentarz`
  MODIFY `ID_KOMENTARZ` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `kruszec`
--
ALTER TABLE `kruszec`
  MODIFY `ID_KRUSZEC` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `waluta`
--
ALTER TABLE `waluta`
  MODIFY `ID_WALUTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT dla tabeli `watek`
--
ALTER TABLE `watek`
  MODIFY `ID_WATEK` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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

DELIMITER $$
--
-- Zdarzenia
--
CREATE DEFINER=`root`@`localhost` EVENT `select_event` ON SCHEDULE EVERY 5 MINUTE STARTS '2020-12-11 12:01:52' ON COMPLETION NOT PRESERVE ENABLE DO SELECT KUPNO, SPRZEDAZ FROM waluta$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
