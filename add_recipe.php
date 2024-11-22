<?php

// Inicia a sessão
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    // Se o usuário não estiver logado, redireciona para a página de login
    header("Location: login.php");
    exit();
}

// Conexão com o banco de dados
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'user_db';

$conn = new mysqli($host, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Variáveis para armazenar mensagens
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Captura os dados do formulário
  $name = $_POST['name'];
  $ingredients = $_POST['ingredients'];
  $preparation_time = $_POST['preparation_time'];
  $steps = $_POST['steps'];
  $tipo = $_POST['tipo'];  // Novo campo
  $dificuldade = $_POST['dificuldade'];  // Novo campo
  $custo = $_POST['custo'];  // Novo campo
  $serves = $_POST['serves'];  // Captura o número de porções
  
  // Verifica se o usuário está logado e pega o ID da sessão
  if (isset($_SESSION['user_id'])) {
      $user_id = $_SESSION['user_id']; // Pega o ID do usuário logado
  } else {
      // Caso o usuário não esteja logado, redireciona para a página de login
      header('Location: login.php');
      exit;
  }


  // Tratamento do upload da imagem
  $image = '';
  if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
      $target_dir = "imagens/";
      $target_file = $target_dir . basename($_FILES["image"]["name"]);
      
      if (getimagesize($_FILES["image"]["tmp_name"]) !== false && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
          $image = $target_file;
      } else {
          $message = "Erro ao fazer o upload da imagem.";
      }
  }

  // Insere os dados no banco
  $sql = "INSERT INTO recipes (user_id, name, ingredients, preparation_time, steps, tipo, dificuldade, custo, serves, image) 
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("isssssssss", $user_id, $name, $ingredients, $preparation_time, $steps, $tipo, $dificuldade, $custo, $serves, $image);

if ($stmt->execute()) {
$message = "Receita adicionada com sucesso!";
} else {
$message = "Erro ao adicionar a receita: " . $conn->error;
}

$stmt->close();
}

// Fecha a conexão
$conn->close();
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
    <title>Publique sua receita</title>

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
           
        </ul>
      </div>

      <script src="js/navbar.js"></script>
</head>

<body>

  <!--Titulo da pagina inicial-->

  <ul class="CriarReceitasBody">
    <h1 class="tituloMenu"> Ensine uma nova receita </h1>
    <form action="add_recipe.php" method="POST" enctype="multipart/form-data">
    <div class="d-flex">
      <div class="p-2">
        <div class="mb-3">
          <label for="name" class="form-label"><h5>Nome da receita</h5></label>
          <input type="name" class="form-control" id="name" name="name" placeholder="Ex: Cocada" style="max-width: 350px;" required>
        </div>
        <div class="mb-3">
          <label for="image" class="form-label"><h5>Escolha uma foto</h5></label>
          <input class="form-control" name="image" type="file" id="image" style="max-width: 350px;" accept="image/*" required>
        </div>
        <h5>Tipo de Receita:</h5>
    <select name="tipo" class="form-select" style="max-width: 350px;" required>
        <option value="Salgada">Salgada</option>
        <option value="Doce">Doce</option>
    </select><br>

    <h5>Dificuldade:</h5>
    <select name="dificuldade" class="form-select" style="max-width: 350px;" required>
        <option value="Fácil">Fácil</option>
        <option value="Média">Média</option>
        <option value="Difícil">Difícil</option>
    </select><br>

    <h5>Custo:</h5>
    <select name="custo" class="form-select" style="max-width: 350px;" required>
        <option value="Baixo">Baixo</option>
        <option value="Médio">Médio</option>
        <option value="Alto">Alto</option>
    </select><br>
        <h5>Tempo de preparo em minutos:</h5>
        <input class="form-control" type="number" id="preparation_time" name="preparation_time" style="max-width: 350px;" required>
        <br>
        <h5>Serve até quantas porções:</h5>
        <input class="form-control" type="number" id="serves" name="serves" style="max-width: 350px;" required>
       
      </div>
      <div class="p-2 w-80 flex-grow-1 ">
        <div class="mb-3" >
          <label for="ingredients" class="form-label"> <h5> Escreva os ingredientes necessários, usando quebra de linha. </h5>
          <p> <strong>Caso seja sua primeira vez cadastrando receita, você precisa antes ver a forma correta de se escrever.</strong> </p>
            <a class="linkEstilo1" href="comofazer.html">Veja como fazer.</a> 
          </label>
          <textarea class="form-control" id="ingredients" name="ingredients" rows="5" required></textarea><br><br>
        </div>
        <div class="mb-3" >
          <label for="steps" class="form-label"> <h5> Escreva o modo de preparo da receita, usando quebra de linha. </h5>
            <a class="linkEstilo1" href="comofazer.html">Veja como fazer.</a> 
          </label>
          <textarea class="form-control" id="steps" name="steps" type="steps" rows="5" required></textarea><br><br>
        </div>
      </div>
    </div>

    <button type="submit" class="btn btn-dark">Publicar</button>
    </form>
    <br><a href="receitas.php" class="btn btnUser">Voltar</a>
    <style>
    .btnUser:hover {
        color: #ff5100;
    }
</style>
   </ul>

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
                    <li><a class="linkEstilo1" href="index.php">ínicio</a></li>
                    <li><a class="linkEstilo1" href="receitas.php">Receitas</a></li>
                    <li><a class="linkEstilo1" href="#">Sobre</a></li>
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

