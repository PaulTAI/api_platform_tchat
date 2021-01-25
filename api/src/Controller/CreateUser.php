<?php

namespace App\Controller;

use App\Manager\UserManager;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        $resp = $this->userManager->registerAccount($user);

        return new JsonResponse($resp, 200);
    }
}
