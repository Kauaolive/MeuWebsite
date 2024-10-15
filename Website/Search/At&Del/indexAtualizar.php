<!DOCTYPE html>
<html lang="pt-br">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styleA.css">
        <title>Editar Cadastro</title>
        </head>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idUsuario = filter_input(INPUT_POST, 'idUsuario', FILTER_SANITIZE_NUMBER_INT);
        
        if (empty($idUsuario) || !is_numeric($idUsuario)) {
            die('ID inválido.');
        }
    

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
        
            exit( "Atualização deu errado: " . $e->getMessage());
            header("Location: ../pesquisa.php");
        }
    }else{ die;
    }?>
        <body>

        <main>
            <div class="form-container">

                <form action="includes/atualizarInfo.inc.php" method="POST">

                    <fieldset class="form-section">
                        <legend>Atualize Suas Informações</legend>

                <?php 
                foreach($resultados as $row):?>
                        <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo htmlspecialchars($row["id"])?>">
                        
                        <label for="usuario">Nome completo</label>
                        <input type="text" id="usuario" name="usuario" value="<?php echo htmlspecialchars($row["usuario"])?>"required>

                        <label for="senha">Senha</label>
                        <input type="password" id="senha" name="senha" required>

                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email"  value="<?php echo htmlspecialchars($row["email"])?>"required>

                        <label for="telefone">Telefone</label>
                        <input type="tel" id="telefone" name="telefone"  value="<?php echo htmlspecialchars($row["telefone"])?>" required>

                        <label for="cnpjCpf">Informe o CNPJ/CPF</label>
                        <input type="text" id="cnpjCpf" name="cnpjCpf"  value="<?php echo htmlspecialchars($row["CNPJ_CPF"])?>"required>
                    </fieldset>

                    <fieldset class="form-section">
                        <legend>Informações de Endereço</legend>

                        <label for="cep">CEP</label>
                        <input type="text" id="cep" name="cep" value="<?php echo htmlspecialchars($row["CEP"])?>"required>

                        <label for="tlog">Tipo de Logradouro</label>
                        <select id="tlog" name="tlog" required>
                            <option value="<?php echo htmlspecialchars($row["Tip_logradouro"])?>"><?php echo htmlspecialchars($row["Tip_logradouro"])?></option>
                            <option value="Rua">Rua</option>
                            <option value="Avenida">Avenida</option>
                            <option value="Distrito">Distrito</option>
                            <option value="Quadra">Quadra</option>
                            <option value="Setor">Setor</option>
                        </select>

                        <label for="logradouro">Logradouro</label>
                        <input type="text" id="logradouro" name="logradouro" value="<?php echo htmlspecialchars($row["logradouro"])?>"required>

                        <label for="nrua">Número</label>
                        <input type="text" id="nrua" name="nrua" value="<?php echo htmlspecialchars($row["num_rua"])?>"required>

                        <label for="bairro">Bairro</label>
                        <input type="text" id="bairro" name="bairro" value="<?php echo htmlspecialchars($row["bairro"])?>"required>

                        <label for="uf">UF</label>
                        <input type="text" id="uf" name="uf" value="<?php echo htmlspecialchars($row["UF"])?>"required>

                        <label for="municipio">Município</label>
                        <input type="text" id="municipio" name="municipio"  value="<?php echo htmlspecialchars($row["municipio"])?>" required>

                        <label for="pref">Ponto de referência</label>
                        <input type="text" id="pref" name="pref" value="<?php echo htmlspecialchars($row["ponto_ref"])?>">

                        <label for="complemento">Complemento</label>
                        <input type="text" id="complemento" name="complemento" value="<?php echo htmlspecialchars($row["complemento"])?>" >
                    </fieldset>
                        <?php
                endforeach;?>

                    <label for="confsenha">Confirme sua Senha</label>
                    <input type="password" id="confsenha" name="confsenha" required>

                    <div class="button-group">
                        <a href="http://localhost/website/Search/">Cancelar</a>
                        <button type="submit">Confirmar</button>
                    </div>
                </form>
            </div>
        </main>

        </body>

</html>
