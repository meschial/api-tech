<?php

namespace App\Services;

use App\Repositories\LevelRepository;

class LevelService
{
    protected $repository;

    public function __construct(LevelRepository $levelRepository)
    {
        $this->repository = $levelRepository;
    }

    public function getLevels()
    {
        return $this->repository->getAllLevels();
    }

    public function createNewLevel(array $data)
    {
        return $this->repository->createLevel($data);
    }

    public function getLevel(int $id)
    {
        return $this->repository->getLevelId($id);
    }

    public function getLevelSearch(string $text)
    {
        return $this->repository->getLevelSearch($text);
    }

    public function deleteLevel(int $id)
    {
        return $this->repository->deleteLevelId($id);
    }

    public function updateLevel(int $id, array $data)
    {
        return $this->repository->updateLevelId($id, $data);
    }
}