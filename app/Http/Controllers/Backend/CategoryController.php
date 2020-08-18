<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Controllers\Manager\AdminManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends AdminManager
{

    function __construct()
    {
        $object = new Category();
        parent::__construct($object, true);
    }

    public function index()
    {
        return view('backend.category.index');
    }

    public function create()
    {
        return view('backend.category.create');
    }

    public function edit($id)
    {
        $entity = Category::findorfail($id);
        $translations = array();
        foreach($this->getArrayLocale() as $key => $value){
            if($key > 0){
                $translations[$value] = $this->getEntityTranslations($entity, $value);
            }
        }
        return view('backend.category.edit')
            ->with('entity', $entity)
            ->with('translations', $translations);
    }

    public function show($id)
    {
        $entity = Category::findorfail($id);
        $translations = array();
        foreach($this->getArrayLocale() as $key => $value){
            if($key > 0){
                $translations[$value] = $this->getEntityTranslations($entity, $value);
            }
        }
        return view('backend.category.show')
            ->with('entity', $entity)
            ->with('translations', $translations);
    }

    public function add()
    {
        return parent::handleForm(null);
    }

    public function update(Request $request)
    {
        $entity = Category::findorfail($request->input('id'));
        return parent::handleForm($entity);
    }

    public function delete($id)
    {
        $entity = Category::findorfail($id);
        return parent::delete($entity);
    }

    public function table(Request $request)
    {
        $totalRecords = DB::table('category')->count();
        $length = $request->input('length');
        $start = $request->input('start');
        $sortCol = $request->input('order')[0]['column'];
        $sortDir = $request->input('order')[0]['dir'];
        $search = $request->input('search')['value'];
        $draw = $request->input('draw');

        switch ($sortCol) {
            case 0: $sortCol = 'id'; break;
            case 1: $sortCol = 'title'; break;
        }

        if($search != null){
            $list = DB::table('category')
                ->where('title', 'like', '%'.$search.'%')
                ->orderBy($sortCol, $sortDir)
                ->get();
        }
        else{
            $list = DB::table('category')
                ->offset($start)
                ->limit($length)
                ->orderBy($sortCol, $sortDir)
                ->get();
        }

        $records["draw"] = $draw + 1;
        $records["recordsTotal"] = $totalRecords;
        $records["recordsFiltered"] = $totalRecords;

        $data = array();
        foreach($list as $item){
            $data[] = array(
                'id' => $item->id,
                'title' => $item->title,
                'actions' => '<div class="table-actions">
                    <a data-href="admin/category/show/'.$item->id.'" class="btn btn-default btn-xs action-table"><i class="fa fa-eye"></i></a>
                    <a data-href="admin/category/edit/'.$item->id.'" class="btn btn-default btn-xs action-table"><i class="fa fa-edit"></i></a>
                    <a data-href="admin/category/delete/'.$item->id.'" class="btn btn-default btn-xs _delete"><i class="fa fa-trash-o"></i></a>
                </div>',
            );
        }
        $records["data"] = $data;

        return JsonResponse::create($records);
    }
}
