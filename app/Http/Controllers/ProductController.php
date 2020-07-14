<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\Product as ProductResource;
use App\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use function GuzzleHttp\Promise\all;


class ProductController extends Controller
{
    private $request;
    private $repository;
    private $service;
    public function __construct(Request $request, ProductRepositoryInterface $repository,ProductService $service)
    {
        $this->request = $request;
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {

        $category = $this->request->get("category");
        $price = $this->request->get("price");
        $results = $this->repository->getProducts($category,$price);
        return new ProductCollection($results);
    }

    public function show($id)
    {
        return new ProductResource($this->repository->find($id));
    }

    public function edit($id)
    {
        return new ProductResource($this->repository->find($id));
    }

    public function store()
    {

        $product = $this->service->saveProduct($this->request->all());
        return (new ProductResource($product))
            ->response()
            ->setStatusCode(201);
    }

    public function update($id)
    {
        $product = $this->service->updateProduct($id,$this->request->all());
        return (new ProductResource($product))
            ->response()
            ->setStatusCode(201);
    }



    public function delete($id)
    {
        $product = $this->repository->find($id);
        $product->delete();
        return response()->json(null, 204);
    }
}
