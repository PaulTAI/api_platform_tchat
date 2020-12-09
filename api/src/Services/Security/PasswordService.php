<?php

namespace App\Service\Security;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Repository\UserRepository;

class PasswordService
{
    private $passwordEncoder;
    private $userRepository;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, UserRepository $userRepository)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
    }

    /**
     * update user password
     * 
     * @param string $mail user mail
     * @param string $newPassword new user password
     * 
     */
    public function updatePassword(string $mail, string $newPassword)
    {
        $user = new User();

        $password = $this->passwordEncoder->encodePassword(
            $user,
            $newPassword
        );

        $this->userRepository->updatePasswordWithUserMail($mail, $password);
    }

    public function encode($entity, $password): string
    {
        return $this->passwordEncoder->encodePassword($entity, $password);
    }

    public function maxLength($len)
    {
        $func = function ($value) use ($len) {
            return strlen($value) <= $len;
        };
        return $func;
    }

    /**
     * hash password
     * 
     * @return string hashed password
     */
    public function hashPassword(User $user)
    {
        return $this->passwordEncoder->encodePassword($user, $user->getPassword());
    }

    /**
     * Check if passwords are the same
     *
     */
    public function checkPassword(User $user, $pass)
    {
        return $this->passwordEncoder->isPasswordValid($user, $pass);
    }
}
