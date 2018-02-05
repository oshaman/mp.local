<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Fresh\Medpravda\Http\Requests\UserRequest;
use Fresh\Medpravda\User;
use Fresh\Medpravda\Repositories\UsersRepository;
use Gate;

class UsersController extends AdminController
{
    protected $us_rep;

    /**
     * UsersController constructor.
     */
    public function __construct(UsersRepository $us_rep)
    {
        $this->title = 'Редактирование пользователей';
        $this->template = 'admin.admin';
        $this->us_rep = $us_rep;
        $this->mark = 'users';
    }

    /**
     * @return mixed
     */
    public function show()
    {
        if (Gate::denies('USERS_ADMIN')) {
            abort(404);
        }

        $users = $this->us_rep->get(['email', 'id'], false, 15, false, false, 'role');
        $this->content = view('admin.users.content')->with('users', $users)->render();
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(UserRequest $request, User $user)
    {
        if (Gate::denies('USERS_ADMIN')) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $result = $this->us_rep->updateUser($request, $user);
            if (is_array($result) && !empty($result['error'])) {
                return back()->with($result);
            }
            return redirect()->route('users_admin')->with($result);
        }

        $this->title = 'Редактирование пользователя - ' . $user->email;

        $roles = $this->us_rep->getRoles();

        $this->content = view('admin.users.edit')->with(['roles' => $roles, 'user' => $user])->render();

        return $this->renderOutput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Gate::denies('USERS_ADMIN')) {
            abort(404);
        }
        $result = $this->us_rep->deleteUser($user);
        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect()->route('users_admin')->with($result);
    }

    public function store(UserRequest $request)
    {
        if (Gate::denies('USERS_ADMIN')) {
            abort(404);
        }
        $this->title = 'Новый пользователь';

        if ($request->isMethod('post')) {
            $result = $this->us_rep->addUser($request);
            if (is_array($result) && !empty($result['error'])) {
                return back()->with($result);
            }
            return redirect()->route('users_admin')->with($result);
        }

        $roles = $this->us_rep->getRoles();

        $this->content = view('admin.users.create')->with('roles', $roles)->render();

        return $this->renderOutput();
    }

}
