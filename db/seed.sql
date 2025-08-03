-- Seed data for EduManager
INSERT INTO niveis_ensino (nome) VALUES
('Primário'),
('Médio'),
('Técnico'),
('Técnico de Saúde'),
('Superior');

-- Courses for Angola
INSERT INTO cursos (nivel_id, nome, duracao_anos, descricao) VALUES
(1, 'Educação Geral 1ª a 6ª classe', 6, 'Ensino primário'),
(2, 'Ciências Físicas e Biológicas', 3, null),
(2, 'Ciências Económicas e Jurídicas', 3, null),
(2, 'Ciências Humanas', 3, null),
(2, 'Ciências Matemáticas', 3, null),
(2, 'Formação de Professores', 3, null),
(2, 'Letras', 3, null),
(2, 'Pedagogia', 3, null),
(2, 'Informática', 3, null),
(3, 'Técnico de Informática', 3, null),
(3, 'Técnico de Contabilidade', 3, null),
(3, 'Técnico de Administração', 3, null),
(3, 'Técnico de Construção Civil', 3, null),
(3, 'Técnico de Mecânica', 3, null),
(3, 'Técnico de Eletricidade', 3, null),
(3, 'Técnico de Marketing', 3, null),
(3, 'Técnico de Estatística', 3, null),
(3, 'Técnico de Secretariado Executivo', 3, null),
(4, 'Enfermagem Geral', 3, null),
(4, 'Laboratório Clínico', 3, null),
(4, 'Farmácia', 3, null),
(4, 'Saúde Pública', 3, null),
(4, 'Radiologia', 3, null),
(4, 'Nutrição', 3, null),
(5, 'Engenharia Informática', 5, null),
(5, 'Engenharia Civil', 5, null),
(5, 'Engenharia Eletrotécnica', 5, null),
(5, 'Medicina', 6, null),
(5, 'Direito', 5, null),
(5, 'Psicologia', 4, null),
(5, 'Ciências da Educação', 4, null),
(5, 'Gestão de Empresas', 4, null),
(5, 'Economia', 4, null),
(5, 'Arquitetura', 5, null),
(5, 'Comunicação Social', 4, null),
(5, 'Engenharia Mecânica', 5, null),
(5, 'Engenharia Química', 5, null),
(5, 'Sociologia', 4, null),
(5, 'Administração Pública', 4, null);

-- Sample users
INSERT INTO usuarios (id, nome, bi, senha, tipo, ativo) VALUES
('11111111-1111-1111-1111-111111111111','Administrador','000000000AB000',crypt('123456', gen_salt('bf')),'admin',true),
('22222222-2222-2222-2222-222222222222','Professor Demo','000000000AB001',crypt('123456', gen_salt('bf')),'professor',true),
('33333333-3333-3333-3333-333333333333','Aluno Demo','000000000AB002',crypt('123456', gen_salt('bf')),'aluno',true);

-- Sample teacher profile
INSERT INTO professores (id, usuario_id, especialidade, grau_academico, bi_professor, numero_agente, data_admissao, situacao_profissional)
VALUES ('44444444-4444-4444-4444-444444444444','22222222-2222-2222-2222-222222222222','Matemática','Licenciatura','111111111LA045','AG12345','2020-01-10','efetivo');

-- Sample student profile
INSERT INTO alunos (usuario_id, data_nascimento, genero, nacionalidade)
VALUES ('33333333-3333-3333-3333-333333333333','2005-05-20','M','Angolana');

-- Sample discipline and class
INSERT INTO disciplinas (curso_id, professor_id, nome, carga_horaria, periodo, tipo)
VALUES ((SELECT id FROM cursos WHERE nome = 'Informática' LIMIT 1), '44444444-4444-4444-4444-444444444444', 'Algoritmos', 60, 1, 'obrigatória');

INSERT INTO turmas (curso_id, nome, ano_letivo, turno, sala, periodo_letivo)
VALUES ((SELECT id FROM cursos WHERE nome = 'Informática' LIMIT 1), '10A', '2024', 'manhã', 'Sala 1', 1);

UPDATE alunos SET turma_id = (SELECT id FROM turmas WHERE nome = '10A' LIMIT 1)
WHERE usuario_id = '33333333-3333-3333-3333-333333333333';

-- Sample evaluation and grade
INSERT INTO avaliacoes (id, turma_id, disciplina_id, professor_id, tipo, peso, data_aplicacao)
VALUES ('55555555-5555-5555-5555-555555555555',(SELECT id FROM turmas WHERE nome='10A'),(SELECT id FROM disciplinas WHERE nome='Algoritmos'),'44444444-4444-4444-4444-444444444444','teste',1,'2024-06-01');

INSERT INTO notas (avaliacao_id, aluno_id, nota, observacao)
VALUES ('55555555-5555-5555-5555-555555555555','33333333-3333-3333-3333-333333333333',15,'Boa prova');

-- Sample payment, receipt and invoice
INSERT INTO pagamentos (id, aluno_id, valor, status, metodo_pagamento, vencimento)
VALUES ('66666666-6666-6666-6666-666666666666','33333333-3333-3333-3333-333333333333',10000,'pendente','multicaixa','2024-07-10');

INSERT INTO agt_faturas (id, pagamento_id, nif, valor, xml_fiscal, status, hash_assinatura)
VALUES ('77777777-7777-7777-7777-777777777777','66666666-6666-6666-6666-666666666666','500000000',10000,'<xml>demo</xml>','emitida','hash123');

INSERT INTO recibos (id, pagamento_id, url_pdf, data_emissao, gerado_por)
VALUES ('99999999-9999-9999-9999-999999999999','66666666-6666-6666-6666-666666666666','https://example.com/recibo/demo.pdf',now(),'11111111-1111-1111-1111-111111111111');

-- Sample agenda event and notification
INSERT INTO agenda_eventos (id, professor_id, turma_id, titulo, tipo, data_inicio, data_fim, descricao)
VALUES ('88888888-8888-8888-8888-888888888888','44444444-4444-4444-4444-444444444444',(SELECT id FROM turmas WHERE nome='10A'),'Aula de Algoritmos','aula','2024-06-05 08:00','2024-06-05 10:00','Introdução');

INSERT INTO notificacoes (id, usuario_id, titulo, conteudo, tipo)
VALUES ('aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa','33333333-3333-3333-3333-333333333333','Bem-vindo','Sua matrícula foi registrada','sistema');

-- Sample message between admin and student
INSERT INTO mensagens (id, remetente_id, destinatario_id, conteudo)
VALUES ('cccccccc-cccc-cccc-cccc-cccccccccccc','11111111-1111-1111-1111-111111111111','33333333-3333-3333-3333-333333333333','Olá, bem-vindo ao sistema EduManager!');

-- Sample task and response
INSERT INTO tarefas (id, disciplina_id, turma_id, professor_id, titulo, descricao, data_entrega, peso, tipo)
VALUES ('bbbbbbbb-bbbb-bbbb-bbbb-bbbbbbbbbbbb',(SELECT id FROM disciplinas WHERE nome='Algoritmos'),(SELECT id FROM turmas WHERE nome='10A'),
'44444444-4444-4444-4444-444444444444','Trabalho 1','Implementar algoritmo de ordenação','2024-06-15',1,'trabalho');

INSERT INTO respostas_tarefas (tarefa_id, aluno_id, resposta_url)
VALUES ('bbbbbbbb-bbbb-bbbb-bbbb-bbbbbbbbbbbb','33333333-3333-3333-3333-333333333333','https://example.com/resposta.pdf');
