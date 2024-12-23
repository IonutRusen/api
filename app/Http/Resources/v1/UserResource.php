<?php

namespace App\Http\Resources\v1;

use App\Http\Resources\DateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
