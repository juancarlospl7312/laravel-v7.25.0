<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Page;
use App\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Manager\AdminManager;

class PageController extends AdminManager
{

    function __construct()
    {
        $object = new Page();
        parent::__construct($object, true);
    }

    public function index()
    {
        return view('backend.page.index');
    }

    public function create()
    {
        return view('backend.page.create')
            ->with('categories', Category::all());
    }

    public function edit($id)
    {
        $entity = Page::findorfail($id);
        $translations = array();
        foreach($this->getArrayLocale() as $key => $value){
            if($key > 0){
                $translations[$value] = $this->getEntityTranslations($entity, $value);
            }
        }
        return view('backend.page.edit')
            ->with('entity', $entity)
            ->with('translations', $translations)
            ->with('categories', Category::all());
    }

    public function show($id)
    {
        $entity = Page::findorfail($id);
        $translations = array();
        foreach($this->getArrayLocale() as $key => $value){
            if($key > 0){
                $translations[$value] = $this->getEntityTranslations($entity, $value);
            }
        }
        $category_translations = array();
        foreach($this->getArrayLocale() as $key => $value){
            if($key > 0)
                $category_translations[$value][] = $this->getEntityTranslations($entity->category(), $value)->title;
        }
        return view('backend.page.show')
            ->with('entity', $entity)
            ->with('translations', $translations)
            ->with('category_translations', $category_translations);
    }

    public function add()
    {
        return parent::handleForm(null);
    }

    public function update(Request $request)
    {
        $entity = Page::findorfail($request->input('id'));
        return parent::handleForm($entity);
    }

    public function delete($id)
    {
        $entity = Page::findorfail($id);
        return parent::delete($entity);
    }

    public function table(Request $request)
    {
        $totalRecords = DB::table('page')->count();
        $length = $request->input('length');
        $start = $request->input('start');
        $sortCol = $request->input('order')[0]['column'];
        $sortDir = $request->input('order')[0]['dir'];
        $search = $request->input('search')['value'];
        $draw = $request->input('draw');

        switch ($sortCol) {
            case 0: $sortCol = 'id'; break;
            case 2: $sortCol = 'title'; break;
            case 3: $sortCol = 'updated_at'; break;
        }

        if($search != null){
            $list = DB::table('page')
                ->where('title', 'like', '%'.$search.'%')
                ->orderBy($sortCol, $sortDir)
                ->get();
        }
        else{
            $list = DB::table('page')
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
                'path' => '<img class="img-responsive" src="storage/'.$item->path.'" style="width:60px;">',
                'title' => $item->title,
                'updated_at' => date('Y-m-d', strtotime($item->updated_at)),
                'actions' => '<div class="table-actions" style="width:80px;">
                    <a data-href="admin/page/show/'.$item->id.'" class="btn btn-default btn-xs action-table"><i class="fa fa-eye"></i></a>
                    <a data-href="admin/page/edit/'.$item->id.'" class="btn btn-default btn-xs action-table"><i class="fa fa-edit"></i></a>
                    <a data-href="admin/page/delete/'.$item->id.'" class="btn btn-default btn-xs _delete"><i class="fa fa-trash-o"></i></a>
                </div>',
            );
        }
        $records["data"] = $data;

        return JsonResponse::create($records);
    }

}
