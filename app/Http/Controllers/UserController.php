<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\{UserAddRequest};
use Spatie\Permission\Models\Role;
use App;

class UserController extends Controller
{
    public function __construct()
    {
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserAddRequest $request)
    {
        //dd($request->file('img'));
        $image_path = null;
        $file_path = null;
        $postdata = $request->all();;

        if($request->file('img') !== null){
            $path = 'uploads/img/';
            $image_path = $this->UserFileUplaod($request->file('img'),$path,'i');
            $postdata['img_path'] = $image_path;
        }if($request->file('file')!== null){
            $path = 'uploads/files/';
            $file_path = $this->UserFileUplaod($request->file('file'),$path,'f');
            $postdata['files_path'] = $file_path;
        }
       // dd($file_path.'&'.$image_path);
        $user = User::create($postdata);
        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    public function UserFileUplaod($fileName,$path,$n){
       // dd($fileName);
        $fileNameToStore = $n.time(). '.' . $fileName->getClientOriginalExtension();
        $destinationPath = public_path($path);
        $fileName->move($destinationPath, $fileNameToStore);
        return $fileNameToStore;
    }

}
