<?php

namespace App\Http\Controllers\Backend;

use App\Role;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Manager\AdminManager;

class UserController extends AdminManager
{

    function __construct()
    {
        $object = new User();
        parent::__construct($object, false);
    }

    public function showProfile()
    {
        return view('backend.user.profile.show');
    }

    public function editProfile()
    {
        return view('backend.user.profile.edit');
    }

    /* CRUD User */
    public function index()
    {
        return view('backend.user.index');
    }

    public function create()
    {
        return view('backend.user.create')
            ->with('roles', Role::all());
    }

    public function edit($id)
    {
        return view('backend.user.edit')
            ->with('entity', User::findorfail($id))
            ->with('roles', Role::all());
    }

    public function show($id)
    {
        return view('backend.user.show')
            ->with('entity', User::findorfail($id));
    }

    public function add()
    {
        return parent::handleForm(null);
    }

    public function update(Request $request)
    {
        $entity = User::findorfail($request->input('id'));
        return parent::handleForm($entity);
    }

    public function delete($id)
    {
        $entity = User::findorfail($id);
        if(Auth::user()->getAuthIdentifier() != $id){
            return parent::delete($entity);
        }
        else{
            $json['success'] = false;
            return JsonResponse::create($json);
        }
    }

    public function table(Request $request)
    {
        $totalRecords = DB::table('users')->count();
        $length = $request->input('length');
        $start = $request->input('start');
        $sortCol = $request->input('order')[0]['column'];
        $sortDir = $request->input('order')[0]['dir'];
        $search = $request->input('search')['value'];
        $draw = $request->input('draw');

        switch ($sortCol) {
            case 0: $sortCol = 'id'; break;
            case 1: $sortCol = 'name'; break;
            case 2: $sortCol = 'email'; break;
            case 3: $sortCol = 'role_id'; break;
        }

        if($search != null){
            $list = DB::table('users')
                ->where('name', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%')
                ->orderBy($sortCol, $sortDir)
                ->get();
        }
        else{
            $list = DB::table('users')
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
                'name' => $item->name,
                'email' => $item->email,
                'role' => (Role::findorfail($item->id))->name,
                'actions' => '<div class="table-actions">
                    <a data-href="admin/user/show/'.$item->id.'" class="btn btn-default btn-xs action-table"><i class="fa fa-eye"></i></a>
                    <a data-href="admin/user/edit/'.$item->id.'" class="btn btn-default btn-xs action-table"><i class="fa fa-edit"></i></a>
                    <a data-href="admin/user/delete/'.$item->id.'" class="btn btn-default btn-xs _delete"><i class="fa fa-trash-o"></i></a>
                </div>',
            );
        }
        $records["data"] = $data;

        return JsonResponse::create($records);
    }

}
