<?php //verificar se foi logado, se sim exibe o alert de login
        session_start();
        require_once ("app/Conexao.php");
        require_once ("app/Usuarios.php");
        require_once ("app/UsuarioDAO.php");
        if (isset($_SESSION['nome'])) {
          # code...    
        
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
        <?php 
          if (isset($_SESSION['logado'])) {
            # code...
            echo
            '
            <center>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Logado!</strong> Bem vindo '.$_SESSION['nome'].'.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            </center>
            ';
            unset($_SESSION['logado']);
          }
        ?>
        <?php 
          if (isset($_GET['apagarPet'])) {
            // code...
            $petID = $_GET['petID'];
            $objPet = new Pet;
            $objPet->setPetID($petID);

            $deletePet = new ClassUsuarioDAO;

            //print_r($objPet);
            if($deletePet->deletePet($objPet) == true){
             
            header("Location: index.php?petDeleted=true");
            }

          }
        ?>
        <?php 
          if (isset($_GET['petDeleted'])) {
            // code...
            echo
              '
              <center>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Registro de Pet deletado!</strong>.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </center>
            ';
          }
          if (isset($_GET['petAdded'])) {
            // code...
             echo
              '
              <center>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Novo Pet Adicionado!</strong>.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </center>
            ';
          }
        ?>
        <table class="table w-75">
            <tr>
              <th>Nome</th>
              <th>Sexo</th>
              <th>Peso</th>
              <th>Data de Nascimento</th>
              <th>Foto</th>
            </tr>
            <?php 
                foreach ($resultadoPETS as $pet) {
                  # code...
                  $petID = $pet['PetID'];
                  echo
                  '
                    <tr>
                      <td>'.$pet['PetNome'].'</td>
                      <td>'.$pet['PetSexo'].'</td>
                      <td>'.number_format($pet['PetPeso'], 2, ",", ".").' KG</td>
                      <td>'.date("d/m/Y", strtotime($pet['PetDataNascimento'])).'</td>
                      <td><a href="#">Foto da(o) '.$pet['PetNome'].'</a></td>
                       <td><a class="btn btn-outline-warning" href="index.php?editarPet=true&petID='.$petID.'">Editar</a></td>
                      <td><a class="btn btn-outline-danger" href="index.php?apagarPet=true&petID='.$petID.'">Apagar</a></td>
                    </tr>
                  ';
                }

            ?>
      </table>
      <a href="petADD.php" class="btn btn-primary">Adicionar um novo Pet</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    
  </body>
  </center>
</html>
    <?php }else{ 
        header("Location: logout.php");
      }
    ?> 