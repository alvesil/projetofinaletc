-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Dez-2021 às 07:48
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `petshop_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `CategoriaID` int(10) UNSIGNED NOT NULL,
  `CategoriaNome` varchar(100) NOT NULL,
  `CategoriaStatus` enum('ATIVO','INATIVO') NOT NULL DEFAULT 'ATIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`CategoriaID`, `CategoriaNome`, `CategoriaStatus`) VALUES
(1000, 'Outros', 'ATIVO'),
(1001, 'Banho e Tosa', 'ATIVO'),
(1002, 'Transporte', 'ATIVO'),
(1003, 'Consulta', 'ATIVO'),
(1004, 'Vacina', 'ATIVO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `especies`
--

CREATE TABLE `especies` (
  `EspecieID` int(10) UNSIGNED NOT NULL,
  `EspecieNome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `especies`
--

INSERT INTO `especies` (`EspecieID`, `EspecieNome`) VALUES
(1000, 'Caninos'),
(1001, 'Felinos'),
(1002, 'Aves'),
(1003, 'Peixes'),
(1004, 'Répteis'),
(1005, 'Roedores');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `FuncionarioID` int(10) UNSIGNED NOT NULL,
  `FuncionarioNome` varchar(80) NOT NULL,
  `FuncionarioEmail` varchar(100) NOT NULL,
  `FuncionarioPassword` varchar(50) NOT NULL,
  `FuncionarioTelefone` varchar(20) DEFAULT NULL,
  `FuncionarioTipo` enum('ADMINISTRADOR','FUNCIONARIO') NOT NULL DEFAULT 'FUNCIONARIO',
  `FuncionarioStatus` enum('ATIVO','INATIVO') NOT NULL DEFAULT 'ATIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`FuncionarioID`, `FuncionarioNome`, `FuncionarioEmail`, `FuncionarioPassword`, `FuncionarioTelefone`, `FuncionarioTipo`, `FuncionarioStatus`) VALUES
(100, 'Admin', 'adm@petshop.com.br', 'caf1a3dfb505ffed0d024130f58c5cfa', '984670000', 'ADMINISTRADOR', 'ATIVO'),
(101, 'secretaria', 'secretaria@petshop.com.br', '202cb962ac59075b964b07152d234b70', '984661111', 'FUNCIONARIO', 'ATIVO'),
(102, 'funcionario01', 'funcionario01@petshop.com.br', '202cb962ac59075b964b07152d234b70', '984660000', 'FUNCIONARIO', 'ATIVO'),
(103, 'Carol Silva', 'carol.silva@petshop.com.br', '202cb962ac59075b964b07152d234b70', '984662222', 'FUNCIONARIO', 'ATIVO'),
(104, 'Pedro Castro', 'pedor.castro@petshop.com.br', '202cb962ac59075b964b07152d234b70', '984665533', 'FUNCIONARIO', 'ATIVO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordemservicoitens`
--

CREATE TABLE `ordemservicoitens` (
  `OrdemServicoItemID` bigint(20) UNSIGNED NOT NULL,
  `OrdemServicoItemQuantidade` int(11) NOT NULL DEFAULT 1,
  `OrdemServicoItemValor` double NOT NULL DEFAULT 0,
  `OrdemServicoID` int(10) UNSIGNED NOT NULL,
  `ServicoID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ordemservicoitens`
--

INSERT INTO `ordemservicoitens` (`OrdemServicoItemID`, `OrdemServicoItemQuantidade`, `OrdemServicoItemValor`, `OrdemServicoID`, `ServicoID`) VALUES
(1, 1, 30, 1, 1000),
(2, 1, 40, 2, 1001),
(3, 1, 20, 2, 1006),
(4, 1, 40, 3, 1001),
(5, 1, 30, 5, 1000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordemservicos`
--

CREATE TABLE `ordemservicos` (
  `OrdemServicoID` int(10) UNSIGNED NOT NULL,
  `OrdemServicoData` date NOT NULL,
  `OrdemServicoNumero` varchar(10) NOT NULL,
  `OrdemServicoStatus` enum('EM ANDAMENTO','CONCLUIDA','CANCELADA') NOT NULL,
  `OrdemServicoObservacao` varchar(255) DEFAULT NULL,
  `PetID` int(10) UNSIGNED NOT NULL,
  `FuncionarioID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ordemservicos`
--

INSERT INTO `ordemservicos` (`OrdemServicoID`, `OrdemServicoData`, `OrdemServicoNumero`, `OrdemServicoStatus`, `OrdemServicoObservacao`, `PetID`, `FuncionarioID`) VALUES
(1, '2021-01-20', '2021010001', 'CONCLUIDA', NULL, 100, 102),
(2, '2021-01-20', '2021010002', 'CONCLUIDA', 'Transporte de dois cachorros.', 110, 102),
(3, '2021-01-21', '2021010003', 'CONCLUIDA', NULL, 109, 102),
(4, '2021-01-21', '2021010004', 'CANCELADA', 'Tutor teve um imprevisto.', 100, 102),
(5, '2021-01-21', '2021010005', 'CONCLUIDA', NULL, 101, 102);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pets`
--

CREATE TABLE `pets` (
  `PetID` int(10) UNSIGNED NOT NULL,
  `PetNome` varchar(80) NOT NULL,
  `PetSexo` char(1) NOT NULL DEFAULT 'M',
  `PetPeso` float NOT NULL,
  `PetDataNascimento` date NOT NULL,
  `PetFoto` varchar(255) NOT NULL,
  `TutorID` int(10) UNSIGNED NOT NULL,
  `RacaID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pets`
--

INSERT INTO `pets` (`PetID`, `PetNome`, `PetSexo`, `PetPeso`, `PetDataNascimento`, `PetFoto`, `TutorID`, `RacaID`) VALUES
(100, 'Bob', 'M', 9, '2015-05-12', 'logo (1).ico', 1000, 101),
(101, 'Chico', 'M', 1, '2020-03-18', '', 1006, 101),
(102, 'Amora', 'F', 3.84, '2018-12-12', '', 1000, 125),
(103, 'Rex', 'M', 5.3, '2014-01-03', '', 1001, 100),
(104, 'Adamastor', 'M', 4.2, '2020-08-03', '', 1002, 100),
(105, 'Tigrinho', 'M', 1.3, '2016-02-28', '', 1004, 207),
(106, 'Amarelo', 'M', 2, '2018-09-10', '', 1004, 207),
(107, 'Rickson', 'M', 6.2, '2016-11-11', '', 1003, 124),
(108, 'Dorinha', 'M', 3.88, '2017-06-06', '', 1003, 125),
(109, 'Maju', 'F', 6.1, '2019-05-12', '', 1005, 100),
(110, 'Balboa', 'M', 1.35, '2018-06-22', '', 1005, 119),
(151, 'GG', 'M', 35, '2021-12-10', 'é.jpg', 1000, 107),
(152, 'pitty', 'M', 4.5, '2021-12-08', 'cropped-Logo-vertical-removebg-preview.png', 1007, 103),
(153, '', 'M', 0, '0000-00-00', 'é.jpg', 1007, 100);

-- --------------------------------------------------------

--
-- Estrutura da tabela `racas`
--

CREATE TABLE `racas` (
  `RacaID` int(10) UNSIGNED NOT NULL,
  `RacaNome` varchar(50) NOT NULL,
  `EspecieID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `racas`
--

INSERT INTO `racas` (`RacaID`, `RacaNome`, `EspecieID`) VALUES
(100, 'SRD - Sem Raça Definida', 1000),
(101, 'Yorkshire Terrier', 1000),
(102, 'Pastor Alemão', 1000),
(103, 'Pastor Belga', 1000),
(104, 'Bulldog', 1000),
(105, 'Dobermann', 1000),
(106, 'Fila Brasileiro', 1000),
(107, 'Rottweiler', 1000),
(108, 'São Bernardo', 1000),
(109, 'Schnauzer Miniatura', 1000),
(110, 'Chow Chow', 1000),
(111, 'Husky Siberiano', 1000),
(112, 'Lulu da Pomerânia', 1000),
(113, 'Spitz Alemão', 1000),
(114, 'Basset Fulvo', 1000),
(115, 'Beagle', 1000),
(116, 'Dálmata', 1000),
(117, 'Cocker Spaniel Inglês', 1000),
(118, 'Golden Retriever', 1000),
(119, 'Labrador Retriever', 1000),
(120, 'Buldogue Francês', 1000),
(121, 'Maltês', 1000),
(122, 'Pequinês', 1000),
(123, 'Poodle', 1000),
(124, 'Pug', 1000),
(125, 'Shih Tzu', 1000),
(126, 'Chihuahua', 1000),
(127, 'American Pit Bull Terrier', 1000),
(128, 'Bulldog Campeiro', 1000),
(200, 'SRD - Sem Raça Definida', 1001),
(201, 'Siamês', 1001),
(202, 'Sphynx', 1001),
(203, 'Savannah', 1001),
(204, 'Siamês', 1001),
(205, 'Persa', 1001),
(206, 'Oriental', 1001),
(207, 'Munchkin', 1001),
(208, 'European Shorthair', 1001),
(300, 'SRD - Sem Raça Definida', 1003),
(301, 'Colisa', 1003),
(302, 'Arco-Íris Boesemani ', 1003),
(303, 'Aurora', 1003),
(304, 'Tetra neon', 1003),
(305, 'Peixe arco-íris', 1003),
(306, 'Mato grosso', 1003),
(307, 'Amphiprion ocellaris', 1003),
(308, 'Betta splendens', 1003),
(400, 'SRD - Sem Raça Definida', 1004),
(401, 'Tartaruga', 1004),
(402, 'Cágado de carapaça estriada ', 1004),
(403, 'Camaleões', 1004),
(500, 'SRD - Sem Raça Definida', 1005),
(501, 'Coelhos', 1005),
(502, 'Hamster', 1005),
(503, 'Porquinho-da-índia', 1005);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE `servicos` (
  `ServicoID` int(10) UNSIGNED NOT NULL,
  `ServicoNome` varchar(100) NOT NULL,
  `ServicoDescricao` varchar(255) DEFAULT NULL,
  `ServicoPreco` double NOT NULL DEFAULT 0,
  `ServicoStatus` enum('ATIVO','INATIVO') NOT NULL DEFAULT 'ATIVO',
  `CategoriaID` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`ServicoID`, `ServicoNome`, `ServicoDescricao`, `ServicoPreco`, `ServicoStatus`, `CategoriaID`) VALUES
(1000, 'Banho P', 'Banho em cachorros tamanho pequeno', 30, 'ATIVO', 1001),
(1001, 'Banho M', 'Banho em cachorros tamanho médio', 35, 'ATIVO', 1001),
(1002, 'Banho G', 'Banho em cachorros tamanho grande', 50, 'ATIVO', 1001),
(1003, 'Banho e Tosa P', 'Banho e Tosa em cachorros tamanho pequeno', 40, 'ATIVO', 1001),
(1004, 'Banho e Tosa M', 'Banho e Tosa em cachorros tamanho médio', 50, 'ATIVO', 1001),
(1005, 'Banho e Tosa G', 'Banho e Tosa em cachorros tamanho grande', 70, 'ATIVO', 1001),
(1006, 'Taxi Dog categoria 1', 'Buscar pets em casa até 10 km', 20, 'ATIVO', 1002),
(1007, 'Taxi Dog categoria 2', 'Buscar pets em casa até 20 km', 30, 'ATIVO', 1002),
(1008, 'Taxi Dog categoria 3', 'Buscar pets em casa até 30 km', 40, 'ATIVO', 1002),
(2000, 'Banho felinos', 'Banho em felinos', 30, 'ATIVO', 1001),
(2001, 'Banho e tosa em felinos ', 'Banho e tosa em felinos', 50, 'ATIVO', 1001);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tutores`
--

CREATE TABLE `tutores` (
  `TutorID` int(10) UNSIGNED NOT NULL,
  `TutorNome` varchar(80) NOT NULL,
  `TutorEmail` varchar(100) NOT NULL,
  `TutorPassword` varchar(50) NOT NULL,
  `TutorTelefone` varchar(20) DEFAULT NULL,
  `TutorFoto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tutores`
--

INSERT INTO `tutores` (`TutorID`, `TutorNome`, `TutorEmail`, `TutorPassword`, `TutorTelefone`, `TutorFoto`) VALUES
(1000, 'João Pedro Oliveira', 'jpo@yahoo.com.br', '202cb962ac59075b964b07152d234b70', '9984671100', ''),
(1001, 'Maria Silva', 'maria.silva@gmail.com.br', '202cb962ac59075b964b07152d234b70', '9987542233', ''),
(1002, 'Fernanda Castro', 'fernanda.castro@yahoo.com.br', '202cb962ac59075b964b07152d234b70', '999999999', ''),
(1003, 'Julina Aguiar', 'juliana.aguiar@gmail.com.br', '202cb962ac59075b964b07152d234b70', '997213344', ''),
(1004, 'Marta Souza', 'marta.souza@outlook.com.br', '202cb962ac59075b964b07152d234b70', '998765432', ''),
(1005, 'Rubens Aguiar', 'rubens.aguiar@outlook.com.br', '202cb962ac59075b964b07152d234b70', '999885511', ''),
(1006, 'Jaciara Teles', 'jaciara.teles@gmail.com.br', '202cb962ac59075b964b07152d234b70', '997742233', ''),
(1007, 'Eduardo', 'alvesil.eduardo.silva@gmail.com', '15de21c670ae7c3f6f3f1f37029303c9', '61999289003', 'logo.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`CategoriaID`);

--
-- Índices para tabela `especies`
--
ALTER TABLE `especies`
  ADD PRIMARY KEY (`EspecieID`);

--
-- Índices para tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`FuncionarioID`),
  ADD UNIQUE KEY `email_UNIQUE` (`FuncionarioEmail`);

--
-- Índices para tabela `ordemservicoitens`
--
ALTER TABLE `ordemservicoitens`
  ADD PRIMARY KEY (`OrdemServicoItemID`),
  ADD KEY `fk_OrdemServicoItem1` (`OrdemServicoID`),
  ADD KEY `fk_Servico1` (`ServicoID`);

--
-- Índices para tabela `ordemservicos`
--
ALTER TABLE `ordemservicos`
  ADD PRIMARY KEY (`OrdemServicoID`),
  ADD KEY `fk_OrdemServicos_Pets1_idx` (`PetID`),
  ADD KEY `fk_OrdemServicos_Funcionarios1_idx` (`FuncionarioID`);

--
-- Índices para tabela `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`PetID`),
  ADD KEY `fk_Pets_Tutores1_idx` (`TutorID`),
  ADD KEY `fk_Pets_Racas1_idx` (`RacaID`);

--
-- Índices para tabela `racas`
--
ALTER TABLE `racas`
  ADD PRIMARY KEY (`RacaID`),
  ADD KEY `fk_Racas_Especies1_idx` (`EspecieID`);

--
-- Índices para tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`ServicoID`),
  ADD KEY `fk_Categorias_Servicos` (`CategoriaID`);

--
-- Índices para tabela `tutores`
--
ALTER TABLE `tutores`
  ADD PRIMARY KEY (`TutorID`),
  ADD UNIQUE KEY `email_UNIQUE` (`TutorEmail`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `CategoriaID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1005;

--
-- AUTO_INCREMENT de tabela `especies`
--
ALTER TABLE `especies`
  MODIFY `EspecieID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1006;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `FuncionarioID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT de tabela `ordemservicoitens`
--
ALTER TABLE `ordemservicoitens`
  MODIFY `OrdemServicoItemID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `ordemservicos`
--
ALTER TABLE `ordemservicos`
  MODIFY `OrdemServicoID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `pets`
--
ALTER TABLE `pets`
  MODIFY `PetID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT de tabela `racas`
--
ALTER TABLE `racas`
  MODIFY `RacaID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=504;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `ServicoID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2002;

--
-- AUTO_INCREMENT de tabela `tutores`
--
ALTER TABLE `tutores`
  MODIFY `TutorID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1009;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `ordemservicoitens`
--
ALTER TABLE `ordemservicoitens`
  ADD CONSTRAINT `fk_OrdemServicoItem1` FOREIGN KEY (`OrdemServicoID`) REFERENCES `ordemservicos` (`OrdemServicoID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Servico1` FOREIGN KEY (`ServicoID`) REFERENCES `servicos` (`ServicoID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ordemservicos`
--
ALTER TABLE `ordemservicos`
  ADD CONSTRAINT `fk_OrdemServicos_Funcionarios1` FOREIGN KEY (`FuncionarioID`) REFERENCES `funcionarios` (`FuncionarioID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_OrdemServicos_Pets1` FOREIGN KEY (`PetID`) REFERENCES `pets` (`PetID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `fk_Pets_Racas1` FOREIGN KEY (`RacaID`) REFERENCES `racas` (`RacaID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pets_Tutores1` FOREIGN KEY (`TutorID`) REFERENCES `tutores` (`TutorID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `racas`
--
ALTER TABLE `racas`
  ADD CONSTRAINT `fk_Racas_Especies1` FOREIGN KEY (`EspecieID`) REFERENCES `especies` (`EspecieID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `servicos`
--
ALTER TABLE `servicos`
  ADD CONSTRAINT `fk_Categorias_Servicos` FOREIGN KEY (`CategoriaID`) REFERENCES `categorias` (`CategoriaID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
