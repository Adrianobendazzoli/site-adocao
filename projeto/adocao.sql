-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/11/2025 às 14:58
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
-- Banco de dados: `adocao`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `animal`
--

CREATE TABLE `animal` (
  `id_animal` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `cor` varchar(255) DEFAULT NULL,
  `tamanho` int(11) DEFAULT NULL,
  `peso` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `castrado` tinyint(1) DEFAULT 0,
  `vacinas` varchar(255) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `id_raca` int(11) DEFAULT NULL,
  `id_status` int(11) DEFAULT 1,
  `id_usuario` int(11) DEFAULT NULL,
  `favorito` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `animal`
--

INSERT INTO `animal` (`id_animal`, `nome`, `descricao`, `cor`, `tamanho`, `peso`, `foto`, `castrado`, `vacinas`, `id_tipo`, `id_raca`, `id_status`, `id_usuario`, `favorito`) VALUES
(2, 'dri', 'fofinho', 'preto', 2, 2, '../uploads/691bcad79b4fc_alysson.jpg', 1, 'raiva', 4, 7, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `interage`
--

CREATE TABLE `interage` (
  `id_usuario` int(11) DEFAULT NULL,
  `id_animal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `raca`
--

CREATE TABLE `raca` (
  `id_raca` int(11) NOT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `raca`
--

INSERT INTO `raca` (`id_raca`, `id_tipo`, `descricao`) VALUES
(1, 1, 'Labrador'),
(2, 1, 'Poodle'),
(3, 1, 'Bulldog'),
(4, 1, 'Golden Retriever'),
(5, 1, 'Pastor Alemão'),
(6, 1, 'Husky Siberiano'),
(7, 1, 'Shih-tzu'),
(8, 1, 'SRD (Sem raça definida)');

-- --------------------------------------------------------

--
-- Estrutura para tabela `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `status`
--

INSERT INTO `status` (`id_status`, `descricao`) VALUES
(1, 'Disponível'),
(2, 'Adotado'),
(3, 'Em tratamento');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo`
--

CREATE TABLE `tipo` (
  `id_tipo` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipo`
--

INSERT INTO `tipo` (`id_tipo`, `descricao`) VALUES
(1, 'Cachorro'),
(2, 'Gato'),
(3, 'Coelho'),
(4, 'Pássaro'),
(5, 'Hamster'),
(6, 'Réptil'),
(7, 'Peixe'),
(8, 'Cavalo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `nivel_acesso` enum('admin','usuario') DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha`, `cpf`, `telefone`, `nivel_acesso`) VALUES
(1, 'Administrador', 'admin@admin.com', '123456', NULL, NULL, 'usuario');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vacinacao_castracao`
--

CREATE TABLE `vacinacao_castracao` (
  `id_vacinacao` int(11) NOT NULL,
  `id_animal` int(11) DEFAULT NULL,
  `vacinas` varchar(255) DEFAULT NULL,
  `castrado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id_animal`),
  ADD KEY `id_tipo` (`id_tipo`),
  ADD KEY `id_raca` (`id_raca`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `interage`
--
ALTER TABLE `interage`
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_animal` (`id_animal`);

--
-- Índices de tabela `raca`
--
ALTER TABLE `raca`
  ADD PRIMARY KEY (`id_raca`),
  ADD KEY `id_tipo` (`id_tipo`);

--
-- Índices de tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Índices de tabela `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `vacinacao_castracao`
--
ALTER TABLE `vacinacao_castracao`
  ADD PRIMARY KEY (`id_vacinacao`),
  ADD KEY `id_animal` (`id_animal`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `animal`
--
ALTER TABLE `animal`
  MODIFY `id_animal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `raca`
--
ALTER TABLE `raca`
  MODIFY `id_raca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `vacinacao_castracao`
--
ALTER TABLE `vacinacao_castracao`
  MODIFY `id_vacinacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `animal_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo` (`id_tipo`),
  ADD CONSTRAINT `animal_ibfk_2` FOREIGN KEY (`id_raca`) REFERENCES `raca` (`id_raca`),
  ADD CONSTRAINT `animal_ibfk_3` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`),
  ADD CONSTRAINT `animal_ibfk_4` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `interage`
--
ALTER TABLE `interage`
  ADD CONSTRAINT `interage_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `interage_ibfk_2` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id_animal`);

--
-- Restrições para tabelas `raca`
--
ALTER TABLE `raca`
  ADD CONSTRAINT `raca_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo` (`id_tipo`);

--
-- Restrições para tabelas `vacinacao_castracao`
--
ALTER TABLE `vacinacao_castracao`
  ADD CONSTRAINT `vacinacao_castracao_ibfk_1` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id_animal`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
