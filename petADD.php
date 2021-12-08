<?php //verificar se foi logado, se sim exibe o alert de login
        session_start();
        require_once ("app/Conexao.php");
        require_once ("app/Usuarios.php");
        require_once ("app/UsuarioDAO.php");
        if (isset($_SESSION['nome'])) {
          # code...
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

            $consultarRacaPet = new ClassUsuarioDAO;
            $resultadoRacaPet = $consultarRacaPet->consultarRacaPet();

            $adicionarPet = new ClassUsuarioDAO;

            

            if (isset($_POST['submit'])) {
              $target_dir = "uploads/pets/";
              $target_file = $target_dir . basename($_FILES["foto"]["name"]);
              $uploadOk = 1;
              $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
              if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["foto"]["name"])). " has been uploaded.";
              }

              $novoPet = new Pet;
              $novoPet->setPetNome($_POST['nome']);
              $novoPet->setPetSexo($_POST['sexo']);
              $novoPet->setPetPeso($_POST['peso']);
              $novoPet->setPetDataNascimento($_POST['nasc']);
              $novoPet->setPetFoto($_FILES['foto']['name']);
              $novoPet->setPetTutorID($resultadoTutor['TutorID']);

              $resultadoPETUNIQUE = $consultar->consultarRacaPetUnique($_POST['raca']);
              $novoPet->setPetRacaID($resultadoPETUNIQUE['RacaID']);
              // print_r($novoPet);
              // print_r($resultadoPETUNIQUE);

              if($adicionarPet->adicionarPet($novoPet) == true){
                  header("Location: index.php?petAdded=true");
              }
            }
            
        ?>
        <?php require_once("navbar_logado.php") ?>
        <br><br><br>
        <h1>Adicionar Pet</h1>
        <form method="POST" action="petADD.php" enctype="multipart/form-data">
            <table>
                <tr>
                  <th>
                    Raça: 
                    <select name="raca">
                        <?php 
                          foreach ($resultadoRacaPet as $value) {
                            // code...
                            echo
                            '
                              <option value="'.$value['RacaNome'].'">'.$value['RacaNome'].'</option>
                            ';
                          }
                        ?>
                    </select>

                  </th>
                </tr>
                <tr>
                  <th>
                    Sexo: 
                    <select name="sexo">
                      <option value="M">M</option>
                      <option value="F">F</option>
                    </select>
                  </th>
                </tr>
                <tr>
                  <th>Nome: <input type="text" name="nome"></th>
                </tr>
                <tr>
                  <th>Peso: <input type="text" name="peso"></th>
                </tr>
                <tr>
                  <th>Data de Nascimento: <input type="date" name="nasc"></th>
                </tr>
                <tr>
                  <th>Foto: <input type="file" name="foto"></th>
                </tr>
          </table>
          <button name="submit" type="submit" class="btn btn-primary">Adicionar</button>
        </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    
  </body>
  </center>
</html>
<?php }else{ 
  header("Location: logout.php");
}
?> 