<?php

namespace App\Controller;

use App\Manager\UserManager;

class CreateUser
{

    protected $em;

    protected $userManager;
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function __invoke($data)
    {
        $user = $data;
        $this->userManager->registerAccount($user);
    }
}
