<!DOCTYPE html>
<html lang="pt-br">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styleA.css">
        <title>Deletar Cadastro</title>
    </head>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Buscar e filtrar informações
        $idUsuario = htmlspecialchars(trim($_POST["idUsuario"]));
        

        try {
            require_once "includes/dbh-inc.php";

            $query = "SELECT * FROM usuarios WHERE id = :idUsuario;";

            $stmt = $pdo->prepare($query);
            
            $stmt->bindParam(":idUsuario", $idUsuario);
        

            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $pdo = null;
            $stmt = null;
        }catch (PDOException $e) {
            // Redirecionar para a página anterior com uma mensagem de erro
        
            exit( "Erro no delete: " . $e->getMessage());
            header("Location: ../pesquisa.php");
        }
    }else{ die;
    }?>
<body>
    <form class="deletar" action="includes\deletarInfo.inc.php" method="post">
        <h2>Deseja deletar seu cadastro?</h2>
        <?php
        foreach($resultados as $row):?>
        <label for="pesquisa">Caso sim confirme seus dados.</label><br><br><br>
        <input type="text" id="usuario" name="usuario" Value="<?php echo htmlspecialchars($row["usuario"])?>" readonly><br><br>
        <input type="text" id="email" name="email" placeholder="Seu email..."><br><br>
        <input type="password" id="senha" name="senha" placeholder="Sua senha..."><br>
        <a href="http://localhost/search/">Cancelar</a><button type="submit">Confirmar</button>
        <?php
        endforeach;?>
    </form>
</body>

</html>