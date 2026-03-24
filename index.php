    <?php
    require 'Usuario.class.php';
    $usuario = new Usuario();

    $conn = $usuario->conecta();

    if ($conn){
        ?>
        <form method="POST" action="cadastrar.php" >
            <input type="text"     placeholder = "digite um nome "   name = "nome" >
            <input type="text"     placeholder = "digite um email "  name = "email" >
            <input type="password" placeholder = "digite uma senha "  name = "senha" >
            <input type="submit" value= "cadastrar" >
        
        </form>
       
        <?php
        }