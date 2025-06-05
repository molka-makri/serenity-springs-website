<?php
 include_once(__DIR__ . '/../config.php');
include(__DIR__ . '/../Model/Service.php');

class ServiceController {

    public function listService() {
        $sql = "SELECT 
                    services.service_id, 
                    services.nom, 
                    services.contact, 
                    services.photo, 
                    service_types.type_name 
                FROM 
                    services
                INNER JOIN 
                    service_types
                ON 
                    services.service_type_id = service_types.service_type_id";
        $db = config::getConnexion();

        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $err) {
            die("Erreur lors de la récupération des services : " . $err->getMessage());
        }
    }

    public function listServiceAlphabetically() {
        // Tri par ordre alphabétique (basé sur la colonne 'nom')
        $sql = "SELECT 
                    services.service_id, 
                    services.nom, 
                    services.contact, 
                    services.photo, 
                    service_types.type_name 
                FROM 
                    services
                INNER JOIN 
                    service_types
                ON 
                    services.service_type_id = service_types.service_type_id
                ORDER BY 
                    services.nom ASC"; // Tri alphabétique sur 'nom'
        $db = config::getConnexion();

        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $err) {
            die("Erreur lors du tri alphabétique des services : " . $err->getMessage());
        }
    }

    public function listServiceByLatest() {
        // Tri par dernier ajouté (basé sur l'identifiant croissant)
        $sql = "SELECT 
                    services.service_id, 
                    services.nom, 
                    services.contact, 
                    services.photo, 
                    service_types.type_name 
                FROM 
                    services
                INNER JOIN 
                    service_types
                ON 
                    services.service_type_id = service_types.service_type_id
                ORDER BY 
                    services.service_id DESC"; // Dernier ajouté en premier
        $db = config::getConnexion();

        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $err) {
            die("Erreur lors du tri des derniers services ajoutés : " . $err->getMessage());
        }
    }

    public function listServiceTypes() {
        $sql = "SELECT * FROM service_types";
        $db = config::getConnexion();

        try {
            return $db->query($sql);
        } catch (Exception $err) {
            die("Erreur lors de la récupération des types de services : " . $err->getMessage());
        }
    }

    public function addService($service) {
        $sql = "INSERT INTO services (service_type_id, nom, contact, photo) 
                VALUES (:service_type_id, :nom, :contact, :photo)";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'service_type_id' => $service->getServiceTypeId(),
                'nom' => $service->getNom(),
                'contact' => $service->getContact(),
                'photo' => $service->getPhoto()
            ]);
        } catch (Exception $err) {
            die("Erreur lors de l'ajout du service : " . $err->getMessage());
        }
    }

    public function deleteService($id) {
        $sql = "DELETE FROM services WHERE service_id = :id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
        } catch (Exception $e) {
            die("Erreur lors de la suppression : " . $e->getMessage());
        }
    }

    public function getService($id) {
        $sql = "SELECT * FROM services WHERE service_id = :id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die("Erreur lors de la récupération du service : " . $e->getMessage());
        }
    }

    public function updateService($service) {
        $sql = "UPDATE services SET service_type_id = :service_type_id, nom = :nom, 
                contact = :contact, photo = :photo WHERE service_id = :id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'service_type_id' => $service->getServiceTypeId(),
                'nom' => $service->getNom(),
                'contact' => $service->getContact(),
                'photo' => $service->getPhoto(),
                'id' => $service->getServiceId()
            ]);
        } catch (Exception $err) {
            die("Erreur lors de la mise à jour du service : " . $err->getMessage());
        }
    }
}
?>