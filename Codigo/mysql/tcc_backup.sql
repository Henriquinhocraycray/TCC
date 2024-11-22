
CREATE TABLE IF NOT EXISTS `tcc`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `cpf` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `telefone` VARCHAR(45) NOT NULL,
  `endereco` VARCHAR(45) NOT NULL,
  `cep` VARCHAR(45) NOT NULL,
  `rg` VARCHAR(45) NOT NULL,
  `registro_func` VARCHAR(45) NOT NULL,
  `data_efetiv` VARCHAR(45) NOT NULL,
  `func_status` VARCHAR(45) NOT NULL,
  `data_saida` VARCHAR(45) NULL,
  `cargo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`));
  
  CREATE TABLE IF NOT EXISTS `tcc`.`cliente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `cpf` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `telefone` VARCHAR(45) NOT NULL,
  `n_reserva` VARCHAR(45) NOT NULL,
  `tipo_reserva` VARCHAR(45) NOT NULL,
  `n_pessoas` VARCHAR(45) NOT NULL,
  `pedido` VARCHAR(45) NOT NULL,
  `preco` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

insert into usuario(nome, cpf, senha, email, telefone, endereco, cep, rg, registro_func, data_efetiv, func_status, cargo)
values('Joao', '23748923809', 'joao1234', 'joao@gmail.com', '1234123412', 'rua jose antonio', '1231234121', '12312341234', '123456', '12/09/2013', 'trabalhando', 'fachineiro');

select * from usuario;
