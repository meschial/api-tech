<?php

namespace App\Repositories;

use App\Models\Level;

class LevelRepository
{
    protected $entity;

    public function __construct(Level $level)
    {
        $this->entity = $level;
    }

    public function getAllLevels()
    {
        return $this->entity->get();
    }

    public function createLevel(array $data)
    {
        return $this->entity->create($data);
    }

    public function getLevelId(int $id)
    {
        return $this->entity->where('id', $id)->firstOrfail();
    }

    public function getLevelSearch(string $text)
    {
        return $this->entity
            ->where('id', 'LIKE', '%'.$text.'%')
            ->orWhere('level', 'LIKE', '%'.$text.'%')
            ->orWhere('created_at', 'LIKE', '%'.$text.'%')
            ->get();
    }

    public function deleteLevelId(int $id)
    {
        $level = $this->getLevelId($id);

        return $level->delete();
    }

    public function updateLevelId(int $id, array $data)
    {
        $level = $this->getLevelId($id);

        return $level->update($data);
    }
}