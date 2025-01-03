<?php

declare(strict_types=1);

namespace App\Http\Resources\v1;

use App\Http\Resources\DateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class UserResource extends JsonResource
{
    public function toArray(Request $request)
    {


        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created' => new DateResource(
                resource: $this->created_at,
            ),

        ];


    }

}
