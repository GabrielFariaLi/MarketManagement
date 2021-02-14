-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Jan-2020 às 13:09
-- Versão do servidor: 10.4.6-MariaDB
-- versão do PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema_login`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `redefinir_senha`
--

CREATE TABLE `redefinir_senha` (
  `ID_redefinir_senha` int(11) NOT NULL,
  `email_redefinir_senha` text COLLATE latin1_general_ci NOT NULL,
  `selecionar_redefinir_senha` text COLLATE latin1_general_ci NOT NULL,
  `token_redefinir_senha` longtext COLLATE latin1_general_ci NOT NULL,
  `validade_redefinir_senha` text COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `redefinir_senha`
--

INSERT INTO `redefinir_senha` (`ID_redefinir_senha`, `email_redefinir_senha`, `selecionar_redefinir_senha`, `token_redefinir_senha`, `validade_redefinir_senha`) VALUES
(9, 'Gabrielfariali@hotmail.com', '119497ee543e7067', '$2y$10$psuO9Uy57J6jwwa01x49gugG3JCF5P3df.PiGrQvPr2BsRBL8CuPy', '1578496814');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
--

CREATE TABLE `utilizador` (
  `ID_utilizador` int(11) NOT NULL,
  `ID_username` tinytext COLLATE latin1_general_ci NOT NULL,
  `email_utilizador` tinytext COLLATE latin1_general_ci NOT NULL,
  `palavrapasse_utilizador` longtext COLLATE latin1_general_ci NOT NULL,
  `permissao` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `utilizador`
--

INSERT INTO `utilizador` (`ID_utilizador`, `ID_username`, `email_utilizador`, `palavrapasse_utilizador`, `permissao`) VALUES
(7, 'biel', 'biel@gmail.com', '$2y$10$VZjt7jcRzNWYDC6O74ifuu81X9YMDOzfc86.CRH.giPOW57ieFfr2', 'Administrador'),
(8, 'barbarachan', 'barbara@gmail.com', '$2y$10$WCFp1dYmoSrXervb0TIpNunKqaCXjUyFi4S4s9lgR8tyz9IaM4tAW', 'Administrador'),
(10, 'fernando', 'fernando@gmail.com', '$2y$10$kQMZ4ogd1YZk5T7lfTjX..zQtVbwhIqQBTeW5bDUH6b3A/NdIKu2y', 'Administrador'),
(11, 'gabriel', 'gabriel@habbohote.com', '$2y$10$QDtLglkjvZUCY/oBgL1fq.S1PGBuAAyHLV3HOiobanlKu/1H8elxW', 'Gerente'),
(12, 'Delvany', 'delvany@hotmail.com', '$2y$10$8O99QUtt2oDYNM7lXmHqCeFjqC0NdwsMOlNVdQCIgHP9/4vePMJG.', 'Visitante'),
(13, 'djbillyboy', 'cabraloka@yahoo.com', '$2y$10$uw/U/CfL4OMCMics0bj6D.4mJCwgB2NmOcE78Dw2rHQb9LU8X87U2', 'Gestor de estoque'),
(14, 'bielnovo', 'bielnovo@gmail.com', '$2y$10$S5CGH0t9Lbnl.tYf58u9He4WQG9wMQgajBSEW6mNwqUGStyvrmsIq', 'Visitante'),
(15, 'GabrielF', 'gabrielfariali@hotmail.com', '$2y$10$Zq5i/seVYHqYAj6zfsnq7OVSuydc.fe33QSKGuobTkcqj0Y/aHDXO', 'Visitante');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `redefinir_senha`
--
ALTER TABLE `redefinir_senha`
  ADD PRIMARY KEY (`ID_redefinir_senha`);

--
-- Índices para tabela `utilizador`
--
ALTER TABLE `utilizador`
  ADD PRIMARY KEY (`ID_utilizador`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `redefinir_senha`
--
ALTER TABLE `redefinir_senha`
  MODIFY `ID_redefinir_senha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `utilizador`
--
ALTER TABLE `utilizador`
  MODIFY `ID_utilizador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
