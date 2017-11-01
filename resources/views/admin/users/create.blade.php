<h2>Добавление пользователя:</h2>
{!! Form::open(['url'=>route('users_create'), 'class'=>'contact-form', 'method'=>'post']) !!}
<fieldset>
    <ul list-group>
        <li>
            <h4>{!! Form::label('name', 'Имя') !!}</h4>
            {!! Form::text('name', old('name') ? : '') !!}
        </li>
        <li>
            <h4>{!! Form::label('email', 'Электронная почта') !!}</h4>
            {!! Form::email('email', old('email') ? : '') !!}
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
            <h4>{!! Form::label('roles', 'Роль') !!}</h4>
            <table class="table">
                @foreach($roles as $id=>$role)
                    <td>
                        <input name="role" {{ $id == old('role') ? 'checked' : '' }} type="radio"
                               value="{{ $id }}">{{ $role }}
                    </td>
                @endforeach
            </table>
        </li>
    </ul>
</fieldset>
<!-- Submit -->
{!! Form::button('Сохранить', ['class' => 'btn btn-success','type'=>'submit']) !!}
{!! Form::close() !!}