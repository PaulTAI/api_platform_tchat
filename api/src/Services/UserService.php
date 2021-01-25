<?php

namespace App\Service;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserService
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * get User
     *
     * @return UserInterface
     */
    public function getUser(){
        return $this->tokenStorage->getToken()->getUser();
    }

    
}
