<?php

namespace App\Entity;

use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=GroupRepository::class)
 * @ORM\Table(name="`group`")
 * @ApiResource()
 */
class Group
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="groups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createAt;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="groupList")
     */
    private $userList;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="toGroup")
     */
    private $messages;

    /**
     * @ORM\OneToMany(targetEntity=Role::class, mappedBy="role_group")
     */
    private $roles;

    public function __construct()
    {
        $this->userList = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->roles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
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

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUserList(): Collection
    {
        return $this->userList;
    }

    public function addUserList(User $userList): self
    {
        if (!$this->userList->contains($userList)) {
            $this->userList[] = $userList;
            $userList->addGroupList($this);
        }

        return $this;
    }

    public function removeUserList(User $userList): self
    {
        if ($this->userList->contains($userList)) {
            $this->userList->removeElement($userList);
            $userList->removeGroupList($this);
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setGroupSended($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getGroupSended() === $this) {
                $message->setGroupSended(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Role[]
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(Role $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles[] = $role;
            $role->setRoleGroup($this);
        }

        return $this;
    }

    public function removeRole(Role $role): self
    {
        if ($this->roles->contains($role)) {
            $this->roles->removeElement($role);
            // set the owning side to null (unless already changed)
            if ($role->getRoleGroup() === $this) {
                $role->setRoleGroup(null);
            }
        }

        return $this;
    }
}
