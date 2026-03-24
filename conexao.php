<?php
public function conecta(){
            $dns        = "mysql:dbname=etimUsuario;host=localhost";
            $userName   = "root";
            $userPass   = "";

            try {
                $this->pdo = new PDO($dns, $userName, $userPass);
                return true;
                
            } catch (\Throwable $th) {
                return false;
            }
        }
