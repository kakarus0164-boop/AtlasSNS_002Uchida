<x-logout-layout>
    <!-- 適切なURLを入力してください -->

<div class="wrapper">
  <div class="login-box register-box">

       {!! Form::open(['url' => 'register']) !!}

           <h2>新規ユーザー登録</h2>

           <div class="form-group">
               {{ Form::label('username','ユーザー名') }}
               {{ Form::text('username',null,['class' => 'input']) }}
           </div>

           <div class="form-group">
               {{ Form::label('email','メールアドレス') }}
               {{ Form::email('email',null,['class' => 'input']) }}
           </div>

           <div class="form-group">
               {{ Form::label('password','パスワード') }}
               {{ Form::password('password',null,['class' => 'input']) }}
           </div>

           <div class="form-group">
               {{ Form::label('password_confirmation','パスワード確認') }}
               {{ Form::password('password_confirmation',null,['class' => 'input']) }}
           </div>

           {{ Form::submit('新規登録' , ['class' => 'register-btn']) }}

           <p><a href="{{ route('login') }}">ログイン画面へ戻る</a></p>

        {!! Form::close() !!}
   </div>
</div>

</x-logout-layout>
