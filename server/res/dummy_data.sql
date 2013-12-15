-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 15, 2013 at 10:51 AM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

USE `eportfolio`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

INSERT INTO `schema` (`id`, `name`, `author`, `createdAt`) VALUES
(1, 'Schema Test 1', 'David', NULL);

INSERT INTO `form` (`id`, `name`, `url`, `hash`) VALUES
(1, 'Form Test 1', 'http://formtest.com/form1?some_param', 'http://formtest.com/form1');

INSERT INTO `field` (`id`, `name`, `type`, `idForm`) VALUES
(1, 'First Name', 'Text', '1'),
(2, 'Last Name', 'Text', '1'),
(3, 'Address', 'Text', '1');

INSERT INTO `concept` (`id`, `name`, `idSchema`) VALUES
(1, 'Concept Test 1', 1),
(2, 'Concept Test 2', 1);

INSERT INTO `attribute` (`id`, `idConcept`, `name`, `type`) VALUES
(1, 1, 'First Name - ConceptTest1', 'Text'),
(2, 1, 'Last Name - ConceptTest 1', 'Text'),
(3, 2, 'Address - ConceptTest 2', 'Text');

INSERT INTO `conceptMaterialized` (`id`, `name`, `idForm`, `idConcept`) VALUES
(1, 'MC Test1', '1', 1),
(2, 'MC Test2', '1', 2);

commit;

INSERT INTO `alignment` (`id`, `idField`, `idAttribute`, `idConceptMaterialized`) VALUES (1, 1, 1, 1);
INSERT INTO `alignment` (`id`, `idField`, `idAttribute`, `idConceptMaterialized`) VALUES (2, 2, 2, 1);
INSERT INTO `alignment` (`id`, `idField`, `idAttribute`, `idConceptMaterialized`) VALUES (3, 3, 3, 2);
