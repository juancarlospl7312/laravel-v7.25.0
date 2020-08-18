<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Manager\AdminManager;
use App\Role;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DefaultController extends AdminManager
{

    function __construct()
    {
        parent::__construct(null, true);
    }

    public function index()
    {
       // $role = new Role();
       // $role->name = 'Administrator';
       // $role->role = 'ADMINISTRATOR';
       // $role->save();

       // $role = new Role();
       // $role->name = 'Editor';
       // $role->role = 'EDITOR';
       // $role->save();

       // $user = new User();
       // $user->name = 'Juan Carlos Prado López';
       // $user->email = 'juancarlospl7312@gmail.com';
       // $user->password = bcrypt('123456');
       // $user->path = 'images/users/tusVXB4XBqmsqdE5Qf5Oe2fIbsYNAEn4XDk7YvQj.png';
       // $user->role_id = $role->id;
       // $user->save();

        return view('layouts.backend');
    }

    public function dashboard()
    {
        $news = DB::table('news')->count();
        $page = DB::table('page')->count();
        $user = DB::table('users')->count();
        $gallery = DB::table('gallery')->count();
        return view('backend.default.dashboard')
            ->with('news', $news)
            ->with('page', $page)
            ->with('user', $user)
            ->with('gallery', $gallery);
    }

    public function uploadFileCKEditor()
    {
        $request = Request();
        if($request->file('file')->getSize() < 1048576/*1MB*/){
            $path = $request->file('file')->store('public/ckeditor', 'local');
            parent::rmDir_rf(getcwd().'/storage');
            mkdir(getcwd().'/storage');
            parent::recurse_copy(getcwd().'/../storage/app/public',getcwd().'/storage');
            $path = explode('public/', $path);
            $json['success'] = true;
            $json['path'] = $path[1];
            return JsonResponse::create($json);
        }
        else{
            $json['success'] = false;
            return JsonResponse::create($json);
        }
    }

    public function deleteFileCKEditor()
    {
        $request = Request();
        $src = explode('/storage/', $request->input('src'));
        $path = $src[1];
        if (file_exists(getcwd().'/../storage/app/public/'.$path)) {
            // Delete file.
            unlink(getcwd().'/../storage/app/public/'.$path);

            if(is_dir(getcwd().'/storage')){
                $this->rmDir_rf(getcwd().'/storage');
            }
            mkdir(getcwd().'/storage');
            $this->recurse_copy(getcwd().'/../storage/app/public',getcwd().'/storage');

            $json['success'] = true;
            return JsonResponse::create($json);
        }
        else{
            $json['success'] = false;
            return JsonResponse::create($json);
        }
    }

}
