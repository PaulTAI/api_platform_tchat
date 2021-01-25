<?php

namespace App\Controller\Role;

use App\Manager\RoleManager;
use Symfony\Component\HttpFoundation\JsonResponse;

class DeleteRole
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
        $resp = $this->roleManager->deleteRole($role);

        return new JsonResponse($resp, 200);
    }
}
