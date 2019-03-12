<?php

namespace App\Transformers;


class GroupTransformer extends BaseTransformer
{
    public function transform($object)
    {
        return [
            'id' => (int) $object->id,
            'name' => (string) $object->name,
            'user_count' => $object->users->count(),
        ];
    }
}