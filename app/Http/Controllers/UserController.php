<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PDF;

class UserController extends Controller
{
    public function register()
    {
        $data['title'] = 'Register';
        return view('user/register', $data);
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->save();

        return redirect()->route('login')->with('success', 'Registration success. Please login!');
    }


    public function login()
    {
        $data['title'] = 'Login';
        return view('user/login', $data);
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'password' => 'Wrong email or password',
        ]);
    }

    public function password()
    {
        $data['title'] = 'Change Password';
        return view('user/password', $data);
    }

    public function password_action(Request $request)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required|confirmed',
        ]);
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->new_password);
        $user->save();
        $request->session()->regenerate();
        return back()->with('success', 'Password changed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // TUGAS ADD USER
    public function index()
    {
        $title = "Data User";
        $user = User::orderBy('id', 'asc')->paginate();
        return view('users.index', compact(['user', 'title']));
    }

    public function create()
    {
        $title = "Tambah Data User";
        $managers = User::where('position', '1')->get();
        return view('users.create', compact(['managers', 'title']));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'nullable',
            'password' => 'required',
            'positions' => 'required',
            'departements' => 'required',
        ]);

        User::create($validatedData);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }


    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }


    public function edit(User $user)
    {
        $title = "Edit Data User";
        $managers = User::where('position', '1')->get();
        return view('users.edit', compact(['user', 'managers', 'title']));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email',
            'password',
            'positions',
            'departements',
        ]);

        $user->fill($request->post())->save();

        return redirect()->route('user.index')->with('success', 'User Has Been updated successfully');
    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User has been deleted successfully');
    }

    public function exportPdf()
    {
        $title = "Laporan Data User";
        $user = User::orderBy('id', 'asc')->get();

        $pdf = PDF::loadview('users.pdf', compact(['user', 'title']));
        return $pdf->stream('laporan-user-pdf');
    }
}