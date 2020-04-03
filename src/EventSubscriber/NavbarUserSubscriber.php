<?php
// src/EventSubscriber/NavbarUserSubscriber.php
namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use KevinPapst\AdminLTEBundle\Event\ShowUserEvent;
use KevinPapst\AdminLTEBundle\Event\NavbarUserEvent;
use KevinPapst\AdminLTEBundle\Event\SidebarUserEvent;
use KevinPapst\AdminLTEBundle\Model\UserModel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class NavbarUserSubscriber implements EventSubscriberInterface
{
    protected $security;
    private $em;

    public function __construct(Security $security, EntityManagerInterface $entityManager)
    {
        $this->security = $security;
        $this->em = $entityManager;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            NavbarUserEvent::class => ['onShowUser', 100],
            SidebarUserEvent::class => ['onShowUser', 100],
        ];
    }

    public function onShowUser(ShowUserEvent $event)
    {
        if (null === $this->security->getUser()) {
            return;
        }

        /* @var $currentUser User */
        //FIXME: I seriously don't know what is going on here ...
        $currentUser = $this->em->getRepository(User::class)->findOneById($this->security->getUser()->getUsername());

        $user = new UserModel();
        $user
            ->setId(/* $myUser->getId() */ 1)
            ->setName($currentUser->getFirstname() . " " . $currentUser->getLastname())
            ->setUsername($currentUser->getEmail())
            ->setIsOnline(true)
            ->setTitle("User")
            ->setAvatar("/profile/1/avatar")
            ->setMemberSince(new \DateTime("now"))
        ;

        $event->setUser($user);

    }
}