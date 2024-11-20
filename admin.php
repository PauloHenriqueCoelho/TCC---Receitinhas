<?php
session_start();

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

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Verifica se o usuário é o administrador (id = 7)
$user_id = $_SESSION['user_id'];
if ($user_id != 7) {
    echo "Acesso negado! Apenas o administrador pode acessar esta página.";
    exit();
}

// Apagar uma receita
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);

    // Deleta a receita com o ID correspondente
    $delete_query = "DELETE FROM recipes WHERE id = $delete_id";
    if ($conn->query($delete_query) === TRUE) {
        echo "Receita apagada com sucesso!";
    } else {
        echo "Erro ao apagar receita: " . $conn->error;
    }
}

// Banir usuário
if (isset($_GET['ban_user_id'])) {
    $ban_user_id = intval($_GET['ban_user_id']);

    // Atualiza o status do usuário para 'banido'
    $ban_query = "UPDATE user_form SET status = 'banido' WHERE id = $ban_user_id";
    if ($conn->query($ban_query) === TRUE) {
        echo "Usuário banido com sucesso!";
    } else {
        echo "Erro ao banir usuário: " . $conn->error;
    }
}

// Consulta todas as receitas
$sql_recipes = "SELECT id, name, tipo FROM recipes";
$result_recipes = $conn->query($sql_recipes);

// Consulta todos os usuários, excluindo o usuário com ID 7
$sql_users = "SELECT id, name, email, status FROM user_form WHERE id != 7";
$result_users = $conn->query($sql_users);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1>Painel Admin</h1>
    <p>Bem-vindo, administrador! Aqui você pode gerenciar as receitas e os usuários cadastrados no site.</p>

    <h3>Gerenciar Receitas</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result_recipes && $result_recipes->num_rows > 0): ?>
                <?php while ($row = $result_recipes->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']); ?></td>
                        <td><?= htmlspecialchars($row['name']); ?></td>
                        <td><?= htmlspecialchars($row['tipo']); ?></td>
                        <td>
                            <a href="admin.php?delete_id=<?= $row['id']; ?>" 
                               class="btn btn-danger"
                               onclick="return confirm('Tem certeza que deseja apagar esta receita?');">
                                Apagar
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Nenhuma receita cadastrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h3>Gerenciar Usuários</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result_users && $result_users->num_rows > 0): ?>
                <?php while ($row = $result_users->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']); ?></td>
                        <td><?= htmlspecialchars($row['name']); ?></td>
                        <td><?= htmlspecialchars($row['email']); ?></td>
                        <td><?= htmlspecialchars($row['status']); ?></td>
                        <td>
                            <?php if ($row['status'] == 'ativo'): ?>
                                <a href="admin.php?ban_user_id=<?= $row['id']; ?>" 
                                   class="btn btn-warning"
                                   onclick="return confirm('Tem certeza que deseja banir este usuário?');">
                                    Banir
                                </a>
                            <?php else: ?>
                                <span class="text-muted">Banido</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Nenhum usuário encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-dark">Voltar para o site</a>
</div>

<?php
// Fecha a conexão
$conn->close();
?>
    
</body>
</html>

