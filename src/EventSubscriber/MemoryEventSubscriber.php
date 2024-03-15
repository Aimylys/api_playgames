<?php

namespace App\EventSubscriber;

use App\Entity\User;
use App\Entity\Memory;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class MemoryEventSubscriber implements EventSubscriber
{
    public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
            Events::postUpdate,
            Events::postRemove,
        ];
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $memory = $args->getObject();
        if (!$memory instanceof Memory) {
            return;
        }

        $this->updateTotalMemoryScore($memory->getUser(), $args);
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $memory = $args->getObject();
        if (!$memory instanceof Memory) {
            return;
        }

        $this->updateTotalMemoryScore($memory->getUser(), $args);
    }

    public function postRemove(LifecycleEventArgs $args)
    {
        $memory = $args->getObject();
        if (!$memory instanceof Memory) {
            return;
        }

        $this->updateTotalMemoryScore($memory->getUser(), $args);
    }

    private function updateTotalMemoryScore(User $user, LifecycleEventArgs $args)
    {
        $totalScore = 0;
        foreach ($user->getScoreMemory() as $memory) {
            $totalScore += $memory->getScoreM();
        }
        $user->setTotalMemoryScore($totalScore);

        // Persist the changes
        $entityManager = $args->getObjectManager();
        $entityManager->persist($user);
        $entityManager->flush();
    }
}
