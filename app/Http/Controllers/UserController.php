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
        //dd($request->all());
        if($request->file('img')){
            $path = 'uploads/img';
            $image_path = $this->UserFileUplaod($request->file('img'),$path);
            array_merge($request->all(), ['img_path' => $image_path]);
        }if($request->file('file')){
            $path = 'uploads/files';
            $file_path = $this->UserFileUplaod($request->file('file'),$path);
            array_merge($request->all(), ['files_path' => $file_path]);
        }
        $user = User::create($request->all());
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
    public function UserFileUplaod($fileName,$path){
        $fileNameToStore = time(). '.' . $fileName->getClientOriginalExtension();
        $destinationPath = public_path($path);
        $fileName->move($destinationPath, $fileNameToStore);
        return $fileNameToStore;
    }

}
