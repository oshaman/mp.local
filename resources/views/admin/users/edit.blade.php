<h2>Редактирование пользователя</h2>
<!-- START CONTENT -->
<div class="container">
    {!! Form::open(['url' => route('users_update', $user->id), 'class'=>'contact-form','method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
    <fieldset>
        <ul list-group>
            <li>
                <h4>{!! Form::label('email', 'Электронная почта') !!}</h4>

                {!! Form::email('email', old('email') ? : $user->email, ['class'=>'form-control', 'required'=>'required']) !!}

            </li>
            <li>
                <h4>{!! Form::label('name', 'Имя') !!}</h4>

                {!! Form::text('name', old('name') ? : $user->name, ['class'=>'form-control', 'required'=>'required']) !!}

            </li>
            <li>
                <h4>{!! Form::label('pass', 'Пароль') !!}</h4>
                {!! Form::password('password') !!}
            </li>
            <li>
                <h4>{!! Form::label('cpass', 'Подтверждение пароля') !!}</h4>
                {!! Form::password('password_confirmation') !!}
            </li>

            <li>
                <h4>{!! Form::label('role', 'Роль') !!}</h4>
                <table class="table">
                    @foreach($roles as $id=>$role)
                        @if($user->role_id == $id)
                            <td>
                                <input checked name="role" type="radio" value="{{ $id }}">{{ $role }}
                            </td>
                        @else
                            <td>
                                <input name="role" type="radio" value="{{ $id }}">{{ $role }}
                            </td>
                        @endif
                    @endforeach
                </table>
            </li>
        </ul>
    </fieldset>
    <!-- Submit -->
    {!! Form::button('Сохранить', ['class' => 'btn btn-success','type'=>'submit']) !!}
    {!! Form::close() !!}
</div>
<!-- END CONTENT -->