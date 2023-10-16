<?php

class DAO{
    protected $pdo;
    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getPresentacions(){
        $sql = "SELECT titol FROM Presentacions";
        $statement = ($this->pdo)->query($sql);

        $statement->setFetchMode(PDO::FETCH_ASSOC);
        return $statement;
    }

    public function setPresentacions($titol, $descripcio){
        $sql = "INSERT INTO Presentacions(titol, descripcio) VALUES (:titol, :descripcio)";
        $statement = ($this->pdo)->prepare($sql);

        $statement->bindValue(':titol', $titol);
        $statement->bindValue(':descripcio', $descripcio);

        $statement->execute();
    }

    public function getDiapositives($id_presentacio){
        $sql = "SELECT titol FROM Diapositives WHERE ID_Presentacio = :id_presentacio";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([':id_presentacio' => $id_presentacio]);
        
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        return $statement;
    }
}