<?php

namespace App\Http\Controllers\Backend;

use App\Gallery;
use App\GalleryFile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Manager\AdminManager;

class GalleryController extends AdminManager
{

    function __construct()
    {
        $object = new Gallery();
        parent::__construct($object, true);
    }

    public function index()
    {
        return view('backend.gallery.index');
    }

    public function create()
    {
        return view('backend.gallery.create');
    }

    public function edit($id)
    {
        $entity = Gallery::findorfail($id);
        $translations = array();
        foreach($this->getArrayLocale() as $key => $value){
            if($key > 0){
                $translations[$value] = $this->getEntityTranslations($entity, $value);
            }
        }
        return view('backend.gallery.edit')
            ->with('entity', $entity)
            ->with('translations', $translations);
    }

    public function show($id)
    {
        $entity = Gallery::findorfail($id);
        $translations = array();
        foreach($this->getArrayLocale() as $key => $value){
            if($key > 0){
                $translations[$value] = $this->getEntityTranslations($entity, $value);
            }
        }
        return view('backend.gallery.show')
            ->with('entity', $entity)
            ->with('translations', $translations);
    }

    public function add()
    {
        return parent::handleForm(null);
    }

    public function update(Request $request)
    {
        $entity = Gallery::findorfail($request->input('id'));
        return parent::handleForm($entity);
    }

    public function delete($id)
    {
        $entity = Gallery::findorfail($id);
        return parent::delete($entity);
    }
    
    // public function deleteGalleryFile($id)
    // {
    //     $gallery_file = GalleryFile::findorfail($id);
    //     parent::delete($gallery_file);
    //     $gallery_files = Gallery::findorfail($gallery_file->gallery()->id)->galleryFiles();

    //     foreach ($gallery_files as $value) {
    //         $gallery_files_array["id"] = $value->id;
    //         $gallery_files_array["path"] = 'storage/'.$value->path;
    //     }

    //     return JsonResponse::create($gallery_files_array);
    // }

    public function table(Request $request)
    {
        $totalRecords = DB::table('gallery')->count();
        $length = $request->input('length');
        $start = $request->input('start');
        $sortCol = $request->input('order')[0]['column'];
        $sortDir = $request->input('order')[0]['dir'];
        $search = $request->input('search')['value'];
        $draw = $request->input('draw');

        switch ($sortCol) {
            case 0: $sortCol = 'id'; break;
            case 2: $sortCol = 'title'; break;
        }

        if($search != null){
            $list = DB::table('gallery')
                ->where('title', 'like', '%'.$search.'%')
                ->orderBy($sortCol, $sortDir)
                ->get();
        }
        else{
            $list = DB::table('gallery')
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
            $gallery = Gallery::findorfail($item->id);
            $data[] = array(
                'id' => $item->id,
                'image' => '<img class="img-responsive" src="storage/'.$gallery->galleryFiles()[0]->path.'" style="width:60px;">',
                'title' => $item->title,
                'actions' => '<div class="table-actions" style="width:80px;">
                    <a data-href="admin/gallery/show/'.$item->id.'" class="btn btn-default btn-xs action-table"><i class="fa fa-eye"></i></a>
                    <a data-href="admin/gallery/edit/'.$item->id.'" class="btn btn-default btn-xs action-table"><i class="fa fa-edit"></i></a>
                    <a data-href="admin/gallery/delete/'.$item->id.'" class="btn btn-default btn-xs _delete"><i class="fa fa-trash-o"></i></a>
                </div>',
            );
        }
        $records["data"] = $data;

        return JsonResponse::create($records);
    }

}
