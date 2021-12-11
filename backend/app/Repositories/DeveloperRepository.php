<?php

namespace App\Repositories;

use App\Models\Developer;

class DeveloperRepository
{
    protected $entity;

    public function __construct(Developer $developer)
    {
        $this->entity = $developer;
    }

    public function getAllDevelopers()
    {
        return $this->entity->with('level')->get();
    }

    public function createDeveloper(array $data)
    {
        return $this->entity->create($data);
    }

    public function getDeveloperId(int $id)
    {
        return $this->entity->where('id', $id)->firstOrfail();
    }

    public function getDeveloperSearch(string $text)
    {
        return $this->entity
            ->where('id', 'LIKE', '%'.$text.'%')
            ->orWhere('name', 'LIKE', '%'.$text.'%')
            ->orWhere('birth', 'LIKE', '%'.$text.'%')
            ->orWhere('age', 'LIKE', '%'.$text.'%')
            ->orWhere('hobby', 'LIKE', '%'.$text.'%')
            ->orWhere('created_at', 'LIKE', '%'.$text.'%')
            ->get();
    }

    public function deleteDeveloperId(int $id)
    {
        $developer = $this->getDeveloperId($id);

        return $developer->delete();
    }

    public function updateDeveloperId(int $id, array $data)
    {
        $developer = $this->getDeveloperId($id);

        return $developer->update($data);
    }
}