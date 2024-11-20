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

?>

<!DOCTYPE html>
<html lang="pt">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Receitinhas</title>

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

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <!--Titulo da pagina inicial-->
  <ul class="menureceitas">

    <h1 class="tituloMenu"> Mais que apenas receitas. </h1>
   </ul>

     <!--Pratos da pagina inicial-->

   <ul class="pratosGif" >
    <img class="pratosGifV" src="imagens/PRATOS GIF.gif" alt="" >
  </ul>

  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative text-center text-lg-start" data-aos="zoom-in" data-aos-delay="100">
      <div class="row">
        <div class="col-lg-8">
          <h1>Bem vindo ao <span>Receitinhas</span></h1>
          <h2 class="tituloMenu">Ensinando novas gerações</h2>

          <div class="btns">
            <a href="receitas.php" class="btn-menu animated fadeInUp scrollto">Nossas receitas</a>
            <a href="quemsomos.html" class="btn-book animated fadeInUp scrollto">Sobre nós</a>
          </div>
        </div>


      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="100">
            <div class="about-img">
              <img src="imagens/ARROZ-CARRETEIRO-COM-FUNDO.png" alt="">
            </div>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h1 class="TextoMenuInfo ">Não apenas ensinamos, criamos nossas próprias experiências.</h1>
            <p class="pMenu ">
              Prepare-se para mergulhar no universo da culinária brasileira com seriedade e dedicação. Aqui, no Receitinhas, honramos a tradição e a autenticidade dos pratos brasileiros, valorizando a história e a diversidade de nossa gastronomia.
            </p>
            <ul>
              <li class="liMenu" ><i class="bi bi-check-circle"></i> De norte a sul, exploramos os sabores regionais que definem a identidade culinária do Brasil.</li>
              <li class="liMenu" ><i class="bi bi-check-circle"></i>Nosso compromisso é apresentar-lhe as receitas mais autênticas e respeitosas, proporcionando-lhe uma experiência culinária verdadeiramente enriquecedora.</li>
              <li class="liMenu" ><i class="bi bi-check-circle"></i> Explore conosco os segredos das panelas brasileiras, descubra técnicas ancestrais transmitidas de geração em geração e entregue-se aos aromas e sabores que tornam nossa culinária tão única.</li>
            </ul>
            <p class="pMenu" >
              No <strong>Receitinhas</strong>, levamos a sério a missão de celebrar e preservar a riqueza da culinária brasileira.
              Junte-se a nós nesta jornada culinária onde cada prato conta uma história e cada refeição é uma celebração da nossa herança gastronômica.
              Bon appétit!
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Menu</h2>
          <h1 class="receitastitulo" style="color:#ff7f43 ;">Veja algumas de nossas principais receitas</h1>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="menu-flters">
              <li data-filter="*"  class="liMenu">Todas</li>
              <li data-filter=".filter-doces">Doces</li>
              <li data-filter=".filter-salgados">Salgadas</li>
            </ul>
          </div>
        </div>

        <div class="row menu-container" data-aos="fade-up" data-aos-delay="200">

          <div class="col-lg-6 menu-item filter-salgados">
            <img src="imagens/Arrozcarretero.png" class="menu-img" alt="">
            <div class="menu-content">
              <a href="todasasreceitas/arrozcarreteiro.html">Arroz carreteiro</a><span>SALGADA</span>
            </div>
            <div class="menu-ingredients">
              Um delicioso arroz para comer no alomoço
            </div>
          </div>

          <div class="col-lg-6 menu-item filter-doces">
            <img src="imagens/Pudim.png" class="menu-img" alt="">
            <div class="menu-content">
              <a href="todasasreceitas/pudim.html">Pudim</a><span>DOCE</span>
            </div>
            <div class="menu-ingredients">
              Uma ótima opção para sobremesa
            </div>
          </div>

          <div class="col-lg-6 menu-item filter-salgados">
            <img src="imagens/Bauru.png" class="menu-img" alt="">
            <div class="menu-content">
              <a href="todasasreceitas/Bauru.html">Bauru</a><span>SALGADA</span>
            </div>
            <div class="menu-ingredients">
              Um lanche leve para comer a tarde
            </div>
          </div>

          <div class="col-lg-6 menu-item filter-salgados">
            <img src="imagens/Galinhada.png" class="menu-img" alt="">
            <div class="menu-content">
              <a href="todasasreceitas/galo ">Galinhada</a><span>SALGADA</span>
            </div>
            <div class="menu-ingredients">
              Uma ótima opção para um alomoço em família
            </div>
          </div>

          <div class="col-lg-6 menu-item filter-salgados">
            <img src="imagens/Pastel.png" class="menu-img" alt="">
            <div class="menu-content">
              <a href="todasasreceitas/pastel.html">Pastel</a><span>SALGADA</span>
            </div>
            <div class="menu-ingredients">
              Um pastel tão gostoso quantos os de feiras
            </div>
          </div>

          <div class="col-lg-6 menu-item filter-doces">
            <img src="imagens/Rocambole.png" class="menu-img" alt="">
            <div class="menu-content">
              <a href="todasasreceitas/rocambole.html">Rocambole</a><span>DOCE</span>
            </div>
            <div class="menu-ingredients">
              Um doce leve e saboroso
            </div>
          </div>

          <div class="col-lg-6 menu-item filter-doces">
            <img src="imagens/Bolodefuba.png" class="menu-img" alt="">
            <div class="menu-content">
              <a href="todasasreceitas/bolodefuba.html">Bolo de fubá</a><span>DOCE</span>
            </div>
            <div class="menu-ingredients">
              O famoso bolo de fubá, mas ainda melhor e fácil
            </div>
          </div>

          <div class="col-lg-6 menu-item filter-doces">
            <img src="imagens/Brigadeiro.png" class="menu-img" alt="">
            <div class="menu-content">
              <a href="todasasreceitas/brigadeiro.html">Brigadeiro</a><span>DOCE</span>
            </div>
            <div class="menu-ingredients">
              Um clássico brasileiro
            </div>
          </div>

          <div class="col-lg-6 menu-item filter-salgados">
            <img src="imagens/Feijoada.png" class="menu-img" alt="">
            <div class="menu-content">
              <a href="#">Feijoada</a><span>SALGADA</span>
            </div>
            <div class="menu-ingredients">
              Não é um site de receitas brasileira sem a feijoada
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Menu Section -->

    <!-- ======= Specials Section ======= -->
    <section id="specials" class="specials">
      <div class="container" data-aos="fade-up">

          <h2 class="tituloMenu">Aprenda a história</h2>
          <br>
          <br>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-3">
            <ul class="nav nav-tabs flex-column">
              <li class="nav-item">
                <a class="nav-link active " data-bs-toggle="tab" href="#tab-1">Cuscuz Paulista</a>
              </li>
              <li class="nav-item">
                <a class="nav-link  " data-bs-toggle="tab" href="#tab-2">Strogonoff </a>
              </li>
              <li class="nav-item">
                <a class="nav-link  " data-bs-toggle="tab" href="#tab-3">Torta de Frango</a>
              </li>
              <li class="nav-item">
                <a class="nav-link  " data-bs-toggle="tab" href="#tab-4">Bolo de cenoura</a>
              </li>
              <li class="nav-item">
                <a class="nav-link  " data-bs-toggle="tab" href="#tab-5">Pudim</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-9 mt-4 mt-lg-0">
            <div class="tab-content">
              <div class="tab-pane active show" id="tab-1">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3 style="color: black; font-family: 'Exo 2' ;">Cuscuz Paulista</h3>
                    <p class="fst-italic">
                      O cuscuz paulista é uma iguaria tradicional da culinária brasileira, especialmente popular no estado de São Paulo. Sua história remonta às influências culturais e gastronômicas que moldaram a região ao longo dos séculos.</p>
                    <p>Com origens que remontam às tradições indígenas, o cuscuz paulista foi moldado pela influência dos colonizadores portugueses e imigrantes de diversas origens, como italianos, espanhóis e africanos. A versão paulista do cuscuz foi adaptada aos ingredientes disponíveis na região e aos gostos locais, tornando-se uma mistura única de sabores e tradições.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="Pratos/PRATO-CUSCUZ-PAULISTA.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-2">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3 style="color: black; font-family: 'Exo 2' ;">Strogonoff</h3>
                    <p class="fst-italic">O Strogonoff é um prato de origem russa que ganhou popularidade em todo o mundo, incluindo o Brasil. Sua história remonta ao século XIX, quando era preparado com fatias de carne refogadas e servido com molho à base de mostarda e creme de leite.</p>
                    <p>A receita foi trazida para o Brasil por imigrantes russos e ganhou adaptações ao longo do tempo para se adequar aos ingredientes disponíveis e aos gostos locais. No Brasil, o Strogonoff é comumente preparado com carne bovina, frango ou camarão, cortados em tiras e refogados com cebola, alho e condimentos.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="Pratos/PRATO-DE-ESTROGONOFE.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-3">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3 style="color: black; font-family: 'Exo 2' ;">Torta de frango</h3>
                    <p class="fst-italic">A torta de frango é um prato popular em muitas culturas ao redor do mundo, incluindo o Brasil. Sua história remonta às tradições europeias de preparar tortas recheadas com carne e vegetais.</p>
                    <p>
                      No Brasil, a torta de frango ganhou popularidade ao longo do tempo devido à sua versatilidade, praticidade e sabor reconfortante. A receita básica consiste em uma massa de farinha de trigo, gordura (como manteiga ou margarina),
                       água e sal, que é recheada com uma mistura de frango desfiado, vegetais (como cenoura e ervilha), temperos e, às vezes, catupiry ou requeijão cremoso.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="Pratos/PRATO-TORTA-DE-FRANGO-COM-ERVILHA.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-4">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3 style="color: black; font-family: 'Exo 2' ;">Bolo de cenoura</h3>
                    <p class="fst-italic">
                      O bolo de cenoura é uma delícia da culinária brasileira, apreciado por seu sabor suave e textura macia. Sua origem exata não é clara, mas é amplamente difundido e amado em todo o país.</p>
                    <p>Feito com ingredientes simples, como cenouras, ovos, farinha de trigo, açúcar e óleo, o bolo de cenoura é fácil de preparar e irresistível ao paladar. A cenoura adiciona umidade natural ao bolo, garantindo que fique macio e fofo.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="Pratos/PRATO-BOLO-DE-CENOURA.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-5">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3 style="color: black; font-family: 'Exo 2' ;">Pudim</h3>
                    <p class="fst-italic" >
                      O pudim é uma sobremesa clássica apreciada em várias partes do mundo, com origens que remontam aos tempos antigos. Sua história é rica e diversificada, com diferentes variações de receitas em diferentes culturas.</p>
                    <p>No Brasil, o pudim é especialmente popular e é considerado uma das sobremesas mais queridas e tradicionais. Feito principalmente com leite, ovos e açúcar, o pudim brasileiro possui uma textura cremosa e suave, com um sabor delicado de caramelo.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="Pratos/PRATO-COM-PUDIM.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Specials Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Testemunhas</h2>
          <p>Oque acham do Receitinhas</p>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Com uma variedade de receitas, instruções claras e dicas úteis, tornou-se meu guia culinário favorito. As fotos ilustrativas facilitam o acompanhamento e a comunidade é acolhedora. Desde que comecei a usá-lo, minha experiência na cozinha tem sido mais prazerosa e surpreendente. Recomendo a todos os amantes da culinária brasileira!
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-1.jpeg" class="testimonial-img" alt="">
                <h3 class="tituloMenu">Júlia</h3>
                <h4 class="tituloMenu">Mãe &amp; Cozinheira</h4>
              </div>
          </div>
        </div>
      </div>
    </section><!-- End Testimonials Section -->

  </main><!-- End #main -->

     <!--Roda-pé-->

     <footer class="w-100 py-4 flex-shrink-0 shadow-lg p-3 mb-5 bg-body-tertiary rounded">
      <div class="container py-4">
          <div class="row gy-4 gx-5">

            <!--Informações rápidas e úteis para o usuário-->

              <div class="col-lg-4 col-md-6">
                  <h5 class="h1 text-dark, tituloMenu" >RE.</h5>
                  <p class="small text-muted">Site feito para fins educacionais, não leve nada a sério. Feito por alunos da etec</p>
                  <p class="small text-muted mb-0">&copy; Copyrights. Todos direitos reservados. <a class="linkEstilo1" href="#">Receitinhas</a></p>
              </div>

              <!--Link para navegação rápida, sem a necessidade de o usuário voltar ao topo da página-->

              <div class="col-lg-2 col-md-6">
                  <h5 class="text-dark mb-3">Navegação rápida</h5>
                  <ul class="list-unstyled text-muted">
                      <li><a class="linkEstilo1" href="index.php">Ínicio</a></li>
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
                          <button class="btn btn-dark" id="button-addon2" type="button"><i class="fas fa-paper-plane"></i></button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
</footer>
  
</body>
</html>

