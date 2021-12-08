<?php require_once("app/UsuarioDAO.php"); ?>
<?php require_once("app/Usuarios.php"); ?>
<?php 
	$id = $_POST['id'];
	$nome = $_POST['nome'];
	$sexo = $_POST['sexo'];
	$peso = $_POST['peso'];
	$nasc = $_POST['nasc'];
	$foto = $_FILES['foto']['name'];

	echo $id;
	echo $nome;
	echo $sexo;
	echo $peso;
	echo $nasc;
	echo $foto;

	$target_dir = "uploads/pets/";
	$target_file = $target_dir . basename($_FILES["foto"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
	echo "The file ". htmlspecialchars( basename( $_FILES["foto"]["name"])). " has been uploaded.";
	}

	$novoPet = new Pet;
	$novoPet->setPetID($id);
	$novoPet->setPetNome($nome);
	$novoPet->setPetSexo($sexo);
	$novoPet->setPetPeso($peso);
	$novoPet->setPetDataNascimento($nasc);
	$novoPet->setPetFoto($foto);

	$atualizarPet = new ClassUsuarioDAO;
	$resultado = $atualizarPet->atualizarPet($novoPet);

	if ($resultado == true) {
		// code...
		header("Location: index.php?petUpdated=true");
	}
?>