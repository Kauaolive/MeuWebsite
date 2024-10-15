<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Buscar e filtrar informações
    $usuario = htmlspecialchars(trim($_POST["usuario"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $senha = $_POST["senha"];
    $idUsuario = filter_input(INPUT_POST, 'idUsuario', FILTER_SANITIZE_NUMBER_INT);
 
    try {
        require_once "dbh-inc.php";

        $query = "SELECT senha, email FROM usuarios WHERE usuario = :usuario AND email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":usuario", $usuario);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $resultados = $stmt->fetchAll();
        foreach($resultados as $row);
        $storedHash = $row["senha"];
        $SQLemail = $row["email"];


        if ($storedHash && password_verify($senha, $storedHash) && $email == $SQLemail) {
            // Se a senha corresponder, excluir o registro
            $query = "DELETE FROM usuarios WHERE usuario = :usuario AND email = :email AND senha = :senha";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":usuario", $usuario);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":senha", $storedHash);  
            $stmt->execute();

            header("Location: ../indexDelet.php");
            exit();
        } else {
            // Se a senha não corresponder, redirecionar com uma mensagem de erro
            exit("Dados inválidos. Não foi possível excluir o cadastro.");
        }

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        // Redirecionar para a página anterior com uma mensagem de erro
        exit("Cadastro falhou: " . $e->getMessage());
    }
} else {
    // Se não for um método POST, redirecionar com uma mensagem de erro
    die("Método inválido.");
}