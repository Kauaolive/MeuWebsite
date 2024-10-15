<!DOCTYPE html>
<html lang="pt-br">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <title>Home</title>
        </head>
<body>
    <header>
        <h1>Bem vindo ao nosso site</h1>
    </header>
    <div>
        <form action=" includes/formhandler.inc.php" method="POST">
                <legend>Faça Login</legend><br>
                    <label for="email">E-mail</label><br>
                    <input type="email" id="email" name="email" placeholder="Seu E-mail" required><br><br>

                    <label for="senha">Defina uma senha</label><br>
                    <input type="password" id="senha" name="senha" placeholder="Sua senha" required><br><br>
                    <button type="submit">Confirmar</button>
        </form>
        <footer>
            <p>Ainda não possui cadastro conosco? <a href="http://localhost/website/cadastro">Cadastre-se</a>
        </footer>
    </div>
</body>
</html>