<?php
namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

class AuthenticationSuccessListener
{
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event): void
    {
        $user = $event->getUser();

        // Ajoutez l'ID de l'utilisateur au payload du token
        $data = $event->getData();
        $data['id'] = $user->getId();
        $event->setData($data);
    }
}