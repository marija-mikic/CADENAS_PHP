<?php

namespace App\Controller;



use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Contracts\HttpClient\HttpClientInterface;



class ProductController extends AbstractController
{
    #[Route('/', name: 'app_product')]
    public function index(HttpClientInterface $client, PaginatorInterface $paginator, Request $request): Response
    {

        $response = $client->request('GET', 'https://dummyjson.com/products');

        $contents = $response->toArray();
        $paginat = $paginator->paginate($contents, $page = 1, $limit = 6);
        // dd($paginat);
        return $this->render('base.html.twig', [
            'contents' => $contents,
            'paginate' => $paginat,
            'page' => $page,
            'limit' => $limit
        ]);
    }

    #[Route('products/{id}', name: 'app_show/product')]
    public function show(HttpClientInterface $client): Response
    {
        $response = $client->request('GET', 'https://dummyjson.com/products');
        $content = $response->toArray();
        // dd($content);
        return $this->render('product/show.html.twig', [
            'content' => $content
        ]);
    }
}
