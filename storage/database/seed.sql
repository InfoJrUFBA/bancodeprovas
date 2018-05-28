-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 28/05/2018 às 15:10
-- Versão do servidor: 5.7.22-0ubuntu0.16.04.1
-- Versão do PHP: 7.0.30-0ubuntu0.16.04.1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mydb`
--

--
-- Tabela truncada antes do insert `areas`
--

TRUNCATE TABLE `areas`;
--
-- Fazendo dump de dados para tabela `areas`
--

INSERT INTO `areas` (`id`, `name`) VALUES
(1, 'Ciências Físicas, Matemática e Tecnologia'),
(2, 'SCiências Biológicas e Profissões da Saúde'),
(3, 'Filosofia e Ciências Humanas'),
(4, 'Letras');

--
-- Tabela truncada antes do insert `components`
--

TRUNCATE TABLE `components`;
--
-- Fazendo dump de dados para tabela `components`
--

INSERT INTO `components` (`id`, `code`, `name`) VALUES
(1, 'MATA01', 'Geometria Analítica'),
(2, 'MATA02', 'Cálculo A'),
(3, 'MATA48', 'Arquitetura de Computadores'),
(4, 'MATA07', 'Algebra Linear'),
(5, 'MATA07', 'Algebra Linear'),
(6, 'MATA47', 'Lógica para computação'),
(7, 'MATA97', 'Matemática Discreta II'),
(8, 'MATA37', 'Introdução a Lógica de Programação'),
(9, 'MATA39', 'Seminários de Introdução ao Curso'),
(10, 'MATA42', 'Matemática Discreta I');

--
-- Tabela truncada antes do insert `courses`
--

TRUNCATE TABLE `courses`;
--
-- Fazendo dump de dados para tabela `courses`
--

INSERT INTO `courses` (`id`, `name`, `type`, `areas_id`) VALUES
(1, 'Ciência da Computação', 1, 1),
(2, 'Sistemas de Informação', 1, 1),
(3, 'Matemática', 1, 1),
(4, 'História', 1, 3),
(5, 'Ciência da Computação', 4, 1),
(6, 'Ciência da Computação', 5, 1),
(7, 'Artes Cênicas', 1, 5),
(8, 'Física', 2, 1),
(9, 'Engenharia Mecânica', 2, 1),
(10, 'Engenharia Elétrica', 2, 1),
(11, 'Engenharia Química', 2, 1),
(12, 'Química', 2, 1),
(13, 'Biologia', 2, 1),
(14, 'Geografia', 1, 3),
(15, 'Sociologia', 1, 3),
(16, 'Psicologia', 1, 3),
(17, 'Arquivologia', 1, 3),
(18, 'Filosofia', 1, 3);

--
-- Tabela truncada antes do insert `courses_has_components`
--

TRUNCATE TABLE `courses_has_components`;
--
-- Fazendo dump de dados para tabela `courses_has_components`
--

INSERT INTO `courses_has_components` (`courses_id`, `components_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5);

--
-- Tabela truncada antes do insert `exams`
--

TRUNCATE TABLE `exams`;
--
-- Tabela truncada antes do insert `users`
--

TRUNCATE TABLE `users`;
--
-- Fazendo dump de dados para tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `score`, `birthdate`, `level`, `courses_id`, `token`, `active`) VALUES
(1, 'Clark', 'Clark@gmail.com', '$2y$10$.FYCA2kKJRWHXvI.5S5I7O9x99zUKIJ9O.HUVz6uVHMfy/Pp0EfOy', ' ', 0, '1111-11-11', 3, 1, '5d63146567e561112c4145832f3f5317', '1'),
(2, 'Valverde', 'danielevalverde27@gmail.com', '$2y$10$.FYCA2kKJRWHXvI.5S5I7O9x99zUKIJ9O.HUVz6uVHMfy/Pp0EfOy', '', 0, '1111-11-11', 5, 1, '5d63146567e561112c4145832f3f5313', '1'),
(3, 'Rafael Menezes', 'rafa@email.com', '$2y$10$unl2ik5skDuTK5G7fnEtpes3kAemiRM9dTFYB0ftPpKbcdm8RskFu', '', 0, '1998-12-11', 1, 7, '5928f763a4d623d16423df4efc7dbfac', '0'),
(4, 'Laura Rosa', 'lr@email.com', '$2y$10$1CVrP0knLFy72C2tTy62Iu5ZBIkjbTtaf3N.sMszIvMmUZRmGTQs.', '', 0, '1998-11-08', 1, 7, 'c34d62665b115c43c7c399b01ef7215eb', '0'),
(5, 'Kara', 'Kara@gmail.com', '$2y$10$.FYCA2kKJRWHXvI.5S5I7O9x99zUKIJ9O.HUVz6uVHMfy/Pp0EfO32', '', 0, '1111-11-11', 5, 1, '5d63146567e561112c4145832f3f5317a', '1'),
(6, 'Bruce', 'batman@gmail.com', '$2y$10$.FYCA2kKJRWHXvI.5S5I7O9x99zUKIJ9O.HUVz6uVHMfy/Pp0EfOy', '', 0, '1111-11-11', 5, 1, '5d63146567e561112c4145832f3f53170', '1'),
(7, 'Diana', 'Diana@gmail.com', '$2y$10$.FYCA2kKJRWHXvI.5S5I7O9x99zUKIJ9O.HUVz6uVHMfy/Pp0EfOy', '', 0, '1111-11-11', 5, 1, '5d63146567e561112c4145832f3f53179', '1'),
(8, 'Barry', 'Barry@gmail.com', '$2y$10$.FYCA2kKJRWHXvI.5S5I7O9x99zUKIJ9O.HUVz6uVHMfy/Pp0EfOy', '', 0, '1111-11-11', 1, 1, '5d63146567e561112c4145832f3f53178', '1'),
(9, 'Jonh', 'Jonh@gmail.com', '$2y$10$.FYCA2kKJRWHXvI.5S5I7O9x99zUKIJ9O.HUVz6uVHMfy/Pp0EfOy', '', 0, '1111-11-11', 5, 1, '5d63146567e561112c4145832f3f53177', '1'),
(10, 'Estelar', 'Estelar@gmail.com', '$2y$10$.FYCA2kKJRWHXvI.5S5I7O9x99zUKIJ9O.HUVz6uVHMfy/Pp0EfOy', '', 0, '1111-11-11', 5, 1, '5d63146567e561112c4145832f3f53176', '1'),
(11, 'Robin', 'Robin@gmail.com', '$2y$10$.FYCA2kKJRWHXvI.5S5I7O9x99zUKIJ9O.HUVz6uVHMfy/Pp0EfOy', '', 0, '1111-11-11', 5, 1, '5d63146567e561112c4145832f3f53175', '1'),
(12, 'Ravena', 'Ravena@gmail.com', '$2y$10$.FYCA2kKJRWHXvI.5S5I7O9x99zUKIJ9O.HUVz6uVHMfy/Pp0EfOy', '', 0, '1111-11-11', 5, 1, '5d63146567e561112c4145832f3f53174', '1'),
(13, 'Thor', 'Thor@gmail.com', '$2y$10$.FYCA2kKJRWHXvI.5S5I7O9x99zUKIJ9O.HUVz6uVHMfy/Pp0EfOy', '', 0, '1111-11-11', 5, 1, '5d63146567e561112c4145832f3f53173', '1'),
(14, 'Tony', 'Tony@gmail.com', '$2y$10$.FYCA2kKJRWHXvI.5S5I7O9x99zUKIJ9O.HUVz6uVHMfy/Pp0EfOy', '', 0, '1111-11-11', 5, 1, '5d63146567e561112c4145832f3f53172', '1'),
(15, 'Banner', 'Banner@gmail.com', '$2y$10$.FYCA2kKJRWHXvI.5S5I7O9x99zUKIJ9O.HUVz6uVHMfy/Pp0EfOy', '', 0, '1111-11-11', 5, 1, '5d63146567e561112c4145832f3f53171', '1');
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
