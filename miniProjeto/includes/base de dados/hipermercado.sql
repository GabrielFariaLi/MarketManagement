-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Jan-2020 às 13:08
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
-- Banco de dados: `hipermercado`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `caixa`
--

CREATE TABLE `caixa` (
  `ID_caixa` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `caixa`
--

INSERT INTO `caixa` (`ID_caixa`) VALUES
(1),
(2),
(3),
(4),
(5),
(6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `catalogo_fornecedor`
--

CREATE TABLE `catalogo_fornecedor` (
  `produto_fk` int(10) NOT NULL,
  `fornecedor_fk` int(10) NOT NULL,
  `preco` float NOT NULL,
  `peso_fornecedor` float NOT NULL,
  `unidade_medida_fornecido` varchar(20) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `catalogo_fornecedor`
--

INSERT INTO `catalogo_fornecedor` (`produto_fk`, `fornecedor_fk`, `preco`, `peso_fornecedor`, `unidade_medida_fornecido`) VALUES
(1, 1, 2, 1, 'kg'),
(1, 2, 2, 1, 'kg'),
(1, 4, 3.5, 1, 'kg'),
(1, 6, 1, 1, 'kg'),
(3, 1, 0.35, 250, 'ml'),
(3, 3, 1, 250, 'ml'),
(4, 3, 1, 1, 'L'),
(4, 6, 2.3, 1, 'L'),
(5, 1, 0.6, 1, 'kg'),
(5, 4, 3, 1, 'kg'),
(5, 6, 1, 1, 'kg'),
(7, 5, 3, 1, 'kg'),
(8, 5, 2, 1, 'kg'),
(9, 5, 2, 1, 'kg'),
(10, 1, 1, 1, 'kg'),
(10, 2, 40.3, 100, 'kg'),
(10, 4, 2, 1000, 'gr'),
(10, 7, 2, 1, 'kg'),
(11, 1, 1, 1, 'kg'),
(11, 3, 0.3, 100, 'gr'),
(11, 6, 1, 1, 'kg'),
(12, 3, 0.4, 100, 'gr'),
(13, 5, 4, 1, 'kg'),
(16, 1, 0.5, 1, 'kg'),
(16, 2, 20, 30, 'kg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `compra`
--

CREATE TABLE `compra` (
  `caixa_fk` int(10) NOT NULL,
  `fatura_fk` int(10) NOT NULL,
  `produto_fk` int(10) NOT NULL,
  `quantidade_compra` int(11) NOT NULL,
  `custo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `compra`
--

INSERT INTO `compra` (`caixa_fk`, `fatura_fk`, `produto_fk`, `quantidade_compra`, `custo`) VALUES
(1, 1, 1, 500, 117),
(1, 1, 3, 1000, 117),
(1, 1, 7, 30, 117),
(1, 3, 5, 5000, 117),
(1, 3, 10, 5000, 117),
(1, 5, 5, 778, 117),
(1, 6, 9, 10, 117),
(1, 7, 1, 500, 117),
(1, 7, 9, 20, 117),
(1, 8, 1, 20, 117),
(1, 8, 5, 121, 117),
(4, 2, 5, 240, 117),
(4, 9, 1, 80, 117);

-- --------------------------------------------------------

--
-- Estrutura da tabela `deslocacao`
--

CREATE TABLE `deslocacao` (
  `produto_fk` int(10) NOT NULL,
  `seccao_fk` int(10) NOT NULL,
  `prateleira` int(2) DEFAULT NULL,
  `origem` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `data_deslocacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `quantidade_deslocacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `deslocacao`
--

INSERT INTO `deslocacao` (`produto_fk`, `seccao_fk`, `prateleira`, `origem`, `data_deslocacao`, `quantidade_deslocacao`) VALUES
(1, 1, 2, 'Encomenda', '2020-01-04 14:36:55', 4000),
(1, 2, 1, 'Armazém', '2020-01-20 14:46:41', 910),
(3, 1, 1, 'Encomenda', '2020-01-01 18:38:35', 6000),
(3, 3, 1, 'Encomenda', '2019-12-28 22:46:24', 1190),
(4, 1, 1, 'encomenda', '2020-01-04 14:36:55', 500),
(4, 3, 1, 'Encomenda', '2019-12-28 22:46:24', 50),
(5, 1, 3, 'encomenda', '2020-01-04 14:36:55', 161),
(5, 2, 1, 'Encomenda', '2020-01-20 14:46:41', 3305),
(7, 4, 1, 'Encomenda', '2019-12-31 17:32:44', 130),
(8, 4, 2, 'Encomenda', '2019-12-28 22:46:24', 50),
(9, 4, 3, 'Encomenda', '2019-12-28 22:46:24', 50),
(10, 2, 1, 'Encomenda', '2020-01-20 14:46:41', 6550),
(11, 3, 2, 'Encomenda', '2019-12-28 22:46:24', 500),
(12, 3, 3, 'Encomenda', '2019-12-28 22:46:24', 300),
(13, 4, 2, 'Armazém', '2019-12-31 23:12:59', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `devolucao`
--

CREATE TABLE `devolucao` (
  `produto_fk` int(10) NOT NULL,
  `fatura_fk` int(10) NOT NULL,
  `data_devolucao` datetime NOT NULL,
  `quantidade_devolucao` int(5) NOT NULL,
  `satisfacao` varchar(200) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `devolucao`
--

INSERT INTO `devolucao` (`produto_fk`, `fatura_fk`, `data_devolucao`, `quantidade_devolucao`, `satisfacao`) VALUES
(3, 2, '2019-12-31 09:28:03', 100, 'ml'),
(3, 4, '2020-01-04 22:28:03', 90, 'Tava ruim'),
(5, 2, '2019-12-25 19:28:03', 660, 'Uva Podre'),
(5, 5, '2020-01-04 01:28:03', 222, 'Uva muito branca'),
(9, 6, '2020-01-04 17:18:03', 10, 'Me enganei na quantidade');

-- --------------------------------------------------------

--
-- Estrutura da tabela `encomenda`
--

CREATE TABLE `encomenda` (
  `ID_encomenda` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `encomenda`
--

INSERT INTO `encomenda` (`ID_encomenda`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fatura`
--

CREATE TABLE `fatura` (
  `ID_fatura` int(10) NOT NULL,
  `nif` int(9) DEFAULT NULL,
  `data_fatura` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tipo_pagamento` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `fatura`
--

INSERT INTO `fatura` (`ID_fatura`, `nif`, `data_fatura`, `tipo_pagamento`) VALUES
(1, 123456789, '2019-12-31 00:59:20', 'Cartão'),
(2, NULL, '2019-12-31 00:59:20', 'Dinheiro'),
(3, NULL, '2020-01-01 18:15:16', 'Dinheiro'),
(4, NULL, '2020-01-02 22:29:15', 'Dinheiro'),
(5, NULL, '2020-01-04 16:17:32', 'Cartão'),
(6, NULL, '2020-01-04 17:16:12', 'Cartão'),
(7, NULL, '2020-01-19 15:48:36', 'Cartão'),
(8, NULL, '2020-01-19 15:52:12', 'Cheque'),
(9, NULL, '2020-01-19 15:57:07', 'Cartão');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `ID_fornecedor` int(10) NOT NULL,
  `nome_fornecedor` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `contacto` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `localidade` varchar(20) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`ID_fornecedor`, `nome_fornecedor`, `contacto`, `email`, `localidade`) VALUES
(1, 'Fast', '123-456-789', 'Fast@gmail.com', 'Porto'),
(2, 'Zoom', '123-456-789', 'Zoom@gmail.com', 'Lisboa'),
(3, 'Sol Nascer', '123-456-789', 'SolNascer@gmail.com', 'Lisboa'),
(4, 'Da Terra', '123-456-789', 'DaTerra@gmail.com', 'Porto'),
(5, 'Sabor Portugues', '123-456-789', 'SaborPortugues@gmail.com', 'Aveiro'),
(6, 'TesteEntregas', '789-456-123', 'teste@gmail.com', 'Aveiro'),
(7, 'Dias Melhores', '810-411-050', 'diasmelhores@gmail.com', 'Aveiro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `cod_barra` int(10) NOT NULL,
  `quantidade_total` int(10) DEFAULT NULL,
  `quantidade_armazem` int(10) DEFAULT NULL,
  `quantidade_seccao` int(10) DEFAULT NULL,
  `descricao` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `preco_unitario` float NOT NULL,
  `peso` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `unidade_medida_produto` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `validade` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`cod_barra`, `quantidade_total`, `quantidade_armazem`, `quantidade_seccao`, `descricao`, `preco_unitario`, `peso`, `unidade_medida_produto`, `validade`) VALUES
(1, 4910, 0, 0, 'Banana', 1.2, '1', 'kg', '2019-11-27'),
(3, 7190, 0, 0, 'Iorgute', 1.05, '250', 'ml', '2019-12-29'),
(4, 590, 0, 0, 'Leite meio gordo', 0.51, '1', 'L', '2019-12-27'),
(5, 3466, 0, 0, 'Uva', 0.3, '50', 'gr', '2019-11-27'),
(7, 130, 0, 0, 'Frango', 3.9, '1', 'kg', '2019-12-23'),
(8, 50, 0, 0, 'Carne de porco', 4.2, '1', 'kg', '2019-12-24'),
(9, 20, 0, 0, 'Novilho', 5, '1', 'kg', '2019-12-23'),
(10, 6550, 0, 0, 'Morango', 1.2, '1', 'kg', '2019-12-24'),
(11, 500, 0, 0, 'Queijo', 2, '500', 'gr', '2019-12-25'),
(12, 300, 0, 0, 'Soro em pó', 5, '500', 'gr', '2019-12-24'),
(13, 10, 0, 0, 'Linguiça', 3, '1', 'kg', '2019-12-25'),
(16, NULL, NULL, NULL, 'Laranja', 1.05, '1', 'kg', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `seccao`
--

CREATE TABLE `seccao` (
  `ID_seccao` int(10) NOT NULL,
  `tipo` varchar(20) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `seccao`
--

INSERT INTO `seccao` (`ID_seccao`, `tipo`) VALUES
(1, 'Armazém'),
(2, 'Frutas'),
(3, 'Laticínios'),
(4, 'Carnes');

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacao`
--

CREATE TABLE `solicitacao` (
  `encomenda_fk` int(10) NOT NULL,
  `produto_fk` int(10) NOT NULL,
  `fornecedor_fk` int(10) NOT NULL,
  `data_encomenda` timestamp NOT NULL DEFAULT '2019-12-22 00:00:00',
  `data_chegada` timestamp NULL DEFAULT NULL,
  `quantidade_solicitacao` int(10) NOT NULL,
  `custo_solicitacao` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `solicitacao`
--

INSERT INTO `solicitacao` (`encomenda_fk`, `produto_fk`, `fornecedor_fk`, `data_encomenda`, `data_chegada`, `quantidade_solicitacao`, `custo_solicitacao`) VALUES
(1, 1, 1, '2019-12-22 00:00:00', '2019-12-26 00:00:00', 50, 50),
(1, 4, 1, '2019-12-22 00:00:00', '2019-12-26 00:00:00', 30, 50),
(1, 7, 1, '2019-12-22 00:00:00', '2019-12-26 00:00:00', 40, 120),
(1, 8, 1, '2019-12-22 00:00:00', '2019-12-26 00:00:00', 30, 40),
(2, 5, 4, '2019-12-22 00:00:00', '2019-12-27 12:38:27', 500, 100),
(2, 10, 4, '2019-12-22 00:00:00', '2019-12-27 12:38:27', 1000, 5),
(3, 7, 6, '2019-12-29 19:01:37', '2019-12-31 17:32:44', 30, 35),
(4, 1, 3, '2019-12-31 15:26:18', '2019-12-31 17:29:43', 4500, 35),
(5, 4, 5, '2019-12-31 23:13:57', '2019-12-31 23:17:13', 40, 34),
(6, 5, 3, '2020-01-01 15:36:19', '2020-01-01 16:07:57', 3500, 50),
(7, 3, 4, '2020-01-01 17:48:19', '2020-01-01 18:38:35', 350, 6),
(8, 1, 4, '2020-01-02 15:50:56', '2020-01-02 22:30:56', 32, 35),
(10, 1, 3, '2020-01-04 02:30:38', '2020-01-04 14:36:55', 500, 2.3),
(10, 4, 3, '2020-01-04 02:30:38', '2020-01-04 14:36:55', 500, 2.3),
(10, 5, 3, '2020-01-04 02:30:38', '2020-01-04 14:36:55', 500, 2.3),
(11, 1, 4, '2020-01-11 23:06:41', NULL, 300, 2.7),
(12, 1, 4, '2020-01-19 20:34:55', NULL, 30, 1),
(12, 10, 4, '2020-01-19 20:34:55', NULL, 30, 1),
(13, 1, 4, '2020-01-19 22:46:31', NULL, 50, 200),
(13, 5, 4, '2020-01-19 22:45:36', NULL, 200, 600),
(14, 1, 4, '2020-01-20 00:28:01', NULL, 50, 200),
(14, 5, 4, '2020-01-20 00:28:01', NULL, 200, 600),
(15, 1, 4, '2020-01-20 00:32:42', NULL, 50, 4),
(15, 5, 4, '2020-01-20 00:32:42', NULL, 200, 3),
(16, 1, 4, '2020-01-20 00:35:08', NULL, 50, 4),
(16, 5, 4, '2020-01-20 00:35:43', NULL, 200, 3),
(17, 1, 4, '2020-01-20 00:36:56', NULL, 50, 4),
(17, 5, 4, '2020-01-20 00:38:40', NULL, 200, 60),
(18, 1, 4, '2020-01-20 00:50:36', NULL, 20, 4),
(18, 5, 4, '2020-01-20 00:51:02', NULL, 200, 0.6),
(18, 10, 4, '2020-01-20 00:51:40', NULL, 10, 20000),
(19, 5, 4, '2020-01-20 00:59:58', NULL, 300, 0.9),
(19, 10, 4, '2020-01-20 00:56:33', NULL, 500, 1000000),
(20, 1, 4, '2020-01-20 01:00:47', NULL, 10, 4),
(20, 5, 4, '2020-01-20 01:01:04', NULL, 300, 0.9),
(20, 10, 4, '2020-01-20 01:08:43', NULL, 500, 1000000),
(21, 1, 4, '2020-01-20 01:15:15', '2020-01-20 14:46:41', 10, 4),
(21, 5, 4, '2020-01-20 01:15:48', '2020-01-20 14:46:41', 300, 0.9),
(21, 10, 4, '2020-01-20 01:15:38', '2020-01-20 14:46:41', 500, 1000),
(22, 7, 5, '2020-01-20 14:57:47', NULL, 10, 3),
(22, 8, 5, '2020-01-20 14:57:40', NULL, 10, 2),
(22, 9, 5, '2020-01-20 14:57:54', NULL, 10, 2),
(23, 7, 5, '2020-01-20 14:59:58', NULL, 10, 30),
(23, 8, 5, '2020-01-20 14:59:58', NULL, 10, 20),
(23, 9, 5, '2020-01-20 14:59:58', NULL, 10, 20),
(24, 1, 4, '2020-01-20 15:02:18', NULL, 10, 25),
(24, 5, 4, '2020-01-20 15:02:18', NULL, 300, 270),
(24, 10, 4, '2020-01-20 15:02:18', NULL, 500, 500000),
(25, 1, 4, '2020-01-20 15:03:54', NULL, 10, 25),
(25, 5, 4, '2020-01-20 15:03:54', NULL, 500, 1.5),
(25, 10, 4, '2020-01-20 15:03:54', NULL, 300, 600),
(26, 10, 2, '2020-01-21 12:00:14', NULL, 20, 806),
(26, 16, 2, '2020-01-21 12:00:14', NULL, 20, 400),
(27, 10, 2, '2020-01-21 12:02:11', NULL, 20, 0),
(27, 16, 2, '2020-01-21 12:02:11', NULL, 20, 0),
(29, 10, 2, '2020-01-21 12:04:20', NULL, 20, 0),
(29, 16, 2, '2020-01-21 12:04:20', NULL, 20, 0),
(31, 10, 2, '2020-01-21 12:06:03', NULL, 20, 8.06),
(31, 16, 2, '2020-01-21 12:06:03', NULL, 20, 13.3333);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `caixa`
--
ALTER TABLE `caixa`
  ADD PRIMARY KEY (`ID_caixa`);

--
-- Índices para tabela `catalogo_fornecedor`
--
ALTER TABLE `catalogo_fornecedor`
  ADD PRIMARY KEY (`produto_fk`,`fornecedor_fk`),
  ADD KEY `produto` (`produto_fk`),
  ADD KEY `fornecedor` (`fornecedor_fk`);

--
-- Índices para tabela `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`caixa_fk`,`fatura_fk`,`produto_fk`),
  ADD KEY `caixa` (`caixa_fk`),
  ADD KEY `fatura` (`fatura_fk`),
  ADD KEY `produto` (`produto_fk`);

--
-- Índices para tabela `deslocacao`
--
ALTER TABLE `deslocacao`
  ADD PRIMARY KEY (`produto_fk`,`seccao_fk`),
  ADD KEY `produto` (`produto_fk`),
  ADD KEY `seccao` (`seccao_fk`) USING BTREE;

--
-- Índices para tabela `devolucao`
--
ALTER TABLE `devolucao`
  ADD PRIMARY KEY (`produto_fk`,`fatura_fk`),
  ADD KEY `produto` (`produto_fk`),
  ADD KEY `fatura` (`fatura_fk`);

--
-- Índices para tabela `encomenda`
--
ALTER TABLE `encomenda`
  ADD PRIMARY KEY (`ID_encomenda`);

--
-- Índices para tabela `fatura`
--
ALTER TABLE `fatura`
  ADD PRIMARY KEY (`ID_fatura`);

--
-- Índices para tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`ID_fornecedor`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`cod_barra`);

--
-- Índices para tabela `seccao`
--
ALTER TABLE `seccao`
  ADD PRIMARY KEY (`ID_seccao`);

--
-- Índices para tabela `solicitacao`
--
ALTER TABLE `solicitacao`
  ADD PRIMARY KEY (`encomenda_fk`,`fornecedor_fk`,`produto_fk`),
  ADD KEY `produto` (`produto_fk`),
  ADD KEY `fornecedor` (`fornecedor_fk`),
  ADD KEY `encomenda_fk` (`encomenda_fk`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `caixa`
--
ALTER TABLE `caixa`
  MODIFY `ID_caixa` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `encomenda`
--
ALTER TABLE `encomenda`
  MODIFY `ID_encomenda` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `fatura`
--
ALTER TABLE `fatura`
  MODIFY `ID_fatura` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `ID_fornecedor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `cod_barra` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `seccao`
--
ALTER TABLE `seccao`
  MODIFY `ID_seccao` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `catalogo_fornecedor`
--
ALTER TABLE `catalogo_fornecedor`
  ADD CONSTRAINT `catalogo_fornecedor_ibfk_1` FOREIGN KEY (`fornecedor_fk`) REFERENCES `fornecedor` (`ID_fornecedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `catalogo_fornecedor_ibfk_2` FOREIGN KEY (`produto_fk`) REFERENCES `produto` (`cod_barra`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`caixa_fk`) REFERENCES `caixa` (`ID_caixa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`fatura_fk`) REFERENCES `fatura` (`ID_fatura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_3` FOREIGN KEY (`produto_fk`) REFERENCES `produto` (`cod_barra`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `deslocacao`
--
ALTER TABLE `deslocacao`
  ADD CONSTRAINT `deslocacao_ibfk_1` FOREIGN KEY (`produto_fk`) REFERENCES `produto` (`cod_barra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deslocacao_ibfk_3` FOREIGN KEY (`seccao_fk`) REFERENCES `seccao` (`ID_seccao`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `devolucao`
--
ALTER TABLE `devolucao`
  ADD CONSTRAINT `devolucao_ibfk_1` FOREIGN KEY (`fatura_fk`) REFERENCES `fatura` (`ID_fatura`) ON UPDATE CASCADE,
  ADD CONSTRAINT `devolucao_ibfk_2` FOREIGN KEY (`produto_fk`) REFERENCES `produto` (`cod_barra`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `solicitacao`
--
ALTER TABLE `solicitacao`
  ADD CONSTRAINT `solicitacao_ibfk_1` FOREIGN KEY (`fornecedor_fk`) REFERENCES `fornecedor` (`ID_fornecedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitacao_ibfk_2` FOREIGN KEY (`produto_fk`) REFERENCES `produto` (`cod_barra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitacao_ibfk_3` FOREIGN KEY (`encomenda_fk`) REFERENCES `encomenda` (`ID_encomenda`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
