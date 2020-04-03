<?php
// src/EventSubscriber/TaskSubscriber.php
namespace App\EventSubscriber;

use KevinPapst\AdminLTEBundle\Event\TaskListEvent;
use KevinPapst\AdminLTEBundle\Helper\Constants;
use KevinPapst\AdminLTEBundle\Model\TaskModel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TaskSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [];
        return [
            TaskListEvent::class => ['onTasks', 100],
        ];
    }

    public function onTasks(TaskListEvent $event)
    {
        $task = new TaskModel();
        $task
            ->setId(1)
            ->setTitle('My task')
            ->setColor(Constants::COLOR_AQUA)
            ->setProgress(80)
        ;
        $event->addTask($task);

        /*
         * You can also set the total number of tasks which could be different from those displayed in the navbar
         * If no total is set, the total will be calculated on the number of tasks added to the event
         */
        $event->setTotal(15);
    }
}