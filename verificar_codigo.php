<?php
include 'config.php';

if (isset($_POST['verify_code'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $verification_code = mysqli_real_escape_string($conn, $_POST['verification_code']);

    // Verifica se o código de verificação inserido corresponde ao código armazenado
    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND verification_code = '$verification_code'") or die('query failed');
    
    if (mysqli_num_rows($select) > 0) {
        // Código correto, atualiza o campo 'verified' para TRUE
        $update = mysqli_query($conn, "UPDATE `user_form` SET `verified` = TRUE WHERE email = '$email'") or die('query failed');

        // Redireciona para a página de login ou onde preferir
        header('location:login.php');
    } else {
        $message[] = 'Código de verificação inválido.';
    }
}
?>

<link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- Formulário de verificação -->

<div class="box-2 d-flex flex-column h-100">
            <div class="mt-5">
                <h2 class="tituloConfirmar">Confirme.</h2>
                <p class="text-muted mb-2 mensagemConfirmar" > Um código foi enviado para o seu email.</p>
                <div class="d-flex flex-column">
                  
                    <p class="text-muted mb-2 mensagemConfirmar2" >É necessário verificar sua conta antes de prosseguir</p>
                    <div class="form-container">
                    <form action="" method="POST">
                    <div class="input-group">
  <input type="email" name="email" placeholder="Digite seu e-mail novamente" class="form-control" required>
  <input type="text" name="verification_code" placeholder="Digite o código de verificação" class="form-control" required>
  <button class="btn btn-outline-secondary" name="verify_code" type="submit" value="Verificar Código">Verificar</button>

</div> 
</div>
</div>
</div>         
</div>

<style>

.mensagemConfirmar{
        font-size: 20px;
    }

    .mensagemConfirmar2{
        font-size: 15px;
    }
   @media (max-width: 980px) {
    .tituloConfirmar{
        font-size: 100px;
        
    }

    .form-control{
        height: 110px;
    }

    .form-control::placeholder{
        font-size: 30px;
    }

    .mensagemConfirmar{
        font-size: 50px;
    }

    .mensagemConfirmar2{
        font-size: 35px;
    }
    }

</style>



<?php
if (isset($message)) {
    foreach ($message as $msg) {
        echo "<div class='message'>$msg</div>";
    }
}
?>
