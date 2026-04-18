<x-logout-layout>
    <!-- 適切なURLを入力してください -->

<div class="wrapper">
    <div class="logo-container2">
        <h1 class="logo"><img src="{{ asset('images/atlas.png') }}" alt="Atlas"></h1>
        <p class="title">Social Network Service</p>
    </div>
    <div class="login-box register-box">
       {!! Form::open(['url' => 'register']) !!}

           <p class="welcome-msg">新規ユーザー登録</p>
           @if ($errors->any())
               <div style="color:red;">
                   <ul>
                        @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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
