<?php

namespace App\Event;

use App\Event\UserRegisteredEvent;

class UserRegisteredEventHandler
{
    public function handle(UserRegisteredEvent $event): void
    {
        $user = $event->getUser();
        $email = $user->getEmail();

        // Simular envío de correo
        echo "Simulando envío de correo\nbienvenid@: $email\n";
    }
}
