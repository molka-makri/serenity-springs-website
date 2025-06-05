<?php
include(__DIR__ . '/../config.php');

class servicetypecontroller {

    // Fonction pour lister tous les types de services
    public function listServiceTypes() {
        $sql = "SELECT * FROM service_types";
        $db = config::getConnexion();

        try {
            return $db->query($sql);
        } catch (Exception $err) {
            die("Erreur lors de la récupération des types de services : " . $err->getMessage());
        }
    }

    // Fonction pour ajouter un type de service
    public function addServiceType($typeName) {
        // Vérifier que le type de service n'est pas vide et qu'il a au maximum 10 caractères
        if (empty($typeName)) {
            throw new Exception("Le nom du type de service ne peut pas être vide.");
        }
        if (strlen($typeName) > 10) {
            throw new Exception("Le nom du type de service ne doit pas dépasser 10 caractères.");
        }

        $sql = "INSERT INTO service_types (type_name) VALUES (:type_name)";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute(['type_name' => $typeName]);
        } catch (Exception $err) {
            die("Erreur lors de l'ajout du type de service : " . $err->getMessage());
        }
    }

    // Fonction pour supprimer un type de service
    public function deleteServiceType($id) {
        // Vérifier si le type de service existe dans la base
        $sqlCheck = "SELECT * FROM service_types WHERE service_type_id = :id";
        $db = config::getConnexion();

        $query = $db->prepare($sqlCheck);
        $query->bindValue(':id', $id);
        $query->execute();
        
        if ($query->rowCount() == 0) {
            throw new Exception("Ce type de service n'existe pas.");
        }

        $sql = "DELETE FROM service_types WHERE service_type_id = :id";
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
        } catch (Exception $e) {
            die("Erreur lors de la suppression du type de service : " . $e->getMessage());
        }
    }

    // Fonction pour récupérer un type de service spécifique
    public function getServiceType($id) {
        $sql = "SELECT * FROM service_types WHERE service_type_id = :id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die("Erreur lors de la récupération du type de service : " . $e->getMessage());
        }
    }

    // Fonction pour mettre à jour un type de service
    public function updateServiceType($id, $typeName) {
        // Vérifier que le type de service n'est pas vide et qu'il a au maximum 10 caractères
        if (empty($typeName)) {
            throw new Exception("Le nom du type de service ne peut pas être vide.");
        }
        if (strlen($typeName) > 10) {
            throw new Exception("Le nom du type de service ne doit pas dépasser 10 caractères.");
        }

        $sql = "UPDATE service_types SET type_name = :type_name WHERE service_type_id = :id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'type_name' => $typeName,
                'id' => $id
            ]);
        } catch (Exception $err) {
            die("Erreur lors de la mise à jour du type de service : " . $err->getMessage());
        }
    }
}
?>