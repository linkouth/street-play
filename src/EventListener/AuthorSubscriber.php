<?php


namespace App\EventListener;

use App\Helper\AuthorInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AuthorSubscriber implements EventSubscriberInterface
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public static function getSubscribedEvents()
    {
        return ['prePersist'];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof AuthorInterface) {
            if ($this->tokenStorage->getToken()) {
                if ($this->tokenStorage->getToken()->getUser()) {
                    if (!$entity->getAuthor()) {
                        $entity->setAuthor($this->tokenStorage->getToken()->getUser());
                    }
                }
            }
        }
    }
}