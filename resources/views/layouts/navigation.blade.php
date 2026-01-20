    <div id="head">
             <h1>
                <a href="{{ route('posts.index') }}">
                   <img src="{{ asset('images/atlas.png') }}" alt="Atlas">
                </a>
             </h1>

               <div class="user-menu">
                   <button id="menuBtn" class="menu-btn">
                       <p>〇〇さん ▼</p>
                   </button>

                   <ul id="menu" class="menu">
                       <li><a href="{{ route('posts.index') }}">ホーム</a></li>
                       <li><a href="{{ route('users.profile') }}">プロフィール</a></li>
                       <li>
                           <form method="POST" action="{{ route('logout') }}">
                              @csrf
                              <button type="submit">ログアウト</button>
                           </form>
                        </li>
                   </ul>
               </div>
    </div>
