<?php

namespace App\Entity;

use App\Repository\AttachmentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AttachmentRepository::class)
 */
class Attachment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity=Timesheet::class, inversedBy="attachment")
     * @ORM\JoinColumn(nullable=false)
     */
    private $timesheet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getTimesheet(): ?Timesheet
    {
        return $this->timesheet;
    }

    public function setTimesheet(?Timesheet $timesheet): self
    {
        $this->timesheet = $timesheet;

        return $this;
    }
}
