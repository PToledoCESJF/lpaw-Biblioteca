-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27-Maio-2019 às 17:27
-- Versão do servidor: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_autores`
--

CREATE TABLE `tb_autores` (
  `id_autor` int(11) NOT NULL,
  `nome_autor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_autores`
--

INSERT INTO `tb_autores` (`id_autor`, `nome_autor`) VALUES
(1, 'Paul Deitel'),
(2, 'Harvey Deitel'),
(3, 'Luckow Melo'),
(4, 'C. J. Date');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_categorias`
--

CREATE TABLE `tb_categorias` (
  `id_categoria` int(11) NOT NULL,
  `nome_categoria` varchar(255) NOT NULL,
  `assunto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_categorias`
--

INSERT INTO `tb_categorias` (`id_categoria`, `nome_categoria`, `assunto`) VALUES
(1, 'InformÃ¡tica', 'Livro de Informatica');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_editoras`
--

CREATE TABLE `tb_editoras` (
  `id_editora` int(11) NOT NULL,
  `nome_editora` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_editoras`
--

INSERT INTO `tb_editoras` (`id_editora`, `nome_editora`) VALUES
(1, 'Pearson Education'),
(2, 'Casa do CÃ³digo'),
(3, 'Novatec'),
(4, 'Bookman'),
(5, 'Campus Elsevier'),
(6, 'Brasport');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_emprestimos`
--

CREATE TABLE `tb_emprestimos` (
  `exemplar` varchar(100) NOT NULL,
  `usuario` int(11) NOT NULL,
  `data_emprestimo` date NOT NULL,
  `observacao` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_exemplares`
--

CREATE TABLE `tb_exemplares` (
  `id_exemplar` varchar(100) NOT NULL,
  `livro` int(11) NOT NULL,
  `tipo_exemplar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_exemplares`
--

INSERT INTO `tb_exemplares` (`id_exemplar`, `livro`, `tipo_exemplar`) VALUES
('5ce9ec32a7f00.pdf', 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_livros`
--

CREATE TABLE `tb_livros` (
  `id_livro` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `isbn` varchar(45) NOT NULL,
  `edicao` varchar(45) DEFAULT NULL,
  `ano` year(4) NOT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `categoria` int(11) NOT NULL,
  `editora` int(11) NOT NULL,
  `descricao` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_livros`
--

INSERT INTO `tb_livros` (`id_livro`, `titulo`, `isbn`, `edicao`, `ano`, `imagem`, `categoria`, `editora`, `descricao`) VALUES
(1, 'Java: como programar', '978-85-4301-905-5', '10Âª EdiÃ§Ã£o', 2001, '5ce968c34f89c.jpg', 1, 1, 'MilhÃµes de alunos e profissionais aprenderam programaÃ§Ã£o e desenvolvimento de software com os livros DeitelÂ®. Java: como programar, 10Âª ediÃ§Ã£o, fornece uma introduÃ§Ã£o clara, simples, envolvente e divertida Ã  programaÃ§Ã£o Java com Ãªnfase inicial em objetos. Destaques incluem: rica cobertura dos fundamentos com exemplos reais; apresentaÃ§Ã£o com Ãªnfase inicial em classes e objetos; uso com Javaâ„¢ SE 7, Javaâ„¢ SE 8 ou ambos; Javaâ„¢ SE 8 abordado em seÃ§Ãµes modulares opcionais; lambdas, fluxos e interfaces funcionais usando mÃ©todos padrÃ£o e estÃ¡ticos do Java SE 8; Swing e GUI do JavaFX: elementos grÃ¡ficos e multimÃ­dia; conjunto de exercÃ­cios \"\"Fazendo a diferenÃ§a\"\"; tratamento de exceÃ§Ãµes integrado; arquivos, fluxos e serializaÃ§Ã£o de objetos; concorrÃªncia para melhor desempenho com multiprocessamento; o livro contÃ©m o conteÃºdo principal para cursos introdutÃ³rios; outros tÃ³picos: recursÃ£o, pesquisa, classificaÃ§Ã£o, coleÃ§Ãµes genÃ©ricas, estruturas de dados, multithreading, banco de dados (JDBC â„¢ e JPA).'),
(2, 'Guia PrÃ¡tico do Servidor Linux: AdministraÃ§Ã£o Linux para Iniciantes', '978-85-94188-78-6', '1Âª EdiÃ§Ã£o', 2018, '5ce9e8c1ab08f.jpg', 1, 2, 'O Linux Ã© o sistema operacional mais seguro que vocÃª poderÃ¡ ter em mÃ£os. Empresas como a Dell, Asus e Acer produzem regularmente computadores que utilizam o Linux. JÃ¡ grandes empresas, como IBM e Google, utilizam-no como estratÃ©gia em seus ambientes corporativos. Hoje, praticamente toda a infraestrutura da internet atua sobre o sistema do pinguim. Conhecer e utilizar o Linux para qualquer pessoa que pretende se tornar um profissional em TI nÃ£o Ã© uma questÃ£o opcional, Ã© um prÃ©-requisito.\r\n\r\nEste livro tem como objetivo formar profissionais na AdministraÃ§Ã£o de servidores GNU/Linux. Juliano Ramos mostra como se introduzir no sistema Linux desde o primeiro contato, iniciando pelos comandos bÃ¡sicos e finalizando com servidores. VocÃª verÃ¡ na prÃ¡tica como trabalhar pelo shell script, conhecerÃ¡ servidores como o SSH, RAID, Apache, Proxy, entre outros, alÃ©m de lidar com redes, mÃ³dulos e particionamento de disco.'),
(3, 'IntroduÃ§Ã£o a Sistemas de Bancos de Dados', '978-85-352-8445-4', '8Âª EdiÃ§Ã£o', 2004, '5ce9eeedc6c69.jpg', 1, 1, 'IntroduÃ§Ã£o a Sistemas de Bancos de Dados, Oitava EdiÃ§Ã£o, oferece uma introduÃ§Ã£o completa ao vasto campo de sistemas de bancos de dados.O livro apresenta uma base sÃ³lida sobre os alicerces da tecnologia de bancos de dados, ao mesmo tempo em que esclarece como o campo deve se desenvolver no futuro.Esta nova ediÃ§Ã£o foi revista e atualizada com as tendÃªncias e desenvolvimentos dos sistemas de bancos de dados.Este livro aborda os seguintes assuntos:VisÃ£o geral do gerenciamento de bancos de dados, Arquitetura de sistemas de bancos de dados, IntroduÃ§Ã£o aos bancos de dados relacionais, IntroduÃ§Ã£o Ã  SQL, Tipos, RelaÃ§Ãµes. CÃ¡lculo relacional, Integridade, VisÃµes, DependÃªncias funcionais, NormalizaÃ§Ã£o avanÃ§ada, Modelagem semÃ¢ntica, RecuperaÃ§Ã£o, ConcorrÃªncia, SeguranÃ§a, OtimizaÃ§Ã£o, Falta de informaÃ§Ãµes, HeranÃ§a de tipo, Bancos de dados distribuÃ­dos, Apoio Ã  decisÃ£o, Sistemas baseados em lÃ³gica, Sistemas baseados em lÃ³gica, Bancos de dados relacional/objeto, A World Wide Web e XML.'),
(4, 'IntegraÃ§Ã£o ContÃ­nua Com Jenkins: Automatize O Ciclo De Desenvolvimento, Testes E ImplantaÃ§Ã£o De AplicaÃ§Ãµes', '978-85-7522-723-7', '1Âª EdiÃ§Ã£o', 2019, '5cea17a1d0323.jpg', 1, 3, 'Neste livro, vocÃª entenderÃ¡ os conceitos e as diferenÃ§as entre Continuous Integration, Continuous Delivery e Continuous Deploy. ConhecerÃ¡ um caso de uso do Jenkins ao ser integrado com as ferramentas: Gogs, Maven, Nexus, SonarQube, Docker, Terraform e Shell Script. Esse conjunto de ferramentas permite automatizar um ciclo de desenvolvimento, testes e implantaÃ§Ã£o de uma aplicaÃ§Ã£o web. VocÃª tambÃ©m conhecerÃ¡ alguns conceitos prÃ³prios do Jenkins, aprenderÃ¡ a configurÃ¡-lo como cÃ³digo, alterar o tema, instalar plugins, gerenciar usuÃ¡rios, credenciais e escrever pipelines. Para ler e praticar os conhecimentos compartilhados neste livro nÃ£o Ã© necessÃ¡rio nenhum conhecimento prÃ©vio sobre Jenkins; o pÃºblico-alvo sÃ£o estudantes da Ã¡rea de Tecnologia da InformaÃ§Ã£o, administradores de sistemas, administradores de rede, desenvolvedores e gerentes.'),
(5, 'Engenharia de Software: Uma Abordagem Profissional', '978-85-8055-534-9', '8Âª EdiÃ§Ã£o', 2016, '5cea184799fc5.jpg', 1, 4, 'Com mais de trÃªs dÃ©cadas de lideranÃ§a de mercado, Engenharia de Software chega Ã  sua 8Âª ediÃ§Ã£o como o mais abrangente guia sobre essa importante Ã¡rea.Totalmente revisada e reestruturada, esta nova ediÃ§Ã£o foi amplamente atualizada para incluir os novos tÃ³picos da â€œengenharia do sÃ©culo 21â€. CapÃ­tulos inÃ©ditos abordam a seguranÃ§a de software e os desafios especÃ­ficos ao desenvolvimento para aplicativos mÃ³veis. ConteÃºdos novos tambÃ©m foram incluÃ­dos em capÃ­tulos existentes, e caixas de texto informativas e conteÃºdos auxiliares foram expandidos, deixando este guia ainda mais prÃ¡tico para uso em sala de aula e em estudos autodidatas.'),
(6, 'Implantando a GovernanÃ§a de TI. Da EstratÃ©gia Ã  GestÃ£o de Processos e ServiÃ§os ', '978-85-7452-658-4', '4Âª EdiÃ§Ã£o', 2014, '5cea19549d025.jpg', 1, 6, 'Este livro apresenta uma visÃ£o integrada e inovadora de GovernanÃ§a de TI que pode ser adaptada para vÃ¡rios ambientes organizacionais.\r\nA partir de um modelo genÃ©rico, os autores detalham as etapas de planejamento, implementaÃ§Ã£o e gestÃ£o da GovernanÃ§a de TI, abrangendo desde o plano do Programa de GovernanÃ§a de TI, passando pelo alinhamento estratÃ©gico da TI ao negÃ³cio, a elaboraÃ§Ã£o do PortfÃ³lio de TI, as operaÃ§Ãµes de serviÃ§os de TI, os modelos de relacionamento com usuÃ¡rios e fornecedores e, por fim, a gestÃ£o do desempenho e do valor da TI.\r\nNesta nova ediÃ§Ã£o sÃ£o analisados as caracterÃ­sticas e os benefÃ­cios de mais de 30 modelos de melhores prÃ¡ticas que podem ser aplicados aos processos de TI, dentre eles: CobiT, ITIL, ISO/IEC 20000, USMBOK, os principais modelos do PMI (PMBOK, GestÃ£o de PortfÃ³lio e GestÃ£o de Programas), PRINCE2, ISO 27001 e 27002, eSCM-SP e eSCM-CL, CMMI, MPS-Br, BPM CBOK, BABOK, BSC, Seis Sigma e outros modelos. AlÃ©m disso, mostra os modelos agrupados por disciplina e representa de forma clara o relacionamento entre os modelos de melhores prÃ¡ticas.\r\nEsta ediÃ§Ã£o traz tambÃ©m capÃ­tulos especÃ­ficos acerca do impacto de tecnologias emergentes sobre a GovernanÃ§a de TI, da sua utilizaÃ§Ã£o em pequenas e mÃ©dias empresas e no Governo e estÃ¡ enriquecida com os resultados obtidos em alguns cases do mercado brasileiro.'),
(7, 'ITIL - guia de implantaÃ§Ã£o', '978-85-352-6854-6', '1Âª EdiÃ§Ã£o', 2013, '5cea19d403218.jpg', 1, 5, 'O material que vocÃª encontrarÃ¡ neste livro Ã© resultado de uma experiÃªncia de mais de 25 anos na Ã¡rea de suporte a usuÃ¡rios. Fundamentado por sua experiÃªncia como analista de suporte, coordenador de equipes, consultor, instrutor, projetista de ferramentas para atendimento a usuÃ¡rios e empresÃ¡rio ligado ao setor, o autor pretende retransmitir ao leitor, no formato de â€œliÃ§Ãµes aprendidasâ€, centenas de aprendizados que acumulou ao longo dos anos. SÃ£o experiÃªncias em ambientes de pequeno, mÃ©dio e grande portes, empresas pÃºblicas e privadas, antes, durante e apÃ³s o advento da adoÃ§Ã£o das melhores prÃ¡ticas de gestÃ£o de serviÃ§os de TI. A diferenÃ§a entre saber o que fazer e saber como fazer nunca foi tÃ£o importante. Se vocÃª jÃ¡ tem o conhecimento teÃ³rico sobre gestÃ£o de serviÃ§os de TI, usando a ITIL ou nÃ£o, terÃ¡ entÃ£o neste material uma grande fonte de informaÃ§Ã£o sobre como aplicar na prÃ¡tica tudo o que jÃ¡ conhece. Um guia definitivo? Jamais. Mas um bom comeÃ§o, sem dÃºvida. Com uma abordagem bem humorada e cheia de analogias, ITIL â€“ GUIA DE IMPLANTAÃ‡ÃƒO lhe mostrarÃ¡ centenas de exemplos nos quais as estratÃ©gias sugeridas tem seu embasamento. Prepare-se para aplicar todos os conceitos que jÃ¡ absorveu atÃ© agora, com uma visÃ£o realmente inovadora para o assunto. EsqueÃ§a todos os livros de revisÃ£o de conceitos que jÃ¡ viu. Aqui, o que vocÃª verÃ¡ sÃ£o as melhores prÃ¡ticas colocadas em prÃ¡tica.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_livros_autores`
--

CREATE TABLE `tb_livros_autores` (
  `id_livro_autor` int(11) NOT NULL,
  `livro` int(11) NOT NULL,
  `autor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(255) NOT NULL,
  `grupo` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_autores`
--
ALTER TABLE `tb_autores`
  ADD PRIMARY KEY (`id_autor`);

--
-- Indexes for table `tb_categorias`
--
ALTER TABLE `tb_categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `tb_editoras`
--
ALTER TABLE `tb_editoras`
  ADD PRIMARY KEY (`id_editora`);

--
-- Indexes for table `tb_emprestimos`
--
ALTER TABLE `tb_emprestimos`
  ADD PRIMARY KEY (`exemplar`,`usuario`,`data_emprestimo`),
  ADD KEY `fk_tb_exemplar_has_tb_pessoa_tb_pessoa1_idx` (`usuario`),
  ADD KEY `fk_tb_exemplar_has_tb_pessoa_tb_exemplar1_idx` (`exemplar`);

--
-- Indexes for table `tb_exemplares`
--
ALTER TABLE `tb_exemplares`
  ADD PRIMARY KEY (`id_exemplar`),
  ADD KEY `fk_tb_exemplar_tb_livro1_idx` (`livro`);

--
-- Indexes for table `tb_livros`
--
ALTER TABLE `tb_livros`
  ADD PRIMARY KEY (`id_livro`),
  ADD UNIQUE KEY `isbn_UNIQUE` (`isbn`),
  ADD KEY `fk_tb_livro_tb_categoria1_idx` (`categoria`),
  ADD KEY `fk_tb_livro_tb_editora1_idx` (`editora`);

--
-- Indexes for table `tb_livros_autores`
--
ALTER TABLE `tb_livros_autores`
  ADD PRIMARY KEY (`id_livro_autor`),
  ADD KEY `fk_livros_autores_autores_idx` (`autor`),
  ADD KEY `fk_livros_autores_livros_idx` (`livro`);

--
-- Indexes for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_autores`
--
ALTER TABLE `tb_autores`
  MODIFY `id_autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_categorias`
--
ALTER TABLE `tb_categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_editoras`
--
ALTER TABLE `tb_editoras`
  MODIFY `id_editora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_livros`
--
ALTER TABLE `tb_livros`
  MODIFY `id_livro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_livros_autores`
--
ALTER TABLE `tb_livros_autores`
  MODIFY `id_livro_autor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_emprestimos`
--
ALTER TABLE `tb_emprestimos`
  ADD CONSTRAINT `fk_emprestimos_exemplares` FOREIGN KEY (`exemplar`) REFERENCES `tb_exemplares` (`id_exemplar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_emprestimos_usuarios` FOREIGN KEY (`usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_exemplares`
--
ALTER TABLE `tb_exemplares`
  ADD CONSTRAINT `fk_exemplares_livros` FOREIGN KEY (`livro`) REFERENCES `tb_livros` (`id_livro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_livros`
--
ALTER TABLE `tb_livros`
  ADD CONSTRAINT `fk_livros_categorias` FOREIGN KEY (`categoria`) REFERENCES `tb_categorias` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_livros_editoras` FOREIGN KEY (`editora`) REFERENCES `tb_editoras` (`id_editora`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_livros_autores`
--
ALTER TABLE `tb_livros_autores`
  ADD CONSTRAINT `fk_livros_autores_autores` FOREIGN KEY (`autor`) REFERENCES `tb_autores` (`id_autor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_livros_autores_livros` FOREIGN KEY (`livro`) REFERENCES `tb_livros` (`id_livro`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
