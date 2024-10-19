<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

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
   public function list(Request $request) 
{ 
    $users = UserModel::select('user_id', 'username', 'nama', 'level_id')                 ->with('level'); 
 
    return DataTables::of($users) 
        // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
        ->addIndexColumn()  
        ->addColumn('aksi', function ($user) {  // menambahkan kolom aksi 
            $btn  = '<a href="'.url('/user/' . $user->user_id).'" class="btn btn-info btnsm">Detail</a> '; 
            $btn .= '<a href="'.url('/user/' . $user->user_id . '/edit').'" class="btn btnwarning btn-sm">Edit</a> '; 
            $btn .= '<form class="d-inline-block" method="POST" action="'. url('/user/'.$user->user_id).'">' 
                    . csrf_field() . method_field('DELETE') .  
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';                  return $btn; 
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
    'username' => 'requiren|string|min:3|unique:m_user,username',
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

   }
       
       
    

