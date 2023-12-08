<?php
// src/Controller/CategoryController.php
namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\ProgramRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    #[Route('/new', name: 'new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Create a new Category Object
        $category = new Category();
        // Create the associated Form
        $form = $this->createForm(CategoryType::class, $category);
        // Get data from HTTP request
        $form->handleRequest($request);
        // Was the form submitted ?
        if ($form->isSubmitted()) {
            $entityManager->persist($category);
            $entityManager->flush();
        }

        // Render the form
        return $this->render('category/new.html.twig', [
            'form' => $form,
        ]);
    }

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
