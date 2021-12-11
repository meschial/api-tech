<?php

namespace App\Services;

use App\Repositories\DeveloperRepository;

class DeveloperService
{
    protected $repository;

    public function __construct(DeveloperRepository $developerRepository)
    {
        $this->repository = $developerRepository;
    }

    public function getDevelopers()
    {
        return $this->repository->getAllDevelopers();
    }

    public function createNewDeveloper(array $data)
    {
        return $this->repository->createDeveloper($data);
    }

    public function getDeveloper(int $id)
    {
        return $this->repository->getDeveloperId($id);
    }

    public function getDeveloperSearch(string $text)
    {
        return $this->repository->getDeveloperSearch($text);
    }

    public function deleteDeveloper(int $id)
    {
        return $this->repository->deleteDeveloperId($id);
    }

    public function updateDeveloper(int $id, array $data)
    {
        return $this->repository->updateDeveloperId($id, $data);
    }
}