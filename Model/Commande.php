<?php
class Commande
{
    private ?int $idCommande = null;
    private ?string $type = null;
    private ?float $prix = null;
    private ?string $dateCommande = null;
    private ?int $quantite = null;

    // Constructeur avec types explicitement définis pour les paramètres
    public function __construct(?int $id = null, string $type, float $prix, string $dateCommande, int $quantite)
    {
        $this->idCommande = $id;
        $this->type = $type;
        $this->prix = $prix;
        $this->dateCommande = $dateCommande;
        $this->quantite = $quantite;
    }

    // Getters et Setters
    public function getIdCommande(): ?int
    {
        return $this->idCommande;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;
        return $this;
    }

    public function getDateCommande(): ?string
    {
        return $this->dateCommande;
    }

    public function setDateCommande(string $dateCommande): self
    {
        $this->dateCommande = $dateCommande;
        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;
        return $this;
    }
}
?>
