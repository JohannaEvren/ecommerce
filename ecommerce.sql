-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 03 jun 2020 kl 13:40
-- Serverversion: 10.4.11-MariaDB
-- PHP-version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `ecommerce`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `products`
--

CREATE TABLE `products` (
  `id` int(9) NOT NULL,
  `title` varchar(90) NOT NULL,
  `description` text NOT NULL,
  `price` int(9) NOT NULL,
  `img_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `img_url`) VALUES
(2, 'lampa', 'Fin lampa.', 100, NULL),
(3, 'soffa', 'snygg soffa', 40000, NULL),
(5, 'bord', 'sfdfdsf', 1000, NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(9) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(60) NOT NULL,
  `phone` varchar(60) NOT NULL,
  `street` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `city` varchar(90) NOT NULL,
  `country` varchar(90) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `street`, `postal_code`, `city`, `country`, `register_date`) VALUES
(33, 'Angelica', 'Lindberg', 'angelica@gmail.com', '$2y$10$XySXUekCoGOHI/u78HawNekBIcoIkpAx7Pk1j5/WUm4RIpdkTl5Sm', '0762772272', 'Lodjuretsgata 238', '13664', '123456', '123456', '2020-05-26 09:15:44'),
(87, 'Angelica', 'Lindberg', 'angelica.lindberg@gmail.com', '$2y$10$CLytjLxejc5rDrZYFNNPiu2capKLM7euif2Wf.v8aOIJKGiNY0RBC', '0762772272', 'Lodjuretsgata 238', '13664', 'Stockholm', '123456', '2020-05-29 12:47:18'),
(88, 'Angelica', 'Lindberg', 'angelica.lindberg96@gmail.com', '$2y$10$qvVKmoLvHG6O69ELkAGyQeFwVJ9RxHlhdSBQN/F2IeK4DsmuSV3uW', '0762772272', 'Lodjuretsgata 238', '13664', 'Stockholm', 'Sweden', '2020-05-29 12:47:59'),
(89, 'Angelica', 'Lindberg', 'angelica123@gmail.com', '$2y$10$rspvcao/m.mw5jMFQXRdOeXlET9izlUVhBi6AZUyJeZD4PNS/UIh.', '0762772272', 'Lodjuretsgata 238', '13664', '123456', '123456', '2020-06-01 11:19:40');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `products`
--
ALTER TABLE `products`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
