-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 02 déc. 2020 à 23:58
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--
CREATE DATABASE IF NOT EXISTS `projet` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `projet`;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `IdCategorie` int(20) NOT NULL,
  `NomCategorie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `IdClient` int(20) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Sexe` varchar(10) NOT NULL,
  `Adresse` varchar(100) NOT NULL,
  `Telephone` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `IdUser` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `IdProduit` int(20) NOT NULL AUTO_INCREMENT,
  `NomProduit` varchar(200) NOT NULL,
  `Prix` float NOT NULL,
  `QteStock` int(10) NOT NULL,
  `IdCategorie` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `IdUser` int(20) NOT NULL,
  `Ndc` varchar(50) NOT NULL,
  `Mdp` varchar(100) NOT NULL,
  `Statut` varchar(20) NOT NULL COMMENT 'Admin/User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`IdCategorie`),
  ADD UNIQUE KEY `UC_NomCategorie` (`NomCategorie`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`IdClient`),
  ADD UNIQUE KEY `UC_Telephone` (`Telephone`) USING BTREE,
  ADD UNIQUE KEY `UC_Email` (`Email`) USING BTREE,
  ADD UNIQUE KEY `IdUser` (`IdUser`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`IdProduit`),
  ADD KEY `IdCategorie_FK` (`IdCategorie`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`IdUser`),
  ADD UNIQUE KEY `UC_Ndc` (`Ndc`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `IdCategorie` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `IdClient` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `IdProduit` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `IdUser` int(20) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `IdUser_FK` FOREIGN KEY (`IdUser`) REFERENCES `users` (`IdUser`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `IdCategorie_FK` FOREIGN KEY (`IdCategorie`) REFERENCES `categories` (`IdCategorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
