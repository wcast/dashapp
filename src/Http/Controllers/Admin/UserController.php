<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\CompanyUser;
use App\Models\Perfil;
use App\Models\User;
use App\Repositories\ImageRepository;
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
        $query->with('perfil');

        $users = $query->paginate(50);

        $perfis = Perfil::all();
        return Inertia::render('users/index', [
            'user' => Auth::user(),
            'users' => $users,
            'perfis' => $perfis
        ]);
    }

    public function search()
    {
        $user = new User();
        $query = $user->search();
        $query->with('perfil');
        $users = $query->paginate(50);
        return json_encode($users);
    }

    public function add()
    {
        $perfis = Perfil::all();
        return Inertia::render('users/add', [
            'perfis' => $perfis,
        ]);
    }

    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->phone = $request->phone;
        $user->perfil_id = $request->perfil_id;
        $user->status = $request->status;
        $user->password = Hash::make('1q2w3e4r');
        $user->online = false;
        $user->avatar = '@';
        if ($user->save()) {
            if ($avatar = ImageRepository::makeFromBase64($request->avatar, 'avatar', '/uploads/avatars/', 70, 100)) {
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
        $perfis = Perfil::all();
        $user = User::query()->findOrFail($id);
        return Inertia::render('users/edit', [
            'perfis' => $perfis,
            'user' => $user
        ]);
    }

    public function account($id = null)
    {
        $perfis = Perfil::all();
        $user = User::query()->findOrFail($id);
        return Inertia::render('users/account', [
            'perfis' => $perfis,
            'user' => $user
        ]);
    }

    public function update(UserRequest $request)
    {
        $user = User::query()->findOrFail($request->id);
        if ($avatar = ImageRepository::makeFromBase64($request->avatar, 'avatar', '/uploads/avatars/', 70, 100)) {
            $user->avatar = $avatar;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->phone = $request->phone;
        $user->perfil_id = $request->perfil_id;
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
