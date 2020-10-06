<?php

namespace App\Entity;

use App\Repository\CandidatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CandidatRepository::class)
 */
class Candidat extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $anneeExp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnneeExp(): ?int
    {
        return $this->anneeExp;
    }

    public function setAnneeExp(?int $anneeExp): self
    {
        $this->anneeExp = $anneeExp;

        return $this;
    }
}
