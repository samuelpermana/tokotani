<?php
namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pegawai;
use App\Models\User;

class PegawaiController extends Controller
{
    // Menampilkan daftar pegawai
    public function index()
    {
        // $pegawai = Pegawai::all();
        $pegawais = Pegawai::with('user')->get();
        return view('owner.pegawai.index', compact('pegawais'));
    }

    // Menampilkan form untuk menambah pegawai
    public function create()
    {
        return view('owner.pegawai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'no_telepon' => 'required|string|max:15',
            'password' => 'required|string|min:8',  // Validate password
        ]);
    
        $user = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password), // Hash the password
            'role' => "pegawai",
        ]);
    
        Pegawai::create([
            'user_id' => $user->id,
            'username' => $request->username,
            'no_telepon' => $request->no_telepon,
        ]);
    
        return redirect()->route('pegawai.index')->with('success', 'Pegawai created successfully.');
    }
    

    // Menampilkan form untuk mengedit pegawai
    public function edit(Pegawai $pegawai)
    {
        return view('owner.pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $pegawai->user->id,
            'no_telepon' => 'required|string|max:15',
            'password' => 'nullable|string|min:8', // Password is optional
        ]);
    
        // Update the user details
        $pegawai->user->update([
            'username' => $request->username,
            'role' => "pegawai",
        ]);
    
        // Update the employee details
        $pegawai->update([
            'username' => $request->username,
            'no_telepon' => $request->no_telepon,
        ]);
    
        // If password is provided, update it
        if ($request->filled('password')) {
            $pegawai->user->update([
                'password' => bcrypt($request->password), // Hash the new password
            ]);
        }
    
        return redirect()->route('pegawai.index')->with('success', 'Pegawai updated successfully.');
    }
    

    // Menghapus pegawai
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();
        $pegawai->user->delete();
        
        return redirect()->route('pegawai.index')->with('success', 'Pegawai deleted successfully.');
    }
}