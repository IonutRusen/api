<?php

declare(strict_types=1);

namespace App\Repository;

use ScriemCodat\Repository\AbstractRepository;

final class Repository extends AbstractRepository implements ReadRepositoryInterface, WriteRepositoryInterface
{
    public function __construct($model)
    {
        $this->model = $model;
    }
}
