<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class RobotTotalStatusCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'items' => $this->collection
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function with($request)
    {
        return [
            'link' => $request->fullUrl(),
            'method' => $request->method(),
            'code' => Response::HTTP_OK,
            'message' => 'Get something successful'
        ];
    }
}
