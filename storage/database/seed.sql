INSERT INTO areas (name) VALUES
('Ciências Físicas, Matemática e Tecnologia'),
('Ciências Biológicas e Profissões da Saúde'),
('Filosofia e Ciências Humanas'),
('Letras'),
('Artes'),
('Bacharelados Interdisciplinares e Tecnólogos');

INSERT INTO courses (name, type, areas_id) VALUES
('Ciência da Computação', 1, 1),
('Sistemas de Informação', 1, 1),
('Matemática', 1, 1),
('História', 1, 3),
('Ciência da Computação', 4, 1),
('Ciência da Computação', 5, 1),
('Artes Cênicas', 1, 5),
('Física', 2, 1);

INSERT INTO components (code, name) VALUES
('MATA01', 'Geometria Analítica'),
('MATA02', 'Cálculo A'),
('MATA37', 'Introdução a Lógica de Programação'),
('MATA39', 'Seminários de Introdução ao Curso'),
('MATA42', 'Matemática Discreta I');

INSERT INTO courses_has_components VALUES
(1,1),
(1,2),
(1,3),
(1,4),
(1,5);