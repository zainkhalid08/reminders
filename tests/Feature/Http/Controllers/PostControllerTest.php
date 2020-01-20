<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Http\Controllers\PostControllerIndexMethodTest;
use Tests\Feature\Http\Controllers\PostControllerShowMethodTest;
use Tests\Feature\Http\Requests\PostTrait;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use 
    // RefreshDatabase;
    PostTrait,
    PostControllerIndexMethodTest,
    PostControllerShowMethodTest;
}
