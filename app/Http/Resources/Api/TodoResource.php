<?php

namespace App\Http\Resources\Api;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        /** @var Todo $this */
        $this->loadMissing([
            'user'
        ]);

        return [
            'title' => $this->title,
            'description' => $this->description,
            'completed' => $this->completed,
            $this->mergeWhen($this->relationLoaded('user'),[
                'user' => new UserResource($this->whenLoaded('user'))
            ])
        ];
    }
}
