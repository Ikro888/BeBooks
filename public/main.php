<?php

include("protect.php");





if (isset($_SESSION['caminhofoto']) && !empty($_SESSION['caminhofoto'])) {
   
    if (file_exists($_SESSION['caminhofoto'])) {
        $foto_perfil = $_SESSION['caminhofoto'];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
     <nav class="navigation_bar">

        <ul class="actions">

                <li class=""> <img style="width: 75px; height: 75px;" src="/BeBooks/assets/Imagens/be.png" alt=""></li>
                <p style="font-family: Righteous; font-size: 1rem;">Bebooks</p>
                <hr> <br>
                <li><a href="explorar.php"><img style="width:35px; height: 35px;" src="/BeBooks/assets/Imagens/lup.png" alt=""></a></li><p style="font-family: Inter; font-size: 1rem;">Explorar</p><br>  <br>
                
                <li><a href=""> <img style="width: 60px; height: 35px;" src="/BeBooks/assets/Imagens/book-library.png" alt=""></a></li> 
                <p style="font-family: Inter; font-size: 1rem;">Estante</p>
                <br><br>
                <li><a href=""><img style="width: 55px; height: 50px;" src="/BeBooks/assets/Imagens/mais.png" alt=""></a></li>
                <P style="font-family: Inter; font-size: 1rem;">Criar</P>
                <br>
                 <li style="margin-top: 8.5rem; object-fit: cover; "><a href="main.php"><img style="width:45px; height: 45px; border-radius: 50px" src="<?php echo htmlspecialchars($foto_perfil); ?>" alt="Foto de Perfil"></a></li>
                <P style="font-family: Inter; font-size: 1rem;">Perfil</P>
        </ul>
    </nav> <!--fimnavbar-->

    <main>
       <!--div de cima-->
        <section class="bkimages">
        
   
                <div style="display: flex; align-items: flex-start; width: 100%; margin-top: 80px; position: relative; z-index: 2;">
      <!--fotodoperfi-->
            <div class="foto-container">
                
                <img src="<?php echo htmlspecialchars($foto_perfil); ?>" alt="Foto de Perfil">
            </div>
         </div>

        </section>

        <div class="campbox">
        <section class="infobox">
             <div class="aa">
               <p> <?php echo $_SESSION['nomeusuario']; ?> </p>
             </div>

              <div class="b">
                <p>Atualmente trabalhando em:</p>
                <section class="wstatus">
                 <p>PLACEholder</p>
                </section>
             </div>
             
              <div class="b">
                <p>Generos Favoritos:</p>
                <section class="fgenero">
                 <p> 
                 <?php
                  echo $_SESSION['usuario_generos']; 
                 ?>  
                </p>
                </section>
             </div>

             
             <section class="d">
               <div class="dupla1">
               
                <p>Leituras</p>
                
              </div>
                <div class="dupla2"> 
                 <p>d2</p>

                </div>
             </section>

              <div class="b">
                <p>notas</p>
                
             </div>
        </section>

         
        <DIV class="teste">
          <p>Projetos e participações</p>
         <section class="bobox">

         </section>
          </DIV>
        </div>

        
    </main>

</body>
</html>