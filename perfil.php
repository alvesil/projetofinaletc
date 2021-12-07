  <?php
  session_start();
      if (isset($_SESSION['nome'])) {
          # code...
          
          require_once ("app/Conexao.php");
          require_once ("app/Usuarios.php");
          require_once ("app/UsuarioDAO.php");

  ?>
  <!doctype html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
      <meta name="generator" content="Hugo 0.88.1">
      <title>PetNet</title>



      <!-- Bootstrap core CSS -->
    <link href="bootstrap-5.1.3-dist/css/bootstrap.css" rel="stylesheet">


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


    </head>
    <center>
    <body>
      
        
          <?php
              $id = $_SESSION['id'] ?? '';
              $email = $_SESSION['email'] ?? '';
              $tutor = new UsuarioTutor;
              $tutor->setID($id);
              $tutor->setEmail($email);
              
              $consultar = new ClassUsuarioDAO;
              //print_r($tutor);
              $resultadoPETS = $consultar->listarPetTutor($tutor);
              //print_r($resultadoPETS);

              $consultarTutor = new ClassUsuarioDAO;
              $resultadoTutor = $consultarTutor->listarTutor($tutor);
              
          ?>
          <?php require_once("navbar_logado.php") ?>
          <br><br><br><br><br>
          <h1>Perfil</h1>
          <p>Nome: <input readonly value="<?php echo $resultadoTutor['TutorNome'];?>" ></p>
          <p>Email: <input readonly value="<?php echo $resultadoTutor['TutorEmail'];?>" ></p>
          <p>Senha: <input readonly type="password" value="<?php echo $resultadoTutor['TutorPassword'];?>" ></p>
          <p>Telefone: <input readonly value="<?php echo $resultadoTutor['TutorTelefone'];?>" ></p>
          <button class="btn btn-outline-primary">Alterar Dados</button>
        </table>
        

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    
    </body>
    </center>
  </html>

  <?php }else{
      header("Location: logout.php");
  } ?>