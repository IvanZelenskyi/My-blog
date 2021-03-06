<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;


class IndexController extends Controller
{
  public function __invoke()
  {
      $tags = tag::all();
      return view('admin.tags.index' , compact('tags'));
  }
}
