<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\Product as ProductResource;
use App\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use function GuzzleHttp\Promise\all;


class ProductController extends Controller
{
    private $request;
    private $repository;
    public function __construct(Request $request, ProductRepositoryInterface $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function index(){

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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
            'categories' => 'required',
        ]);
        $data = $request->all();
        $image = $request->file('image');
        $filename = uniqid().".".$image->getClientOriginalExtension();
        Storage::disk('public')->put($filename, File::get($image));
        $data["image"] = $filename;

        $product = $this->repository->saveProduct($data);

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(201);
    }

    public function update($id,Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
            'categories' => 'required',
        ]);

        $data = $request->all();
        $image = $request->file('image');
        if($image){
            $filename = uniqid().".".$image->getClientOriginalExtension();
            Storage::disk('public')->put($filename, File::get($image));
            $data["image"] = $filename;
        }else{
            unset($data["image"]);
        }
        $product = $this->repository->updateProduct($id,$data);

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
