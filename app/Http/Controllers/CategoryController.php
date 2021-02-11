<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //all category
    public function AllCat()
    {
        //eloquent
        //$categories = Category::all();
        //$categories = Category::latest()->get();
        $categories = Category::latest()->paginate(5);

        //query builder

       // $categories = DB::table('categories')->latest()->paginate(5);

    //    $categories=DB::table('categories')
    //     ->join('users','categories.user_id','users.id')
    //     ->select('categories.*','users.name')
    //     ->latest()->paginate(5);


        return view('admin.category.index',compact('categories'));
    }
    //add category
    public function AddCat(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',

        ], [
            'category_name.required' => 'input nama kategori',
            'category_name.max' => 'max kategori 255',

        ]);
            //eloquent ORM
        // Category::insert([
        //     'category_name'=> $request->category_name,
        //     'user_id'=>Auth::user()->id,
        //     'created_at'=>Carbon::now(),


        //     ]);

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->user_id= Auth::user()->id;
        $category->save();

            //query builder
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);


        return Redirect()->back()->with('success', 'Category tersimpan');
    }


    public function Edit($id){
        $categories = Category::find($id);
        return view('admin.category.edit', compact('categories'));
    }

    public function Update(Request $request,$id)
    {
        $update = Category::find($id)->Update([
            'category_name'=>$request->category_name,
            'user_id'=>Auth::user()->id
        ]);

        return Redirect()->route('all.category')->with('success', 'Category Update berhasil');

    }
}
