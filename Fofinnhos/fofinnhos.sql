-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 01-Out-2024 às 18:45
-- Versão do servidor: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fofinnhos`
--
DROP DATABASE IF EXISTS `fofinnhos`;
CREATE DATABASE IF NOT EXISTS `fofinnhos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fofinnhos`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `cod_cli` int(11) NOT NULL,
  `nome` varchar(40) DEFAULT NULL,
  `endereco` varchar(50) DEFAULT NULL,
  `bairro` varchar(20) DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `cpf` bigint(20) DEFAULT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `data_nasci` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `cod_fun` int(11) NOT NULL,
  `nome` varchar(40) DEFAULT NULL,
  `cpf` bigint(20) DEFAULT NULL,
  `endereco` varchar(50) DEFAULT NULL,
  `bairro` varchar(20) DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `usuario` varchar(25) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`cod_fun`, `nome`, `cpf`, `endereco`, `bairro`, `cidade`, `estado`, `telefone`, `email`, `usuario`, `senha`) VALUES
(1, 'Rambo Stallone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pet`
--

CREATE TABLE `pet` (
  `cod_pet` int(11) NOT NULL,
  `cod_cli` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `pelagem` char(7) DEFAULT NULL,
  `peso` double DEFAULT NULL,
  `data_nasci` date DEFAULT NULL,
  `foto` blob
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE `servico` (
  `cod_serv` int(11) NOT NULL,
  `cod_pet` int(11) NOT NULL,
  `cod_fun` int(11) NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `descricao` text,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `duracao` time DEFAULT NULL,
  `valor` decimal(5,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cod_cli`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`cod_fun`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`cod_pet`),
  ADD KEY `cod_cli` (`cod_cli`);

--
-- Indexes for table `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`cod_serv`),
  ADD KEY `cod_pet` (`cod_pet`),
  ADD KEY `cod_fun` (`cod_fun`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
