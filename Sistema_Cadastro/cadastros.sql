set time_zone = "+00:00";

/*CREATE DATABASE cadastros;*/

DROP TABLE IF EXISTS `Usuarios`;
CREATE TABLE IF NOT EXISTS `Usuarios`(
    `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL,
    `permissao` VARCHAR(255) NOT NULL,
    `senha` VARCHAR(300) NOT NULL,
    `token` VARCHAR(300) NOT NULL
);

DROP TABLE IF EXISTS `Clientes`;
CREATE TABLE IF NOT EXISTS `Clientes`(
    `id_cliente` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `celular` VARCHAR(20) NOT NULL,
    `cidade` VARCHAR(20) DEFAULT NULL,
    `uf` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `data_cadastro` datetime NOT NULL,
    `ultima_alteracao` datetime DEFAULT NULL,
    `criado_por` VARCHAR(200) NOT NULL,
    `alterado_por` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `situacao` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'PENDENTE'
);

INSERT INTO `Clientes` (`id_cliente`, `nome`, `email`, `celular`, `cidade`, `uf`, `data_cadastro`, `ultima_alteracao`, `criado_por`, `alterado_por`, `situacao`) VALUES
(1, 'Ciclano', 'ciclano@gmail.com', '(12) 12345-7890', 'Brasília', 'DF', '2021-09-28 02:29:17', '2021-09-28 02:55:52', 'Administrador Sistema', 'Administrador Sistema', 'Ativo'),
(2, 'Beltrano', 'beltrano@gmail.com','(09) 78965-1234', 'São Paulo', 'SP', '2021-09-28 02:39:54', '2021-09-28 02:46:10', 'Desenvolvedor Junior', 'Administrador Sistema', 'Ativo');

INSERT INTO `Usuarios` (`id`, `nome`, `permissao`, `senha`, `token`) VALUES
(1, 'Administrador', 'admin', '202cb962ac59075b964b07152d234b70', 'e0dd669bdfe0821b8083fe92b0689426'),
(5, 'Desenvolvedor Junior', 'junior', '202cb962ac59075b964b07152d234b70', '74279ec3066c02d25fd213654c059a23');