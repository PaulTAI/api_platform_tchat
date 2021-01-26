<?php

namespace App\Controller\Group;

use App\Manager\GroupManager;
use Symfony\Component\HttpFoundation\JsonResponse;

class DeleteUserFromGroup
{

    protected $em;

    protected $groupManager;
    public function __construct(GroupManager $groupManager)
    {
        $this->groupManager = $groupManager;
    }

    public function __invoke($data) : JsonResponse
    {
        $group = $data;
        $resp = $this->groupManager->deleteUserGroup($group);

        return new JsonResponse($resp, 200);
    }
}
