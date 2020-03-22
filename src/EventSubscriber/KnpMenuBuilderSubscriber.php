<?php
// src/EventSubscriber/KnpMenuBuilderSubscriber.php
namespace App\EventSubscriber;

use KevinPapst\AdminLTEBundle\Event\KnpMenuEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class KnpMenuBuilderSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return [
            KnpMenuEvent::class => ['onSetupMenu', 100],
        ];
    }

    public function onSetupMenu(KnpMenuEvent $event)
    {
        $menu = $event->getMenu();

        $menu->addChild('Main', [
            'label' => 'MENU',
            'childOptions' => $event->getChildOptions()
        ])->setAttribute('class', 'header');

        $menu->getChild('Main')->addChild('Main_Dashboard', [
            'route' => 'home',
            'label' => 'Dashboard',
            'childOptions' => $event->getChildOptions()
        ])->setLabelAttribute('icon', 'fas fa-tachometer-alt');

        $menu->getChild('Main')->addChild('Main_Inbox', [
            'route' => 'documents_inbox',
            'label' => 'Inbox',
            'childOptions' => $event->getChildOptions()
        ])->setLabelAttribute('icon', 'fas fa-inbox');

        $menu->getChild('Main')->addChild('Main_FollowUps', [
            'route' => 'documents_followups',
            'label' => 'Follow Ups',
            'childOptions' => $event->getChildOptions()
        ])->setLabelAttribute('icon', 'fas fa-flag');

        $menu->getChild('Main')->addChild('Main_AllDocuments', [
            'route' => 'documents_all',
            'label' => 'All Documents',
            'childOptions' => $event->getChildOptions()
        ])->setLabelAttribute('icon', 'fas fa-globe-europe');



        /*

        $menu = $event->getMenu();

        $menu->addChild('MainNavigationMenuItem', [
       	    'label' => 'MAIN NAVIGATION',
            'childOptions' => $event->getChildOptions()
        ])->setAttribute('class', 'header');

        $menu->addChild('blogId', [
            'route' => 'item_symfony_route',
            'label' => 'Blog',
            'childOptions' => $event->getChildOptions()
        ])->setLabelAttribute('icon', 'fas fa-tachometer-alt');

        $menu->getChild('blogId')->addChild('ChildOneItemId', [
            'route' => 'child_1_route',
            'label' => 'ChildOneDisplayName',
            'childOptions' => $event->getChildOptions()
        ])->setLabelAttribute('icon', 'fas fa-rss-square');

        $menu->getChild('blogId')->addChild('ChildTwoItemId', [
            'route' => 'child_2_route',
            'label' => 'ChildTwoDisplayName',
            'childOptions' => $event->getChildOptions()
        ]);

         */
    }
}