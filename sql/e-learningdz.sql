-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 16 mars 2023 à 20:08
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `e-learningdz`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `ID` int(255) NOT NULL,
  `fn` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `dob` varchar(250) NOT NULL,
  `pn` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `job` varchar(250) NOT NULL,
  `seal` varchar(250) NOT NULL,
  `signature` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `del` varchar(250) NOT NULL,
  `code` varchar(255) NOT NULL,
  `address` varchar(250) NOT NULL,
  `wilaya` varchar(250) NOT NULL,
  `groupage` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `new` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`ID`, `fn`, `name`, `gender`, `dob`, `pn`, `email`, `password`, `job`, `seal`, `signature`, `status`, `del`, `code`, `address`, `wilaya`, `groupage`, `description`, `new`) VALUES
(1, 'Dris', 'Djihad', 'Mâle', '2006-08-06', '0673730290', 'djihad139@gmail.com', '0000', 'Admin', '', '', 'Activé', '', 'ABCDEFGHIJ', 'Cité Souladj Boudjemaa, Sigus', 'Oum El Bouaghi', 'O+', '', ''),
(2, 'Dris', 'Nacer', 'Mâle', '1969-02-23', '0672178992', 'ameda5311@gmail.com', '0000', 'Médecin', 'http://localhost/E-learning%20DZ/admin/img/no.jpg', 'http://localhost/E-learning%20DZ/admin/img/no.jpg', 'Activé', '', '', 'Sigus', 'Oum El Bouaghi', 'O+', 'Neurologie', ''),
(6, 'Lemzerri', 'Badra', 'Femalle', '1979-08-17', '0658223161', 'badralemzerri@gmail.com', '0000', 'Pharmacien', '', '', 'Activé', '', '', 'Sigus', 'Oum El Bouaghi', 'A+', '', ''),
(34, 'ret', 'tetr', 'Mâle', '1990-01-01', '0', 'a@a', '0000', 'Admin', '', '', 'Activé', '', 'BIKNBBBQHC', '0', 'Djelfa', 'AB+', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `appointments`
--

CREATE TABLE `appointments` (
  `ID` int(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `time` varchar(250) NOT NULL,
  `mp` varchar(250) NOT NULL,
  `namepatient` varchar(250) NOT NULL,
  `fnpatient` varchar(250) NOT NULL,
  `dob` varchar(250) NOT NULL,
  `valid` varchar(250) NOT NULL,
  `observation` varchar(250) NOT NULL,
  `price` varchar(250) NOT NULL,
  `pay` varchar(250) NOT NULL,
  `remain` varchar(250) NOT NULL,
  `del` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `ID` int(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `message` varchar(250) NOT NULL,
  `sender` varchar(250) NOT NULL,
  `receiver` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `time` varchar(250) NOT NULL,
  `del` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `drugs`
--

CREATE TABLE `drugs` (
  `ID` int(255) NOT NULL,
  `name` varchar(250) NOT NULL,
  `form` varchar(250) NOT NULL,
  `del` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `drugs`
--

INSERT INTO `drugs` (`ID`, `name`, `form`, `del`) VALUES
(1, 'paracetamol', 'comprimé', ''),
(2, 'paralgon', 'comprimé', '');

-- --------------------------------------------------------

--
-- Structure de la table `patients`
--

CREATE TABLE `patients` (
  `ID` int(255) NOT NULL,
  `fn` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `dob` varchar(250) NOT NULL,
  `pn` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `mpi` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `del` varchar(250) NOT NULL,
  `notes` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `wilaya` varchar(250) NOT NULL,
  `height` varchar(250) NOT NULL,
  `weight` varchar(250) NOT NULL,
  `groupage` varchar(250) NOT NULL,
  `allergies` varchar(250) NOT NULL,
  `surgeries` varchar(250) NOT NULL,
  `chronic` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `patients`
--

INSERT INTO `patients` (`ID`, `fn`, `name`, `gender`, `dob`, `pn`, `email`, `password`, `mpi`, `status`, `del`, `notes`, `code`, `address`, `wilaya`, `height`, `weight`, `groupage`, `allergies`, `surgeries`, `chronic`) VALUES
(1, 'gj', 'gj', 'Mâle', '0001-02-01', 'ujh', '', 'GCVSONWX5R', 'Badra', 'Activé', '', '', 'KTWGPZKPVX', 'iioo', 'Tamanrasset', '', '', '', '', '', ''),
(2, 'hgk', 'jhukgjk', 'Mâle', '2000-01-01', '56', 'kjl@yh', '2NMKHB8VFD', 'Nacer', 'Activé', '', '', 'MXYSIHRQNI', '', '', '', '', '', '', '', ''),
(3, 'hgk', 'jhukgjk', 'Mâle', '2000-01-01', '56654', 'kjl@yh', 'PI7CJBTI4Q', 'Nacer', 'Activé', '', '', 'PQOEABXHQQ', 'jmhi', 'Oum El Bouaghi', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `ID` int(255) NOT NULL,
  `details` mediumtext NOT NULL,
  `mp` varchar(250) NOT NULL,
  `namepatient` varchar(250) NOT NULL,
  `fnpatient` varchar(250) NOT NULL,
  `dob` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `del` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `prescriptions`
--

INSERT INTO `prescriptions` (`ID`, `details`, `mp`, `namepatient`, `fnpatient`, `dob`, `date`, `del`) VALUES
(1, 'paracetamol: 4 comprimé => 3 x jour', 'Badra', 'gj', 'gj', '0001-02-01', '2022-10-20', 'yes'),
(2, 'paracetamol: 1 comprimé => 1 x jour\nPendant 1 jour(s)\n\nparalgon: 1 comprimé => 1 x jour', 'Badra', 'gj', 'gj', '0001-02-01', '2022-10-30', 'yes'),
(3, 'paracetamol: 1 comprimé => 1 x jour\n\nparacetamol: 1 comprimé => 1 x jour\n\nparacetamol: 1 comprimé => 1 x jour\nPendant 1 jour(s)\n\nparacetamol: 1 comprimé => 1 x jour\nPendant 1 jour(s)', 'Badra', 'gj', 'gj', '0001-02-01', '2022-10-25', 'yes'),
(4, 'yuihgopuç_', 'Badra', 'gj', 'gj', '0001-02-01', '2022-11-05', ''),
(5, 'paralgon: 1 comprimé => 2 x jour\nPendant 5 jour(s)', 'Nacer', 'jhukgjk', 'hgk', '2000-01-01', '2022-11-05', ''),
(6, '- paracetamol: 1 comprimé => 2 x jour\n\n- paracetamol: 1 comprimé => 2 x jour\n\n- paralgon: 1 comprimé => 2 x jour\n   Pendant 1 jour(s)', 'Badra', 'gj', 'gj', '0001-02-01', '2022-12-26', '');

-- --------------------------------------------------------

--
-- Structure de la table `specialties`
--

CREATE TABLE `specialties` (
  `ID` int(255) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `specialties`
--

INSERT INTO `specialties` (`ID`, `name`) VALUES
(3, 'Anatomie pathologique'),
(4, 'Anesthésie - Réanimation'),
(5, 'Biochimie'),
(6, 'Biologie clinique'),
(7, 'Cardiologie'),
(8, 'Chirurgie générale'),
(9, 'Chirurgie orthopédique'),
(10, 'Chirurgie pédiatrique'),
(11, 'Chirurgie urologique'),
(12, 'Chirurgie maxillo-faciale'),
(13, 'Chirurgie cardio-vasculaire'),
(14, 'Dermatologie'),
(15, 'Endocrinologie – Diabétologie'),
(16, 'Gastro-entérologie'),
(17, 'Gynéco-obstétrique'),
(18, 'Hématologie'),
(19, 'Hémobiologie'),
(20, 'Histo-embryologie'),
(21, 'Immunologie'),
(22, 'Maladies infectieuses'),
(23, 'Médecine interne'),
(24, 'Médecine légale'),
(25, 'Médecine nucléaire'),
(26, 'Médecine du travail'),
(27, 'Microbiologie'),
(28, 'Néphrologie'),
(29, 'Neurochirurgie'),
(30, 'Neurologie'),
(31, 'O.R.L.'),
(32, 'Ophtalmologie'),
(33, 'Oncologie médicale'),
(34, 'Parasitologie'),
(35, 'Pédiatrie'),
(36, 'Pharmacologie clinique'),
(37, 'Physiologie'),
(38, 'Pneumo-phtisiologie'),
(39, 'Psychiatrie'),
(40, 'Radiologie - Imagerie'),
(41, 'Radiothérapie'),
(42, 'Rééducation fonctionnelle'),
(43, 'Rhumatologie');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `specialties`
--
ALTER TABLE `specialties`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `ID` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `ID` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `patients`
--
ALTER TABLE `patients`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `specialties`
--
ALTER TABLE `specialties`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
