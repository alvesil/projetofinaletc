<!-- Usuarios.php -->
<?php
class UsuarioTutor{
    private $id;
    private $email;
    private $nome;   
    private $password; 
    private $telefone; 
    private $foto;
	
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
    function getFoto() {
        return $this->foto;
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
    function setFoto($foto) {
        $this->foto = $foto;
    }
}

/**
 * 
 */
class Pet{
    private $petID;
    private $petNome;
    private $petSexo;
    private $petPeso;
    private $petDataNascimento;
    private $petFoto;
    private $petTutorID;
    private $petRacaID;

    function getPetID(){
        return $this->petID;
    }
    function getPetNome(){
        return $this->petNome;
    }
    function getPetSexo(){
        return $this->petSexo;
    }
    function getPetPeso(){
        return $this->petPeso;
    }
    function getPetDataNascimento(){
        return $this->petDataNascimento;
    }
    function getPetFoto(){
        return $this->petFoto;
    }
    function getPetTutorID(){
        return $this->petTutorID;
    }
    function getPetRacaID(){
        return $this->petRacaID;
    }

    function setPetID($petID){
        $this->petID = $petID;
    }
    function setPetNome($petNome){
        $this->petNome = $petNome;
    }
    function setPetSexo($petSexo){
        $this->petSexo = $petSexo;
    }
    function setPetPeso($petPeso){
        $this->petPeso = $petPeso;
    }
    function setPetDataNascimento($petDataNascimento){
        $this->petDataNascimento = $petDataNascimento;
    }
    function setPetFoto($petFoto){
        $this->petFoto = $petFoto;
    }
    function setPetTutorID($petTutorID){
        $this->petTutorID = $petTutorID;
    }
    function setPetRacaID($petRacaID){
        $this->petRacaID = $petRacaID;
    }
}