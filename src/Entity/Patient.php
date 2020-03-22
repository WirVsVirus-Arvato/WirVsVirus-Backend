<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PatientRepository")
 */
class Patient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $uniqueId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $monitorUntil;

    /**
     * @ORM\Column(type="datetime")
     */
    private $addedOn;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastSync;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $preconditions = [];

    /**
     * @ORM\Column(type="boolean")
     */
    private $singleHousehold;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUniqueId(): ?string
    {
        return $this->uniqueId;
    }

    public function setUniqueId(string $uniqueId): self
    {
        $this->uniqueId = $uniqueId;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getMonitorUntil(): ?\DateTimeInterface
    {
        return $this->monitorUntil;
    }

    public function setMonitorUntil(?\DateTimeInterface $monitorUntil): self
    {
        $this->monitorUntil = $monitorUntil;

        return $this;
    }

    public function getAddedOn(): ?\DateTimeInterface
    {
        return $this->addedOn;
    }

    public function setAddedOn(\DateTimeInterface $addedOn): self
    {
        $this->addedOn = $addedOn;

        return $this;
    }

    public function getLastSync(): ?\DateTimeInterface
    {
        return $this->lastSync;
    }

    public function setLastSync(?\DateTimeInterface $lastSync): self
    {
        $this->lastSync = $lastSync;

        return $this;
    }

    public function getPreconditions(): ?array
    {
        return $this->preconditions;
    }

    public function setPreconditions(?array $preconditions): self
    {
        $this->preconditions = $preconditions;

        return $this;
    }

    public function getSingleHousehold(): ?bool
    {
        return $this->singleHousehold;
    }

    public function setSingleHousehold(bool $singleHousehold): self
    {
        $this->singleHousehold = $singleHousehold;

        return $this;
    }
}
