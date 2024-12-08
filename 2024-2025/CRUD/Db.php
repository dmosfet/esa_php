<?php
class Db {
    private PDO $connexion;
    public function __construct ($sqlite = 'esa.db') {
        $this->connexion = new PDO('sqlite:'.$sqlite);
    }

    public function store ($data) {
        $sql ="INSERT INTO users (nom, prenom, email) VALUES(?,?,?)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([$data['nom'],$data['prenom'],$data['email']]);
    }

    public function update ($data) {
        $sql = "UPDATE users SET nom = ?, prenom = ?, email = ? WHERE id = ?";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([$data['nom'],$data['prenom'],$data['email'],$data['id']]);
    }

    public function delete ($id) {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([$id]);
    }

    public function findAll () : array {
        $sql ="SELECT id,nom,prenom,email FROM users";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function findOne ($id) : stdClass {
        $sql ="SELECT id,nom,prenom,email FROM users where id= ?";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}