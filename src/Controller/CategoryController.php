<?php
// src/Controller/CategoryController.php
namespace App\Controller;


use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    /*#[Route('/program/', name: 'program_index')]
    public function index(): Response
    {
        return $this->render('program/index.html.twig', [
            'website' => 'Wild Series',
        ]);
    }*/

    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', ['categories' => $category]);
    }

    /*#[Route('/program/{page}', methods: ['GET'], requirements: ['page' => '\d+'], name: 'program_')]
    public function show(int $page = 1): Response
    {
        return $this->render('program/show.html.twig', [
            'page' => $page,
        ]);
    }*/

    #[Route('/{categoryName}', name: 'show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
    {
        $category = $categoryRepository->findOneBy(['name' => $categoryName]);
        // same as $category = $categoryRepository->find($id);

        if (!$category) {
            throw $this->createNotFoundException(
                'Aucune catégorie trouvée à ce nom : ' . $categoryName . ''
            );
        } else {
            $programList = $programRepository->findBy(
                ['category' => $category->getId()],
                ['id' => 'DESC']
            );
        }
        return $this->render('category/show.html.twig', [
            'category_name' => $category,
            'program_list' => $programList
        ]);
    }
}
