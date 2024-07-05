<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FolderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->folder_nama,
            'user'=> $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'files' => FileResource::collection($this->whenLoaded('files')),
            'subfolders' => FolderResource::collection($this->whenLoaded('subfolders')), // Support for nested folders
        ];
    }
}
