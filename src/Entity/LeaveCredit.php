<?php

namespace App\Entity;

use App\Repository\LeaveCreditRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LeaveCreditRepository::class)
 */
class LeaveCredit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=LeaveType::class, inversedBy="leaveCredits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $leaveType;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="leaveCredits")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLeaveType(): ?LeaveType
    {
        return $this->leaveType;
    }

    public function setLeaveType(?LeaveType $leaveType): self
    {
        $this->leaveType = $leaveType;

        return $this;
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
}
