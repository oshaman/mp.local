<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\User;
use Gate;
use File;

class UsersRepository extends Repository
{
    /**
     * UsersRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @param $request
     * @param $user
     * @return array
     */
    public function updateUser($request, $user)
    {
        if (Gate::denies('USERS_ADMIN', $this->model)) {
            abort(404);
        }

        $data = $request->except('_token');

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            array_forget($data, 'password');
        }

        $data['role_id'] = $data['role'];


        $user->fill($data)->update();

        return ['status' => 'Данные пользователя обновлены'];
    }

    /**
     * @param $user
     * @return array
     */
    public function deleteUser($user)
    {
        if (Gate::denies('USERS_ADMIN', $this->model)) {
            abort(404);
        }

        if (File::exists(public_path('photos/' . $user->id))) {
            File::deleteDirectory(public_path('photos/' . $user->id));
        }

        if ($user->delete()) {
            return ['status' => 'Пользователь удален'];
        }
    }

    /**
     * @param $request
     * @return array
     */
    public function addUser($request)
    {

        if (Gate::denies('USERS_ADMIN', $this->model)) {
            abort(404);
        }

        $data = $request->all();

        $user = $this->model->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role_id' => $data['role'],
            'password' => bcrypt($data['password']),
        ]);

        if (!$user) {
            return ['status' => 'Ошибка добавления пользователя.'];
        }

        return ['status' => 'Пользователь добавлен.'];

    }

    public function getRoles()
    {
        return \Fresh\Medpravda\Role::all()->reduce(function ($returnRoles, $role) {
            $returnRoles[$role->id] = $role->name;
            return $returnRoles;
        }, []);
    }
}

?>