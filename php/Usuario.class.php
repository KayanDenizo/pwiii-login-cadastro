<?php

    class Usuario{
        private $id;
        private $email;
        private $nome;
        private $senha;
        private $pdo;

        public function conecta(){
            $dns = "mysql:dbname=etimUsuario;host=localhost";
            $userName = "root";
            $userPass = "";

            try {
                $this->pdo = new PDO($dns, $userName, $userPass);
                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }

        public function listarUsuarios(){
            $sql = "SELECT id, nome, email, senha FROM usuario";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }



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
            $sql = "SELECT * FROM usuario WHERE email = :e AND senha = :s";
            $stmt = $this->pdo ->prepare($sql);
            $stmt-> bindValue(":e", $email);
            $stmt-> bindValue(":s", $senha);
            $stmt->execute();
            
            return $stmt->rowCount()>0;

        }
    }
?>