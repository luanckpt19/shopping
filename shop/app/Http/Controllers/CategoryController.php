<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    private $category;

    public function __construct(Category $category)
    {
        $this ->category = $category;
    }

    public function create()
    {

//
//       foreach ($data as $value) {
//           if ($value['parent_id'] == 0) {
//               echo "<opition>" . $value['name'] . "</opition>";
//
//               foreach ($data as $value2) {
//                   if ($value2['parent_id'] == $value['id']) {
//                       echo "<opition>" . $value2['name'] . "</opition>";
//
//                       foreach ($data as $value3) {
//                           if ($value3['parent_id'] == $value2['id']) {
//                               echo "<opition>" . $value3['name'] . "</opition>";
//                           }
//
//                       }
//                   }
//               }
//           }
//       }

        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive -> categoryRecusive();
        return view('category.add', compact('htmlOption'));
    }

    public function index()
    {
        $categories = $this -> category ->latest() -> paginate(5);
        return view('category.index', compact('categories'));
    }

    public function store(Request $request)
    {

        $this->category->create([
            'name'=> $request->name,
            'parent_id' => $request -> parent_id,
            'slug' => Str::slug($request->name),

        ]);

        return redirect()->route('categories.index');
    }

    public  function edit($id){

    }

    public  function delete($id){

    }
}


