<?php

namespace App\Services;


use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class CategoryService
{
    private $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function saveCategory($data)
    {
        $this->validate($data);
        return $this->repository->saveCategory($data);
    }


    public function updateCategory($id,$data)
    {
        $this->validate($data);
        return $this->repository->updateCategory($id,$data);
    }

    public function validate($data)
    {
        Validator::make($data, [
            'name' => 'required|max:255',
        ])->validate();
    }
}
