-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2020 at 12:19 AM
-- Server version: 10.2.30-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- --------------------------------------------------------

--
-- Table structure for table `tb_acessojogo`
--

CREATE TABLE IF NOT EXISTS `tb_acessojogo` (
  `id_acessojogo` int(11) NOT NULL AUTO_INCREMENT,
  `id_jogo` int(11) NOT NULL,
  `dt_acessojogo` datetime NOT NULL,
  `dt_acesso` date NOT NULL,
  PRIMARY KEY (`id_acessojogo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_agenda`
--

CREATE TABLE IF NOT EXISTS `tb_agenda` (
  `id_agenda` int(11) NOT NULL AUTO_INCREMENT,
  `st_nome` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_descricao` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `st_local` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dt_data` date NOT NULL,
  `nu_horario` time NOT NULL,
  `st_observacao` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bl_ativo` tinyint(1) NOT NULL DEFAULT 1,
  `bl_jogo` tinyint(1) NOT NULL DEFAULT 0,
  `id_jogo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_agenda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_apoio`
--

CREATE TABLE IF NOT EXISTS `tb_apoio` (
  `id_apoio` int(11) NOT NULL AUTO_INCREMENT,
  `st_nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_empresa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_telefone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bl_analisado` tinyint(1) DEFAULT 0,
  `bl_ativo` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_apoio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_botao`
--

CREATE TABLE IF NOT EXISTS `tb_botao` (
  `id_botao` int(11) NOT NULL AUTO_INCREMENT,
  `st_texto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_icone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_cor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bl_ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_botao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_comentario`
--

CREATE TABLE IF NOT EXISTS `tb_comentario` (
  `id_comentario` int(11) NOT NULL AUTO_INCREMENT,
  `st_imagem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `st_autor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_comentario` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_comentario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_comentarioimagem`
--

CREATE TABLE IF NOT EXISTS `tb_comentarioimagem` (
  `id_comentarioimagem` int(11) NOT NULL AUTO_INCREMENT,
  `id_comentario` int(11) NOT NULL,
  `id_imagem` int(11) NOT NULL,
  PRIMARY KEY (`id_comentarioimagem`),
  KEY `id_imagem` (`id_imagem`),
  KEY `id_comentario` (`id_comentario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_datahorariocampeonato`
--

CREATE TABLE IF NOT EXISTS `tb_datahorariocampeonato` (
  `id_datahorariocampeonato` int(11) NOT NULL AUTO_INCREMENT,
  `id_jogo` int(11) NOT NULL,
  `st_diasemana` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_hora` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_datahorariocampeonato`),
  KEY `id_jogo` (`id_jogo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_diahorario`
--

CREATE TABLE IF NOT EXISTS `tb_diahorario` (
  `id_diahorario` int(11) NOT NULL AUTO_INCREMENT,
  `st_diahorario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_diahorario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_duvida`
--

CREATE TABLE IF NOT EXISTS `tb_duvida` (
  `id_duvida` int(11) NOT NULL AUTO_INCREMENT,
  `st_duvida` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_resposta` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nu_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_duvida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_fotogaleria`
--

CREATE TABLE IF NOT EXISTS `tb_fotogaleria` (
  `id_fotogaleria` int(11) NOT NULL AUTO_INCREMENT,
  `st_nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_legenda` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bl_visivel` tinyint(1) NOT NULL DEFAULT 1,
  `bl_horizontal` tinyint(1) DEFAULT NULL,
  `nu_height` float DEFAULT NULL,
  `nu_widht` float DEFAULT NULL,
  PRIMARY KEY (`id_fotogaleria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_fotogaleriaimagem`
--

CREATE TABLE IF NOT EXISTS `tb_fotogaleriaimagem` (
  `id_fotogaleriaimagem` int(11) NOT NULL AUTO_INCREMENT,
  `id_fotogaleria` int(11) NOT NULL,
  `id_imagem` int(11) NOT NULL,
  PRIMARY KEY (`id_fotogaleriaimagem`),
  KEY `id_fotogaleria` (`id_fotogaleria`),
  KEY `id_imagem` (`id_imagem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_icone`
--

CREATE TABLE IF NOT EXISTS `tb_icone` (
  `id_icone` int(11) NOT NULL AUTO_INCREMENT,
  `id_secao` int(11) DEFAULT NULL,
  `st_icone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `st_valor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_icone`),
  KEY `id_secao` (`id_secao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_imagem`
--

CREATE TABLE IF NOT EXISTS `tb_imagem` (
  `id_imagem` int(11) NOT NULL AUTO_INCREMENT,
  `st_nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `st_prefixotamanho` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'ori',
  PRIMARY KEY (`id_imagem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_integracaosympla`
--

CREATE TABLE IF NOT EXISTS `tb_integracaosympla` (
  `id_integracaosympla` int(11) NOT NULL AUTO_INCREMENT,
  `st_chave` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_evento` int(11) NOT NULL,
  `bl_sincronizariniciar` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_integracaosympla`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jogo`
--

CREATE TABLE IF NOT EXISTS `tb_jogo` (
  `id_jogo` int(11) NOT NULL AUTO_INCREMENT,
  `st_nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_descricao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_lancamento` date DEFAULT NULL,
  `st_estilo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `st_video` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `st_ingresso` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nu_vaga` int(11) DEFAULT NULL,
  `st_plataforma` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `st_regra` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bl_campeonato` tinyint(1) DEFAULT 0,
  `st_classificacaoindicativa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `st_plataformacampeonato` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nu_quantidadejogadores` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_jogo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jogoimagem`
--

CREATE TABLE IF NOT EXISTS `tb_jogoimagem` (
  `id_jogoimagem` int(11) NOT NULL AUTO_INCREMENT,
  `id_jogo` int(11) NOT NULL,
  `id_imagem` int(11) NOT NULL,
  PRIMARY KEY (`id_jogoimagem`),
  KEY `id_jogo` (`id_jogo`),
  KEY `id_imagem` (`id_imagem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_localizacao`
--

CREATE TABLE IF NOT EXISTS `tb_localizacao` (
  `id_localizacao` int(11) NOT NULL AUTO_INCREMENT,
  `st_local` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_cep` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_endereco` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_mapa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_localizacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_log`
--

CREATE TABLE IF NOT EXISTS `tb_log` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `st_rota` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_descricao` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `dt_log` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_notificacao`
--

CREATE TABLE IF NOT EXISTS `tb_notificacao` (
  `id_notificacao` int(11) NOT NULL AUTO_INCREMENT,
  `st_titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_notificacao` datetime NOT NULL,
  PRIMARY KEY (`id_notificacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_notificacaousuario`
--

CREATE TABLE IF NOT EXISTS `tb_notificacaousuario` (
  `id_notificacaousuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_notificacao` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `bl_vizualizado` tinyint(1) NOT NULL DEFAULT 0,
  `dt_vizualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`id_notificacaousuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_participantessympla`
--

CREATE TABLE IF NOT EXISTS `tb_participantessympla` (
  `id` int(11) NOT NULL,
  `order_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_in` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_patrocinador`
--

CREATE TABLE IF NOT EXISTS `tb_patrocinador` (
  `id_patrocinador` int(11) NOT NULL AUTO_INCREMENT,
  `st_nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `st_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `st_imagem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_tipo` int(11) NOT NULL DEFAULT 2,
  PRIMARY KEY (`id_patrocinador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_patrocinadorimagem`
--

CREATE TABLE IF NOT EXISTS `tb_patrocinadorimagem` (
  `id_patrocinadorimagem` int(11) NOT NULL AUTO_INCREMENT,
  `id_imagem` int(11) NOT NULL,
  `id_patrocinador` int(11) NOT NULL,
  PRIMARY KEY (`id_patrocinadorimagem`),
  KEY `id_patrocinador` (`id_patrocinador`),
  KEY `id_imagem` (`id_imagem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_secao`
--

CREATE TABLE IF NOT EXISTS `tb_secao` (
  `id_secao` int(11) NOT NULL AUTO_INCREMENT,
  `st_titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_texto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_rota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bl_hasvideo` int(11) NOT NULL DEFAULT 0,
  `bl_hasimagem` int(11) NOT NULL DEFAULT 0,
  `bl_hasicone` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_secao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_secaoimagem`
--

CREATE TABLE IF NOT EXISTS `tb_secaoimagem` (
  `id_secaoimagem` int(11) NOT NULL AUTO_INCREMENT,
  `id_secao` int(11) NOT NULL,
  `id_imagem` int(11) NOT NULL,
  PRIMARY KEY (`id_secaoimagem`),
  KEY `id_secao` (`id_secao`),
  KEY `id_imagem` (`id_imagem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_sessao`
--

CREATE TABLE IF NOT EXISTS `tb_sessao` (
  `id_sessao` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `st_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_sessao` datetime NOT NULL DEFAULT current_timestamp(),
  `id_tipousuario` int(11) NOT NULL,
  PRIMARY KEY (`id_sessao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_social`
--

CREATE TABLE IF NOT EXISTS `tb_social` (
  `id_social` int(11) NOT NULL AUTO_INCREMENT,
  `st_nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_icone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `st_cor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_social`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tipousuario`
--

CREATE TABLE IF NOT EXISTS `tb_tipousuario` (
  `id_tipousuario` int(11) NOT NULL AUTO_INCREMENT,
  `st_tipousuario` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_tipousuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_uploadimagem`
--

CREATE TABLE IF NOT EXISTS `tb_uploadimagem` (
  `id_uploadimagem` int(11) NOT NULL AUTO_INCREMENT,
  `id_imagem` int(11) NOT NULL,
  `st_alt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dt_criacao` datetime NOT NULL DEFAULT current_timestamp(),
  `st_nome` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_uploadimagem`),
  KEY `id_imagem` (`id_imagem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_usuarios`
--

CREATE TABLE IF NOT EXISTS `tb_usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `st_nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `st_senha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_imagem` int(11) DEFAULT NULL,
  `id_tipousuario` int(11) NOT NULL DEFAULT 2,
  PRIMARY KEY (`id_usuario`),
  KEY `id_imagem` (`id_imagem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_acessosjogos`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_acessosjogos` (
`vw_primary_id_jogo` int(11)
,`id_jogo` int(11)
,`st_nome` varchar(255)
,`st_descricao` text
,`dt_lancamento` date
,`st_estilo` varchar(255)
,`st_video` text
,`st_ingresso` varchar(255)
,`nu_vaga` int(11)
,`st_plataforma` varchar(255)
,`st_regra` text
,`bl_campeonato` tinyint(1)
,`st_classificacaoindicativa` varchar(255)
,`st_plataformacampeonato` varchar(255)
,`nu_quantidadejogadores` int(11)
,`nu_acessos` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_notificacao`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_notificacao` (
`vw_primary_id_notificacaousuario` int(11)
,`id_notificacaousuario` int(11)
,`st_titulo` varchar(255)
,`st_descricao` varchar(255)
,`dt_vizualizado` datetime
,`dt_notificacao` datetime
,`id_usuario` int(11)
,`bl_vizualizado` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_usuarioimagem`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_usuarioimagem` (
`vw_primary_id_usuario` int(11)
,`id_usuario` int(11)
,`st_nome` varchar(255)
,`st_login` varchar(255)
,`id_imagem` int(11)
,`st_nomeimagem` varchar(255)
,`st_url` text
,`st_alt` varchar(255)
,`id_tipousuario` int(11)
,`st_prefixotamanho` varchar(10)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_acessosjogos`
--
DROP TABLE IF EXISTS `vw_acessosjogos`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_acessosjogos`  AS  select `j`.`id_jogo` AS `vw_primary_id_jogo`,`j`.`id_jogo` AS `id_jogo`,`j`.`st_nome` AS `st_nome`,`j`.`st_descricao` AS `st_descricao`,`j`.`dt_lancamento` AS `dt_lancamento`,`j`.`st_estilo` AS `st_estilo`,`j`.`st_video` AS `st_video`,`j`.`st_ingresso` AS `st_ingresso`,`j`.`nu_vaga` AS `nu_vaga`,`j`.`st_plataforma` AS `st_plataforma`,`j`.`st_regra` AS `st_regra`,`j`.`bl_campeonato` AS `bl_campeonato`,`j`.`st_classificacaoindicativa` AS `st_classificacaoindicativa`,`j`.`st_plataformacampeonato` AS `st_plataformacampeonato`,`j`.`nu_quantidadejogadores` AS `nu_quantidadejogadores`,count(`j`.`id_jogo`) AS `nu_acessos` from (`tb_jogo` `j` join `tb_acessojogo` `a` on(`a`.`id_jogo` = `j`.`id_jogo`)) group by `j`.`id_jogo` ;

-- --------------------------------------------------------

--
-- Structure for view `vw_notificacao`
--
DROP TABLE IF EXISTS `vw_notificacao`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_notificacao`  AS  select `notus`.`id_notificacaousuario` AS `vw_primary_id_notificacaousuario`,`notus`.`id_notificacaousuario` AS `id_notificacaousuario`,`noti`.`st_titulo` AS `st_titulo`,`noti`.`st_descricao` AS `st_descricao`,`notus`.`dt_vizualizado` AS `dt_vizualizado`,`noti`.`dt_notificacao` AS `dt_notificacao`,`notus`.`id_usuario` AS `id_usuario`,`notus`.`bl_vizualizado` AS `bl_vizualizado` from (`tb_notificacao` `noti` join `tb_notificacaousuario` `notus` on(`notus`.`id_notificacao` = `noti`.`id_notificacao`)) order by `noti`.`dt_notificacao` desc,`notus`.`bl_vizualizado` desc ;

-- --------------------------------------------------------

--
-- Structure for view `vw_usuarioimagem`
--
DROP TABLE IF EXISTS `vw_usuarioimagem`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_usuarioimagem`  AS  select `tb_usuarios`.`id_usuario` AS `vw_primary_id_usuario`,`tb_usuarios`.`id_usuario` AS `id_usuario`,`tb_usuarios`.`st_nome` AS `st_nome`,`tb_usuarios`.`st_login` AS `st_login`,`tb_imagem`.`id_imagem` AS `id_imagem`,`tb_imagem`.`st_nome` AS `st_nomeimagem`,`tb_imagem`.`st_url` AS `st_url`,`tb_imagem`.`st_alt` AS `st_alt`,`tb_usuarios`.`id_tipousuario` AS `id_tipousuario`,`tb_imagem`.`st_prefixotamanho` AS `st_prefixotamanho` from (`tb_usuarios` left join `tb_imagem` on(`tb_usuarios`.`id_imagem` = `tb_imagem`.`id_imagem`)) ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_comentarioimagem`
--
ALTER TABLE `tb_comentarioimagem`
  ADD CONSTRAINT `tb_comentarioimagem_ibfk_1` FOREIGN KEY (`id_imagem`) REFERENCES `tb_imagem` (`id_imagem`),
  ADD CONSTRAINT `tb_comentarioimagem_ibfk_2` FOREIGN KEY (`id_comentario`) REFERENCES `tb_comentario` (`id_comentario`);

--
-- Constraints for table `tb_datahorariocampeonato`
--
ALTER TABLE `tb_datahorariocampeonato`
  ADD CONSTRAINT `tb_datahorariocampeonato_ibfk_1` FOREIGN KEY (`id_jogo`) REFERENCES `tb_jogo` (`id_jogo`),
  ADD CONSTRAINT `tb_datahorariocampeonato_ibfk_2` FOREIGN KEY (`id_jogo`) REFERENCES `tb_jogo` (`id_jogo`);

--
-- Constraints for table `tb_fotogaleriaimagem`
--
ALTER TABLE `tb_fotogaleriaimagem`
  ADD CONSTRAINT `tb_fotogaleriaimagem_ibfk_1` FOREIGN KEY (`id_fotogaleria`) REFERENCES `tb_fotogaleria` (`id_fotogaleria`),
  ADD CONSTRAINT `tb_fotogaleriaimagem_ibfk_2` FOREIGN KEY (`id_imagem`) REFERENCES `tb_imagem` (`id_imagem`);

--
-- Constraints for table `tb_icone`
--
ALTER TABLE `tb_icone`
  ADD CONSTRAINT `tb_icone_ibfk_1` FOREIGN KEY (`id_secao`) REFERENCES `tb_secao` (`id_secao`);

--
-- Constraints for table `tb_jogoimagem`
--
ALTER TABLE `tb_jogoimagem`
  ADD CONSTRAINT `tb_jogoimagem_ibfk_1` FOREIGN KEY (`id_jogo`) REFERENCES `tb_jogo` (`id_jogo`),
  ADD CONSTRAINT `tb_jogoimagem_ibfk_2` FOREIGN KEY (`id_imagem`) REFERENCES `tb_imagem` (`id_imagem`);

--
-- Constraints for table `tb_patrocinadorimagem`
--
ALTER TABLE `tb_patrocinadorimagem`
  ADD CONSTRAINT `tb_patrocinadorimagem_ibfk_1` FOREIGN KEY (`id_patrocinador`) REFERENCES `tb_patrocinador` (`id_patrocinador`),
  ADD CONSTRAINT `tb_patrocinadorimagem_ibfk_2` FOREIGN KEY (`id_imagem`) REFERENCES `tb_imagem` (`id_imagem`);

--
-- Constraints for table `tb_secaoimagem`
--
ALTER TABLE `tb_secaoimagem`
  ADD CONSTRAINT `tb_secaoimagem_ibfk_1` FOREIGN KEY (`id_secao`) REFERENCES `tb_secao` (`id_secao`),
  ADD CONSTRAINT `tb_secaoimagem_ibfk_2` FOREIGN KEY (`id_imagem`) REFERENCES `tb_imagem` (`id_imagem`);

--
-- Constraints for table `tb_uploadimagem`
--
ALTER TABLE `tb_uploadimagem`
  ADD CONSTRAINT `tb_uploadimagem_ibfk_1` FOREIGN KEY (`id_imagem`) REFERENCES `tb_imagem` (`id_imagem`);

--
-- Constraints for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD CONSTRAINT `tb_usuarios_ibfk_1` FOREIGN KEY (`id_imagem`) REFERENCES `tb_imagem` (`id_imagem`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
