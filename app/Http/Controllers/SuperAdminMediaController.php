<?php

namespace App\Http\Controllers;
use Validator,Redirect,Response;
use Illuminate\Http\Request;
use App\User;
use App\Media;
use App\Configuration;
use File;
use Illuminate\Support\Facades\Storage;use App\GlobalConfig;
class SuperAdminMediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:SUPER_ADMIN');GlobalConfig::adminSession();
    }

    public function index()
    {
        $media = Media::get();
        return view('admin/media', ['medias'=>$media]);
    }
       
    public function uploadMedia(Request $request){
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            foreach ($files as $file) {
                $originalFileName = $file->getClientOriginalName();
                $entension=$file->extension();
                $fileName = time().'.'.$entension;  
                $file->move(public_path('media'), $fileName); 
                $fileName = 'media/'.$fileName;
                Media::create([
                    'media_url'=>$fileName,
                    'title'=>$file->getClientOriginalName(),
                    'file_name'=>$originalFileName,
                    'file_type'=>$entension
                ]);
            }
            $media = Media::get();
            return response()->json($media);
        }
    }

    public function delete(Request $request)
    {
        $id = $request->query('id');      
        $fileName =$request->query('path'); 
        Media::where('id', '=', $id)->delete();
        Storage::delete($fileName);       
        return Redirect::to('/textla/media')->with('status','Image deleted successfully');
    }
}
