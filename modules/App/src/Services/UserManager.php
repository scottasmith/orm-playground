<?php

declare(strict_types=1);

namespace App\Services;

use App\Entities\User;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class UserManager
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * UserManager constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param string $username
     * @return User|null
     */
    public function findByUsername(string $username): ?User
    {
        /** @var User $user */
        $user = $this->em
            ->getRepository(User::class)
            ->findOneByUsername($username);

        return $user;
    }

    /**
     * @param User $user
     * @throws Exception
     */
    public function createUser(User $user)
    {
        $username = $user->getUsername();

        if ($user->getId()) {
            throw new Exception('User entity already has an ID');
        }

        if ($this->findByUsername($username)) {
            throw new Exception("User with username(${$username}) already exists");
        }

        // Persist to memory
        $this->em->persist($user);

        // Flush to database
        $this->em->flush();
    }
}
