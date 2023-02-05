<?php

namespace App\Controller;


use App\Service\ApiClient;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Contracts\HttpClient\HttpClientInterface;



class ProductController extends AbstractController
{


    #[Route('/', name: 'app_product')]
    public function index(ApiClient $client, PaginatorInterface $paginator, Request $request): Response
    {
        $products = $client->getProduct();
        $productsEncode = json_encode($products);
        //$data = $paginator->paginate($productsEncode, $request->query->getInt('page', 1), 10);
        // dd($productsEncode);
        return $this->render('base.html.twig', [
            'productsEncode' => $productsEncode,

        ]);
    }

    #[Route('products/{id}', name: 'app_show/product')]
    public function show(ApiClient $client): Response
    {
        $products = $client->getProduct();
        $productsEncode = json_encode($products);
        //$data = $paginator->paginate($productsEncode, $request->query->getInt('page', 1), 10);
        // dd($productsEncode);
        return $this->render('/product/index.html.twig', [
            'productsEncode' => $productsEncode,
        ]);
    }
}
