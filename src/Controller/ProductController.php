<?php

namespace App\Controller;


use App\Service\ApiClient;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class ProductController extends AbstractController
{


    #[Route('/', name: 'app_product')]
    public function index(ApiClient $client, PaginatorInterface $paginator, Request $request): Response
    {

        $product = $client->getProduct();
        $products = $paginator->paginate($product['products'], $request->query->getInt('page', 1), 4);
        //dd($products);
        return $this->render('base.html.twig', [
            'products' => $products,


        ]);
    }

    #[Route('products/{id}', name: 'app_show/product')]
    public function show(ApiClient $client, $id): Response
    {

        $response = $client->getId($id);

        $product = json_decode($response->getContent(), true);
        //var_dump($product);
        return $this->render('product/index.html.twig', [
            'product' => $product
        ]);
    }
}
