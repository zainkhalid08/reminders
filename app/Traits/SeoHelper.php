<?php

namespace App\Traits;

trait SeoHelper 
{
  public function template()
  {
    return [
      'title' => '',
      'meta' => [
        'description' => '',
        // 'keywords' => '',
      ],
    ];
  }

  public function mergeWithTemplate(array $data) : array
  {
    return array_merge($this->template() , $data);
  }
}