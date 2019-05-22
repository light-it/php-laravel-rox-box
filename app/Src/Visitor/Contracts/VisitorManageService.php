<?php

namespace App\Src\Visitor\Contracts;

use App\DTO\VisitorDTO;
use App\Models\Visitor;
use Illuminate\Database\Eloquent\Collection;

interface VisitorManageService
{

    /**
     * @param VisitorDTO $visitorDTO
     * @return Visitor|mixed
     */
    public function findOrCreate(VisitorDTO $visitorDTO): Visitor;

}
