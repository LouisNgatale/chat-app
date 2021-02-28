<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *X
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "body" => $this->body,
            "post_id" => $this->post_id,
            "created_at" => $this->created_at,
            "isMain" => $this->isMain,
            "childComments" => new ChildCommentCollection($this->children),
        ];
    }
}
