<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema de Login com PHP</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
</head>
<body>
<div class="container">
<div class="form-signin" style="background: #42dea4;">
    <center><h2>Área Restrita</h2></center><br>
    <?php
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    if(isset($_SESSION['msgcad'])){
        echo $_SESSION['msgcad'];
        unset($_SESSION['msgcad']);
    }
    ?>
    <form method="POST" action="valida.php">
    <!--<label>Usuário</label>-->
    <input type="text" name="usuario" placeholder="Digite o seu usuário" class="form-control"><br>

    <!--<label>Senha</label>-->
    <input type="password" name="senha" placeholder="Digite a sua senha" class="form-control"><br>

    <center><input type="submit" name="btnLogin" value="Acessar" class="btn btn-success btn-block"></center><br>

    <center><h6>Você ainda não possui uma conta?</h6></center><br>
    <center><a href="cadastrar.php" class="btn btn-primary btn-block">Crie uma grátis agora mesmo</a></center>
    </form>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>