<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

#[Route('/author', name: 'author:')]
class AuthorController extends AbstractController
{
    /**
     * Methode dédiée à l'affichage de la liste des livres
     *
     * @param AuthorRepository $authorRepository
     * @return Response
     */
    #[Route('s', name: 'index', methods: ["HEAD","GET"])] // site.com/authors
    public function index(AuthorRepository $authorRepository): Response
    {
        // TODO: Make a pagination
        // Requete DQL de récup de la liste des livres en BDD
        $authors = $authorRepository->findAll();

        // Rendu de la page dédiée à l'affichage de la liste des livres
        // en passant la variable $authors contenant la liste des livres de la BDD
        return $this->render('pages/author/index.html.twig', [
            'authors' => $authors
        ]);
    }

    /**
     * Méthode dédiée à l'affichage et au traitement du formulaire de création d'un livre
     *
     * @param Request $request
     * @param AuthorRepository $authorRepository
     * @return Response
     */
    #[Route('', name: 'create', methods: ["HEAD","GET","POST"])] // site.com/author
    public function create(Request $request, AuthorRepository $authorRepository): Response
    {
        // Check if user is granted
        // ...

        // Create the new Author object
        $author = new Author;

        // Build the form
        // Creation du formulaire basé sur l'architecture AuthorType
        // ET sur l'objet $author
        $form = $this->createForm(AuthorType::class, $author);

        // Handle the request
        $form->handleRequest($request);

        // Form treatment + form validator + saving data
        if ($form->isSubmitted() && $form->isValid())
        {
            $authorRepository->save($author, true);

            // return $this->redirectToRoute('author:index');
            return $this->redirectToRoute('author:read', [
                'id' => $author->getId()
            ]);
        }

        // Create the form view
        $form = $form->createView();

        return $this->render('pages/author/create.html.twig', [
            // Binding the form
            'form' => $form
        ]);
    }

    /**
     * Methode dédié à l'affichage des données d'un livre
     */
    #[Route('/{id}', name: 'read', methods: ["HEAD","GET"])] // site.com/author/42
    public function read(Author $author): Response
    {
        return $this->render('pages/author/read.html.twig', [
            'author' => $author
        ]);
    }

    #[Route('/{id}/edit', name: 'update', methods: ["HEAD","GET","POST"])] // site.com/author/42/edit
    public function update(Author $author, Request $request, AuthorRepository $authorRepository): Response
    {
        // Check if user is granted
        // ...

        // Build the form
        // Creation du formulaire basé sur l'architecture AuthorType
        // ET sur l'objet $author
        $form = $this->createForm(AuthorType::class, $author);

        // Handle the request
        $form->handleRequest($request);

        // Form treatment + form validator + saving data
        if ($form->isSubmitted() && $form->isValid())
        {
            $authorRepository->save($author, true);

            // return $this->redirectToRoute('author:index');
            return $this->redirectToRoute('author:read', [
                'id' => $author->getId()
            ]);
        }

        // Create the form view
        $form = $form->createView();

        return $this->render('pages/author/update.html.twig', [
            'author' => $author,
            'form' => $form
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ["HEAD","GET","DELETE"])] // site.com/author/42/delete
    public function delete(): Response
    {
        return $this->render('pages/author/delete.html.twig', [
        ]);
    }
}