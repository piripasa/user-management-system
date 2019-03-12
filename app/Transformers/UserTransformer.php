<?php

namespace App\Transformers;


class UserTransformer extends BaseTransformer
{
    public function transform($object)
    {
        return [
            'id' => (int) $object->id,
            'name' => (string) $object->name,
            'groups' => $object->groups->pluck('name')//app(GroupTransformer::class)->transformCollection($object->groups)['data']
        ];
    }
}