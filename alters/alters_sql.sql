    /*
     * Inicialmente as queries devem ser executadas manualmente
     * no editor de sql do seu banco.
    */

-- Criando a tabela clientes --
CREATE TABLE IF NOT EXISTS clientes (
    id_cliente INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    email_cliente VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
    senha_cliente VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
    nome_cliente VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
    endereco_cliente VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
    cidade_cliente VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
    telefone_cliente VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
    purl_cliente VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
    status_cliente TINYINT(4) NULL DEFAULT 0,
    data_cadastro DATETIME NULL DEFAULT current_timestamp(),
    data_modificacao DATETIME NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    data_delete DATETIME NULL DEFAULT NULL,
    PRIMARY KEY (id_cliente) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;