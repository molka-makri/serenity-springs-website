<?php
class Service {
    private ?int $service_id;
    private ?int $service_type_id;
    private ?string $nom;
    private ?string $contact;
    private ?string $photo;

    public function __construct(?int $service_id, ?int $service_type_id, ?string $nom, ?string $contact, ?string $photo) {
        $this->service_id = $service_id;
        $this->service_type_id = $service_type_id;
        $this->nom = $nom;
        $this->contact = $contact;
        $this->photo = $photo;
    }

    public function getServiceId(): ?int {
        return $this->service_id;
    }

    public function setServiceId(?int $service_id): void {
        $this->service_id = $service_id;
    }

    public function getServiceTypeId(): ?int {
        return $this->service_type_id;
    }

    public function setServiceTypeId(?int $service_type_id): void {
        $this->service_type_id = $service_type_id;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom(?string $nom): void {
        $this->nom = $nom;
    }

    public function getContact(): ?string {
        return $this->contact;
    }

    public function setContact(?string $contact): void {
        $this->contact = $contact;
    }

    public function getPhoto(): ?string {
        return $this->photo;
    }

    public function setPhoto(?string $photo): void {
        $this->photo = $photo;
    }
}
?>