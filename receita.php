<?php

session_start();

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

// Verifica se o usuário está logado
if (isset($_SESSION['user_id'])) {
    // Se o usuário estiver logado, pega o nome do usuário usando o id
    $user_id = $_SESSION['user_id'];

    // Preparar a consulta SQL para evitar injeção de SQL
    $sql = "SELECT name FROM user_form WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);  // Bind do parâmetro (i para inteiro)
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_name);

    if ($stmt->fetch()) {
        // Armazena o nome do usuário na sessão
        $_SESSION['user_name'] = $user_name;
    }
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

// Captura o ID da receita
$recipe_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Consulta para pegar os detalhes da receita
$sql = "SELECT r.name, r.ingredients, r.preparation_time, r.steps, r.tipo, r.dificuldade, r.custo, r.image, r.serves, u.name AS user_name
        FROM recipes r
        JOIN user_form u ON r.user_id = u.id
        WHERE r.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$result = $stmt->get_result();
$recipe = $result->fetch_assoc();

// Fecha a conexão
$stmt->close();
$conn->close();

// Verifica se a receita existe
if (!$recipe) {
    echo "Receita não encontrada.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Quinta da receita</title>

    <!--Nav bar-->

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
        <?php if (isset($_SESSION['user_id'])): ?>
    <li>Bom te ver, <?php echo $_SESSION['user_name']; ?>!</li>
    <li><a href="user.php">Gerenciar conta</a></li> <!-- Link para Gerenciar conta -->
        <?php else: ?>
            <li><a href="login.php"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 22 18">
              <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
              <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
            </svg> Entrar</a></li>
        <?php endif; ?>
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
        <?php if (isset($_SESSION['user_id'])): ?>
    <li>Bom te ver, <?php echo $_SESSION['user_name']; ?>!</li>
    <li><a href="user.php">Gerenciar conta</a></li> <!-- Link para Gerenciar conta -->
        <?php else: ?>
            <li><a href="login.php"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 22 18">
              <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
              <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
            </svg> Entrar</a></li>
        <?php endif; ?>
      </ul>
    </div>

    <script src="js/navbar.js"></script>

</head>
<body>

   <!--Página da receita-->

   <ul class="menureceitas">
            <ul class="receita">
                <div class="d-flex flex-column flex-md-row">

                    <!-- Receita em si -->
                    <div class="p-2 w-100 flex-grow-1">
                        <div class="card mb-3" style="width: 100%;">
                            <img src="<?= htmlspecialchars($recipe['image']); ?>" style="width: 100%;" class="card-img-top" alt="Imagem da Receita">
                            <div class="card-body">
                                <h1 class="card-title">Como fazer <?= htmlspecialchars($recipe['name']); ?></h1>
                                <p class="card-text"><strong>Ingredientes:</strong><br>
                                    <?= nl2br(htmlspecialchars($recipe['ingredients'])); ?>
                                </p>
                                <p class="card-text"><strong>Modo de Preparo:</strong><br>
                                    <?= nl2br(htmlspecialchars($recipe['steps'])); ?>
                                </p>
                                <p class="card-text">
                                    <small class="text-body-secondary">Receita feita por <?= htmlspecialchars($recipe['user_name']); ?></small>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Informações gerais -->
                    <div class="p-2">
                        <h1>Verifique disponibilidade dos ingredientes:</h1>
                        <ul class="list-group">
                            <?php 
                            $ingredients = explode("\n", $recipe['ingredients']);
                            foreach ($ingredients as $ingredient): ?>
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="ingredient-<?= md5($ingredient); ?>">
                                        <label class="form-check-label" for="ingredient-<?= md5($ingredient); ?>">
                                            <?= htmlspecialchars($ingredient); ?>
                                        </label>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <br>
                        <h3>Mais informações:</h3>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Tempo de preparo em minutos
                                <span class="badge text-bg-dark rounded-pill"><?= htmlspecialchars($recipe['preparation_time']); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Dificuldade
                                <span class="badge text-bg-dark rounded-pill"><?= htmlspecialchars($recipe['dificuldade']); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Custo
                                <span class="badge text-bg-dark rounded-pill"><?= htmlspecialchars($recipe['custo']); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Serve até quantas porções:
                                <span class="badge text-bg-dark rounded-pill"><?= htmlspecialchars($recipe['serves']); ?> </span>
                            </li>
                        </ul>

                        <br><br><br>
                        <h3>Você pode se interessar por:</h3>
                        <ul class="list-group">
                        <?php
// Conexão com o banco de dados
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'user_db';

$conn = new mysqli($host, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Obtém o ID da receita atual
$current_recipe_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Busca o tipo da receita atual
$current_type_query = "SELECT tipo FROM recipes WHERE id = $current_recipe_id";
$current_type_result = $conn->query($current_type_query);

if ($current_type_result && $current_type_result->num_rows > 0) {
    $current_type = $current_type_result->fetch_assoc()['tipo'];

    // Consulta receitas do mesmo tipo, excluindo a receita atual
    $related_recipes_query = "SELECT id, name FROM recipes WHERE tipo = '$current_type' AND id != $current_recipe_id LIMIT 10";
    $related_recipes_result = $conn->query($related_recipes_query);

    // Exibe receitas relacionadas
    if ($related_recipes_result && $related_recipes_result->num_rows > 0) {
        echo '<ul class="list-group">';
        while ($row = $related_recipes_result->fetch_assoc()) {
            echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
            echo htmlspecialchars($row['name']);
            echo '<a href="receita.php?id=' . $row['id'] . '" class="btn btn-dark">Veja a receita</a>';
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>Nenhuma receita relacionada encontrada.</p>';
    }
} else {
    echo '<p>Tipo da receita não encontrado.</p>';
}

// Fecha a conexão
$conn->close();
?>

</ul>

                    </div>
                </div>
            </ul>
        </ul>


   <!--Roda pé-->

   <footer class="w-100 py-4 flex-shrink-0 shadow-lg p-3 mb-5 bg-body-tertiary rounded">
    <div class="container py-4">
        <div class="row gy-4 gx-5">
            <div class="col-lg-4 col-md-6">
                <h5 class="h1 text-dark">RE.</h5>
                <p class="small text-muted">Site feito para fins educacionais, não leve nada a sério. Feito por alunos da ETEC.</p>
                <p class="small text-muted mb-0">&copy; Copyrights. Todos direitos reservados. <a class="linkEstilo1" href="#">Receitinhas</a></p>
            </div>
            <div class="col-lg-2 col-md-6">
                <h5 class="text-dark mb-3">Navegação rápida</h5>
                <ul class="list-unstyled text-muted">
                  <li><a class="linkEstilo1" href="index.php">Ínicio</a></li>
                  <li><a class="linkEstilo1" href="receitas.php">Receitas</a></li>
                  <li><a class="linkEstilo1" href="#">Sobre</a></li>
                </ul>
            </div>
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


