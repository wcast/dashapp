<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\CompanyUser;
use App\Models\Perfil;
use App\Models\User;
use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use function session;

class UserController extends Controller
{

    public function index()
    {
        $user = new User();
        $query = $user->search();
        $users = $query->paginate(50);
        return Inertia::render('users/index', [
            'user' => Auth::user(),
            'users' => $users
        ]);
    }

    public function search()
    {
        $user = new User();
        $query = $user->search();
        $users = $query->paginate(50);
        return json_encode($users);
    }

    public function add()
    {
        return Inertia::render('users/add');
    }

    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->phone = $request->phone;
        $user->status = $request->status;
        $user->password = Hash::make('1q2w3e4r');
        $user->online = false;
        $user->avatar = '@';
        if ($user->save()) {
            if ($avatar = Images::makeFromBase64($request->avatar, 'avatar', '/uploads/avatars/', 70, 100)) {
                $user->avatar = $avatar;
                $user->save();
            } else {
                $user->avatar = '/uploads/no-image.png';
                $user->save();
            }
            return session()->flash('success', 'Registro realizado com sucesso!');
        }
    }

    public function edit($id = null)
    {
        $user = User::query()->findOrFail($id);
        return Inertia::render('users/edit', [
            'user' => $user
        ]);
    }

    public function account($id = null)
    {
        $user = User::query()->findOrFail($id);
        return Inertia::render('users/account', [
            'user' => $user
        ]);
    }

    public function update(UserRequest $request)
    {
        $user = User::query()->findOrFail($request->id);
        if ($avatar = Images::makeFromBase64($request->avatar, 'avatar', '/uploads/avatars/', 70, 100)) {
            $user->avatar = $avatar;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->phone = $request->phone;
        $user->status = $request->status;
        if ($user->save()) {
            return session()->flash('success', 'Registro atualizado com sucesso!');
        }
    }

    public function delete(Request $request)
    {
        $res = User::destroy($request->id);

        if ($res) {
            return response()->json([
                'success' => true,
                'msg' => 'Registro excluído com sucesso'
            ]);
        } else {

            return response()->json([
                'success' => false,
                'msg' => 'Registro não pode ser excluído'
            ]);
        }
    }
}
