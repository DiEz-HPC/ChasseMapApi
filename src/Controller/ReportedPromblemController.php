<?php

namespace App\Controller;

use App\Entity\ReportedProblem;
use PhpParser\Comment;
use App\Repository\ReportedProblemRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReportedPromblemController extends AbstractController
{

    public function __invoke(
        string $email,
        string  $name,
        string $comment,
        Request $request,
        ReportedProblemRepository $ReportedProblemRepository
    ) {

        $reportProblem = new ReportedProblem();

        $form = $this->createForm(ProfileType::class, $reportProblem);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ReportedProblemRepository->setEmail($email);
            $ReportedProblemRepository->setName($name);
            $ReportedProblemRepository->setComment($comment);

            $ReportedProblemRepository->save($reportProblem, true);
        }

        return $this->json($form);
    }
}
