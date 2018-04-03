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