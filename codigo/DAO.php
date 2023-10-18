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

    public function getTitolPorID($id_presentacio) {
        $sql = "SELECT titol FROM Presentacions WHERE ID_Presentacio = :id_presentacio";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([':id_presentacio' => $id_presentacio]);
    
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['titol'];
        } else {
            return "Título no encontrado";
        }
    }
    
    public function getLastInsertId() {
        return $this->pdo->lastInsertId();
    }

    public function setPresentacions($titol, $descripcio){
        $sql = "INSERT INTO Presentacions (titol, descripcio) VALUES (:titol, :descripcio)";
        $statement = ($this->pdo)->prepare($sql);

        // $statement->bindValue(':titol', $titol);
        // $statement->bindValue(':descripcio', $descripcio);

        try {
            $statement->execute([
                "titol" => $titol,
                "descripcio" => $descripcio
            ]);
            
        } catch (PDOException $e) {
            echo "Error al guardar datos: " . $e->getMessage();
        }
    }

    public function getDiapositives($id_presentacio){
        $sql = "SELECT titol FROM Diapositives WHERE ID_Presentacio = :id_presentacio";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([':id_presentacio' => $id_presentacio]);
        
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        return $statement;
    }
}