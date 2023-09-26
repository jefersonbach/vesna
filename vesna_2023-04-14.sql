# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.26)
# Database: vesna
# Generation Time: 2023-04-14 09:23:14 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table empresas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `empresas`;

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ativo` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `regra1` varchar(255) DEFAULT NULL,
  `col1` varchar(255) DEFAULT NULL,
  `tipo1` varchar(255) DEFAULT NULL,
  `val1` varchar(255) DEFAULT NULL,
  `regra2` varchar(255) DEFAULT NULL,
  `col2` varchar(255) DEFAULT NULL,
  `tipo2` varchar(255) DEFAULT NULL,
  `val2` varchar(255) DEFAULT NULL,
  `regra3` varchar(255) DEFAULT NULL,
  `col3` varchar(255) DEFAULT NULL,
  `tipo3` varchar(255) DEFAULT NULL,
  `val3` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `clean_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;

INSERT INTO `empresas` (`id`, `ativo`, `nome`, `site`, `regra1`, `col1`, `tipo1`, `val1`, `regra2`, `col2`, `tipo2`, `val2`, `regra3`, `col3`, `tipo3`, `val3`, `token`, `clean_url`)
VALUES
	(1,'Sim','Parceiro teste 1','www.empresa.com.br','+','6','+','20','+','7','+','50','+','8','+','2','a4c587b02006cbff1f8b216ec3565497','parceiro-teste-1');

/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table seo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `seo`;

CREATE TABLE `seo` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `rua` varchar(255) DEFAULT NULL,
  `regiao` varchar(255) DEFAULT NULL,
  `es` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `abstract` varchar(255) DEFAULT NULL,
  `after` varchar(255) DEFAULT NULL,
  `pag` text NOT NULL,
  `bkp` varchar(255) DEFAULT NULL,
  `paginas` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `seo` WRITE;
/*!40000 ALTER TABLE `seo` DISABLE KEYS */;

INSERT INTO `seo` (`id`, `empresa`, `email`, `telefone`, `rua`, `regiao`, `es`, `cidade`, `description`, `keywords`, `abstract`, `after`, `pag`, `bkp`, `paginas`)
VALUES
	(1,'Vesna','contato@vesna.com.br','','','','','',NULL,NULL,NULL,NULL,',empresas,usuarios,relatorios',NULL,'');

/*!40000 ALTER TABLE `seo` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table usuarios
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `adm` int(11) DEFAULT NULL,
  `ativo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;

INSERT INTO `usuarios` (`id`, `usuario`, `senha`, `adm`, `ativo`)
VALUES
	(1,'trump','36f17c3939ac3e7b2fc9396fa8e953ea',1,'Sim');

/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
