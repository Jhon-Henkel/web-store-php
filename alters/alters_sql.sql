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
    (1, 'homem', 'Tshirt Vermelha', 'Ab laborum, commodi aspernatur, quas distinctio cum quae omnis autem ea, odit sint quisquam similique! Labore aliquam amet veniam ad fugiat optio.', 'tshirt_vermelha.png', 45.70, 0, 1, '2021-02-06 19:45:18', '2021-02-06 19:45:25', NULL),
    (2, 'homem', 'Tshirt Azul', 'Possimus iusto esse atque autem rem, porro officiis sapiente quos velit laboriosam id expedita odio obcaecati voluptate repudiandae dignissimos eveniet repellat blanditiis.', 'tshirt_azul.png', 55.25, 100, 1, '2021-02-06 19:45:19', '2021-02-06 19:45:25', NULL),
    (3, 'homem', 'Tshirt Verde', 'Nostrum quisquam dolorum dolor autem accusamus fugit nesciunt, atque et? Quis eum nemo quidem officia cum dolorem voluptates! Autem, earum. Similique, fugit.', 'tshirt_verde.png', 35.15, 100, 1, '2021-02-06 19:45:20', '2021-02-06 19:45:26', NULL),
    (4, 'homem', 'Tshirt Amarela', 'Molestiae quaerat distinctio, facere perferendis necessitatibus optio repellat alias commodi voluptatem velit corrupti natus exercitationem quos amet facilis sint nulla delectus.', 'tshirt_amarela.png', 32.00, 100, 1, '2021-02-06 19:45:20', '2021-02-06 19:45:27', NULL),
    (5, 'mulher', 'Vestido Vermelho', 'Labore voluptatem sed in distinctio iste tempora quo assumenda impedit illo soluta repudiandae animi earum suscipit, sequi excepturi inventore magnam velit voluptatibus.', 'dress_vermelho.png', 75.20, 100, 1, '2021-02-06 19:45:21', '2021-02-06 19:45:27', NULL),
    (6, 'mulher', 'Vertido Azul', 'Provident ipsum earum magnam odit in, illum nostrum est illo pariatur molestias esse delectus aliquam ullam maxime mollitia tempore, sunt officia suscipit.', 'dress_azul.png', 86.00, 100, 1, '2021-02-06 19:45:21', '2021-02-06 19:45:28', NULL),
    (7, 'mulher', 'Vestido Verde', 'Qui aliquid sed quisquam autem quas recusandae labore neque laudantium iusto modi repudiandae doloremque ipsam ad omnis inventore, cum ducimus praesentium. Consectetur!', 'dress_verde.png', 48.85, 100, 1, '2021-02-06 19:45:22', '2021-02-06 19:45:28', NULL),
    (8, 'mulher', 'Vestido Amarelo', 'Aspernatur labore corporis modi quis temporibus eos hic? Sed fugiat, repudiandae distinctio, labore temporibus, non magni consectetur dolorum earum amet impedit nesciunt.', 'dress_amarelo.png', 46.45, 100, 1, '2021-02-06 19:45:22', '2021-02-06 19:45:29', NULL);

-- Criando tabela pedidos --
CREATE TABLE IF NOT EXISTS pedidos (
    id_pedido int(10) unsigned NOT NULL AUTO_INCREMENT,
    id_cliente int(10) DEFAULT NULL,
    endereco_entrega varchar(250) DEFAULT NULL,
    data_pedido datetime DEFAULT NULL,
    cidade_entrega varchar(250) DEFAULT NULL,
    email_cliente varchar(250) DEFAULT NULL,
    telefone_cliente varchar(250) DEFAULT NULL,
    codido_pedido varchar(50) DEFAULT NULL,
    status_pedido int(4) DEFAULT NULL,
    observacoes varchar(250) DEFAULT NULL,
    created_at datetime DEFAULT NULL,
    updated_at datetime DEFAULT NULL,
    deleted_at datetime DEFAULT NULL,
    PRIMARY KEY (id_pedido)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Criando tabela pedidos_produtos --
CREATE TABLE IF NOT EXISTS pedidos_produtos (
    id_pedido_produto int(10) unsigned NOT NULL AUTO_INCREMENT,
    id_pedido int(10) DEFAULT NULL,
    nome_produto varchar(250) DEFAULT NULL,
    valor_unitario decimal (6, 2) DEFAULT NULL,
    quantidade int(10) DEFAULT NULL,
    created_at datetime DEFAULT NULL,
    PRIMARY KEY (id_pedido_produto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Criando tabela admin_login --
CREATE TABLE IF NOT EXISTS admin_login (
    id_admin int(10) auto_increment NOT NULL,
    usuario_admin varchar(100) NULL,
    senha_admin varchar(100) NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    deleted_at DATETIME NULL,
    PRIMARY KEY (id_admin)
    )
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Admin padrão user admin pass 1234--
INSERT INTO admin_login
    (usuario_admin, senha_admin, created_at, updated_at, deleted_at)
VALUES
    ('admin', '$2y$10$nz/shXc55Pa8awtfKVwfCuCyTs9N55tEBuHj3WjBCaMpWKcB8UtgW', '2022-07-14 23:08:58', NULL, NULL);
