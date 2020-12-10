<?php

namespace App\Manager;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\Security\PasswordService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserManager
{

    protected $passwordService;
    protected $UserRepository;
    protected $entityManager;

    public function __construct(PasswordService $passwordService, EntityManagerInterface $entityManager, UserRepository $UserRepository)
    {
        $this->passwordService = $passwordService;
        $this->entityManager = $entityManager;
        $this->UserRepository = $UserRepository;
    }

    /**
     * Retour si l'email exist
     *
     * @param string $email
     * @return void
     */
    public function EmailIsUse(string $email)
    {
        $user = $this->UserRepository->findByEmail($email);
        if ($user) {
            return $user[0];
        }

        return null;
    }

    public function tokenResetFormat()
    {
        return "TRESF" . uniqid();
    }

    public function registerAccount(User $user)
    {
        if ($this->EmailIsUse($user->getEmail())) {
            throw new BadRequestHttpException('Cette adresse email exist déjà');
        }

        $user->setEmail($user->getEmail());
        $pass = $this->passwordService->encode($user, $user->getPassword());
        $user->setPassword($pass);
        $user->setTokenReset($this->tokenResetFormat());
        $user->setCreateAt(new \DateTime());

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return [
            "message" => "Utilisateur enregistré",
            "user" => $user
        ];
    }
}
