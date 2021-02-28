<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "caption" => $this->caption,
            "media" => $this->media,
            "privacy" => $this->privacy,
            "user_id" => $this->user_id,
            "comments" =>  new CommentCollection($this->comment)
        ];
    }
}
