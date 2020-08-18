<?php

namespace App\Http\Controllers\Manager;

use App\GalleryFiles;
use App\Http\Controllers\Controller;
use App\Translations;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminManager extends Controller
{
    protected $object;
    protected $translatable;
    public $array_locale = ['en', 'es'];

    function __construct($object, $translatable)
    {
        $this->object = $object;
        $this->translatable = $translatable;
    }

    public function getArrayLocale()
    {
        return $this->array_locale;
    }

    public function handleForm($entity)
    {
        $entity = $entity == null ? $this->object : $entity;

        if($this->translatable){
            $this->handleTranslation($entity);
        }
        else{
            $this->handleEntity($entity);
        }

        $json['success'] = true;
        return JsonResponse::create($json);
    }

    public function handleEntity($entity)
    {
        $request = Request();
        $array_keys = array_keys($request->all());
        $array_many_to_many = array();

        foreach($array_keys as $item){
                if($request->file($item) == null && substr($item, -5) != '_many'){
                if($request->input($item) != null){
                    $entity->{$item} = $request->input($item);
                }
            }
            /*many to many*/
            if(substr($item, -5) == '_many'){
                $array_many_to_many[] = $item;
            }
            /*file*/
            if($request->file($item) != null && $entity->getTable() != 'gallery'){
                $entity = $this->uploadFile($entity, $request->file($item));
            }
        }

        $entity->save();

        /*many to many*/
        $this->addManyToMany($entity, $array_many_to_many);

        /*Gallery Files*/
        if($entity->getTable() == 'gallery'){
            foreach($request->allFiles()['gallery_files'] as $item){
                $gallery_files_entity = new GalleryFiles();
                $gallery_files_entity->gallery_id = $entity->id;
                $gallery_files_entity = $this->uploadFile($gallery_files_entity, $item);
                $gallery_files_entity->save();
            }
        }

        return true;
    }

    public function handleTranslation($entity)
    {
        $request = Request();
        $array_keys = array_keys($request->all());
        $array_many_to_many = array();

        foreach($this->array_locale as $key => $locale){
            if($key == 0){
                foreach($array_keys as $item){
                    $rest = substr($item, -3);
                    if($this->ifExistLocale($locale, $rest)){
                        if($request->input($item) != null){
                            $entity->{substr($item, 0, -3)} = $request->input($item);
                        }
                    }
                    else{
                        if(!$this->ifHasAnyLocale($this->array_locale, $rest)){
                            if($request->file($item) == null && substr($item, -5) != '_many' && $item != 'slug' && $entity->getTable() != 'gallery' && $entity->getTable() != 'gallery_files'){
                                if($request->input($item) != null){
                                    $entity->{$item} = $request->input($item);
                                }
                            }
                            /*many to many*/
                            if(substr($item, -5) == '_many'){
                                $array_many_to_many[] = $item;
                            }
                            /*file*/
                            if($request->file($item) != null && $entity->getTable() != 'gallery'){
                                $entity = $this->uploadFile($entity, $request->file($item));
                            }
                        }
                    }

                }

                /*slug*/
                if(asset($request->input('slug'))){
                    $entity->slug = Str::slug($request->input('title_'.$locale), '-');
                }

                $entity->save();

                /*many to many*/
                $this->addManyToMany($entity, $array_many_to_many);

                /*Gallery Files*/
                if($entity->getTable() == 'gallery'){
                    if(count($request->allFiles()) > 0){
                        if($request->allFiles()['gallery_files'] != null){
                            foreach($request->allFiles()['gallery_files'] as $item){
                                $gallery_files_entity = new GalleryFiles();
                                $gallery_files_entity->gallery_id = $entity->id;
                                $gallery_files_entity = $this->uploadFile($gallery_files_entity, $item);
                                $gallery_files_entity->save();
                            }
                        }
                    }
                }
            }
            else{
                foreach($array_keys as $item){
                    $rest = substr($item, -3);
                    if($this->ifExistLocale($locale, $rest)){
                        $this->addTranslations(substr($item, 0, -3), $entity, $locale, $request->input($item));
                    }
                }
                /*slug*/
                if(asset($request->input('slug'))){
                    $this->addTranslations('slug', $entity, $locale, Str::slug($request->input('title_'.$locale), '-'));
                }
            }
        }

        return true;
    }

    public function uploadFile($entity, $file)
    {
        if($file->getSize() < 1048576/*1MB*/){
            $path = $file->store('public/'.$entity->getTable(), 'local');
            if($entity != null){
                $this->deleteFile($entity->path);
            }
            if(is_dir(getcwd().'/storage')){
                $this->rmDir_rf(getcwd().'/storage');
            }
            mkdir(getcwd().'/storage');
            $this->recurse_copy(getcwd().'/../storage/app/public',getcwd().'/storage');

            $path = explode('public/', $path);
            $entity->path = $path[1];
        }
        return $entity;
    }

    function recurse_copy($src,$dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) {
            if ($file != '.' && $file != '..') {
                if ( is_dir($src . '/' . $file) ) {
                    $this->recurse_copy($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }
    function rmDir_rf($directory)
    {
        $objects = scandir($directory);
        foreach($objects as $item){
            if ($item != '.' && $item != '..') {
                if (is_dir($directory .'/'.$item)){
                    $this->rmDir_rf($directory .'/'.$item);
                } else {
                    unlink($directory .'/'.$item);
                }
            }
        }
        rmdir($directory);
    }

    public function addManyToMany($entity, $array_many_to_many)
    {
        $request = Request();
        foreach($array_many_to_many as $item){
            $many = substr($item, 0,-5);
            $entity->{$many}()->detach();
            foreach($request->input($item) as $value) {
                $entity->{$many}()->attach($value);
            }
        }
    }

    public function delete($entity)
    {
        if($entity->getTable() == 'gallery'){
            foreach ($entity->galleryFiles() as $item)
            {
                $this->deleteFile($item->path);
            }
        }
        else{
            $this->deleteFile($entity->path);
        }

        if(is_dir(getcwd().'/storage')){
            $this->rmDir_rf(getcwd().'/storage');
        }
        mkdir(getcwd().'/storage');
        $this->recurse_copy(getcwd().'/../storage/app/public',getcwd().'/storage');

        $entity->delete();
        if($this->translatable){
            $translations = DB::table('translations')
                ->where('table_name', '=', $entity->getTable())
                ->where('foreign_key', '=', $entity->id)
                ->get();
            foreach($translations as $item){
                $item = Translations::findorfail($item->id);
                $item->delete();
            }
        }
        $json['success'] = true;
        return JsonResponse::create($json);
    }

    public function ifExistLocale($locale, $rest){
        return '_'.$locale == $rest;
    }

    public function ifHasAnyLocale($array_locale, $rest){
        foreach($array_locale as $value) {
            if('_'.$value == $rest){
                return true;
            }
        }
        return false;
    }

    public function deleteFile($path)
    {
        if($path != null){
            if (file_exists(getcwd().'/../storage/app/public/'.$path)) {
                // Delete file.
                unlink(getcwd().'/../storage/app/public/'.$path);
            }
        }
    }

    public function addTranslations($column_name, $entity, $locale, $value){
        $translation = DB::table('translations')
            ->where('table_name', '=', $entity->getTable())
            ->where('column_name', '=', $column_name)
            ->where('foreign_key', '=', $entity->id)
            ->where('locale', '=', $locale)
            ->get();
        if(count($translation) == 0){
            $translation = new Translations();
        }
        else{
            $translation = Translations::findorfail($translation[0]->id);
        }
        $translation->table_name = $entity->getTable();
        $translation->column_name = $column_name;
        $translation->foreign_key = $entity->id;
        $translation->locale = $locale;
        $translation->value = $value;
        $translation->save();
    }

    public function getEntityTranslations($object, $locale){
        $translations = DB::table('translations')
            ->where('table_name', '=', $object->getTable())
            ->where('foreign_key', '=', $object->id)
            ->where('locale', '=', $locale)
            ->get();
        $entity = DB::table($object->getTable())
            ->where('id', '=', $object->id)
            ->get();
        foreach($translations as $item){
            $entity->{$item->column_name} = $item->value;
        }
        return $entity;
    }

}
