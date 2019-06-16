<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlaceRepository")
 */
class Place
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $images;

    /**
     * @var ArrayCollection|Message[]
     *
     * @ORM\OneToMany(targetEntity="Message", mappedBy="place")
     */
    private $messages;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(string $images): self
    {
        $this->images = $images;

        return $this;
    }

    /**
     * @return Message[]|ArrayCollection
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param Message[]|ArrayCollection $messages
     */
    public function setMessages($messages): void
    {
        $this->messages = $messages;
    }

    /**
     * @param Message $message
     */
    public function addMessage(Message $message): void
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
        }
    }

    /**
     * @param Message $message
     */
    public function removeMessage(Message $message): void
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
        }
    }
}
