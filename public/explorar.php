<?php

include("protect.php");





if (isset($_SESSION['caminhofoto']) && !empty($_SESSION['caminhofoto'])) {
   
    if (file_exists($_SESSION['caminhofoto'])) {
        $foto_perfil = $_SESSION['caminhofoto'];
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navigation_bar">

        <ul class="actions">

                <li class=""> <img style="width: 75px; height: 75px;" src="/TCC/assets/Imagens/be.png" alt=""></li>
                <p style="font-family: Righteous; font-size: 1rem;">Bebooks</p>
                <hr> <br>
                <li><a href="explorar.html"><img style="width:35px; height: 35px;" src="/TCC/assets/Imagens/lup.png" alt=""></a></li><p style="font-family: Inter; font-size: 1rem;">Explorar</p><br>  <br>
                
                <li><a href=""> <img style="width: 60px; height: 35px;" src="/TCC/assets/Imagens/book-library.png" alt=""></a></li> 
                <p style="font-family: Inter; font-size: 1rem;">Estante</p>
                <br><br>
                <li><a href=""><img style="width: 55px; height: 50px;" src="/TCC/assets/Imagens/mais.png" alt=""></a></li>
                <P style="font-family: Inter; font-size: 1rem;">Criar</P>
                <br>
                 <li style="margin-top: 8.5rem; object-fit: cover; "><a href="main.php"><img style="width:45px; height: 45px; border-radius: 50px" src="<?php echo htmlspecialchars($foto_perfil); ?>" alt="Foto de Perfil"></a></li>
                <P style="font-family: Inter; font-size: 1rem;">Perfil</P>
        </ul>
    </nav> <!--fimnavbar-->





    
</body>
</html>