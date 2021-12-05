<!-- Usuarios.php -->
<?php
class UsuarioTutor{
    private $id;
    private $email;
    private $nome;   
    private $password; 
    private $telefone; 
	
    function getID() {
        return $this->id;
    }
    function getEmail() {
        return $this->email;
    }
    function getNome() {
        return $this->nome;
    }
    function getPassword() {
        return $this->password;
    }
    function getTelefone() {
        return $this->telefone;
    }
    function setID($id) {
        $this->id = $id;
    }
    function setEmail($email) {
        $this->email = $email;
    }
    function setNome($nome) {
        $this->nome = $nome;
    }
    function setPassword($password) {
        $this->password = $password;
    }
    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }
}
