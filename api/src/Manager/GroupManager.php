<?php

namespace App\Manager;
// TODO CHANGER ROLE EN GROUP
use App\Entity\Group;
use App\Repository\GroupRepository;
use App\Service\GroupService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class GroupManager
{
    protected $GroupRepository;
    protected $entityManager;
    private $groupService;

    public function __construct(EntityManagerInterface $entityManager, GroupRepository $GroupRepository, GroupService $groupService)
    {
        $this->entityManager = $entityManager;
        $this->GroupRepository = $GroupRepository;
        $this->groupService = $groupService;
    }

    /**
     * add user in group
     * @param Group $group
     * @return void
     */
    public function addUserToGroup(Group $group) {
        var_dump($group);
        exit;
        $users = $group->getUserList();
        
        $userRights = $this->groupService->getUserRightsInGroup($group);
        
        // 1 => id pour ajouter un utilisateur d'un groupe
        if(in_array("owner", $userRights) || in_array(1, $userRights)){
            // TODO ajouter utilisateur dans le groupe
            // dans groupRepository
            
            $this->GroupRepository->insertUserInGroup($users, $group);

            return  [
                "message" => "L'utilisateur a bien été ajouté",
                "users" => $users
            ];
        }

        return [
            "message" => "Vous n'avais pas les droits pour ajouter un utilisateur dans le groupe",
            "rights" => $userRights
        ];
    }


    /**
     * delete user in group
     *
     * @return void
     */
    public function deleteUserGroup(Group $group){

        $users = $group->getUserList();

        $userRights = $this->groupService->getUserRightsInGroup($group);

        // 2 => id pour supprimer un utilisateur d'un groupe
        if(in_array("owner", $userRights) || in_array(2, $userRights)){
            // TODO suppruer l'utilsateur dans le groupe
            // dans groupRepository
            $this->GroupRepository->deleteUserFromGroup($users, $group);

            return [
                "message" => "L'utilisateur a bien été supprimé",
                "users" => $users
            ];
        }

        return [
            "message" => "Vous n'avais pas les droits pour supprimer un utilisateur dans le groupe",
            "rights" => $userRights
        ];

    }
}
