<?php

namespace App\Http\Controllers;


use App\Http\Resources\CategoryCollection;
use App\Http\Resources\Category as CategoryResource;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $request;
    private $repository;
    private $service;

    public function __construct(Request $request, CategoryRepositoryInterface $repository,CategoryService $service)
    {
        $this->request = $request;
        $this->repository = $repository;
        $this->service = $service;
    }
    public function index(){
        return new CategoryCollection($this->repository->getCategories());
    }

    public function show($id)
    {
        return new CategoryResource($this->repository->find($id));
    }

    public function list()
    {
        return response()->json($this->repository->getListCategories());
    }

    public function edit($id)
    {
        return new CategoryResource($this->repository->find($id));
    }
    public function store(Request $request)
    {

        $category = $this->service->saveCategory($request->all());

        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(201);
    }

    public function update($id,Request $request)
    {
        $category = $this->service->updateCategory($id,$request->all());
        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(201);
    }
    public function delete($id)
    {
        $category = $this->repository->find($id);
        $category->delete();
        return response()->json(null, 204);
    }
}
