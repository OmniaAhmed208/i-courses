<?php

if (!function_exists('flat_ancestors')) {
    function flat_ancestors($model)
    {
        $result = [];
        if ($model->parent) {
            $result[] = $model->parent;
            $result = array_merge($result, flat_ancestors($model->parent));
        }
        return $result;
    }
}

if (!function_exists('flat_descendants')) {
    function flat_descendants($model)
    {
        $result = [];
        foreach ($model->children as $child) {
            $result[] = $child;
            if ($child->children) {
                $result = array_merge($result, flat_descendants($child));
            }
        }
        return $result;
    }
}

if (!function_exists('unique_random_numbers')) {
    function unique_random_numbers($numbers, $quantity)
    {
        shuffle($numbers);
        return array_slice($numbers, 0, $quantity);
    }
}
