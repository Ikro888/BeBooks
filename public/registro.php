
<?php
include("conexao.php");

$mensagem_erro = '';
$caminhoperfilpic = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // o trampo chato p krl da foto
    if (isset($_FILES['imagem_perfil']) && $_FILES['imagem_perfil']['error'] == 0) {
        
        $arquivo = $_FILES['imagem_perfil'];
        $pasta_uploads = "ENVIOSft/";
        
        $tamanho_maximo_mb = 5;
        if ($arquivo['size'] > $tamanho_maximo_mb * 1024 * 1024) {
            $mensagem_erro = "Erro: O arquivo é muito grande! (Máx: {$tamanho_maximo_mb}MB)";
        }

        $tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif'];
        if (empty($mensagem_erro) && !in_array($arquivo['type'], $tipos_permitidos)) {
            $mensagem_erro = "Erro: Tipo de arquivo não permitido! (Apenas JPG, PNG, GIF)";
        }

        if (empty($mensagem_erro)) {
            $nome_arquivo = pathinfo($arquivo['name'], PATHINFO_FILENAME);
            $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
            $nome_unico = uniqid($nome_arquivo . '_') . '.' . $extensao;
            $caminho_final = $pasta_uploads . $nome_unico;

            if (move_uploaded_file($arquivo['tmp_name'], $caminho_final)) {
                $caminhoperfilpic = $caminho_final;
            } else {
                $mensagem_erro = "Erro crítico ao salvar o arquivo. Verifique as permissões da pasta.";
            }
        }
    }
     //cadusuarios
    if (empty($mensagem_erro)) {
        if (isset($_POST['email'], $_POST['senha'], $_POST['nomeuser'])) {
            
        if (strlen($_POST["senha"]) < 8) {
               $mensagem_erro = "A senha deve ter pelo menos 8 dígitos.";
           } else {
              $email = $mysqli->real_escape_string($_POST['email']);
              $nomeusuario = $mysqli->real_escape_string($_POST['nomeuser']);
              $senha_hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);
             $sql_inserir_usuario = "INSERT INTO usuario (email, senha, nomeusuario, caminhofoto) VALUES (?, ?, ?, ?)";
             $stmt = $mysqli->prepare($sql_inserir_usuario);
         $stmt->bind_param("ssss", $email, $senha_hash, $nomeusuario, $caminhoperfilpic);

        
                if ($stmt->execute()) {
                    if (isset($_POST['generos']) && is_array($_POST['generos'])) {
                   foreach ($_POST['generos'] as $id_genero) {
                     $id_genero_seguro = (int)$id_genero;
                     $sql_inserir_genero = "INSERT INTO usuario_generos (email_usuario, id_genero) VALUES ('$email', '$id_genero_seguro')";
                     $mysqli->query($sql_inserir_genero); 
                      }
                    }
                    header("Location: login.php");
                    exit();
                } else {
                    $mensagem_erro = "Falha ao cadastrar usuário: " . $stmt->error;
                }
                $stmt->close();
            }
        } else {
            $mensagem_erro = "Por favor, preencha todos os campos obrigatórios.";
        }
    }
}
//html pa baixo
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="loginstyles.css">
</head>
<body>
    <div class="animated-background"></div>

    <p class="p1">Bebooks</p>
    <p class="p2">Registrar-se</p>

    <div class="bigbox">
        <form action="registro.php" method="POST" enctype="multipart/form-data" style="display: contents;">
     <div class="centralbox">
      <label for="nomeuser">Nome de usuário</label>
       <input type="text" name="nomeuser" id="nomeuser" placeholder="seu nome unico" required>
           
     <label for="email">E-mail</label>
      <input type="email" name="email" id="email" placeholder="exemplo@exemplo.com" required>
       <br>
       <label for="password">Crie uma senha</label>
      <input type="password" name="senha" id="senha" placeholder="mínimo 8 caracteres" required>
       
      <div style="margin-bottom: 1rem;">
    <label><input type="checkbox" name="generos[]" value="1"> Terror</label>
      <label><input type="checkbox" name="generos[]" value="2"> Fantasia</label>
       <label><input type="checkbox" name="generos[]" value="3"> Romance</label>
       <label><input type="checkbox" name="generos[]" value="4"> Sci-fi</label>
       <label><input type="checkbox" name="generos[]" value="5"> Negócios</label>
       <label><input type="checkbox" name="generos[]" value="6"> Suspense</label>
                </div>
                <button class="b" type="submit" style="background-color:rgb(43, 73, 156); color: white; padding: 15px 32px; text-align: center; font-size: 16px; border: none; border-radius: 8px; cursor: pointer; width: 100%;">
                    Registrar
                </button>
                
                <p>Já tem uma conta? <a href="login.php" style="color: rgb(43, 73, 156);">Faça login</a></p>
            </div>
            <div class="centralbox">  
                <label for="foto" style="cursor: pointer; display: block; text-align: center;">
                    Selecione sua foto de perfil (opcional):
                    <section class="imgarea" id="previewcont">
                    <i class='bx bx-user-circle icon'></i> 
                        <img src="" id="imgpreview" style="display: none;">
                    </section>
                </label>
                <input type="file" id="foto" name="imagem_perfil" accept="image/png, image/jpeg, image/gif" style="display: none;">
                <?php 
                if (!empty($mensagem_erro)) {
                    echo '<p style="color:red; text-align:center; margin-top:10px;">' . htmlspecialchars($mensagem_erro) . '</p>';
                }
                ?>
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>
