<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

#[Route('/book', name: 'book:')]
class BookController extends AbstractController
{
    /**
     * Methode dédiée à l'affichage de la liste des livres
     *
     * @param BookRepository $bookRepository
     * @return Response
     */
    #[Route('s', name: 'index', methods: ["HEAD","GET"])] // site.com/books
    public function index(BookRepository $bookRepository): Response
    {
        // TODO: Make a pagination
        // Requete DQL de récup de la liste des livres en BDD
        $books = $bookRepository->findAll();

        // Rendu de la page dédiée à l'affichage de la liste des livres
        // en passant la variable $books contenant la liste des livres de la BDD
        return $this->render('pages/book/index.html.twig', [
            'books' => $books
        ]);
    }

    /**
     * Méthode dédiée à l'affichage et au traitement du formulaire de création d'un livre
     *
     * @param Request $request
     * @param BookRepository $bookRepository
     * @return Response
     */
    #[Route('', name: 'create', methods: ["HEAD","GET","POST"])] // site.com/book
    public function create(Request $request, BookRepository $bookRepository): Response
    {
        // Check if user is granted
        // ...

        // Create the new Book object
        $book = new Book;

        // Build the form
        // Creation du formulaire basé sur l'architecture BookType
        // ET sur l'objet $book
        $form = $this->createForm(BookType::class, $book);

        // Handle the request
        $form->handleRequest($request);

        // Form treatment + form validator + saving data
        if ($form->isSubmitted() && $form->isValid())
        {
            $bookRepository->save($book, true);

            // return $this->redirectToRoute('book:index');
            return $this->redirectToRoute('book:read', [
                'id' => $book->getId()
            ]);
        }

        // Create the form view
        $form = $form->createView();

        return $this->render('pages/book/create.html.twig', [
            // Binding the form
            'form' => $form
        ]);
    }

    /**
     * Methode dédié à l'affichage des données d'un livre
     */
    #[Route('/{id}', name: 'read', methods: ["HEAD","GET"])]
    public function read(Book $book): Response
    {
        return $this->render('pages/book/read.html.twig', [
            'book' => $book
        ]);
    }

    #[Route('/{id}/edit', name: 'update', methods: ["HEAD","GET","POST"])] 
    public function update(): Response
    {
        return $this->render('pages/book/update.html.twig', [
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ["HEAD","GET","DELETE"])] 
    public function delete(): Response
    {
        return $this->render('pages/book/delete.html.twig', [
        ]);
    }
}