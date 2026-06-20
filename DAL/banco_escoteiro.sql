-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/06/2026 às 19:04
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
-- Banco de dados: `administracao_escoteiro`
--
CREATE DATABASE IF NOT EXISTS `administracao_escoteiro` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `administracao_escoteiro`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `atividades`
--

DROP TABLE IF EXISTS `atividades`;
CREATE TABLE `atividades` (
  `id_atividade` int(11) NOT NULL,
  `data_atividade` date NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `atividade_chefe`
--

DROP TABLE IF EXISTS `atividade_chefe`;
CREATE TABLE `atividade_chefe` (
  `id_vinculo_chefe` int(11) NOT NULL,
  `id_atividade` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data_vinculo` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `atividade_escoteiro`
--

DROP TABLE IF EXISTS `atividade_escoteiro`;
CREATE TABLE `atividade_escoteiro` (
  `id_vinculo` int(11) NOT NULL,
  `id_atividade` int(11) NOT NULL,
  `id_escoteiro` int(11) NOT NULL,
  `data_inscricao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `chefes_voluntarios`
--

DROP TABLE IF EXISTS `chefes_voluntarios`;
CREATE TABLE `chefes_voluntarios` (
  `id_voluntario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `funcao` varchar(50) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `escoteiros`
--

DROP TABLE IF EXISTS `escoteiros`;
CREATE TABLE `escoteiros` (
  `id_escoteiro` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL,
  `nome_responsavel` varchar(100) NOT NULL,
  `telefone_responsavel` varchar(20) NOT NULL,
  `bolsa_familia` tinyint(1) DEFAULT 0,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `notificacoes`
--

DROP TABLE IF EXISTS `notificacoes`;
CREATE TABLE `notificacoes` (
  `id_notificacao` int(11) NOT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `mensagem` text DEFAULT NULL,
  `data_envio` datetime DEFAULT NULL,
  `id_escoteiro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cargo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `atividades`
--
ALTER TABLE `atividades`
  ADD PRIMARY KEY (`id_atividade`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `atividade_chefe`
--
ALTER TABLE `atividade_chefe`
  ADD PRIMARY KEY (`id_vinculo_chefe`),
  ADD KEY `id_atividade` (`id_atividade`);

--
-- Índices de tabela `atividade_escoteiro`
--
ALTER TABLE `atividade_escoteiro`
  ADD PRIMARY KEY (`id_vinculo`),
  ADD KEY `id_atividade` (`id_atividade`),
  ADD KEY `id_escoteiro` (`id_escoteiro`);

--
-- Índices de tabela `chefes_voluntarios`
--
ALTER TABLE `chefes_voluntarios`
  ADD PRIMARY KEY (`id_voluntario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `escoteiros`
--
ALTER TABLE `escoteiros`
  ADD PRIMARY KEY (`id_escoteiro`);

--
-- Índices de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`id_notificacao`),
  ADD KEY `id_escoteiro` (`id_escoteiro`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atividades`
--
ALTER TABLE `atividades`
  MODIFY `id_atividade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `atividade_chefe`
--
ALTER TABLE `atividade_chefe`
  MODIFY `id_vinculo_chefe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `atividade_escoteiro`
--
ALTER TABLE `atividade_escoteiro`
  MODIFY `id_vinculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `chefes_voluntarios`
--
ALTER TABLE `chefes_voluntarios`
  MODIFY `id_voluntario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `escoteiros`
--
ALTER TABLE `escoteiros`
  MODIFY `id_escoteiro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id_notificacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `atividades`
--
ALTER TABLE `atividades`
  ADD CONSTRAINT `atividades_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Restrições para tabelas `atividade_chefe`
--
ALTER TABLE `atividade_chefe`
  ADD CONSTRAINT `atividade_chefe_ibfk_1` FOREIGN KEY (`id_atividade`) REFERENCES `atividades` (`id_atividade`) ON DELETE CASCADE;

--
-- Restrições para tabelas `atividade_escoteiro`
--
ALTER TABLE `atividade_escoteiro`
  ADD CONSTRAINT `atividade_escoteiro_ibfk_1` FOREIGN KEY (`id_atividade`) REFERENCES `atividades` (`id_atividade`) ON DELETE CASCADE,
  ADD CONSTRAINT `atividade_escoteiro_ibfk_2` FOREIGN KEY (`id_escoteiro`) REFERENCES `escoteiros` (`id_escoteiro`) ON DELETE CASCADE;

--
-- Restrições para tabelas `chefes_voluntarios`
--
ALTER TABLE `chefes_voluntarios`
  ADD CONSTRAINT `chefes_voluntarios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Restrições para tabelas `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD CONSTRAINT `notificacoes_ibfk_1` FOREIGN KEY (`id_escoteiro`) REFERENCES `escoteiros` (`id_escoteiro`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
