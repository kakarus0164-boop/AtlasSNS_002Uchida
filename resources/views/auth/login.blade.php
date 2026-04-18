<x-logout-layout>

  <div class="wrapper">
    <div class="logo-container">
        <h1 class="logo"><img src="{{ asset('images/atlas.png') }}" alt="Atlas"></h1>
        <p class="title">Social Network Service</p>
    </div>

       <div class="login-box">
          {!! Form::open(['url' => '/login']) !!}
             <p class="welcome-msg">AtlasSNSへようこそ</p>

              <div class="form-group">
                {{ Form::label('email') }}
                {{ Form::text('email', null, ['class' => 'input']) }}
              </div>

              <div class="form-group">
                {{ Form::label('password') }}
                {{ Form::password('password', ['class' =>  'input']) }}
              </div>

            {{ Form::submit('ログイン', ['class' => 'register-btn']) }}

            <p class="register-link"><a href="/register">新規ユーザーの方はこちら</a></p>
          {!! Form::close() !!}
        </div>
  </div>
</x-logout-layout>
