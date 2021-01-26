<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *      collectionOperations={
*           "GET",
*           "create_role"= {
*               "method"="POST",
*               "path"="/role",
*               "controller"=App\Controller\Role\CreateRole::class,
*           },
*           "delete_role"= {
*               "method"="DELETE",
*               "path"="/role",
*               "controller"=App\Controller\Role\DeleteRole::class,
*           },
*           "update_role"= {
*               "method"="PATCH",
*               "path"="/roles/{id}/users",
*               "controller"=App\Controller\Role\AddRoleToUser::class,
*               "defaults"={"_api_resource_class"=Role::class, "_api_collection_operation_name"="update_role"}
*           }       
*   })
 * @ORM\Entity(repositoryClass=RoleRepository::class)
 * @ORM\Table(name="`role`")
 */
class Role
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Right::class, inversedBy="roles")
     */
    private $rights;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="role")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=Group::class, inversedBy="roles")
     */
    private $role_group;

    public function __construct()
    {
        $this->rights = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Right[]
     */
    public function getRights(): Collection
    {
        return $this->rights;
    }

    public function addRight(Right $right): self
    {
        if (!$this->rights->contains($right)) {
            $this->rights[] = $right;
        }

        return $this;
    }

    public function removeRight(Right $right): self
    {
        if ($this->rights->contains($right)) {
            $this->rights->removeElement($right);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
        }

        return $this;
    }

    public function getRoleGroup(): ?Group
    {
        return $this->role_group;
    }

    public function setRoleGroup(?Group $role_group): self
    {
        $this->role_group = $role_group;

        return $this;
    }
}
