<?php require_once("app/Usuarios.php") ?>
<?php require_once("app/UsuarioDAO.php") ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Signin Template · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
    <link href="bootstrap-5.1.3-dist/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/signin.css">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <?php 
        if (isset($_POST['email'])) {
            # code...
            $email = $_POST['email'];
            $pass = $_POST['pass'];

            $novoUsuario = new UsuarioTutor;
            $novoUsuario->setEmail($email);

            $logar = new ClassUsuarioDAO;
            $resultado = $logar->listarTutor($novoUsuario);
            //print_r($resultado);
            
            //echo $resultado['TutorPassword'];
            if ($resultado['TutorPassword'] == md5($pass)) {
                # code...
                session_start();
                $_SESSION['logado'] = true;
                $_SESSION['nome'] = $resultado['TutorNome'];
                $_SESSION['email'] = $resultado['TutorEmail'];
                $_SESSION['id'] = $resultado['TutorID'];
                header("Location: index.php?login=true");
            }
        }
    ?>
    <main class="form-signin">
    <form method="POST">
        <img class="mb-4" src="img/ps.png" alt="" width="150" height="90">
        <h1 class="h3 mb-3 fw-normal">Faça o Login</h1>

        <div class="form-floating">
        <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Seu Email</label>
        </div>
        <div class="form-floating">
        <input name="pass" type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Sua Senha</label>
        </div>

        <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Lembrar-me
        </label>
        </div>
        <?php 

          try {
            $pdoStatus = new PDO("mysql:host=localhost;dbname=petshop_db","root","");
            echo 'Server Status: Online <a style="color: green; background-color: green; border-radius: 50%; " >aaa</a>';
            echo '<button class="w-100 btn btn-lg btn-primary" type="submit">Logar</button>';
          } catch (PDOException $err) {
            echo 'Server Status: Offline <a style="color: red; background-color: red; border-radius: 50%; " >aaa</a>';
            echo '<button disabled class="w-100 btn btn-lg btn-danger" type="submit">Logar</button>';
          }
        ?>
        
        <p class="mt-5 mb-3 text-muted">&copy; <?php echo date("Y");?></p>
        
    </form>
    </main>

  </body>
</html>
