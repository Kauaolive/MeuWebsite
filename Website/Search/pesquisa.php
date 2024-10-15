<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Buscar e filtrar informações
    $pesquisaUsuario = htmlspecialchars(trim($_POST["pesquisaUsuario"]));

    try {
        require_once "includes/dbh.inc.php";

        $query = "SELECT * FROM usuarios WHERE usuario = :pesquisaUsuario;";

        $stmt = $pdo->prepare($query);
        
        $stmt->bindParam(":pesquisaUsuario", $pesquisaUsuario);
      

        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;
        

    } catch (PDOException $e) {
        // Redirecionar para a página anterior com uma mensagem de erro
       
        exit( "Pesquisa falhou: " . $e->getMessage());
        header("Location: ../index.php");
    }
} else {
    // Se não for um método POST, redirecionar com uma mensagem de erro
    die("Método inválido.");
    header("Location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Pesquisar informações</title>
</head>

<body>
    <section>
        <h3>Resultados da pesquisa</h3>
    </section>

    <section>

        <?php
        if(empty($resultados)){
            echo "<div><p>Nenhum resultado encontrado.</p></div>";
        }else{?>
            <table>
                <thead>
                    <tr>
                        <th>Usuario</th> 
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>CNPJ/CPF</th>
                        <th>CEP</th>
                    </tr>
                </thead>
                <?php 
                foreach($resultados as $row):?>
                    <tbody>
                        <tr>
                            <td> <?php echo htmlspecialchars($row["usuario"])?> </td>
                            <td> <?php echo htmlspecialchars($row["email"]) ?> </td>
                            <td> <?php echo htmlspecialchars($row["telefone"]) ?> </td>
                            <td> <?php echo htmlspecialchars($row["CNPJ_CPF"]) ?></td>
                            <td> <?php echo htmlspecialchars($row["CEP"]) ?> </td>
                            <td>
                            <form action="At&Del/indexAtualizar.php" method="post" style="display:inline;">
                                <input type="hidden" name="idUsuario" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <button type="submit" class="edit">Editar</button>
                            </form>
                            <form action="At&Del/indexDelet.php" method="post" style="display:inline;">
                                <input type="hidden" name="idUsuario" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <button type="submit" class="delete">Deletar</button>
                            </form>
                        </tr>
                    </tbody>
                    <?php 
                endforeach;?>
            </table>
        <?php
        }?>
    </section>
</body>
<footer>
    <p>Visite nossa <a href="http://localhost/website/cadastro">área de cadastros</a> para criar um novo cadastro</p>
</footer>

</html>