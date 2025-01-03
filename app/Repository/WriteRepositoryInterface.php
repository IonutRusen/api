<?php

declare(strict_types=1);

namespace App\Repository;

interface WriteRepositoryInterface
{
    public function create($data);
    public function update($id, $data);
    public function deleteById($id);
}
