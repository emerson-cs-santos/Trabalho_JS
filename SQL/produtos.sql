-- TABELA DE PRODUTOS
CREATE TABLE IF NOT EXISTS produtos 
	(
		codigo		INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY
		,nome		VARCHAR(150) NOT NULL
		,descri		VARCHAR(2500) NOT NULL
		,categoria	VARCHAR(20) NOT NULL
		,imagem		VARCHAR(200) NOT NULL
		,preco		DECIMAL(8,2) NOT NULL
		,desconto	DECIMAL(8,2) NOT NULL
		,estoque	INTEGER NOT NULL
		,tipo		VARCHAR(20) NOT NULL -- 'ATIVO'
		,ean		VARCHAR(150) NOT NULL
	);