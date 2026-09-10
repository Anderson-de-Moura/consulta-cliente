CREATE TABLE IF NOT EXISTS empresas (
    id_empresa INT NOT NULL AUTO_INCREMENT,
    nome_empresa VARCHAR(150) NOT NULL,
    cnpj VARCHAR(20) NOT NULL UNIQUE,
    status_contrato ENUM('ativo', 'suspenso') NOT NULL DEFAULT 'ativo',
    data_cadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_empresa)
);

INSERT INTO empresas (nome_empresa, cnpj)
SELECT 'Empresa principal', '00.000.000/0001-00'
WHERE NOT EXISTS (SELECT 1 FROM empresas);

ALTER TABLE usuarios
    ADD COLUMN id_empresa INT NULL AFTER id_usuario;

UPDATE usuarios
SET id_empresa = (SELECT id_empresa FROM empresas ORDER BY id_empresa LIMIT 1)
WHERE nivel_acesso = 'cliente' AND id_empresa IS NULL;

ALTER TABLE usuarios
    MODIFY nivel_acesso ENUM('admin', 'cliente', 'master', 'empresa', 'operador') NOT NULL DEFAULT 'operador',
    MODIFY status_conta ENUM('ativo', 'bloqueado') NOT NULL DEFAULT 'ativo';

UPDATE usuarios SET nivel_acesso = 'master' WHERE nivel_acesso = 'admin';
UPDATE usuarios SET nivel_acesso = 'operador' WHERE nivel_acesso = 'cliente';

ALTER TABLE usuarios
    MODIFY nivel_acesso ENUM('master', 'empresa', 'operador') NOT NULL DEFAULT 'operador';

ALTER TABLE usuarios
    ADD CONSTRAINT fk_usuarios_empresa
    FOREIGN KEY (id_empresa) REFERENCES empresas (id_empresa)
    ON DELETE SET NULL;

