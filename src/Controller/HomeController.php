<?php

namespace App\Controller;

use App\Repository\BlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(BlogRepository $blogRepository): Response
    {
        $blogs = $blogRepository->findLastThreeBlogs();

        return $this->render('home/home.html.twig', [
            'blogs' => $blogs
        ]);
    }
}
