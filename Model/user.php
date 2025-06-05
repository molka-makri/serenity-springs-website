<?php
class user{

    private ?int $id = null;
    private ?string $nom = null;
    private ?string $email = null;
    private ?string $mdp = null;
    private ?string $role = null;
    

    // Constructeur
    public function __construct($id, $nom, $email, $mdp, $role) {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->mdp = $mdp;
        $this->role = $role;
    }

    // Méthodes getter
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMdp() {
        return $this->mdp;
    }

    public function getRole() {
        return $this->role;
    }

    // Méthodes setter
    public function setId($id) {
        $this->id = $id;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setMotDePasse($mdp) {
        $this->mdp = $mdp;
    }

    public function setRole($role) {
        $this->role = $role;
    }

}
?>