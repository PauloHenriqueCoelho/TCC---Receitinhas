<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Usuário</title>

   <link rel='stylesheet' type='text/css' media='screen' href='main.css'>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="container">

   <div class="profile">
      <?php
         // Seleciona informações do usuário
         $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('Query falhou');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         // Mostra a imagem de perfil
         if($fetch['image'] == ''){
            echo '<div style="display: flex; align-items: center; justify-content: center;">
            <img style="border-radius: 100%; width: 200px; height: 200px; box-shadow: rgba(50, 50, 93, 0.25) 0px 10px 15px -5px,
            rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;" src="imagens/default-avatar.png"></div>';
         }else{
            echo '<div style="display: flex; align-items: center; justify-content: center;">
            <img style="border-radius: 100%; width: 200px; height: 200px; box-shadow: rgba(50, 50, 93, 0.25) 0px 10px 15px -5px,
            rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;" src="imagemAdicionada/'.$fetch['image'].'">
          </div>';
         }

         // Conta o número de receitas criadas pelo usuário
         $recipe_count_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM `recipes` WHERE user_id = '$user_id'") or die('Query falhou');
         $recipe_count = mysqli_fetch_assoc($recipe_count_query);
      ?>
      <h2 class="text-dark mb-3" style="align-items: center; justify-content: center; display:flex; margin-top: 20px; ">
         <?php echo $fetch['name']; ?>
      </h2>
      <p class="text-center">Você publicou <strong><?php echo $recipe_count['total']; ?></strong> receitas até agora.</p>
      <div style="align-items: center; justify-content: center; display:flex; margin-top: 20px;">
      <a href="update_profile.php" class="btn btnUser" >Atualizar informações</a>
     
      <a href="user.php?logout=<?php echo $user_id; ?>" class="btn btn-dark">Desconectar</a>
      </div>
      <div style="align-items: center; justify-content: center; display:flex; margin-top: 20px;">
      <a href="add_recipe.php" class="btn btnUser">Publicar receitas</a>
      <a href="receitas.php" class="btn btn-dark" style="margin-left:20px;">Ver receitas</a>
      <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == 7): ?>
    <a href="admin.php" class="btn btn-dark" style="margin-left:20px;">Área do administrador</a>
<?php endif; ?>
      </div>
      <style>
    .btnUser:hover {
        color: #ff5100;
    }
</style>
      
   </div>

</div>


</body>
</html>