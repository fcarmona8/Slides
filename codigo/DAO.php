<?php

class DAO{
    protected $pdo;
    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    // funcio per mostrar totes les presentacions guardades a la base de dades
    public function getPresentacions(){
        $sql = "SELECT titol, ID_Presentacio FROM Presentacions";
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
    public function getDescPorID($id_presentacio) {
        $sql = "SELECT descripcio FROM Presentacions WHERE ID_Presentacio = :id_presentacio";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([':id_presentacio' => $id_presentacio]);
    
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['descripcio'];
        } else {
            return "Descripcion no encontrada";
        }
    }
    
    public function getLastInsertId() {
        return $this->pdo->lastInsertId();
    }

    public function getTitolDiapoPorID($id_diapositiva){
        $sql = "SELECT titol FROM Diapositives WHERE ID_Diapositiva = :id_diapositiva LIMIT 1";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([':id_diapositiva' => $id_diapositiva]);
        
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $row = $statement->fetch();
        return $row['titol'];
    }

    public function getContingutPorID($id_diapositiva){
        $sql = "SELECT contingut FROM Diapositives WHERE ID_Diapositiva = :id_diapositiva LIMIT 1";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([':id_diapositiva' => $id_diapositiva]);
        
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $row = $statement->fetch();
        return $row['contingut'];
    }

    public function getOrdenPorID($id_diapo){
        $sql = "SELECT orden FROM Diapositives WHERE ID_Diapositiva = :id_diapo";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([':id_diapo' => $id_diapo]);

        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $row = $statement->fetch();
        return $row['orden'];
    }

    public function getIDPorOrden($orden){
        $sql = "SELECT ID_Diapositiva FROM Diapositives WHERE orden = :orden";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([':orden' => $orden]);

        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $row = $statement->fetch();
        return $row['ID_Diapositiva'];
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

    public function editarPresentacio($titol, $descripcio, $id){
        $sql = "UPDATE Presentacions SET titol = (:titol), descripcio = (:descripcio) WHERE ID_Presentacio = (:id)";
        $statement = ($this->pdo)->prepare($sql);

        // $statement->bindValue(':titol', $titol);
        // $statement->bindValue(':descripcio', $descripcio);

        try {
            $statement->execute([
                "titol" => $titol,
                "descripcio" => $descripcio,
                "id" => $id
            ]);
            
        } catch (PDOException $e) {
            echo "Error al guardar datos: " . $e->getMessage();
        }
    }

    public function setDiapositives($titol, $contingut, $id_presentacio){
        $sql = "INSERT INTO Diapositives (titol, contingut, orden, ID_Presentacio) VALUES (:titol, :contingut, :orden, :id_presentacio)";
        $statement = ($this->pdo)->prepare($sql);

        $orden = $this->getOrdenPorID($id_presentacio)+1;
        if ($orden<1 || $orden == 'NULL') {
            $orden = 1;
        }
        try {
            $statement->execute([
                "titol" => $titol,
                "contingut" => $contingut,
                "orden" => $orden,
                ':id_presentacio' => $id_presentacio
            ]);
            
        } catch (PDOException $e) {
            echo "Error al guardar datos: " . $e->getMessage();
        }
    }

    public function alterDiapositives($titol, $contingut, $id_diapositiva){
        $sql = "UPDATE  Diapositives SET titol = :titol, contingut = :contingut WHERE ID_Diapositiva = :id_diapo";
        $statement = ($this->pdo)->prepare($sql);

        try {
            $statement->execute([
                "titol" => $titol,
                "contingut" => $contingut,
                ':id_diapo' => $id_diapositiva
            ]);
            
        } catch (PDOException $e) {
            echo "Error al guardar datos: " . $e->getMessage();
        }
    }

    public function changeOrden($ordenNew, $id_diapo){
        try {            
            $ordenAnterior = $this->getOrdenPorID($id_diapo);

            $sql1 = "UPDATE Diapositives SET orden= -1 WHERE orden = :orden1";
            $statement1 = $this->pdo->prepare($sql1);

            $sql2 = "UPDATE Diapositives SET orden= :orden1 WHERE orden= :orden2";
            $statement2 = $this->pdo->prepare($sql2);

            $sql3 = "UPDATE Diapositives SET orden= :orden2 WHERE orden= -1";
            $statement3 = $this->pdo->prepare($sql3);
            try {
                $statement1->execute(['orden1' => $ordenNew]);
                $statement2->execute(['orden1' => $ordenNew, 'orden2' => $ordenAnterior]);
                $statement3->execute(['orden2' => $ordenAnterior]);
            } catch (PDOException $th) {
                echo 'error al intercambiar   ' . $ordenNew ;
                echo $ordenAnterior;
            }
            
        } catch (PDOException $th) {
           echo 'Error al intercambiar el orden';
        }
    }

    public function getDiapositives($id_presentacio){
        $sql = "SELECT titol, ID_Diapositiva FROM Diapositives WHERE ID_Presentacio = :id_presentacio ORDER BY orden ASC";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([':id_presentacio' => $id_presentacio]);
        
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        return $statement;
    }

    public function eliminarDiapo($id_diapo){
        try {
            $this->pdo->beginTransaction();

            $sql = "DELETE from Diapositives WHERE ID_Diapositiva = :id_diapo";
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':id_diapo', $id_diapo);
            $statement->execute(); 

            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollback();
            return false;
        }
       
    }

    public function eliminarPresentacion($id_presentacion) {
        try {
            $this->pdo->beginTransaction();
    
            // Eliminar las diapositivas relacionadas
            $sql_eliminar_diapositivas = "DELETE FROM Diapositives WHERE ID_Presentacio = :id_presentacion";
            $statement_eliminar_diapositivas = $this->pdo->prepare($sql_eliminar_diapositivas);
            $statement_eliminar_diapositivas->execute([':id_presentacion' => $id_presentacion]);
    
            // Luego, eliminar la propia presentación
            $sql_eliminar_presentacion = "DELETE FROM Presentacions WHERE ID_Presentacio = :id_presentacion";
            $statement_eliminar_presentacion = $this->pdo->prepare($sql_eliminar_presentacion);
            $statement_eliminar_presentacion->execute([':id_presentacion' => $id_presentacion]);
    
            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollback();
            return false;
        }
    }
}