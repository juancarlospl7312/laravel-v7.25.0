<?php

namespace App\Http\Controllers\Backend;

use App\Carousel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Manager\AdminManager;

class CarouselController extends AdminManager
{
   
    function __construct()
    {
        parent::__construct(new Carousel(), false);
    }

    public function index()
    {
        return view('backend.carousel.index');
    }

    public function create()
    {
        return view('backend.carousel.create');
    }

    public function edit($id)
    {
        return view('backend.carousel.edit')
            ->with('entity', Carousel::findorfail($id));
    }

    public function show($id)
    {
        return view('backend.carousel.show')
            ->with('entity', Carousel::findorfail($id));
    }

    public function add()
    {
        return parent::handleForm(null);
    }

    public function update(Request $request)
    {
        $entity = Carousel::findorfail($request->input('id'));
        return parent::handleForm($entity);
    }

    public function delete($id)
    {
        $entity = Carousel::findorfail($id);
        return parent::delete($entity);
    }

    public function table(Request $request)
    {
        $totalRecords = DB::table('carousel')->count();
        $length = $request->input('length');
        $start = $request->input('start');
        $sortCol = $request->input('order')[0]['column'];
        $sortDir = $request->input('order')[0]['dir'];
        $draw = $request->input('draw');

        switch ($sortCol) {
            case 0: $sortCol = 'id'; break;
            case 2: $sortCol = 'updated_at'; break;
        }

        $list = DB::table('carousel')
            ->offset($start)
            ->limit($length)
            ->orderBy($sortCol, $sortDir)
            ->get();

        $records["draw"] = $draw + 1;
        $records["recordsTotal"] = $totalRecords;
        $records["recordsFiltered"] = $totalRecords;

        $data = array();
        foreach($list as $item){
            $data[] = array(
                'id' => $item->id,
                'path' => '<img class="img-responsive" src="storage/'.$item->path.'" style="width:90px;">',
                'actions' => '<div class="table-actions">
                    <a data-href="admin/carousel/show/'.$item->id.'" class="btn btn-default btn-xs action-table"><i class="fa fa-eye"></i></a>
                    <a data-href="admin/carousel/edit/'.$item->id.'" class="btn btn-default btn-xs action-table"><i class="fa fa-edit"></i></a>
                    <a data-href="admin/carousel/delete/'.$item->id.'" class="btn btn-default btn-xs _delete"><i class="fa fa-trash-o"></i></a>
                </div>',
            );
        }
        $records["data"] = $data;

        return JsonResponse::create($records);
    }

}