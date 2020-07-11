<?php

namespace App\Http\Controllers;


use App\Http\Resources\CategoryCollection;
use App\Http\Resources\Category as CategoryResource;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $request;
    private $repository;

    public function __construct(Request $request, CategoryRepositoryInterface $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }
    public function index(){
        return new CategoryCollection($this->repository->paginate(6));
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $category = $this->repository->create($request->all());

        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(201);
    }

    public function update($id,Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $category = $this->repository->update($request->all(),$id);

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
