<?php

namespace App\Entity;

use App\Entity\Users;
use App\Entity\Ticket;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TicketRepository;

/**
 * @ORM\Entity(repositoryClass=TicketRepository::class)
 */
class Ticket
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
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_read = 0;

    /**
     * @ORM\ManyToOne(targetEntity=users::class, inversedBy="sent")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sender;

    /**
     * @ORM\ManyToOne(targetEntity=users::class, inversedBy="received")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipient;

    public function __construct()
    {
        $this->created_at = new \DateTime();
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

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getIsRead(): ?bool
    {
        return $this->is_read;
    }

    public function setIsRead(bool $is_read): self
    {
        $this->is_read = $is_read;

        return $this;
    }

    public function getSender(): ?users
    {
        return $this->sender;
    }

    public function setSender(?users $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getRecipient(): ?users
    {
        return $this->recipient;
    }

    public function setRecipient(?users $recipient): self
    {
        $this->recipient = $recipient;

        return $this;
    }
}
