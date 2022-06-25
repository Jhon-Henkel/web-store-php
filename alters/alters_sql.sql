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

-- Criando tabela produtos --
CREATE TABLE IF NOT EXISTS produtos (
    id_pdt int(10) unsigned NOT NULL AUTO_INCREMENT,
    categoria_pdt varchar(50) DEFAULT NULL,
    nome_pdt varchar(50) DEFAULT NULL,
    descricao_pdt varchar(200) DEFAULT NULL,
    imagem_pdt varchar(200) DEFAULT NULL,
    preco_pdt decimal(6,2) DEFAULT NULL,
    qtd_pdt_estoque int(11) DEFAULT NULL,
    status_pdt tinyint(4) DEFAULT NULL,
    created_at datetime DEFAULT NULL,
    updated_at datetime DEFAULT NULL,
    deleted_at datetime DEFAULT NULL,
    PRIMARY KEY (id_pdt)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert de produtos teste --
INSERT INTO produtos (id_pdt, categoria_pdt, nome_pdt, descricao_pdt, imagem_pdt, preco_pdt, qtd_pdt_estoque, status_pdt, created_at, updated_at, deleted_at) VALUES
    (1, 'homem', 'Tshirt Vermelha', 'Ab laborum, commodi aspernatur, quas distinctio cum quae omnis autem ea, odit sint quisquam similique! Labore aliquam amet veniam ad fugiat optio.', 'tshirt_vermelha.png', 45.70, 100, 1, '2021-02-06 19:45:18', '2021-02-06 19:45:25', NULL),
    (2, 'homem', 'Tshirt Azul', 'Possimus iusto esse atque autem rem, porro officiis sapiente quos velit laboriosam id expedita odio obcaecati voluptate repudiandae dignissimos eveniet repellat blanditiis.', 'tshirt_azul.png', 55.25, 100, 1, '2021-02-06 19:45:19', '2021-02-06 19:45:25', NULL),
    (3, 'homem', 'Tshirt Verde', 'Nostrum quisquam dolorum dolor autem accusamus fugit nesciunt, atque et? Quis eum nemo quidem officia cum dolorem voluptates! Autem, earum. Similique, fugit.', 'tshirt_verde.png', 35.15, 100, 1, '2021-02-06 19:45:20', '2021-02-06 19:45:26', NULL),
    (4, 'homem', 'Tshirt Amarela', 'Molestiae quaerat distinctio, facere perferendis necessitatibus optio repellat alias commodi voluptatem velit corrupti natus exercitationem quos amet facilis sint nulla delectus.', 'tshirt_amarela.png', 32.00, 100, 1, '2021-02-06 19:45:20', '2021-02-06 19:45:27', NULL),
    (5, 'mulher', 'Vestido Vermelho', 'Labore voluptatem sed in distinctio iste tempora quo assumenda impedit illo soluta repudiandae animi earum suscipit, sequi excepturi inventore magnam velit voluptatibus.', 'vestido_vermelho.png', 75.20, 100, 1, '2021-02-06 19:45:21', '2021-02-06 19:45:27', NULL),
    (6, 'mulher', 'Vertido Azul', 'Provident ipsum earum magnam odit in, illum nostrum est illo pariatur molestias esse delectus aliquam ullam maxime mollitia tempore, sunt officia suscipit.', 'vestido_azul.png', 86.00, 100, 1, '2021-02-06 19:45:21', '2021-02-06 19:45:28', NULL),
    (7, 'mulher', 'Vestido Verde', 'Qui aliquid sed quisquam autem quas recusandae labore neque laudantium iusto modi repudiandae doloremque ipsam ad omnis inventore, cum ducimus praesentium. Consectetur!', 'vestido_verde.png', 48.85, 100, 1, '2021-02-06 19:45:22', '2021-02-06 19:45:28', NULL),
    (8, 'mulher', 'Vestido Amarelo', 'Aspernatur labore corporis modi quis temporibus eos hic? Sed fugiat, repudiandae distinctio, labore temporibus, non magni consectetur dolorum earum amet impedit nesciunt.', 'vestido_amarelo.png', 46.45, 100, 1, '2021-02-06 19:45:22', '2021-02-06 19:45:29', NULL);
