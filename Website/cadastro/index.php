<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Catálogo</title>
</head>

<body>
    <header>
        <h1>Bem-vindo ao nosso site</h1>
        <p>Faça seu cadastro</p>
    </header>

    <main>
        <form action=" includes/formhandler.inc.php" method="POST">
            <fieldset>
                <legend>Suas Informações</legend>
                <div class="fieldset-container">
                    <label for="usuario">Nome completo</label><br>
                    <input type="text" id="usuario" name="usuario" placeholder="Seu nome" required><br><br>

                    <label for="email">E-mail</label><br>
                    <input type="email" id="email" name="email" placeholder="Seu E-mail" required><br><br>

                    <label for="senha">Defina uma senha</label><br>
                    <input type="password" id="senha" name="senha" placeholder="Sua senha" required><br><br>

                    <label for="confSenha">Confirme sua senha</label><br>
                    <input type="password" id="confSenha" name="confSenha" placeholder="Confirme sua senha"
                        required><br><br>

                    <label for="telefone">Telefone</label><br>
                    <input type="tel" id="telefone" name="telefone" placeholder="Seu Telefone" required><br><br>

                    <label for="cnpjCpf">Informe o CNPJ/CPF</label><br>
                    <input type="text" id="cnpjCpf" name="cnpjCpf" placeholder="Seu CNPJ/CPF" required><br><br>
                </div>
            </fieldset>

            <fieldset>
                <legend>Informações de Endereço</legend>
                <div class="fieldset-container">
                    <label for="cep">CEP</label><br>
                    <input type="text" id="cep" name="cep" placeholder="Seu CEP" required><br><br>

                    <label for="tlog">Tipo de Logradouro</label><br>
                    <select id="tlog" name="tlog" required>
                        <option value="">Defina o tipo de Logradouro</option>
                        <option value="Rua">Rua</option>
                        <option value="Avenida">Avenida</option>
                        <option value="Distrito">Distrito</option>
                        <option value="Quadra">Quadra</option>
                        <option value="Setor">Setor</option>
                    </select><br><br>

                    <label for="logradouro">Logradouro</label><br>
                    <input type="text" id="logradouro" name="logradouro" placeholder="Seu Logradouro" required><br><br>

                    <label for="nrua">Número</label><br>
                    <input type="text" id="nrua" name="nrua" placeholder="Número do endereço" required><br><br>

                    <label for="bairro">Bairro</label><br>
                    <input type="text" id="bairro" name="bairro" placeholder="Bairro" required><br><br>

                    <label for="uf">UF</label><br>
                    <input type="text" id="uf" name="uf" placeholder="UF" required><br><br>

                    <label for="municipio">Município</label><br>
                    <input type="text" id="municipio" name="municipio" placeholder="Seu Município" required><br><br>

                    <label for="pref">Ponto de referência</label><br>
                    <input type="text" id="pref" name="pref" placeholder="Ponto de Referência"><br><br>

                    <label for="complemento">Complemento</label><br>
                    <input type="text" id="complemento" name="complemento" placeholder="Complemento"><br><br>
                </div>
            </fieldset>

            <button type="submit">Cadastre-se</button>
        </form>
    </main>
    <footer>
        <p>Já possui cadastro? <a href="http://localhost/website/Home/">Faça login.</a></p>
    </footer>
</body>

</html>