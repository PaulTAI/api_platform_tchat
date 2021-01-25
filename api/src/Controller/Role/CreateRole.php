<?php

namespace App\Controller\Role;

use App\Manager\RoleManager;
use Symfony\Component\HttpFoundation\JsonResponse;

class CreateRole
{

    protected $em;

    protected $roleManager;
    public function __construct(RoleManager $roleManager)
    {
        $this->roleManager = $roleManager;
    }

    public function __invoke($data) : JsonResponse
    {
        $role = $data;
        $resp = $this->roleManager->createRole($role);

        return new JsonResponse($resp, 200);
    }
}
