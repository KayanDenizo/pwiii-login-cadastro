<?php

    class Usuario{
        private $id;
        private $email;
        private $nome;
        private $senha;
        private $pdo;

        
        public function inserirUsuario($nome, $email, $senha){
            // passo 1 - Criar uma variável com a consulta SQL
            $sql = "INSERT INTO usuario SET nome = :n, email = :e, senha = :s";

            //passo 2 - Passar essa consulta para o metodo prepare do PDO;
            $stmt = $this->pdo->prepare($sql);

            //pasos 3 - Para cada apelido, criar um bindValue;
            $stmt->bindValue(":e", $email);
            $stmt->bindValue(":n", $nome);
            $stmt->bindValue(":s", $senha);

            //passo 4 - Executar o comando e retornar V ou F
            return $stmt->execute();
        }

        function checkUser($email){
            $sql = "SELECT *FROM usuario WHERE email = :e ";
            $stmt = $this->pdo ->prepare($sql);
            $stmt-> bindValue(":e", $email);
            $stmt->execute();
            
            return $stmt->rowCount()>0;


        }
        function checkPass($email, $senha){
            $sql = "SELECT *FROM usuario WHERE email = :e ";
            $sql = "SELECT *FROM usuario WHERE senha = :s ";
            $stmt = $this->pdo ->prepare($sql);
            $stmt-> bindValue(":e", $email);
            $stmt-> bindValue(":s", $senha);
            $stmt->execute();
            
            return $stmt->rowCount()>0;

        }
    }
?>