<x-logout-layout>

  <div class="wrapper">
    <div>

      <div class="title">
        <p>Social Network Service</p>
      </div>

      <div class="login-box">

        {!! Form::open(['url' => '/login']) !!}

          <p>AtlasSNSへようこそ</p>

          {{ Form::label('email') }}
          {{ Form::text('email', null, ['class' => 'input']) }}

          {{ Form::label('password') }}
          {{ Form::password('password', ['class' => 'input']) }}

          {{ Form::submit('ログイン') }}

          <p><a href="/register">新規ユーザーの方はこちら</a></p>

        {!! Form::close() !!}

      </div>
    </div>
  </div>

</x-logout-layout>
