<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   public function index() {
    $users = User::all();
    $title = "User Management";
    return view ('admin.users.index', compact('users', 'title'));
    }

   public function create(){
    $roles = Role::all();
    $title = "Add User";

    return view('admin.users.create', compact('roles', 'title'));

   }

   public function store(Request $request){
       // kita validasi dulu data yang mau ditangkep dari form tambah user

    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email'=> 'required|email|unique:users,email',
        'password'=> 'required|min:8',
        'role_id'=>'required',
    ]);
    // terus kita jalanin fungsi create buat simpen data2 yang udah divalidasi biar disimpen di dalem database
    User::create([
        'name'=>$validatedData['name'],
        'email'=>$validatedData['email'],
        'password'=>Hash::make($request->password),
        'role_id'=>$validatedData['role_id'],
    ]);
    // nah abis itu kita redirect deh ke halaman index biar keliatan udah kesimpen datanya
    return redirect()->route('admin.users.index')->with('success', 'User successfully added');
    
   }

   public function edit($id){
    // pertama, kita cari dulu user berdasarkan ID, kalo ga ketemu/fail nanti muncul halaman 404
    $user = User::findorFail($id);
    $roles = Role::all();
    $title = "Edit User";

    // terus, kita arahin ke view edit, terus kirim data user yang lama
    return view('admin.users.edit', compact('user', 'roles'));
    
   }

   public function update(Request $request, $id){
    // Update buat simpen perubahan data
    $user = User::findOrFail($id);

    // kita validasi inputnya
    $validatedData = $request->validate([
        'name'=>'required|string|max:255',
        'email'=> 'required|email|unique:users,email,'. $id,
        'role_id'=>'required|string',
        'password'=>'nullable|min:8',
        ]);

    // terus siapin data yang mau diupdate deh
    $updateData = [
        'name'=>$validatedData['name'],
        'email'=>$validatedData ['email'],
        'role_id'=>$validatedData ['role_id'],
    ];

    // kalo kolom password diisi sama admin, maka bakal di encrypt dan masuk ke array update
    if($request->filled('password')) {
        $updateData['password']= Hash::make($request->password);
    }
    // update data ke database
    $user->update($updateData);

    return redirect()->route('admin.users.index')->with('success', 'Successfully update user data!');
   }

   public function destroy($id){
    // cari user berdasarkan ID, kalo gaada error 404
    $user = User::findorFail($id);

    // hapus data dari database
    $user->delete();

    // redirect ke halaman awal deh
    return redirect()->route('admin.users.index')->with('success', 'User has been deleted');
   }
}
