<?php
    session_start();
    ob_start();
    $btnCadUsuario = filter_input(INPUT_POST, 'btnCadUsuario', FILTER_SANITIZE_STRING);
    if($btnCadUsuario){
        include_once 'conexao.php';
        $dados_rc = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $erro = false;

       $dados_st = array_map('strip_tags', $dados_rc);
       $dados = array_map('trim', $dados_st);

       if(in_array('',$dados)){
           $erro = true;
           $_SESSION['msg'] = "Necessário preencher todos os campos";
       }elseif((strlen($dados['senha'])) < 6){
           $erro = true;
           $_SESSION['msg'] = "A sua senha deve conter 6 ou mais caracteres";
       }else{
           $result_usuario = "SELECT id FROM usuarios 
           WHERE usuario = '" .$dados['usuario']. "'";
           $resultado_usuario = mysqli_query($conn, $result_usuario);
           if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
               $erro = true;
               $_SESSION['msg'] = "Este usuário já está sendo utilizado";
           }

           $result_usuario = "SELECT id FROM usuarios
           WHERE email = '" .$dados['email']. "'";
           $resultado_usuario = mysqli_query($conn, $result_usuario);
           if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
               $erro = true;
               $_SESSION['msg'] = "Este email já está sendo utilizado";
           }
       }


       //var_dump($dados);
        if(!$erro){
            //var_dump($dados);
       $dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);

       $result_usuario = "INSERT INTO usuarios (nome, email, usuario, senha) 
       VALUES(
           '" .$dados['nome']. "', 
           '" .$dados['email']. "', 
           '" .$dados['usuario']. "', 
           '" .$dados['senha']. "'
           )";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        if(mysqli_insert_id($conn)){
            $_SESSION['msgcad'] = "Usuário cadastrado com sucesso";
            header("Location: login.php");
        }else{
            $_SESSION['msg'] = "Erro ao cadastrar o usuário";
        }
        }  
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Sistema de Login com PHP</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/signin.css" rel="stylesheet">
    </head>
    
    <body>
        <div class="container">
            <div class="form-signin" style="background: #42dea4;">
                <center><h2>Cadastre-se agora mesmo</h2></center>

            <?php
                if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
                }
            ?>

                <form method="POST" action="" class="form-signin">
                    <!--<label>Nome</label>-->
                    <input type="text" name="nome" placeholder="Digite o nome  e o sobrenome" class="form-control"><br>

                    <!--<label>Email</label>-->
                    <input type="text" name="email" placeholder="Digite o seu email" class="form-control"><br>

                    <!--<label>Usuário</label>-->
                    <input type="text" name="usuario" placeholder="Digite o seu usuario" class="form-control"><br>

                    <!--<label>Senha</label>-->
                    <input type="password" name="senha" placeholder="Digite a senha" class="form-control"><br>

                    <center><input type="submit" name="btnCadUsuario" value="Cadastrar" class="btn btn-success"></center><br><br>

                    <center>
                        Lembrou?
                        <a href="login.php">Clique Aqui</a> para logar
                    </center>
                </form>
            </div>    
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>