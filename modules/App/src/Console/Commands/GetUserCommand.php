<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\UserManager;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class GetUserCommand extends Command
{
    protected static $defaultName = 'user:get';
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
            ->setDescription('Get test user');
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

        $username = null;
        if (!$username = $helper->ask($input, $output, $usernameQuestion)) {
            $output->writeln('<error>Username not given</error>');
            return 0;
        }

        $user = $this->userManager->findByUsername($username);

        dd($user);
    }
}
