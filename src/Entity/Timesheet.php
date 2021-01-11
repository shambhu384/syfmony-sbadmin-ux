<?php

namespace App\Entity;

use App\Repository\TimesheetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TimesheetRepository::class)
 */
class Timesheet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="timesheets")
     */
    private $user;

    /**
     * @ORM\Column(type="date")
     */
    private $workDay;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $hour;

    /**
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @ORM\OneToMany(targetEntity=Attachment::class, mappedBy="timesheet")
     */
    private $attachment;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->attachment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getWorkDay(): ?\DateTimeInterface
    {
        return $this->workDay;
    }

    public function setWorkDay(\DateTimeInterface $workDay): self
    {
        $this->workDay = $workDay;

        return $this;
    }

    public function getHour(): ?float
    {
        return $this->hour;
    }

    public function setHour(float $hour): self
    {
        $this->hour = $hour;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return Collection|Attachment[]
     */
    public function getAttachment(): Collection
    {
        return $this->attachment;
    }

    public function addAttachment(Attachment $attachment): self
    {
        if (!$this->attachment->contains($attachment)) {
            $this->attachment[] = $attachment;
            $attachment->setTimesheet($this);
        }

        return $this;
    }

    public function removeAttachment(Attachment $attachment): self
    {
        if ($this->attachment->removeElement($attachment)) {
            // set the owning side to null (unless already changed)
            if ($attachment->getTimesheet() === $this) {
                $attachment->setTimesheet(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
