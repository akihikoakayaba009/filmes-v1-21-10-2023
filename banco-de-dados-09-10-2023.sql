-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 10-Out-2023 às 01:09
-- Versão do servidor: 8.0.30
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `filmesv1`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administradores`
--

CREATE TABLE `administradores` (
  `admin_id` int NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_celular` varchar(14) DEFAULT NULL,
  `admin_telefone` varchar(13) DEFAULT NULL,
  `admin_whatsapp` varchar(19) DEFAULT NULL,
  `admin_senha` varchar(32) NOT NULL,
  `admin_hash` varchar(32) DEFAULT NULL,
  `admin_nome` varchar(255) NOT NULL,
  `admin_avatar` varchar(36) DEFAULT NULL,
  `admin_responsavel` varchar(255) DEFAULT NULL,
  `admin_permissao` text,
  `admin_email_confirmado` varchar(3) NOT NULL,
  `admin_ultimo_login` datetime DEFAULT NULL,
  `admin_online` datetime DEFAULT NULL,
  `admin_hash_confirmacao_email` varchar(32) NOT NULL,
  `admin_hash_recuperar_senha` varchar(32) DEFAULT NULL,
  `admin_hash_recuperar_senha_expiracao` datetime DEFAULT NULL,
  `admin_data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `administradores`
--

INSERT INTO `administradores` (`admin_id`, `admin_email`, `admin_celular`, `admin_telefone`, `admin_whatsapp`, `admin_senha`, `admin_hash`, `admin_nome`, `admin_avatar`, `admin_responsavel`, `admin_permissao`, `admin_email_confirmado`, `admin_ultimo_login`, `admin_online`, `admin_hash_confirmacao_email`, `admin_hash_recuperar_senha`, `admin_hash_recuperar_senha_expiracao`, `admin_data`) VALUES
(70, 'admin@admin.com', NULL, NULL, NULL, '14e1b600b1fd579f47433b88e8d85291', '40197b3148bc7b51116a50e199f7c63a', 'Administrador', '1f146aacf721b947248708f6904759e9.png', NULL, NULL, 'sim', '2023-10-08 20:53:58', '2023-10-08 20:57:51', 'b291b211efd08d392129ff09d1a9949e', 'f8d903696e32c37065f813184312111c', '2023-03-02 14:08:15', '2022-11-06 19:50:17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carousel`
--

CREATE TABLE `carousel` (
  `carousel_id` int NOT NULL,
  `carousel_para` varchar(255) NOT NULL,
  `carousel_item_url` varchar(255) NOT NULL,
  `carousel_item_url_destino` varchar(255) NOT NULL,
  `carousel_posicao` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `comentario_id` int NOT NULL,
  `comentario` text NOT NULL,
  `comentario_midia_id` int NOT NULL,
  `comentario_perfil_apelido` varchar(255) NOT NULL,
  `comentario_perfil_id` int NOT NULL,
  `comentario_perfil_avatar` varchar(36) NOT NULL,
  `comentario_data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `midia`
--

CREATE TABLE `midia` (
  `midia_id` int NOT NULL,
  `midia_titulo` varchar(255) NOT NULL,
  `midia_avaliacao` varchar(4) DEFAULT NULL,
  `midia_ano` varchar(4) DEFAULT NULL,
  `midia_trailer` varchar(255) DEFAULT NULL,
  `midia_image` varchar(255) NOT NULL,
  `midia_background` varchar(255) DEFAULT NULL,
  `midia_sinopse` text NOT NULL,
  `midia_categoria` text NOT NULL,
  `midia_tipo` varchar(10) NOT NULL,
  `midia_tmdb` varchar(255) DEFAULT NULL,
  `midia_visualizacoes` int NOT NULL DEFAULT '0',
  `midia_diretorio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `midia_categorias`
--

CREATE TABLE `midia_categorias` (
  `categoria_id` int NOT NULL,
  `categoria_titulo` varchar(255) NOT NULL,
  `categoria_descricao` text,
  `categoria_diretorio` varchar(255) NOT NULL,
  `categoria_image` varchar(36) DEFAULT NULL,
  `categoria_para` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `midia_episodios`
--

CREATE TABLE `midia_episodios` (
  `episodio_id` int NOT NULL,
  `episodio_numero` int NOT NULL,
  `episodio_titulo` varchar(255) DEFAULT NULL,
  `episodio_descricao` text,
  `episodio_image` varchar(255) DEFAULT NULL,
  `episodio_diretorio` varchar(255) NOT NULL,
  `episodio_temporada_id` int NOT NULL,
  `episodio_midia_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `midia_players`
--

CREATE TABLE `midia_players` (
  `player_id` int NOT NULL,
  `player_titulo` varchar(255) DEFAULT NULL,
  `player_url` varchar(255) NOT NULL,
  `player_tipo` varchar(20) NOT NULL,
  `player_duracao` varchar(20) DEFAULT NULL,
  `player_audio` varchar(20) NOT NULL,
  `player_acesso` varchar(10) DEFAULT NULL,
  `player_para` varchar(255) DEFAULT NULL,
  `player_visualizacoes` int DEFAULT '0',
  `player_episodio_id` int DEFAULT '0',
  `player_temporada_id` int DEFAULT '0',
  `player_midia_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `midia_temporadas`
--

CREATE TABLE `midia_temporadas` (
  `temporada_id` int NOT NULL,
  `temporada_titulo` varchar(255) NOT NULL,
  `temporada_diretorio` varchar(255) NOT NULL,
  `temporada_midia_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `paginas`
--

CREATE TABLE `paginas` (
  `pagina_id` int NOT NULL,
  `pagina_titulo` varchar(255) NOT NULL,
  `pagina_diretorio` varchar(255) NOT NULL,
  `pagina_conteudo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `planos_premium`
--

CREATE TABLE `planos_premium` (
  `premium_id` int NOT NULL,
  `premium_titulo` varchar(255) NOT NULL,
  `premium_diretorio` varchar(255) NOT NULL,
  `premium_preco` varchar(20) NOT NULL,
  `premium_dias_acesso` int NOT NULL,
  `premium_caracteristica` text NOT NULL,
  `premium_telas` int NOT NULL,
  `premium_consumo_creditos_revendedor` int NOT NULL,
  `plano_status` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `revendedores`
--

CREATE TABLE `revendedores` (
  `revendedor_id` int NOT NULL,
  `revendedor_nome` varchar(255) NOT NULL,
  `revendedor_email` varchar(255) NOT NULL,
  `revendedor_senha` varchar(32) NOT NULL,
  `revendedor_avatar` varchar(36) DEFAULT NULL,
  `revendedor_whatsapp` varchar(20) DEFAULT NULL,
  `revendedor_telegram` varchar(20) DEFAULT NULL,
  `revendedor_instagram` varchar(255) DEFAULT NULL,
  `revendedor_creditos` int NOT NULL DEFAULT '0',
  `revendedor_online` datetime DEFAULT NULL,
  `revendedor_hash` varchar(32) DEFAULT NULL,
  `revendedor_hash_recuperar_senha` varchar(32) DEFAULT NULL,
  `revendedor_hash_recuperar_senha_expiracao` datetime DEFAULT NULL,
  `revendedor_cadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `site_config`
--

CREATE TABLE `site_config` (
  `site_nome` varchar(255) DEFAULT NULL,
  `site_email` varchar(255) DEFAULT NULL,
  `site_whatsapp` varchar(19) DEFAULT NULL,
  `site_facebook` varchar(255) DEFAULT NULL,
  `site_instagram` varchar(255) DEFAULT NULL,
  `site_twitter` varchar(255) DEFAULT NULL,
  `site_youtube` varchar(255) DEFAULT NULL,
  `site_descricao` text,
  `site_keywords` varchar(512) DEFAULT NULL,
  `site_logo` varchar(36) DEFAULT NULL,
  `site_favicon` varchar(36) DEFAULT NULL,
  `site_background` varchar(36) DEFAULT NULL,
  `site_avatar` varchar(36) DEFAULT NULL,
  `site_categoria_image` varchar(36) DEFAULT NULL,
  `site_episodio_image` varchar(36) DEFAULT NULL,
  `site_midia_background` varchar(36) DEFAULT NULL,
  `site_token_mp` varchar(255) DEFAULT NULL,
  `site_paginacao` int DEFAULT '18',
  `site_cache` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `site_config`
--

INSERT INTO `site_config` (`site_nome`, `site_email`, `site_whatsapp`, `site_facebook`, `site_instagram`, `site_twitter`, `site_youtube`, `site_descricao`, `site_keywords`, `site_logo`, `site_favicon`, `site_background`, `site_avatar`, `site_categoria_image`, `site_episodio_image`, `site_midia_background`, `site_token_mp`, `site_paginacao`, `site_cache`) VALUES
('PopFlix', NULL, NULL, NULL, NULL, NULL, NULL, 'Assistir filmes online, Séries Online Canais Tv Online, Novelas Online. Venha assistir online grátis.', 'Assistir filmes online grátis, Séries Online grátis, Canais Tv Online grátis, Novelas Online grátis, Desenhos online grátis, Novelas online grátis, Venha assistir online grátis,', 'ec109274309ccdb837ad8f69a2f6092b.png', '001bbe0c920d1cc1b136698cc7b515eb.png', '8f1133874b8855a6e277f00534bf7026.png', '942aed27e9f81ff437000f7446e6cfca.png', '0dfc8b9e7350a1ce3fb527ce562ac0b4.png', '9369a2868d3062808c61031155ff7ec9.png', 'e629720e09eb56ebba5912000cab7dd3.png', NULL, 18, 21);

-- --------------------------------------------------------

--
-- Estrutura da tabela `site_monetizacao`
--

CREATE TABLE `site_monetizacao` (
  `monetizacao_id` int NOT NULL,
  `monetizacao_titulo` varchar(255) NOT NULL,
  `monetizacao_posicao` varchar(255) NOT NULL,
  `monetizacao_codigo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `smtp`
--

CREATE TABLE `smtp` (
  `smtp_user` varchar(255) DEFAULT NULL,
  `smtp_senha` varchar(255) DEFAULT NULL,
  `smtp_porta` varchar(255) DEFAULT NULL,
  `smtp_email` varchar(255) DEFAULT NULL,
  `smtp_host` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `user_id` int NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_nome` varchar(255) NOT NULL,
  `user_senha` varchar(32) NOT NULL,
  `user_avatar` varchar(36) NOT NULL,
  `user_hash` varchar(32) NOT NULL,
  `user_hash_recuperar_senha` varchar(32) DEFAULT NULL,
  `user_hash_recuperar_senha_expiracao` datetime DEFAULT NULL,
  `user_premium` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_online` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_premium_plano_id` int DEFAULT NULL,
  `user_revendedor` int DEFAULT '0',
  `user_cadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios_lista`
--

CREATE TABLE `usuarios_lista` (
  `usuario_lista_id` int NOT NULL,
  `usuario_lista_midia_id` int NOT NULL,
  `usuario_lista_perfil_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios_perfil`
--

CREATE TABLE `usuarios_perfil` (
  `perfil_id` int NOT NULL,
  `perfil_apelido` varchar(255) NOT NULL,
  `perfil_avatar` varchar(36) NOT NULL,
  `perfil_user_id` int NOT NULL,
  `perfil_user_email` varchar(255) NOT NULL,
  `perfil_hash` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `venda_id` int NOT NULL,
  `venda_titulo` varchar(255) NOT NULL,
  `venda_item_id` int NOT NULL,
  `venda_item_preco` varchar(255) NOT NULL,
  `venda_status` varchar(255) NOT NULL,
  `venda_forma_pagamento` varchar(255) NOT NULL,
  `venda_collection_id` varchar(255) NOT NULL,
  `venda_user_id` int NOT NULL,
  `venda_user_email` varchar(255) NOT NULL,
  `venda_user_nome` varchar(255) NOT NULL,
  `venda_item` varchar(255) DEFAULT NULL,
  `venda_finalizada` varchar(200) NOT NULL DEFAULT 'nao',
  `venda_data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `venda_aprovada_data` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `visitas`
--

CREATE TABLE `visitas` (
  `visita_id` int NOT NULL,
  `visita_ip` varchar(15) NOT NULL,
  `visita_data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`admin_id`);

--
-- Índices para tabela `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`carousel_id`);

--
-- Índices para tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`comentario_id`);

--
-- Índices para tabela `midia`
--
ALTER TABLE `midia`
  ADD PRIMARY KEY (`midia_id`);

--
-- Índices para tabela `midia_categorias`
--
ALTER TABLE `midia_categorias`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Índices para tabela `midia_episodios`
--
ALTER TABLE `midia_episodios`
  ADD PRIMARY KEY (`episodio_id`);

--
-- Índices para tabela `midia_players`
--
ALTER TABLE `midia_players`
  ADD PRIMARY KEY (`player_id`);

--
-- Índices para tabela `midia_temporadas`
--
ALTER TABLE `midia_temporadas`
  ADD PRIMARY KEY (`temporada_id`);

--
-- Índices para tabela `paginas`
--
ALTER TABLE `paginas`
  ADD PRIMARY KEY (`pagina_id`);

--
-- Índices para tabela `planos_premium`
--
ALTER TABLE `planos_premium`
  ADD PRIMARY KEY (`premium_id`);

--
-- Índices para tabela `revendedores`
--
ALTER TABLE `revendedores`
  ADD PRIMARY KEY (`revendedor_id`);

--
-- Índices para tabela `site_monetizacao`
--
ALTER TABLE `site_monetizacao`
  ADD PRIMARY KEY (`monetizacao_id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user_id`);

--
-- Índices para tabela `usuarios_lista`
--
ALTER TABLE `usuarios_lista`
  ADD PRIMARY KEY (`usuario_lista_id`);

--
-- Índices para tabela `usuarios_perfil`
--
ALTER TABLE `usuarios_perfil`
  ADD PRIMARY KEY (`perfil_id`);

--
-- Índices para tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`venda_id`);

--
-- Índices para tabela `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`visita_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administradores`
--
ALTER TABLE `administradores`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de tabela `carousel`
--
ALTER TABLE `carousel`
  MODIFY `carousel_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `comentario_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `midia`
--
ALTER TABLE `midia`
  MODIFY `midia_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de tabela `midia_categorias`
--
ALTER TABLE `midia_categorias`
  MODIFY `categoria_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `midia_episodios`
--
ALTER TABLE `midia_episodios`
  MODIFY `episodio_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `midia_players`
--
ALTER TABLE `midia_players`
  MODIFY `player_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `midia_temporadas`
--
ALTER TABLE `midia_temporadas`
  MODIFY `temporada_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `paginas`
--
ALTER TABLE `paginas`
  MODIFY `pagina_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `planos_premium`
--
ALTER TABLE `planos_premium`
  MODIFY `premium_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `revendedores`
--
ALTER TABLE `revendedores`
  MODIFY `revendedor_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `site_monetizacao`
--
ALTER TABLE `site_monetizacao`
  MODIFY `monetizacao_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuarios_lista`
--
ALTER TABLE `usuarios_lista`
  MODIFY `usuario_lista_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuarios_perfil`
--
ALTER TABLE `usuarios_perfil`
  MODIFY `perfil_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `venda_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `visitas`
--
ALTER TABLE `visitas`
  MODIFY `visita_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
