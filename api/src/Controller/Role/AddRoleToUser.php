<?php

namespace App\Controller\Role;

use App\Manager\RoleManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Role;

class AddRoleToUser
{

    protected $em;

    protected $roleManager;
    public function __construct(RoleManager $roleManager)
    {
        $this->roleManager = $roleManager;
    }

    public function __invoke($data)
    {
        var_dump($data);
        exit;
        $resp = $this->roleManager->addRoleToUser($data);

        return new JsonResponse($resp, 200);
    }
}
