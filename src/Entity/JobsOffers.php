<?php

namespace App\Entity;

use App\Repository\JobsOffersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobsOffersRepository::class)]
class JobsOffers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $title = null;

    #[ORM\Column(length: 100)]
    private ?string $address = null;

    #[ORM\Column(length: 100)]
    private ?string $city = null;

    #[ORM\Column(length: 5)]
    private ?string $zipCode = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $publishedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'myOffers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recuiters $authorId;

    #[ORM\OneToMany(mappedBy: 'applies', targetEntity: Apply::class)]
    private Collection $listApply;

    public function __construct()
    {   
        $this->createdAt = new \DateTimeImmutable();
        $this->publishedAt = new \DateTimeImmutable();
        $this->isActive = false;
        $this->listApply = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeImmutable
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeImmutable $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getAuthorId(): ?Recuiters
    {
        return $this->authorId;
    }

    public function setAuthorId(?Recuiters $authorId): self
    {
        $this->authorId = $authorId;

        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }

    /**
     * @return Collection<int, Apply>
     */
    public function getListApply(): Collection
    {
        return $this->listApply;
    }

    public function addListApply(Apply $listApply): self
    {
        if (!$this->listApply->contains($listApply)) {
            $this->listApply->add($listApply);
            $listApply->setApplies($this);
        }

        return $this;
    }

    public function removeListApply(Apply $listApply): self
    {
        if ($this->listApply->removeElement($listApply)) {
            // set the owning side to null (unless already changed)
            if ($listApply->getApplies() === $this) {
                $listApply->setApplies(null);
            }
        }

        return $this;
    }

}
