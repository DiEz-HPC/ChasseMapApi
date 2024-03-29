<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:make-user',
    description: 'User admin',
)]
class MakeUserCommand extends Command
{

    public function __construct(private EntityManagerInterface $entityManagerInterface, private UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('email', InputArgument::OPTIONAL, 'The email of the user');
        $this->addArgument('password', InputArgument::OPTIONAL, 'The password of the user');
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $em = $this->entityManagerInterface;
        $io = new SymfonyStyle($input, $output);
        $io->title("Bienvenue dans l'interface de création de l'utilisateur");
        if($input->getArgument('email') && $input->getArgument('password'))
        {
            $email = $input->getArgument('email');
            $password = $input->getArgument('password');
        }else{
        $email = $io->ask("Quel est votre adresse email ?");
        $password = $io->askHidden("Quel est votre mot de passe ?");
        }
        $io->text("Création en cours...");

        $user = new User();
        $user->setEmail($email);
        $user->setPassword($this->passwordHasher->hashPassword(
            $user,
            $password
        ));
        $user->setRoles(['ROLE_ADMIN']);

        $em->persist($user);
        $em->flush();

        $io->success("Félicitation l'utilisateur a était crée avec les identifiants suivants :" . $email . " " . $password);
        return Command::SUCCESS;
    }
}
