<!--  ClassUsuarioDAO.php  -->
<?php
require_once 'conexao.php';
class ClassUsuarioDAO {
   		public function cadastrar($novoUsuario) {
        try {
            $pdo = Conexao::getInstance(); // Instanciando o objeto a partir da classe conexão -solicitar um “getInstance()” na nossa classe Conexao
            $sql = "INSERT INTO tutores(TutorNome,TutorEmail,TutorPassword, TutorTelefone) values (?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $novoUsuario->getMatricula());
            $stmt->bindValue(2, $novoUsuario->getNome());
            $stmt->bindValue(3, $novoUsuario->getPassword());
            $stmt->bindValue(4, $novoUsuario->getTelefone());
            $stmt->execute();
			//Os “binds” são as operações de atribuição de valores aos nossos parâmetros, ou seja, o parâmetro “:nome” terá o valor armazenado em “$usuario-&gt;getNome()” e assim por diante. Utilizando o método “bindValue()” do PDO garantimos uma série de segurança extra para nosso código, tais como prevenção a SQL Injection.
           //return true;
	        echo "<center><h1>Cadastro realizado com sucesso!</h1><center><br>";
			?>
			<a href="listar.php">Listar</a>
		    <?php
			} catch (PDOException $erro) {
				echo $erro->getMessage();
			}
		}//fechamento do método cadastrar
		
// Listar os usuários Tutores
    public function listarTutor($novoUsuario) {
        try {
            $pdo = Conexao::getInstance($novoUsuario);
            $sql = "SELECT * FROM tutores WHERE TutorEmail = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $novoUsuario->getEmail());
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $erro) {
            return $erro->getMessage();
        }        
	}//fechamento do método listar
	
// Listar os pets dos Tutores
public function listarPetTutor($novoUsuario) {
    try {
        $pdo = Conexao::getInstance($novoUsuario);
        $sql = "SELECT * FROM pets WHERE TutorID = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $novoUsuario->getID());
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $erro) {
        return $erro->getMessage();
    }        
}//fechamento do método listar

// listar pet especifico do Tutor
public function listarPetEspecifico($novoUsuario) {
    try {
        $pdo = Conexao::getInstance($novoUsuario);
        $sql = "SELECT * FROM pets WHERE PetID = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $novoUsuario->getID());
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $erro) {
        return $erro->getMessage();
    }        
}//fechamento do método listar

// Listar todas as raças dos pets
public function consultarRacaPet() {
    try {
        $pdo = Conexao::getInstance();
        $sql = "SELECT * FROM racas";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $erro) {
        return $erro->getMessage();
    }        
}//fechamento do método listar


// Listar a raça do pet especifico
public function consultarRacaPetUnique($petNome) {
    try {
        $pdo = Conexao::getInstance($petNome);
        $sql = "SELECT RacaID FROM racas WHERE RacaNome = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $petNome);   
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $erro) {
        return $erro->getMessage();
    }        
}//fechamento do método listar

// adicionar novo pet ao Tutor
public function adicionarPet($novoPet) {
    try {
        $pdo = Conexao::getInstance($novoPet);
        $sql = "INSERT INTO pets (PetNome, PetSexo, PetPeso, PetDataNascimento, PetFoto, TutorID, RacaID) 
        VALUES(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $novoPet->getPetNome());
        $stmt->bindValue(2, $novoPet->getPetSexo());
        $stmt->bindValue(3, $novoPet->getPetPeso());
        $stmt->bindValue(4, $novoPet->getPetDataNascimento());
        $stmt->bindValue(5, $novoPet->getPetFoto());
        $stmt->bindValue(6, $novoPet->getPetTutorID());
        $stmt->bindValue(7, $novoPet->getPetRacaID());
        $stmt->execute();
        return true;
    } catch (PDOException $erro) {
        return $erro->getMessage();
    }        
}//fechamento do método listar

// Excluir usuário pelo matricula
    public function deletePet($apagarPet){
        try {
            $pdo = Conexao::getInstance($apagarPet);
            $sql = "DELETE FROM pets WHERE PetID=:id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id',$apagarPet->getPetID());
            $stmt->execute();
            return TRUE;
        }catch (PDOException $erro) {
            return $erro->getMessage();
        }
    }//fechamento do método excluir
	
// Atualizar
    public function alterar($novoUsuario) {
        try {
            $pdo = Conexao::getInstance(); 
            $sql = "UPDATE contatos SET  matricula=:matricula, nome=:nome WHERE matricula=:matricula";
            $stmt = $pdo->prepare($sql);
			$stmt->bindValue(':matricula',$novoUsuario->getMatricula());
			$stmt->bindValue(':nome'     ,$novoUsuario->getNome());
            $stmt->execute();
            return TRUE;
        } catch (PDOException $erro){
            echo $erro->getMessage();
        }
    }//fechamento da função alterar
}//fechamento da classe