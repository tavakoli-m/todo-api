<?php

namespace App\Http\Resources\V1\Todo;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TodoApiResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'result' => $this->collection,
            'last_page' => $this->lastPage()
        ];
    }
}
