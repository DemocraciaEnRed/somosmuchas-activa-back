-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 26, 2019 at 05:12 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `causascomunes`
--

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `image` varchar(512) DEFAULT NULL,
  `dir` varchar(512) DEFAULT NULL,
  `size` varchar(512) DEFAULT NULL,
  `type` varchar(512) DEFAULT NULL,
  `hasc` char(2) DEFAULT NULL,
  `hierarchy` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `districts`
--

-- distritos originales
/*INSERT INTO `districts` (`id`, `name`, `image`, `dir`, `size`, `type`, `hasc`, `hierarchy`) VALUES
(1, 'Ciudad Autónoma de Buenos Aires', 'Bandera_de_la_Ciudad_de_Buenos_Aires.png', '\\img\\distritos\\1563417854.7762', '46720', 'image/png', 'CA', 1),
(2, 'Buenos Aires', 'Bandera_de_la_Provincia_de_Buenos_Aires.png', '\\img\\distritos\\1563417866.1746', '18356', 'image/png', 'BA', 1),
(3, 'Catamarca', 'Bandera_de_la_Provincia_de_Catamarca.png', '\\img\\distritos\\1563417885.5716', '83320', 'image/png', 'CT', 1),
(4, 'Chaco', 'Bandera_de_la_Provincia_del_Chaco.png', '\\img\\distritos\\1563417930.0873', '46077', 'image/png', 'CC', 1),
(5, 'Chubut', 'Bandera_de_la_Provincia_del_Chubut.png', '\\img\\distritos\\1563417919.8534', '50281', 'image/png', 'CH', 1),
(6, 'Córdoba', 'Bandera_de_la_Provincia_de_Córdoba.png', '\\img\\distritos\\1563419020.2902', '20515', 'image/png', 'CB', 1),
(7, 'Corrientes', 'Bandera_de_la_Provincia_de_Corrientes.png', '\\img\\distritos\\1563417945.7307', '8301', 'image/png', 'CN', 1),
(8, 'Entre Ríos', 'Bandera_de_la_Provincia_de_Entre_Ríos.png', '\\img\\distritos\\1563419057.8095', '3692', 'image/png', 'ER', 1),
(9, 'Formosa', 'Bandera_de_la_Provincia_de_Formosa.png', '\\img\\distritos\\1563419121.6984', '7809', 'image/png', 'FM', 1),
(10, 'Jujuy', 'Bandera_de_la_Provincia_de_Jujuy.png', '\\img\\distritos\\1563419137.5428', '420181', 'image/png', 'JY', 1),
(11, 'La Pampa', 'Flag_of_La_Pampa_province.png', '\\img\\distritos\\1563419147.8677', '29584', 'image/png', 'LP', 1),
(12, 'La Rioja', 'Bandera_de_la_Provincia_de_La_Rioja.png', '\\img\\distritos\\1563419153.846', '38100', 'image/png', 'LR', 1),
(13, 'Mendoza', 'Bandera_de_la_Provincia_de_Mendoza.png', '\\img\\distritos\\1563419162.2728', '129730', 'image/png', 'MZ', 1),
(14, 'Misiones', 'Bandera_de_la_Provincia_de_Misiones.png', '\\img\\distritos\\1563419167.7411', '517', 'image/png', 'MN', 1),
(15, 'Neuquén', 'Bandera_de_la_Provincia_de_Neuquén.png', '\\img\\distritos\\1563419184.9902', '30935', 'image/png', 'NQ', 1),
(16, 'Río Negro', 'Bandera_de_la_Provincia_del_Río_Negro.png', '\\img\\distritos\\1563419200.1486', '5936', 'image/png', 'RN', 1),
(17, 'Salta', 'Bandera_de_la_Provincia_de_Salta.png', '\\img\\distritos\\1563419207.4019', '19362', 'image/png', 'SA', 1),
(18, 'San Juan', 'Bandera_de_la_Provincia_de_San_Juan.png', '\\img\\distritos\\1563419214.7115', '21875', 'image/png', 'SJ', 1),
(19, 'San Luis', 'Bandera_de_la_Provincia_de_San_Luis.png', '\\img\\distritos\\1563419221.3443', '104442', 'image/png', 'SL', 1),
(20, 'Santa Cruz', 'Bandera_de_la_Provincia_de_Santa_Cruz.png', '\\img\\distritos\\1563419228.6012', '47109', 'image/png', 'SC', 1),
(21, 'Santa Fe', 'Bandera_de_la_Provincia_de_Santa_Fe.png', '\\img\\distritos\\1563419244.3471', '12304', 'image/png', 'SF', 1),
(22, 'Santiago del Estero', 'Bandera_de_la_Provincia_de_Santiago_del_Estero.png', '\\img\\distritos\\1563419331.6751', '4795', 'image/png', 'SE', 1),
(23, 'Tierra del Fuego', 'Bandera_de_la_Provincia_de_Tierra_del_Fuego.png', '\\img\\distritos\\1563419324.2148', '5167', 'image/png', 'TF', 1),
(24, 'Tucumán', 'Bandera_de_la_Provincia_de_Tucumán.png', '\\img\\distritos\\1563419319.4852', '233', 'image/png', 'TM', 1),
(25, 'Nacional', '', NULL, NULL, NULL, 'AR', 0);
*/
-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `project` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `parties`
--

CREATE TABLE `parties` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `color` char(7) DEFAULT NULL,
  `image` varchar(512) DEFAULT NULL,
  `dir` varchar(512) DEFAULT NULL,
  `size` varchar(512) DEFAULT NULL,
  `type` varchar(512) DEFAULT NULL,
  `ideology` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `politicians`
--

CREATE TABLE `politicians` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `marital_status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `religion` varchar(50) DEFAULT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `twitter` varchar(50) DEFAULT NULL,
  `instagram` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `image` varchar(512) DEFAULT NULL,
  `dir` varchar(512) DEFAULT NULL,
  `size` varchar(512) DEFAULT NULL,
  `type` varchar(512) DEFAULT NULL,
  `position_id` int(10) UNSIGNED DEFAULT NULL,
  `district_id` int(11) UNSIGNED DEFAULT NULL,
  `party_id` int(11) UNSIGNED DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `politicians_project`
--

CREATE TABLE `politicians_project` (
  `id` int(10) UNSIGNED NOT NULL,
  `sort_position` tinyint(3) UNSIGNED DEFAULT NULL,
  `politician_id` int(10) UNSIGNED DEFAULT NULL,
  `project_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `politicians_stances`
--

CREATE TABLE `politicians_stances` (
  `id` int(10) UNSIGNED NOT NULL,
  `politician_id` int(10) UNSIGNED DEFAULT NULL,
  `project_id` int(10) UNSIGNED DEFAULT NULL,
  `stance_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `pluralization` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `positions_project`
--

CREATE TABLE `positions_project` (
  `id` int(10) UNSIGNED NOT NULL,
  `position_id` int(11) UNSIGNED DEFAULT NULL,
  `project_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `sort_position` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `short_text` text,
  `slider_text` text,
  `text` text,
  `tally` int(10) UNSIGNED DEFAULT '0',
  `highlighted` tinyint(3) UNSIGNED DEFAULT '0',
  `show_tally` tinyint(3) UNSIGNED DEFAULT '0',
  `show_videos` tinyint(3) UNSIGNED DEFAULT '0',
  `show_text` tinyint(3) UNSIGNED DEFAULT '0',
  `image` varchar(512) DEFAULT NULL,
  `cover_image` varchar(512) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `primary_color` char(6) DEFAULT NULL,
  `secondary_color` char(6) DEFAULT NULL,
  `dir` varchar(512) DEFAULT NULL,
  `size` varchar(512) DEFAULT NULL,
  `type` varchar(512) DEFAULT NULL,
  `c_dir` varchar(512) DEFAULT NULL,
  `c_size` varchar(512) DEFAULT NULL,
  `c_type` varchar(512) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stances`
--

CREATE TABLE `stances` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value` tinyint(4) DEFAULT NULL,
  `project_id` int(10) UNSIGNED DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

CREATE TABLE `tweets` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` varchar(512) DEFAULT NULL,
  `stance_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

-- en otro .sql aparte lo pusimos
-- INSERT INTO `users` (`id`, `username`, `password`, `created`, `modified`) VALUES
-- (1, 'admin', '$2y$10$dOZzqbtsW8g9cWJMN7qo1eZZv53DpEsJ1GAg7/OY9bJakGr0R1xq6', '2019-07-19 21:58:17', '2019-07-19 21:58:17');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(512) DEFAULT NULL,
  `sort_position` tinyint(4) DEFAULT NULL,
  `project_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parties`
--
ALTER TABLE `parties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `politicians`
--
ALTER TABLE `politicians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `politician_district_id` (`district_id`),
  ADD KEY `politician_party_id` (`party_id`),
  ADD KEY `FK_politicians_positions` (`position_id`);

--
-- Indexes for table `politicians_project`
--
ALTER TABLE `politicians_project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pp_politician_id` (`politician_id`),
  ADD KEY `pp_project_id` (`project_id`);

--
-- Indexes for table `politicians_stances`
--
ALTER TABLE `politicians_stances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ps_politician_id` (`politician_id`),
  ADD KEY `ps_stance_id` (`stance_id`),
  ADD KEY `ps_project_id` (`project_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions_project`
--
ALTER TABLE `positions_project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_positions_project_positions` (`position_id`),
  ADD KEY `FK_positions_project_projects` (`project_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stances`
--
ALTER TABLE `stances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stance_project_id` (`project_id`);

--
-- Indexes for table `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tweet_stance_id` (`stance_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_project_id` (`project_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `parties`
--
ALTER TABLE `parties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `politicians`
--
ALTER TABLE `politicians`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `politicians_project`
--
ALTER TABLE `politicians_project`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `politicians_stances`
--
ALTER TABLE `politicians_stances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `positions_project`
--
ALTER TABLE `positions_project`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `stances`
--
ALTER TABLE `stances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `politicians`
--
ALTER TABLE `politicians`
  ADD CONSTRAINT `FK_politicians_positions` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`),
  ADD CONSTRAINT `politician_district_id` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`),
  ADD CONSTRAINT `politician_party_id` FOREIGN KEY (`party_id`) REFERENCES `parties` (`id`);

--
-- Constraints for table `politicians_project`
--
ALTER TABLE `politicians_project`
  ADD CONSTRAINT `pp_politician_id` FOREIGN KEY (`politician_id`) REFERENCES `politicians` (`id`),
  ADD CONSTRAINT `pp_project_id` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Constraints for table `politicians_stances`
--
ALTER TABLE `politicians_stances`
  ADD CONSTRAINT `ps_politician_id` FOREIGN KEY (`politician_id`) REFERENCES `politicians` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ps_project_id` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ps_stance_id` FOREIGN KEY (`stance_id`) REFERENCES `stances` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `positions_project`
--
ALTER TABLE `positions_project`
  ADD CONSTRAINT `FK_positions_project_positions` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`),
  ADD CONSTRAINT `FK_positions_project_projects` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Constraints for table `stances`
--
ALTER TABLE `stances`
  ADD CONSTRAINT `stance_project_id` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tweets`
--
ALTER TABLE `tweets`
  ADD CONSTRAINT `tweet_stance_id` FOREIGN KEY (`stance_id`) REFERENCES `stances` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `video_project_id` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
