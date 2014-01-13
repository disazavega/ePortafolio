-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 13, 2014 at 09:26 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `eportfolio`
--

--
-- Dumping data for table `schema`
--

INSERT INTO `schema` (`id`, `name`, `author`, `createdAt`) VALUES
(1, 'Person', 'Schema.Org', '01.13.2014'),
(2, 'Organization', 'Schema.Org', '01.13.2014'),
(3, 'MoveAction', 'Schema.Org', '01.13.2014');

--
-- Dumping data for table `concept`
--

INSERT INTO `concept` (`id`, `name`, `idSchema`) VALUES
(1, 'Person', 1),
(2, 'Organization', 2),
(3, 'MoveAction', 3);

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`id`, `idConcept`, `name`, `type`) VALUES
(4, 1, 'Address', 'Text'),
(5, 1, 'Birth Date', 'Date'),
(6, 1, 'email', 'Text'),
(7, 1, 'Gender', 'Text'),
(8, 1, 'Nationality', 'Text'),
(9, 1, 'First Name', 'Text'),
(10, 1, 'Last Name', 'Text'),
(11, 2, 'Address', 'Text'),
(12, 2, 'Brand', 'Text'),
(13, 2, 'Telephone', 'Telephone Number'),
(14, 2, 'eMail', 'eMail'),
(15, 2, 'Fax Number', 'Telephone Number'),
(16, 3, 'From Location', 'Text'),
(17, 3, 'To Location', 'Text'),
(18, 3, 'Date', 'Date');

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `hash`, `name`, `url`) VALUES
(1, 'http://formtest.com/form1', 'Form Test 1', 'http://formtest.com/form1?some_param');

--
-- Dumping data for table `field`
--

INSERT INTO `field` (`id`, `name`, `type`, `idForm`) VALUES
(1, 'First Name', 'Text', 1),
(2, 'Last Name', 'Text', 1),
(3, 'Address', 'Text', 1),
(4, 'Personal email', 'eMail', 1),
(5, 'Nationality', 'Text', 1),
(6, 'Birth Date', 'Text', 1),
(7, 'Telephone Number', 'Telephone Number', 1),
(8, 'Secondary Email', 'eMail', 1),
(9, 'Location', 'Text', 1),
(10, 'Destination', 'Text', 1),
(11, 'Departure Date', 'Date', 1),
(12, 'Return Date', 'Date', 1);

--
-- Dumping data for table `conceptMaterialized`
--

INSERT INTO `conceptMaterialized` (`id`, `name`, `idForm`, `idConcept`) VALUES
(3, 'Travel - Person', 1, 1),
(4, 'Travel - Organization', 1, 2),
(5, 'Travel - Date', 1, 3);

--
-- Dumping data for table `alignment`
--

INSERT INTO `alignment` (`id`, `idField`, `idAttribute`, `idConceptMaterialized`) VALUES
(4, 3, 4, 3),
(5, 6, 5, 3),
(6, 4, 6, 3),
(7, 5, 8, 3),
(8, 1, 9, 3),
(9, 2, 10, 3),
(10, 7, 13, 4),
(11, 8, 14, 4),
(12, 9, 16, 5),
(13, 10, 17, 5),
(14, 11, 18, 5),
(17, 12, 18, 5);
