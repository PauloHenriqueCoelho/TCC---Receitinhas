<?php
include 'config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Se estiver usando o Composer

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   // Verifica se o email já existe
   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'Email já cadastrado';
   } else {
      if($pass != $cpass){
         $message[] = 'As senhas não coincidem!';
      } else 
      {
        
         // Gera um código aleatório para o e-mail
         $verification_code = rand(100000, 999999);  // Código de 6 dígitos

         // Insere os dados do usuário com o código de verificação
         $insert = mysqli_query($conn, "INSERT INTO `user_form`(name, email, password, verification_code) VALUES('$name', '$email', '$pass', '$verification_code')") or die('query failed');

         if($insert){
            // Envia o e-mail de verificação
            $mail = new PHPMailer(true);

            try {
               // Configurações do servidor SMTP
               $mail->isSMTP();
               $mail->Host = 'smtp.gmail.com';  // Para Gmail
               $mail->SMTPAuth = true;
               $mail->Username = 'receitinhasbrasileiras@gmail.com';  // Seu e-mail
               $mail->Password = 'lymq lnjt gkux atgp';  // Sua senha de e-mail ou App password
               $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
               $mail->Port = 587;

               $mail->SMTPDebug = 2;  // Isso ativa a depuração para o SMTP. Isso mostrará detalhes sobre a conexão.


               // Remetente e destinatário
               $mail->setFrom('receitinhasbrasileiras@gmail.com', 'Receitinhas');
               $mail->addAddress($email);

               // Conteúdo do e-mail
               $mail->isHTML(true);
               $mail->Subject = 'Codigo de verificacao';
               $mail->Body    = "Seu código de verificação é: <b>$verification_code</b>. Assim que voce confirmar este código, será redirecionado para a página de login. Após isso, será apenas necessário fornecer seu email e senha para logar no site.";


               // Envia o e-mail
               $mail->send();
               $message[] = 'Cadastro realizado com sucesso. Verifique seu e-mail para o código de confirmação.';
               header('location:verificar_codigo.php?email=' . $email); // Redireciona para a página de verificação
            } catch (Exception $e) {
               $message[] = 'Erro ao enviar o e-mail: ' . $mail->ErrorInfo;
            }
         } else {
            $message[] = 'Falha no cadastro!';
         }
      }
   }
}
?>



<!DOCTYPE html>
<html lang="pt">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Quinta da receita</title>

      <!--Nav bar, o site inteiro foi trabalhado usando bootstrap.-->

      <nav>
        <div class="logo">
          <img src="imagens/LOGO-RECEITINHAS.png" alt="logo" />
          <h1></h1>
        </div>
        <ul>
          <li>
            
            <a href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-house" viewBox="0 0 22 18">
              <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
            </svg> Ínicio</a>
          </li>
          <li>
            <a href="receitas.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-book" viewBox="0 0 22 18">
                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
              </svg> Receitas</a>
          </li>
          <li>
            <a href="quemsomos.html">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-award" viewBox="0 0 22 18">
                <path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702z"/>
                <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1z"/>
              </svg> Sobre</a>
          </li>
          <li>
            <a href="contato.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-envelope" viewBox="0 0 22 18">
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
              </svg> Contato</a>
          </li>
          <li>
            <a href="login.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 22 18">
                <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
                <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
              </svg> Entrar</a>
          </li>
        </ul>
        <div class="hamburger">
          <span class="line"></span>
          <span class="line"></span>
          <span class="line"></span>
        </div>
      </nav>
      <div class="menubar">
        <ul>
          <li>
            
            <a href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-house" viewBox="0 0 22 18">
              <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
            </svg> Ínicio</a>
          </li>
          <li>
            <a href="receitas.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-book" viewBox="0 0 22 18">
                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
              </svg> Receitas</a>
          </li>
          <li>
            <a href="quemsomos.html">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-award" viewBox="0 0 22 18">
                <path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702z"/>
                <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1z"/>
              </svg> Sobre</a>
          </li>
          <li>
            <a href="contato.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-envelope" viewBox="0 0 22 18">
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
              </svg> Contato</a>
          </li>
          <li>
            <a href="login.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 22 18">
                <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
                <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
              </svg> Entrar</a>
          </li>
        </ul>
      </div>

      <script src="js/navbar.js"></script>
</head>

<body>

  <!--Titulo da pagina inicial-->


  <div class="container">
    <div class="body d-md-flex align-items-center justify-content-between" style="box-shadow: 0 0.5rem 1rem rgb(183 183 183); " >
        <div class="box-1 mt-md-0 mt-5" style="width: 100%;">
            <img src="imagens/BannerLogin.jpeg" class="" alt="" id="imageLogin">
        </div>
        <div class=" box-2 d-flex flex-column h-100">
            <div class="mt-0">
                <h2>Crie sua conta.</h2>

                <p class="text-muted mb-2" style="font-size: 20px;"> E ajude a melhorar a plataforma.</p>
                <div class="d-flex flex-column ">
                  <br>
                   
                    <div class="form-container">


                    <form action="" method="post">
   <h3>Registrar-se</h3>
   <?php
   if(isset($message)){
      foreach($message as $message){
         echo '<div class="message">'.$message.'</div>';
      }
   }
   ?>

   <!-- Campos do formulário -->
   <div class="form-floating mb-3">
      <input type="text" name="name" placeholder="Nome de usuário" class="form-control" required>
      <label for="name">Nome de usuário</label>
   </div>

   <div class="form-floating mb-3">
      <input type="email" name="email" placeholder="Email" class="form-control" required>
      <label for="email">Email</label>
   </div>

   <div class="form-floating mb-3">
      <input type="password" name="password" placeholder="Senha" class="form-control" required>
      <label for="password">Senha</label>
   </div>

   <div class="form-floating mb-3">
      <input type="password" name="cpassword" placeholder="Confirme sua senha" class="form-control" required>
      <label for="cpassword">Confirme sua senha</label>
   </div>

   <div class="d-grid">
      <input type="submit" name="submit" value="Cadastrar" class="btn btn-dark">
   </div>
   <p class="footer text mb-0 mt-md-4 mt-4">Já possui uma conta? 
      <span class="p-color me-1"><a href="login.php" class="p-color me-1">Logar</a></span>
    </p>
</form>
                   
                   
            </div>
            </div>
            </div>
            <div class="mt-auto">
                <p class="footer text-muted mb-0 mt-md-0 mt-4">Ao se registrar, você concorda com
                    <span class="p-color me-1"><a href="receitas.php" class="p-color me-1">Termos e Condições</a></span>e nossa
                    <span class="p-color ms-1"><a href="Legal/PV.html" class="p-color me-1">Política de Privacidade</a></span>
                </p>
            </div>
        </div>
    </div>
</div>




<script>
  // Lista de URLs das imagens que você deseja mostrar
  const imageUrls = [
      'imagens/BannerContato.jpg',
      'imagens/BannerContato2.jpg',
  ];


  // Gera um número aleatório dentro do intervalo do tamanho da lista de imagens
  const randomIndex = Math.floor(Math.random() * imageUrls.length);

// Seleciona a imagem com base no índice aleatório gerado
const randomImage = imageUrls[randomIndex];

// Define a imagem aleatória como src da imagem
document.getElementById('imageLogin').src = randomImage;
</script>

  
     <!--Roda-pé-->

  <footer class="w-100 py-4 flex-shrink-0 shadow-lg p-3 mb-5 bg-body-tertiary rounded">
    <div class="container py-4">
        <div class="row gy-4 gx-5">

           <!--Informações rápidas e úteis para o usuário-->

            <div class="col-lg-4 col-md-6">
                <h5 class="h1 text-dark">RE.</h5>
                <p class="small text-muted">Site feito para fins educacionais. Feito por alunos da etec</p>
                <p class="small text-muted mb-0">&copy; Copyrights. Todos direitos reservados. <a class="linkEstilo1" href="#">Receitinhas</a></p>
            </div>

              <!--Link para navegação rápida, sem a necessidade de o usuário voltar ao topo da página-->

            <div class="col-lg-2 col-md-6">
                <h5 class="text-dark mb-3">Navegação rápida</h5>
                <ul class="list-unstyled text-muted">
                    <li><a class="linkEstilo1" href="index.php">Ínicio</a></li>
                    <li><a class="linkEstilo1" href="receitas.php">Receitas</a></li>
                    <li><a class="linkEstilo1" href="quemsomos.html">Sobre</a></li>
                </ul>
            </div>

             <!--Seção para receber noticias pelo email (não funcional ainda)-->

            <div class="col-lg-4 col-md-6">
                <h5 class="text-dark mb-3">Notícias</h5>
                <p class="small text-muted">Se cadastre e receba as melhores receitas da década.</p>
                <form action="#">
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" placeholder="Seu nome" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-dark" id="button-addon2" type="button"><i class="fas fa-paper-plane"></i>Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</footer>
  
</body>
</html>
