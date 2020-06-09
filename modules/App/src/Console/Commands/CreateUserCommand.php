<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Entities\User;
use App\Services\UserManager;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CreateUserCommand extends Command
{
    protected static $defaultName = 'user:create';
    /**
     * @var UserManager
     */
    private UserManager $userManager;

    /**
     * CreateUserCommand constructor.
     * @param UserManager $userManager
     */
    public function __construct(UserManager $userManager)
    {
        parent::__construct();
        $this->userManager = $userManager;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Create test user');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');

        $usernameQuestion = new Question('Username?', false);
        $passwordQuestion = new Question('Password?', false);
        $nameQuestion = new Question('Name?', false);

        $username = null;
        $password = null;
        $name = null;

        if (!$username = $helper->ask($input, $output, $usernameQuestion)) {
            $output->writeln('<error>Username not given</error>');
            return 0;
        }

        if (!$password = $helper->ask($input, $output, $passwordQuestion)) {
            $output->writeln('<error>Password not given</error>');
            return 0;
        }

        if (!$name = $helper->ask($input, $output, $nameQuestion)) {
            $output->writeln('<error>Name not given</error>');
            return 0;
        }

        // No password hashing as this is only a test/demo
        $user = (new User())
            ->setUsername($username)
            ->setPassword($password)
            ->setName($name);

        $this->userManager->createUser($user);

        return 0;
    }
}
