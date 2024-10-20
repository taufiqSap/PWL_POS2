<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\LevelModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index()
    {
     $breadcrumb =(object)[
      'title' => 'Daftar User',
      'list'  => ['Home', 'User']
     ];

     $page = (object)[
      'title' => 'Daftar user yang terdaftar dalam sistem'
     ];

     $activeMenu ='user';

     return view('user.index',['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
  // Ambil data user dalam bentuk JSON untuk DataTables
public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
            ->with('level');
       if($request->level_id){
        $users->where('level_id',$request->level_id);
       } 
       return DataTables::of($users)
        ->addIndexColumn()
        ->addColumn('aksi', function ($user){
          $btn  = '<button onclick="modalAction(\''.url('/user/' . $user->user_id . 
          '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> '; 
                      $btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id . 
          '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> '; 
                      $btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id . 
          '/delete_ajax').'\')"  class="btn btn-danger btn-sm">Hapus</button> '; 
           
                      return $btn;  
                  })  
                  ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html  
                  ->make(true);  
          
}

public function create()
{
  $breadcrumb =(object)[
    'title' => 'Tambah User',
    'list'  => ['Home', 'User','Tambah']
  ];

  $page = (object)[
    'title' => 'Tambah user baru'
  ];

  $level = LevelModel::all();
  $activeMenu ='user';

  return view ('user.create',['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);

}
public function store(Request $request)
{
  $request->validate([
    //username harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel m_user kolom username
    'username' => 'required|string|min:3|unique:m_user,username',
    'nama' => 'required|string|max:100',
    'password' => 'required|min:5',
    'level'   => 'required|integer'
  ]);
  
  UserModel::create([
    'username' => $request->username,
    'nama'     => $request->nama,
    'password' => bcrypt($request->password),
    'level_id' => $request->level_id
  ]);

  return redirect('/user')->with('succes', 'Data user berhasil disimpan');
}
  public function show(string $id)
  {
    $user = UserModel::with('level')-> find($id);

    $breadcrumb = (object)[
      'title' => 'Detail User',
      'list' => ['Home', 'User','Detail']
    ];

    $page =(object)[
      'title' => 'Detail User'
    ];

    $activeMenu = 'user';
    return view('user.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
  }

  public function edit(string $id)
  {
    $user = UserModel::find($id);
    $level = LevelModel::all();

    $breadcrumb = (object)[
      'title' => 'Edit User',
      'list'  => ['Home', 'User', 'Edit']
    ];
    $page = (object)[
      'title' => 'Edit User'
    ];

    $activeMenu = 'user';
    return view('user.edit',['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
  }

  public function update($request,string $id)
  {
    $request->validate([
      'username' => 'required|string|min:3|unique:m_user,username',
    'nama' => 'required|string|max:100',
    'password' => 'required|min:5',
    'level'   => 'required|integer'
    ]);
    $user = UserModel::find($id)->update([
      'username' => $request->username,
      'nama' => $request->nama,
      'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
    ]);
    return redirect('/user')->with('succes','Data user berhasil diubah');
  }

  //menghapus data user
 
  public function create_ajax()
  {
      $level = LevelModel::select('level_id', 'level_nama')->get();
      return view('user.create_ajax')
          ->with('level', $level);
  }
  
  public function edit_ajax(string $id)
  {
      $user = UserModel::find($id);
      $level = LevelModel::select('level_id', 'level_nama')->get();
      return view('user.edit_ajax', ['user' => $user, 'level' => $level]);
  }
  public function update_ajax(Request $request, $id)
  {
      // cek apakah request dari ajax
      if ($request->ajax() || $request->wantsJson()) {
          $rules = [
              'level_id' => 'required|integer',
              'username' => 'required|max:20|unique:m_user,username,' . $id . ',user_id',
              'nama' => 'required|max:100',
              'password' => 'nullable|min:6|max:20'
          ];
          // use Illuminate\Support\Facades\Validator;
          $validator = Validator::make($request->all(), $rules);
          if ($validator->fails()) {
              return response()->json([
                  'status' => false, // respon json, true: berhasil, false: gagal
                  'message' => 'Validasi gagal.',
                  'msgField' => $validator->errors() // menunjukkan field mana yang error
              ]);
          }
          $check = UserModel::find($id);
          if ($check) {
              if (!$request->filled('password')) { // jika password tidak diisi, maka hapus dari request
                  $request->request->remove('password');
              }
              $check->update($request->all());
              return response()->json([
                  'status' => true,
                  'message' => 'Data berhasil diupdate'
              ]);
          } else {
              return response()->json([
                  'status' => false,
                  'message' => 'Data tidak ditemukan'
              ]);
          }
      }
      return redirect('/');
  }

  public function confirm_ajax(string $id)
  {
     $user = UserModedl::find($id);

     return view('user.confirm_ajax', ['user' => $user]);
  }

  public function delete_ajax(Request $request, $id)
  {
    if($request->ajax() || $request->wantJson()){
      $user = UserModedl::find($id);
      if($user) {
        $user->delete();
        return response()->json([
          'status' => true,
          'message' => 'Data berhasil dihapus'
        ]);
      } else{
        return response()->json([
          'status' => false,
          'message' => 'Data tidak ditemukan'
        ]);
      }
    }
    return redirect('/');
  }

  public function destroy(string $id)
  {
    $check = UserModel::find($id);
    if(!$check){
      return redirect('/user')->with('error', 'Data user tidak ditemukan');
    }
    try{
      UserModel::destroy($id);
      return redirect('/user')->with('success', 'Data user berhasil dihapus');
    } catch(\illuminate\Database\QueryException $e){
      return redirect('/user')->with('error', 'Data gagal dihapus karena masih terdapat tabel yang terkait dengan data ini');
    }
  }
   }
       
       
    

