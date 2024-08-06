-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/07/2024 às 02:29
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `carrinho`
--
CREATE DATABASE IF NOT EXISTS `carrinho` DEFAULT CHARACTER SET utf8 COLLATE utf8_swedish_ci;
USE `carrinho`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tab_itens_pedido`
--

CREATE TABLE `tab_itens_pedido` (
  `id_item` int(10) NOT NULL,
  `id_pedido` int(10) NOT NULL,
  `id_produto` int(10) NOT NULL,
  `qtde` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tab_pedidos`
--

CREATE TABLE `tab_pedidos` (
  `id_pedido` int(10) NOT NULL,
  `id_pessoa` int(10) NOT NULL,
  `data` date NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tab_pessoas`
--

CREATE TABLE `tab_pessoas` (
  `id_pessoa` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `complemento` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Despejando dados para a tabela `tab_pessoas`
--

INSERT INTO `tab_pessoas` (`id_pessoa`, `nome`, `email`, `senha`, `cep`, `numero`, `complemento`) VALUES
(1, 'Rodrigo Sales', 'rodrigosalesveloso@gmail.comm', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '03131-010', '316', 'Senac');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tab_produtos`
--

CREATE TABLE `tab_produtos` (
  `id` int(10) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `estoque` int(10) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Despejando dados para a tabela `tab_produtos`
--

INSERT INTO `tab_produtos` (`id`, `nome`, `preco`, `estoque`, `foto`) VALUES
(1, 'Teclado USB Game KG-10BK, C3TECH', 80.00, 30, 'teclado.png'),
(2, 'Mouse Gamer Rgb 6 Botões 4 Switches Até 7200 Dpi L-Pulse 1619A Letron', 20.00, 0, 'mouse.png'),
(3, 'Notebook Dell Inspiron i15-3501-WA70S 15.6\' HD 11ª G Intel Core i7 8GB 256GB SSD NVIDIA GeForce', 3500.00, 4, 'notebook.png'),
(4, 'Monitor Led Samsung 22 Full Hd 1080p Hdmi Vga 60hz 5ms Vesa Gtia Oficial', 380.00, 9, 'monitor.png'),
(5, 'Processador gamer Intel Core i7-10700F BX8070110700F de 8 núcleos e 4.8GHz de frequência', 1360.00, 18, 'processador-i7.png'),
(6, 'WD BLUE SSD 500GB SATA3 6GBS 2.5 POL.', 612.90, 2, 'ssd-500g.png'),
(7, 'GABINETE GAMER PICHAU HX300M GLASS, MID-TOWER, LATERAL DE VIDRO, PRETO, PG-HX3-BKM01', 159.90, 25, 'gabinete.png'),
(8, 'Placa de vídeo GTX 1050 Ti GEFORCE Nvidia MSI 4GB OC Edition', 1207.03, 13, 'placa-video.png');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tab_itens_pedido`
--
ALTER TABLE `tab_itens_pedido`
  ADD PRIMARY KEY (`id_item`);

--
-- Índices de tabela `tab_pedidos`
--
ALTER TABLE `tab_pedidos`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Índices de tabela `tab_pessoas`
--
ALTER TABLE `tab_pessoas`
  ADD PRIMARY KEY (`id_pessoa`);

--
-- Índices de tabela `tab_produtos`
--
ALTER TABLE `tab_produtos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tab_itens_pedido`
--
ALTER TABLE `tab_itens_pedido`
  MODIFY `id_item` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tab_pedidos`
--
ALTER TABLE `tab_pedidos`
  MODIFY `id_pedido` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tab_pessoas`
--
ALTER TABLE `tab_pessoas`
  MODIFY `id_pessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tab_produtos`
--
ALTER TABLE `tab_produtos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
