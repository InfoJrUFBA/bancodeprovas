USE mydb;

INSERT INTO areas (name) VALUES
('Ciências Físicas, Matemática e Tecnologia'),
('SCiências Biológicas e Profissões da Saúde'),
('Filosofia e Ciências Humanas'),
('Letras');

INSERT INTO courses (name, type, areas_id) VALUES
('Ciência da Computação', 1, 1),
('Sistemas de Informação', 1, 1),
('Matemática', 1, 1),
('História', 1, 3),
('Ciência da Computação', 4, 1),
('Ciência da Computação', 5, 1),
('Artes Cênicas', 1, 5),
('Física', 2, 1);
('Engenharia Mecânica', 2, 1);
('Engenharia Elétrica', 2, 1);
('Engenharia Química', 2, 1);
('Química', 2, 1),
('Biologia', 2, 1),
('Geografia', 1, 3),
('Sociologia', 1, 3),
('Psicologia'1,3) ,
('Arquivologia', 1 , 3)
('Filosofia', 1, 3);

INSERT INTO components (code, name) VALUES
('MATA01', 'Geometria Analítica'),
('MATA02', 'Cálculo A'),
('MATA48', 'Arquitetura de Computadores'),
('MATA07', 'Algebra Linear'),
('MATA07', 'Algebra Linear'),
('MATA47', 'Lógica para computação'),
('MATA97', 'Matemática Discreta II'),
('MATA37', 'Introdução a Lógica de Programação'),
('MATA39', 'Seminários de Introdução ao Curso'),
('MATA42', 'Matemática Discreta I');

INSERT INTO courses_has_components VALUES
(1,1),
(1,2),
(1,3),
(1,4),
(1,5);

INSERT INTO users (id, name, email, password , image, score, birthdate, level, courses_id, token, active) VALUES
(1, 'Clark', 'Clark@gmail.com', '$2y$10$.FYCA2kKJRWHXvI.5S5I7O9x99zUKIJ9O.HUVz6uVHMfy/Pp0EfOy', ' ', 0, '1111-11-11', 3, 1, '5d63146567e561112c4145832f3f5317', '1'),
(2, 'Valverde', 'danielevalverde27@gmail.com', '$2y$10$.FYCA2kKJRWHXvI.5S5I7O9x99zUKIJ9O.HUVz6uVHMfy/Pp0EfOy', '', 0, '1111-11-11', 5, 1, '5d63146567e561112c4145832f3f5317', '1'),
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
