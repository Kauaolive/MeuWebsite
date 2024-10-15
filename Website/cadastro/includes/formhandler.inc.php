<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Buscar e filtrar informações
    $usuario = htmlspecialchars(trim($_POST["usuario"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $senha = $_POST["senha"];
    $confsenha = $_POST["confSenha"];
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

    // Definição de padrões
    $padraoEmail = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    // Análise de erros
    $erros = [];
    //Verificação de CNPJ OU CPF.
    $verCnpjouCpf = "0";

    function verificarCnpjouCpf($cnpjCpf) {
        $cnpjCpf = preg_replace("/\D/", "", $cnpjCpf);
        
        if (strlen($cnpjCpf) == 11) {
            $verCnpjouCpf = "CPF";
        }
        if (strlen($cnpjCpf) == 14) {
            $verCnpjouCpf = "CNPJ";
        }
    }
            
    if ($senha != $confsenha) {
        $erros[] = "As senhas não correspondem.";
    }

    if (empty($usuario) || empty($email) || empty($senha) || empty($telefone) || empty($cnpjCpf) || empty($cep) || empty($tLogradouro) || empty($logradouro) || empty($numEnd) || empty($bairro) || empty($uf) || empty($municipio)) {
        $erros[] = "Favor preencher todos os campos corretamente.";
    }

    if (!preg_match($padraoEmail, $email)) {
        $erros[] = "E-mail inválido.";
    }
    function verificarTelefone($telefone) {
        $telefone = preg_replace("/\D/", "", $telefone);
        
        if (strlen($telefone) <> 11) {
            $errors[] = "Telefone inválido";
        }
        
    }
    
        $errors[] = $verCnpjouCpf;
   
        if (!empty($erros)) {
            // Exibir as mensagens de erro em uma lista
            echo "<ul>";
            foreach ($erros as $erro) {
                echo "<li>" . htmlspecialchars($erro) . "</li>";
            }
            echo "</ul>";
            exit;
        }

    try {
        require_once "dbh-inc.php";

        // Hash da senha
        $hashedSenha = password_hash($senha, PASSWORD_DEFAULT);

        $query = "INSERT INTO usuarios (
                usuario, 
                email, 
                senha, 
                telefone, 
                CNPJ_CPF, 
                CEP, 
                Tip_logradouro, 
                logradouro,
                num_rua, 
                bairro, 
                UF, 
                municipio, 
                ponto_ref, 
                complemento
            ) VALUES (
                :usuario,
                :email, 
                :senha, 
                :telefone, 
                :cnpjCpf, 
                :cep, 
                :tLog, 
                :logradouro, 
                :nrua, 
                :bairro, 
                :uf, 
                :municipio, 
                :pref, 
                :complemento
            );";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":usuario", $usuario);
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

        header("Location: ../index.php");
        

    } catch (PDOException $e) {
        // Redirecionar para a página anterior com uma mensagem de erro
       
        exit( "Cadastro falhou: " . $e->getMessage());
        header("Location: ../index.php");
    }
} else {
    // Se não for um método POST, redirecionar com uma mensagem de erro
    die("Método inválido.");
    header("Location: ../index.php");
}