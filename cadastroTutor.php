<?php require_once("app/Usuarios.php"); ?>
<?php require_once("app/UsuarioDAO.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastro</title>
	 <!-- Bootstrap core CSS -->
  	<link href="bootstrap-5.1.3-dist/css/bootstrap.css" rel="stylesheet">
</head>
<body>
	<?php 

	if (isset($_POST['submit'])) {
		// code...
		$target_dir = "uploads/tutores/";
		$target_file = $target_dir . basename($_FILES["foto"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
		echo "The file ". htmlspecialchars( basename( $_FILES["foto"]["name"])). " has been uploaded.";
		}

		$novoTutor = new UsuarioTutor;
		$novoTutor->setNome($_POST['nome']);
		$novoTutor->setEmail($_POST['email']);
		$novoTutor->setPassword(md5($_POST['senha']));
		$novoTutor->setTelefone($_POST['telefone']);
		$novoTutor->setFoto($_FILES['foto']['name']);

		$cadastrarTutor = new ClassUsuarioDAO;
		
		if ($cadastrarTutor->cadastrarTutor($novoTutor) == true) {
			// code...
			echo
			'
			<center>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Logado!</strong> Cadastrado!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            </center>
			';
		}
		}
			
	?>
	<center>
		<br><br><br><br><br><br>
		<h1>Novo Cadastro</h1>
		<form method="POST" enctype="multipart/form-data">
		<div class="container w-50">
			<div class="row">
				<div class="col form-floating mb-3">
				  <input required name="nome" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
				  <label for="floatingInput">Nome</label>
				</div>
				<div class="col form-floating">
				  <input required name="senha" type="password" class="form-control" id="floatingPassword" placeholder="Password">
				  <label for="floatingPassword">Senha</label>
				</div>
			</div>
			<div class="row">
				<div class="col form-floating mb-3">
				  <input required name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
				  <label for="floatingInput">Email</label>
				</div>
				<div class="col form-floating mb-3">
				  <input name="telefone" type="text" class="form-control" id="floatingPassword" placeholder="Password">
				  <label for="floatingPassword">Telefone</label>
				</div>
			</div>
			<div class="row">
				<div class="col input-group mb-3">
				  <label class="input-group-text" for="inputGroupFile01">Foto</label>
				  <input name="foto" type="file" class="form-control" id="inputGroupFile01">
				</div>
			</div>
			<div class="row">
				<button name="submit" type="submit" class="btn btn-outline-primary">Cadastrar</button>
			</div>
		</div>
		</form>
		<br>
		<a class="btn btn-secondary" href="index.php">Voltar</a>
	</center>
</body>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>