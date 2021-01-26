<?php

namespace App\Controller\Group;

use App\Manager\GroupManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Group;

class AddUserToGroup
{

    protected $em;

    protected $groupManager;
    public function __construct(GroupManager $groupManager)
    {
        $this->groupManager = $groupManager;
    }

    public function __invoke($data) : JsonResponse
    {
        var_dump($data);
        exit;
        $resp = $this->groupManager->addUserToGroup($group);

        return new JsonResponse($resp, 200);
    }
}
