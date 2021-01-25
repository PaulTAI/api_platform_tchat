<?php

namespace App\Service;

use App\Entity\Group;
use App\Service\UserService;
use App\Repository\GroupRepository;

class GroupService
{
    private $groupRepository;
    private $UserService;

    public function __construct(GroupRepository $groupRepository, UserService $UserService)
    {
        $this->groupRepository = $groupRepository;
        $this->UserService = $UserService;
    }

    /**
     * get user rights in the group
     *
     * @param Group $group
     * @return array array of rights ids
     */
    public function getUserRightsInGroup(Group $group){
        
        $currentUser = $this->UserService->getUser();
        
        if($group->getOwner() == $currentUser){
            return ["owner"];
        }

        $roles = $group->getRoles();

        $rightsIds = [];
        for($i = 0; $i < sizeof($roles); $i++){
            for($j = 0; $j < sizeof($roles[$i]->getUsers()); $j++){
                if($roles[$i]->getUsers()[$j] == $currentUser){
                    for($k = 0; $k < sizeof($roles[$i]->getRights()); $k++){
                        array_push($rightsIds, $roles[$i]->getRights()[$k]->getId());
                    }
                }
            }
        }

        return [];

    }
}
