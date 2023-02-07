<?php

namespace App\Controller;


use App\Service\ApiClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class ProductController extends AbstractController
{


    #[Route('/', name: 'app_product')]
    public function index(ApiClient $client): Response
    {

        $products = $client->getProduct();

        return $this->render('base.html.twig', [
            'products' => $products['products'],


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
