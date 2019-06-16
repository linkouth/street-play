<?php


namespace App\Helper;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;

trait AuthorTrait
{
    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $author;

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }
}