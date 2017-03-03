# Banco de Dados brigida Rodando em localhost 
# phpMyAdmin SQL Dump
# version 2.5.4
# http://www.phpmyadmin.net
#
# Servidor: localhost
# Tempo de Generação: Abr 05, 2003 at 03:45 AM
# Versão do Servidor: 4.1.0
# Versão do PHP: 4.3.4
# 
# Banco de Dados : `brigida`
# 

# --------------------------------------------------------

#
# Estrutura da tabela `dicas`
#

CREATE TABLE `dicas` (
  `cd` int(10) unsigned NOT NULL auto_increment,
  `dica` varchar(255) NOT NULL default '',
  `descricao` blob NOT NULL,
  PRIMARY KEY  (`cd`)
) TYPE=MyISAM CHARSET=latin1 AUTO_INCREMENT=1 ;

#
# Extraindo dados da tabela `dicas`
#


# --------------------------------------------------------

#
# Estrutura da tabela `enquetes`
#

CREATE TABLE `enquetes` (
  `cd` int(10) unsigned NOT NULL auto_increment,
  `pergunta` varchar(255) NOT NULL default '',
  `opcao1` varchar(255) NOT NULL default '',
  `opcao2` varchar(255) NOT NULL default '',
  `opcao3` varchar(255) NOT NULL default '',
  `opcao4` varchar(255) NOT NULL default '',
  `qtd_opcao1` int(10) unsigned NOT NULL default '0',
  `qtd_opcao2` int(10) unsigned NOT NULL default '0',
  `qtd_opcao3` int(10) unsigned NOT NULL default '0',
  `qtd_opcao4` int(10) unsigned NOT NULL default '0',
  `ativa` char(1) NOT NULL default '',
  `data` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`cd`)
) TYPE=MyISAM CHARSET=latin1 AUTO_INCREMENT=1 ;

#
# Extraindo dados da tabela `enquetes`
#


# --------------------------------------------------------

#
# Estrutura da tabela `eventos`
#

CREATE TABLE `eventos` (
  `cd` int(10) unsigned NOT NULL auto_increment,
  `nomes` varchar(255) NOT NULL default '',
  `data` int(11) NOT NULL default '0',
  `local` varchar(255) NOT NULL default '',
  `descricao` varchar(255) NOT NULL default '',
  `imagem_destaque` int(10) unsigned default NULL,
  `email` varchar(255) default NULL,
  `senha` varchar(8) default NULL,
  `tipo` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`cd`),
  KEY `nomes` (`nomes`)
) TYPE=MyISAM CHARSET=latin1 AUTO_INCREMENT=1 ;

#
# Extraindo dados da tabela `eventos`
#


# --------------------------------------------------------

#
# Estrutura da tabela `fotos`
#

CREATE TABLE `fotos` (
  `cd` int(10) unsigned NOT NULL auto_increment,
  `path` varchar(255) NOT NULL default '',
  `path_thumb` varchar(255) NOT NULL default '',
  `cd_evento` int(10) unsigned NOT NULL default '0',
  `bytes` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`cd`)
) TYPE=MyISAM CHARSET=latin1 AUTO_INCREMENT=1 ;

#
# Extraindo dados da tabela `fotos`
#


# --------------------------------------------------------

#
# Estrutura da tabela `imagens`
#

CREATE TABLE `imagens` (
  `cd` int(10) unsigned NOT NULL auto_increment,
  `nome` varchar(255) NOT NULL default '',
  `tamanho` varchar(20) NOT NULL default '',
  `caminho_img` varchar(255) NOT NULL default '',
  `caminho_thumb` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`cd`),
  KEY `nome` (`nome`)
) TYPE=MyISAM CHARSET=latin1 AUTO_INCREMENT=1 ;

#
# Extraindo dados da tabela `imagens`
#


# --------------------------------------------------------

#
# Estrutura da tabela `parceiro_evento`
#

CREATE TABLE `parceiro_evento` (
  `parceiro` int(10) unsigned NOT NULL default '0',
  `evento` int(10) unsigned NOT NULL default '0'
) TYPE=MyISAM CHARSET=latin1;

#
# Extraindo dados da tabela `parceiro_evento`
#


# --------------------------------------------------------

#
# Estrutura da tabela `parceiros`
#

CREATE TABLE `parceiros` (
  `cd` int(10) unsigned NOT NULL auto_increment,
  `nome` varchar(255) NOT NULL default '',
  `descricao` varchar(255) NOT NULL default '',
  `site` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `telefone` varchar(50) NOT NULL default '',
  `endereco` varchar(255) NOT NULL default '',
  `tipo` int(10) unsigned NOT NULL default '0',
  `path` varchar(255) NOT NULL default '',
  `path_thumb` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`cd`)
) TYPE=MyISAM CHARSET=latin1 AUTO_INCREMENT=1 ;

#
# Extraindo dados da tabela `parceiros`
#


# --------------------------------------------------------

#
# Estrutura da tabela `textos`
#

CREATE TABLE `textos` (
  `cd` int(10) unsigned NOT NULL auto_increment,
  `nome` varchar(255) NOT NULL default '',
  `conteudo` blob,
  PRIMARY KEY  (`cd`)
) TYPE=MyISAM CHARSET=latin1 AUTO_INCREMENT=3 ;

#
# Extraindo dados da tabela `textos`
#

INSERT INTO `textos` (`cd`, `nome`, `conteudo`) VALUES (1, 'home', '');
INSERT INTO `textos` (`cd`, `nome`, `conteudo`) VALUES (2, 'quemsomos', '');

# --------------------------------------------------------

#
# Estrutura da tabela `tipodeevento`
#

CREATE TABLE `tipodeevento` (
  `cd` int(10) unsigned NOT NULL auto_increment,
  `tipo` varchar(255) binary NOT NULL default '',
  PRIMARY KEY  (`cd`),
  UNIQUE KEY `tipo` (`tipo`)
) TYPE=MyISAM CHARSET=latin1 AUTO_INCREMENT=1 ;

#
# Extraindo dados da tabela `tipodeevento`
#


# --------------------------------------------------------

#
# Estrutura da tabela `tipodeparceiro`
#

CREATE TABLE `tipodeparceiro` (
  `cd` int(10) unsigned NOT NULL auto_increment,
  `tipo` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`cd`),
  UNIQUE KEY `tipo` (`tipo`)
) TYPE=MyISAM CHARSET=latin1 AUTO_INCREMENT=1 ;

#
# Extraindo dados da tabela `tipodeparceiro`
#

    