<?php

namespace App\Entity;

use App\Helper\AuthorInterface;
use App\Helper\AuthorTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message implements AuthorInterface
{
    use AuthorTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $place;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $text;

    /**
     * @ORM\Column(type="integer")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    public function __construct()
    {
        $this->createdAt = time();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(?string $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getCreatedAt(): ?int
    {
        return $this->createdAt;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }
}
