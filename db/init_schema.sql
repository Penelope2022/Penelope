-- EduManager init_schema.sql
-- This script creates core tables for authentication, multi-school, and profiles.

-- Enable extensions as needed (PostgreSQL)
CREATE EXTENSION IF NOT EXISTS "uuid-ossp";
CREATE EXTENSION IF NOT EXISTS "pgcrypto";

-- 1. Owners table for SaaS multi-institution
CREATE TABLE proprietarios (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    nome TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    telefone TEXT,
    senha TEXT NOT NULL,
    criado_em TIMESTAMP WITH TIME ZONE DEFAULT now(),
    ultimo_login TIMESTAMP WITH TIME ZONE
);

-- 2. Schools table
CREATE TABLE escolas (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    proprietario_id UUID REFERENCES proprietarios(id) ON DELETE SET NULL,
    nome_oficial TEXT NOT NULL,
    categoria TEXT,
    nif TEXT,
    email TEXT,
    telefone TEXT,
    endereco TEXT,
    provincia TEXT,
    municipio TEXT,
    comuna TEXT,
    logotipo_url TEXT,
    status TEXT DEFAULT 'ativa',
    criado_em TIMESTAMP WITH TIME ZONE DEFAULT now()
);

-- 3. Plans and subscriptions
CREATE TABLE planos (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    nome TEXT NOT NULL,
    preco_mensal NUMERIC(10,2) DEFAULT 0,
    funcionalidades JSONB DEFAULT '[]'::jsonb,
    limite_usuarios INTEGER,
    limite_gb_armazenamento INTEGER,
    duracao_meses INTEGER,
    status TEXT DEFAULT 'ativo'
);

CREATE TABLE assinaturas (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    escola_id UUID REFERENCES escolas(id) ON DELETE CASCADE,
    plano_id UUID REFERENCES planos(id) ON DELETE SET NULL,
    status TEXT DEFAULT 'ativa',
    data_inicio DATE,
    data_fim DATE,
    metodo_pagamento TEXT,
    ultima_renovacao DATE,
    gateway_transacao_id TEXT
);

CREATE TABLE modulos_escola (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    escola_id UUID REFERENCES escolas(id) ON DELETE CASCADE,
    nome_modulo TEXT NOT NULL,
    liberado BOOLEAN DEFAULT false,
    liberado_por_assinatura BOOLEAN DEFAULT true
);

-- 4. Users
CREATE TABLE usuarios (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    escola_id UUID REFERENCES escolas(id) ON DELETE CASCADE,
    nome TEXT NOT NULL,
    bi TEXT UNIQUE NOT NULL,
    senha TEXT NOT NULL,
    tipo TEXT NOT NULL,
    email TEXT,
    telefone TEXT,
    ativo BOOLEAN DEFAULT true,
    ultimo_login TIMESTAMP WITH TIME ZONE,
    criado_em TIMESTAMP WITH TIME ZONE DEFAULT now(),
    atualizado_em TIMESTAMP WITH TIME ZONE DEFAULT now()
);

-- 5. Students
CREATE TABLE alunos (
    usuario_id UUID PRIMARY KEY REFERENCES usuarios(id) ON DELETE CASCADE,
    turma_id UUID,
    data_nascimento DATE,
    genero TEXT,
    nacionalidade TEXT,
    nome_pai TEXT,
    telefone_pai TEXT,
    nome_mae TEXT,
    telefone_mae TEXT,
    nome_encarregado TEXT,
    telefone_encarregado TEXT,
    grau_parentesco TEXT,
    provincia TEXT,
    municipio TEXT,
    comuna TEXT,
    endereco TEXT
);

-- 6. Teachers
CREATE TABLE professores (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    usuario_id UUID UNIQUE REFERENCES usuarios(id) ON DELETE CASCADE,
    especialidade TEXT,
    grau_academico TEXT,
    bi_professor TEXT UNIQUE,
    numero_agente TEXT,
    data_admissao DATE,
    situacao_profissional TEXT,
    provincia TEXT,
    municipio TEXT,
    comuna TEXT,
    endereco TEXT,
    carga_horaria_total INTEGER,
    turno TEXT,
    regime TEXT,
    salario_base NUMERIC(12,2),
    vinculo_escolar TEXT,
    cv_url TEXT,
    certificados_url TEXT,
    observacoes TEXT,
    criado_em TIMESTAMP WITH TIME ZONE DEFAULT now(),
    atualizado_em TIMESTAMP WITH TIME ZONE DEFAULT now()
);

-- 7. Login logs
CREATE TABLE logs_usuarios (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    usuario_id UUID REFERENCES usuarios(id) ON DELETE CASCADE,
    ip_address TEXT,
    navegador TEXT,
    sistema_operacional TEXT,
    dispositivo TEXT,
    user_agent TEXT,
    data_login TIMESTAMP WITH TIME ZONE DEFAULT now(),
    tipo_login TEXT,
    sucesso BOOLEAN,
    tentativa_falha BOOLEAN DEFAULT false,
    localizacao_aproximada TEXT,
    navegador_id TEXT,
    nota_de_alerta TEXT,
    evento TEXT
);

-- 8. Academic core tables
CREATE TABLE niveis_ensino (
    id SERIAL PRIMARY KEY,
    nome TEXT NOT NULL
);

CREATE TABLE cursos (
    id SERIAL PRIMARY KEY,
    nivel_id INTEGER REFERENCES niveis_ensino(id) ON DELETE CASCADE,
    nome TEXT NOT NULL,
    duracao_anos INTEGER,
    descricao TEXT,
    ativo BOOLEAN DEFAULT true
);

CREATE TABLE disciplinas (
    id SERIAL PRIMARY KEY,
    curso_id INTEGER REFERENCES cursos(id) ON DELETE CASCADE,
    professor_id UUID REFERENCES professores(id) ON DELETE SET NULL,
    nome TEXT NOT NULL,
    carga_horaria INTEGER,
    periodo INTEGER,
    tipo TEXT
);

CREATE TABLE turmas (
    id SERIAL PRIMARY KEY,
    curso_id INTEGER REFERENCES cursos(id) ON DELETE CASCADE,
    nome TEXT NOT NULL,
    ano_letivo TEXT,
    turno TEXT,
    sala TEXT,
    periodo_letivo INTEGER
);

-- Academic progress and finance tables
CREATE TABLE avaliacoes (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    turma_id INTEGER REFERENCES turmas(id) ON DELETE CASCADE,
    disciplina_id INTEGER REFERENCES disciplinas(id) ON DELETE CASCADE,
    professor_id UUID REFERENCES professores(id) ON DELETE SET NULL,
    tipo TEXT,
    peso NUMERIC,
    data_aplicacao DATE,
    descricao TEXT
);

CREATE TABLE notas (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    avaliacao_id UUID REFERENCES avaliacoes(id) ON DELETE CASCADE,
    aluno_id UUID REFERENCES alunos(usuario_id) ON DELETE CASCADE,
    nota NUMERIC,
    observacao TEXT,
    registrada_em TIMESTAMP WITH TIME ZONE DEFAULT now()
);

CREATE TABLE pagamentos (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    aluno_id UUID REFERENCES alunos(usuario_id) ON DELETE CASCADE,
    valor NUMERIC,
    status TEXT,
    metodo_pagamento TEXT,
    vencimento DATE,
    pago_em DATE,
    referencia TEXT
);

CREATE TABLE recibos (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    pagamento_id UUID REFERENCES pagamentos(id) ON DELETE CASCADE,
    url_pdf TEXT,
    data_emissao TIMESTAMP WITH TIME ZONE DEFAULT now(),
    gerado_por UUID REFERENCES usuarios(id) ON DELETE SET NULL
);

CREATE TABLE agt_faturas (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    pagamento_id UUID REFERENCES pagamentos(id) ON DELETE CASCADE,
    nif TEXT,
    valor NUMERIC,
    xml_fiscal TEXT,
    status TEXT,
    hash_assinatura TEXT,
    motivo_erro TEXT,
    criado_em TIMESTAMP WITH TIME ZONE DEFAULT now()
);

CREATE TABLE agenda_eventos (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    professor_id UUID REFERENCES professores(id) ON DELETE CASCADE,
    turma_id INTEGER REFERENCES turmas(id) ON DELETE CASCADE,
    titulo TEXT,
    tipo TEXT,
    data_inicio TIMESTAMP WITH TIME ZONE,
    data_fim TIMESTAMP WITH TIME ZONE,
    descricao TEXT
);

CREATE TABLE notificacoes (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    usuario_id UUID REFERENCES usuarios(id) ON DELETE CASCADE,
    titulo TEXT,
    conteudo TEXT,
    tipo TEXT,
    lida BOOLEAN DEFAULT false,
    criada_em TIMESTAMP WITH TIME ZONE DEFAULT now()
);

-- Messaging between users
CREATE TABLE mensagens (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    remetente_id UUID REFERENCES usuarios(id) ON DELETE CASCADE,
    destinatario_id UUID REFERENCES usuarios(id) ON DELETE CASCADE,
    conteudo TEXT NOT NULL,
    enviado_em TIMESTAMP WITH TIME ZONE DEFAULT now(),
    lido_em TIMESTAMP WITH TIME ZONE
);

-- Additional tables for future modules should follow similar structure.

-- RPC: returns the user type based on BI
CREATE OR REPLACE FUNCTION verificar_perfil(p_bi TEXT)
RETURNS TEXT AS $$
DECLARE v_tipo TEXT;
BEGIN
    SELECT tipo INTO v_tipo FROM usuarios WHERE bi = p_bi;
    RETURN v_tipo;
END;
$$ LANGUAGE plpgsql SECURITY DEFINER;

-- RPC: update user password if old password matches
CREATE OR REPLACE FUNCTION atualizar_senha(p_bi TEXT, p_senha_antiga TEXT, p_nova_senha TEXT)
RETURNS BOOLEAN AS $$
DECLARE v_hash TEXT;
BEGIN
    SELECT senha INTO v_hash FROM usuarios WHERE bi = p_bi;
    IF NOT FOUND THEN
        RETURN FALSE;
    END IF;
    IF crypt(p_senha_antiga, v_hash) <> v_hash THEN
        RETURN FALSE;
    END IF;
    UPDATE usuarios
       SET senha = crypt(p_nova_senha, gen_salt('bf')), atualizado_em = now()
     WHERE bi = p_bi;
    RETURN TRUE;
END;
$$ LANGUAGE plpgsql SECURITY DEFINER;

-- RPC: register login attempt
CREATE OR REPLACE FUNCTION registrar_login(
    p_usuario_id UUID,
    p_sucesso BOOLEAN,
    p_ip TEXT,
    p_navegador TEXT,
    p_so TEXT,
    p_dispositivo TEXT,
    p_user_agent TEXT
)
RETURNS VOID AS $$
BEGIN
    INSERT INTO logs_usuarios(usuario_id, sucesso, ip_address, navegador, sistema_operacional, dispositivo, user_agent)
    VALUES (p_usuario_id, p_sucesso, p_ip, p_navegador, p_so, p_dispositivo, p_user_agent);
END;
$$ LANGUAGE plpgsql SECURITY DEFINER;

-- RPC: generate student's grade report
CREATE OR REPLACE FUNCTION gerar_boletim(p_aluno UUID)
RETURNS TABLE(disciplina TEXT, nota NUMERIC) AS $$
BEGIN
    RETURN QUERY
    SELECT d.nome, n.nota
    FROM notas n
    JOIN avaliacoes a ON n.avaliacao_id = a.id
    JOIN disciplinas d ON a.disciplina_id = d.id
    WHERE n.aluno_id = p_aluno;
END;
$$ LANGUAGE plpgsql SECURITY DEFINER;

-- RPC: create receipt for a payment
CREATE OR REPLACE FUNCTION emitir_recibo(p_pagamento UUID)
RETURNS TABLE(id UUID, pagamento_id UUID, url_pdf TEXT, data_emissao TIMESTAMP WITH TIME ZONE, gerado_por UUID) AS $$
BEGIN
    RETURN QUERY
    INSERT INTO recibos(pagamento_id, url_pdf, gerado_por)
    VALUES (p_pagamento, 'https://example.com/recibo/' || p_pagamento, NULL)
    RETURNING id, pagamento_id, url_pdf, data_emissao, gerado_por;
END;
$$ LANGUAGE plpgsql SECURITY DEFINER;

-- RPC: create notification for a user
CREATE OR REPLACE FUNCTION notificar(p_usuario UUID, p_titulo TEXT, p_conteudo TEXT, p_tipo TEXT)
RETURNS notificacoes AS $$
DECLARE v_notif notificacoes%ROWTYPE;
BEGIN
    INSERT INTO notificacoes(usuario_id, titulo, conteudo, tipo)
    VALUES (p_usuario, p_titulo, p_conteudo, p_tipo)
    RETURNING * INTO v_notif;
    RETURN v_notif;
END;
$$ LANGUAGE plpgsql SECURITY DEFINER;

-- RPC: send a message between users
CREATE OR REPLACE FUNCTION enviar_mensagem(p_remetente UUID, p_destinatario UUID, p_conteudo TEXT)
RETURNS mensagens AS $$
DECLARE v_msg mensagens%ROWTYPE;
BEGIN
    INSERT INTO mensagens(remetente_id, destinatario_id, conteudo)
    VALUES (p_remetente, p_destinatario, p_conteudo)
    RETURNING * INTO v_msg;
    RETURN v_msg;
END;
$$ LANGUAGE plpgsql SECURITY DEFINER;

-- RPC: list messages for a user
CREATE OR REPLACE FUNCTION listar_mensagens(p_usuario UUID)
RETURNS SETOF mensagens AS $$
BEGIN
    RETURN QUERY
    SELECT * FROM mensagens
     WHERE remetente_id = p_usuario OR destinatario_id = p_usuario
     ORDER BY enviado_em DESC;
END;
$$ LANGUAGE plpgsql SECURITY DEFINER;

-- RPC: get agenda events for a professor
CREATE OR REPLACE FUNCTION get_agenda_professor(p_professor UUID)
RETURNS SETOF agenda_eventos AS $$
BEGIN
    RETURN QUERY SELECT * FROM agenda_eventos WHERE professor_id = p_professor ORDER BY data_inicio;
END;
$$ LANGUAGE plpgsql SECURITY DEFINER;

-- RPC: generate fiscal invoice and payment
CREATE OR REPLACE FUNCTION gerar_fatura_agt(p_nif TEXT, p_aluno UUID, p_valor NUMERIC)
RETURNS agt_faturas AS $$
DECLARE v_pagamento UUID;
DECLARE v_fatura agt_faturas%ROWTYPE;
BEGIN
    INSERT INTO pagamentos(aluno_id, valor, status)
    VALUES (p_aluno, p_valor, 'pendente') RETURNING id INTO v_pagamento;
    INSERT INTO agt_faturas(pagamento_id, nif, valor, xml_fiscal, status, hash_assinatura)
    VALUES (v_pagamento, p_nif, p_valor, '<xml>simulado</xml>', 'emitida', md5(random()::text))
    RETURNING * INTO v_fatura;
    RETURN v_fatura;
END;
$$ LANGUAGE plpgsql SECURITY DEFINER;

-- Tasks and homework tables
CREATE TABLE tarefas (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    disciplina_id INTEGER REFERENCES disciplinas(id) ON DELETE CASCADE,
    turma_id INTEGER REFERENCES turmas(id) ON DELETE CASCADE,
    professor_id UUID REFERENCES professores(id) ON DELETE SET NULL,
    titulo TEXT NOT NULL,
    descricao TEXT,
    data_entrega DATE,
    data_publicacao TIMESTAMP WITH TIME ZONE DEFAULT now(),
    peso NUMERIC,
    tipo TEXT,
    arquivo_url TEXT,
    avaliacao_id UUID REFERENCES avaliacoes(id) ON DELETE SET NULL
);

CREATE TABLE respostas_tarefas (
    id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    tarefa_id UUID REFERENCES tarefas(id) ON DELETE CASCADE,
    aluno_id UUID REFERENCES alunos(usuario_id) ON DELETE CASCADE,
    resposta_url TEXT,
    nota NUMERIC,
    comentario_professor TEXT,
    data_envio TIMESTAMP WITH TIME ZONE DEFAULT now(),
    avaliada_em TIMESTAMP WITH TIME ZONE
);

-- RPC: list tasks for a class
CREATE OR REPLACE FUNCTION listar_tarefas_por_turma(p_turma INTEGER)
RETURNS SETOF tarefas AS $$
BEGIN
    RETURN QUERY SELECT * FROM tarefas WHERE turma_id = p_turma ORDER BY data_entrega;
END;
$$ LANGUAGE plpgsql SECURITY DEFINER;

-- RPC: student submits task response
CREATE OR REPLACE FUNCTION responder_tarefa(p_tarefa UUID, p_aluno UUID, p_url TEXT)
RETURNS respostas_tarefas AS $$
DECLARE v_resp respostas_tarefas%ROWTYPE;
BEGIN
    INSERT INTO respostas_tarefas(tarefa_id, aluno_id, resposta_url)
    VALUES (p_tarefa, p_aluno, p_url)
    RETURNING * INTO v_resp;
    RETURN v_resp;
END;
$$ LANGUAGE plpgsql SECURITY DEFINER;

-- RPC: teacher grades task response
CREATE OR REPLACE FUNCTION avaliar_resposta_tarefa(p_tarefa UUID, p_aluno UUID, p_nota NUMERIC, p_comentario TEXT)
RETURNS respostas_tarefas AS $$
DECLARE v_resp respostas_tarefas%ROWTYPE;
BEGIN
    UPDATE respostas_tarefas
       SET nota = p_nota,
           comentario_professor = p_comentario,
           avaliada_em = now()
     WHERE tarefa_id = p_tarefa AND aluno_id = p_aluno
    RETURNING * INTO v_resp;
    RETURN v_resp;
END;
$$ LANGUAGE plpgsql SECURITY DEFINER;
