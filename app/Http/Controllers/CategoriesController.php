<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $data['title'] = __a('category');
        $data['categories'] = Category::whereStep(0)->with('sub_categories', 'sub_categories.sub_categories')->orderBy('category_name', 'asc')->paginate(2);

        return view('admin.categories.categories', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(){
        $data['title'] = __a('category');
        $data['sub_title'] = __a('category_create');
        $data['categories'] = Category::whereStep(0)->with('sub_categories')->orderBy('category_name', 'asc')->get();

        return view('admin.categories.category_add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(Request $request)
    {
        if(config('app.is_demo')) return back()->with('error', __a('demo_restriction'));

        $user_id = Auth::user()->id;
        $rules = [
            'category_name' => 'required'
        ];
        $this->validate($request, $rules);

        $slug = unique_slug(clean_html($request->category_name), 'Category');

        $data = [
            'user_id'               => $user_id,
            'category_name'         => clean_html($request->category_name),
            'slug'                  => $slug,
            'category_id'           => clean_html($request->parent),
            'icon_class'            => clean_html($request->icon_class),
            'thumbnail_id'          => clean_html($request->thumbnail_id),
            'status'                => clean_html($request->status),
            'step'                  => 0,
        ];

        if ($request->parent){
            $data['step'] = 1;
            $parent = Category::find($request->parent);
            if ($parent && $parent->category_id){
                $data['step'] = 2;
            }
        }

        $is_create = Category::create($data);
        return back()->with('success', __a('category_created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id){
        $category = Category::find($id);

        $data['title'] = __a('category_edit');
        $data['category'] = $category;
        $data['categories'] = Category::whereStep(0)->with('sub_categories')->orderBy('category_name', 'asc')->where('id', '!=', $id)->get();

        if ( ! $category){
            abort(404);
        }

        return view('admin.categories.category_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id){
        if(config('app.is_demo')) return back()->with('error', __a('demo_restriction'));

        $category = Category::find($id);
        if ( ! $category){
            return back()->with('error', trans('admin.category_not_found'));
        }

        $rules = [
            'category_name' => 'required'
        ];
        $this->validate($request, $rules);

        $data = [
            'category_name'         => clean_html($request->category_name),
            'category_id'           => $request->parent,
            'icon_class'            => $request->icon_class,
            'thumbnail_id'          => $request->thumbnail_id,
            'step'                  => 0,
            'status'                => $request->status,
        ];

        if ($request->parent){
            $data['step'] = 1;
            $parent = Category::find($request->parent);
            if ($parent && $parent->category_id){
                $data['step'] = 2;
            }
        }
        $category->update($data);

        return back()->with('success', trans('admin.category_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy(Request $request)
    {
        if(config('app.is_demo')) return back()->with('error', __a('demo_restriction'));

        if (count($request->categories)){
            Category::whereIn('id', $request->categories)->delete();
            return ['success' => true];
        }
        return ['success' => false];
    }

    public function getTopicOptions(Request $request){
        $topics = Category::whereCategoryId($request->category_id)->get();

        $options_html = "<option value=''>".__t('select_topic')."</option>";
        foreach ($topics as $topic){
            $options_html .= "<option value='{$topic->id}'>{$topic->category_name}</option>";
        }
        return ['success' => 1, 'options_html' => $options_html];
    }


    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show categories view
     *
     */

    public function show($slug){
        $category = Category::whereSlug($slug)->orWhere('id', $slug)->first();
        if ( ! $category){
            abort(404);
        }

        $title = $category->category_name;
        return view(theme('single-category'), compact('title', 'category'));
    }

    public function home(){
        $title = __t('topics');

        return view(theme('categories'), compact('title'));
    }

}
