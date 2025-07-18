<?php

namespace App\Entity;

use App\Repository\AudioLogRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity(repositoryClass: AudioLogRepository::class)]
#[HasLifecycleCallbacks]
class AudioLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $sessionNumber = null;

    #[ORM\Column]
    private ?int $partNumber = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $transript = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $summary = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $speaker = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $subject = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSessionNumber(): ?int
    {
        return $this->sessionNumber;
    }

    public function setSessionNumber(int $sessionNumber): static
    {
        $this->sessionNumber = $sessionNumber;

        return $this;
    }

    public function getPartNumber(): ?int
    {
        return $this->partNumber;
    }

    public function setPartNumber(int $partNumber): static
    {
        $this->partNumber = $partNumber;

        return $this;
    }

    public function getTransript(): ?string
    {
        return $this->transript;
    }

    public function setTransript(?string $transript): static
    {
        $this->transript = $transript;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): static
    {
        $this->summary = $summary;

        return $this;
    }

    public function getSpeaker(): ?string
    {
        return $this->speaker;
    }

    public function setSpeaker(?string $speaker): static
    {
        $this->speaker = $speaker;

        return $this;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new DateTimeImmutable();
        $this->setUpdatedAtValue();
    }

    #[ORM\PreUpdate]
    public function setUpdatedAtValue(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): static
    {
        $this->subject = $subject;

        return $this;
    }

}
