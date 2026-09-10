CREATE TABLE IF NOT EXISTS consultas (
    id_consulta INT NOT NULL AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    cpf_hash CHAR(64) NOT NULL,
    cpf_mascarado VARCHAR(14) NOT NULL,
    justificativa_lgpd VARCHAR(50) NOT NULL,
    status_consulta ENUM('aguardando_integracao', 'concluida', 'erro') NOT NULL DEFAULT 'aguardando_integracao',
    data_consulta TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_consulta),
    KEY idx_consultas_usuario_data (id_usuario, data_consulta),
    CONSTRAINT fk_consultas_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario)
);