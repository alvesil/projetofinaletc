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
          if (isset($_GET['petUpdated'])) {
            // code...
             echo
              '
              <center>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Regirstro do Pet Atualizado!</strong>.
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
                       <td><a class="btn btn-outline-warning" href="editarPet.php?editarPet=true&petID='.$petID.'">Editar</a></td>
                      <td><a class="btn btn-outline-danger" href="editarPet.php?apagarPet=true&petID='.$petID.'">Apagar</a></td>
                    </tr>
                  ';
                }

            ?>
      </table>
      <!-- Button trigger modal -->
          <button hidden id="md1" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Launch demo modal
          </button>
          <?php if (isset($_GET['editarPet'])) { ?>
          
          <script>
            window.onload = function() {
              // body...
              document.getElementById("md1").click();
            }
            
          </script>
          <?php
            $novoPet = new Pet;
            $novoPet->setPetID($_GET['petID']);

            $atualizarPet = new ClassUsuarioDAO;
            $resultadoPet = $atualizarPet->listarPetEspecifico($novoPet);
          ?>
      
      <!-- Modal -->
      <form method="POST" action="atualizarPet.php" enctype="multipart/form-data">
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar Pet</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input hidden type="text" name="id" value="<?php echo $resultadoPet['PetID']; ?>">
                <table class="table">
                  <tr>
                    <th>Nome</th>
                    <th>Sexo</th>
                    <th>Peso(Kg)</th>
                  </tr>
                  <tr>
                    <td><input type="text" name="nome" value="<?php echo $resultadoPet['PetNome']; ?>"></td>
                    <td>
                      <select class="form-select" name="sexo">
                        <option <?php if($resultadoPet['PetSexo'] == 'M'){ echo 'selected';} ?> value="M">M</option>
                        <option <?php if($resultadoPet['PetSexo'] == 'F'){ echo 'selected';} ?> value="F">F</option>
                      </select>
                    </td>
                    <td><input type="text" name="peso" value="<?php echo $resultadoPet['PetPeso']; ?>"></td>
                  </tr>
                  <tr>
                    <th>Data de Nascimento</th>
                    <th>Foto</th>
                  </tr>
                  <tr>
                    <td><input type="date" name="nasc" value="<?php echo $resultadoPet['PetDataNascimento']; ?>"></td>
                    <td><input type="file" name="foto"></td>
                  </tr>
                </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
              <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
      <a href="petADD.php" class="btn btn-primary">Adicionar um novo Pet</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    
  </body>
  </center>
</html>
    <?php }else{ 
        header("Location: logout.php");
      }
    ?> 