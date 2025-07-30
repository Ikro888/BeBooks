<?php
session_start();
include("conexao.php");

if (isset($_POST['email']) && isset($_POST['senha'])) {

    if (empty($_POST["email"])) {
        $erro = "O email não pode estar vazio";
    } else if (empty($_POST["senha"])) {
        $erro = "A senha não pode estar vazia";
    } else {
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha_digitada = $_POST['senha'];

        $sql_code = "SELECT email, nomeusuario, senha, caminhofoto FROM usuario WHERE email = '$email' LIMIT 1";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código aql: " . $mysqli->error);
        
        if ($sql_query->num_rows == 1) {
            
            
            $usuario = $sql_query->fetch_assoc();
            $hash_senha_banco = $usuario['senha'];

            if (password_verify($senha_digitada, $hash_senha_banco)) {
                
                $_SESSION["email"] = $usuario['email'];
                $_SESSION["nomeusuario"] = $usuario['nomeusuario'];
                $_SESSION["caminhofoto"] = $usuario['caminhofoto'];
                 $sql_generos = "
                    SELECT g.nome_genero 
                    FROM generos g
                    JOIN usuario_generos ug ON g.id_genero = ug.id_genero
                    WHERE ug.email_usuario = '$email'
                ";
                
                $query_generos = $mysqli->query($sql_generos);
                
               
                $lista_generos = [];
                while ($genero = $query_generos->fetch_assoc()) {
                    $lista_generos[] = $genero['nome_genero'];
                }

                $generos_formatados = implode(', ', $lista_generos);
               
                $_SESSION['usuario_generos'] = $generos_formatados;

                header("Location: main.php");
                exit();

            } else {
                
                $erro = "Falha ao logar e-mail ou senha incorretos";
            }
        } else {
            $erro = "Falha ao logar e-mail ou senha incorretos";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="loginstyles.css">
</head>
<body>
    <div class="animated-background"></div>

    <p class="p1">Bebooks</p>
    <p class="p2">Logar</p>

    <div class="centralbox">
        <form action="" method="POST">
            <br>
            <label for="email">E-mail</label><br>
            <input type="email" name="email" id="email" required>
            <br>
            <label for="senha">Senha</label><br>
            <input type="password" name="senha" id="senha" required>
            <br>
            <button type="submit" style="background-color:rgb(43, 73, 156); color: white; padding: 15px 32px; text-align: center; font-size: 16px; border: none; border-radius: 8px; cursor: pointer; width: 100%;">Entrar</button>
        </form>
       
        <?php 
        //mensagemerro
        if (isset($erro)) {
            echo '<p style="color:red; text-align:center; margin-top:10px;">' . $erro . '</p>';
        }
        ?>
         <p>não tem uma conta? <a href="registro.php" style="color: rgb(43, 73, 156);">Crie uma</a></p>
    </div>
    
</body>
</html>