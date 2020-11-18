<?php

namespace App\Entity;

use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupRepository::class)
 * @ORM\Table(name="`group`")
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
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $tchatJwt;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="groupList")
     */
    private $userList;

    public function __construct()
    {
        $this->userList = new ArrayCollection();
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

    public function getTchatJwt(): ?string
    {
        return $this->tchatJwt;
    }

    public function setTchatJwt(?string $tchatJwt): self
    {
        $this->tchatJwt = $tchatJwt;

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
}
