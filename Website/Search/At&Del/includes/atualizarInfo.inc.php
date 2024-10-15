<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Buscar e filtrar informações
    $usuario = htmlspecialchars(trim($_POST["usuario"]));
    $idUsuario = htmlspecialchars(trim($_POST["idUsuario"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $senha = ($_POST["senha"]);
    $confsenha = ($_POST["confsenha"]);
    $telefone = htmlspecialchars(trim($_POST["telefone"]));
    $cnpjCpf = htmlspecialchars(trim($_POST["cnpjCpf"]));
    $cep = htmlspecialchars(trim($_POST["cep"]));
    $tLogradouro = htmlspecialchars(trim($_POST["tlog"]));
    $logradouro = htmlspecialchars(trim($_POST["logradouro"]));
    $numEnd = htmlspecialchars(trim($_POST["nrua"]));
    $bairro = htmlspecialchars(trim($_POST["bairro"]));
    $uf = htmlspecialchars(trim($_POST["uf"]));
    $municipio = htmlspecialchars(trim($_POST["municipio"]));
    $pontoRef = htmlspecialchars(trim($_POST["pref"]));
    $complemento = htmlspecialchars(trim($_POST["complemento"]));

       if (!$email) {
        exit("Email inválido.");
    }
    if (empty($usuario) || empty($senha) || empty($confsenha)|| empty($cep)|| empty($email)|| empty($telefone)
        || empty($cnpjCpf)|| empty($tLogradouro)|| empty($logradouro)|| empty($numEnd)|| empty($bairro)|| empty($uf)|| empty($municipio)) {
        exit("Preencha os campos obrigatórios.");
    }


    try {
        require_once "dbh-inc.php";

        $query = "SELECT senha FROM usuarios WHERE id=:idUsuario";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":idUsuario", $idUsuario);
        $stmt->execute();

        
        $storedHash = $stmt->fetchColumn();

        if($senha != $confsenha){
            $hashedSenha = password_hash($senha, PASSWORD_DEFAULT);
        }
       

        if ($storedHash && password_verify($confsenha, $storedHash)) {
        
            $query = "UPDATE usuarios SET 
            usuario = :usuario,          
            email = :email,
            senha = :senha,
            telefone = :telefone,
            CNPJ_CPF = :cnpjCpf,
            CEP = :cep,
            Tip_logradouro = :tLog,
            logradouro = :logradouro,
            num_rua = :nrua, 
            bairro = :bairro, 
            UF = :uf, 
            municipio = :municipio, 
            ponto_ref = :pref, 
            complemento = :complemento
            WHERE
            id = :idUsuario";

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":usuario", $usuario);
            $stmt->bindParam(":idUsuario", $idUsuario);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":senha", $hashedSenha);
            $stmt->bindParam(":telefone", $telefone);
            $stmt->bindParam(":cnpjCpf", $cnpjCpf);
            $stmt->bindParam(":cep", $cep);
            $stmt->bindParam(":tLog", $tLogradouro);
            $stmt->bindParam(":logradouro", $logradouro);
            $stmt->bindParam(":nrua", $numEnd);
            $stmt->bindParam(":bairro", $bairro);
            $stmt->bindParam(":uf", $uf);
            $stmt->bindParam(":municipio", $municipio);
            $stmt->bindParam(":pref", $pontoRef);
            $stmt->bindParam(":complemento", $complemento);

            $stmt->execute();

            $pdo = null;
            $stmt = null;

            header("../indexAtualizar.php");
        } else {
            // Se a senha não corresponder, redirecionar com uma mensagem de erro
            exit("Senha não corresponde, não há permissão de editar o cadastro.");
        }
    } catch (PDOException $e) {
        // Redirecionar para a página anterior com uma mensagem de erro
        exit("Atualização falhou: " . $e->getMessage());
    }
} else {
    // Se não for um método POST, redirecionar com uma mensagem de erro
    die("Método inválido.");
}

        