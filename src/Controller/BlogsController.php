<?php

namespace App\Controller;

use App\Repository\BlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogsController extends AbstractController
{
    #[Route('/blogs', name: 'app_blogs')]
    public function index(BlogRepository $blogRepository): Response
    {
        $allBlogs = $blogRepository->findAll();

        return $this->render('blogs/index.html.twig', [
            'blogs' => $allBlogs,
        ]);
    }

    #[Route('/blogs/{id}', name: 'app_single_blog')]
    public function single(BlogRepository $blogRepository, $id): Response
    {
        $singleBlog = $blogRepository->find($id);

        return $this->render('blogs/single_blog.html.twig', [
            'blog' => $singleBlog,
        ]);
    }
}
