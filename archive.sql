-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Φιλοξενητής: localhost
-- Χρόνος δημιουργίας: 12 Μαρ 2019 στις 09:54:46
-- Έκδοση διακομιστή: 5.6.37
-- Έκδοση PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `archive`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `id` int(11) NOT NULL,
  `subject` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `registry_number` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `registry_protocol` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `registry_date` date NOT NULL,
  `consigner` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `consignee` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `registry_preview` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `document`
--

INSERT INTO `document` (`id`, `subject`, `registry_number`, `registry_protocol`, `registry_date`, `consigner`, `consignee`, `registry_preview`, `user_id`) VALUES
(1, 'Συγκρότηση συνεργείου απασχόλησης', 'ΑΔΑ_6ΖΩΧΩ1', '21/2018/00587', '2019-02-16', 'Δήμος Κορινθίων', 'Πολιτική Προστασία (ΠΕ Κορινθίας)', '/images/photos/ΑΔΑ_6ΖΩΧΩ1.png', 1);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `job` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `employer` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `employee`
--

INSERT INTO `employee` (`id`, `name`, `job`, `employer`, `email`, `mobile`) VALUES
(1, 'Σταματούλης  Σπυρογεράσιμος ', 'Υπάλληλος', 'Πολιτική Προστασία (ΠΕ Κορινθίας)', 's.stamatoulis@pekorinthias.gr', '6944359599'),
(2, 'Τζαβάρας Παναγιώτης', 'Υπάλληλος', 'Πολιτική Προστασία (ΠΕ Μεσσηνίας)', 'politikiprostasia@na-messinias.gr', '6972308078');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Ευρετήρια για πίνακα `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT για πίνακα `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `has_documents` FOREIGN KEY (`user_id`) REFERENCES `employee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
