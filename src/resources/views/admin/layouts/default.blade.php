<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/default.css') }}">
    @yield('css')
    @yield('js')
</head>
<body>
  <header class="header">
    <div class="header__contents">
      <a href="/">
          <div class="logo__svg" style="background-image: url('{{ asset('storage/images/logo.svg') }}')">
          </div>
      </a>
        @yield('button')
      <form action="/logout" method="post">
        @csrf
        <nav class="header-nav">
            <ul class="header-ul">
                <li class="header-li"><a class="header-nav__link" href="/attendance">勤怠</a></li>
                <li class="header-li"><a class="header-nav__link" href="/attendance/list">勤怠一覧</a></li>
                <li class="header-li header-li-purchase"><a class="header-nav__link" href="/stamp_correction_request/list">申請</a></li>
                <li class="">
                  <?php
              if(Auth::check()) {
                echo '<li class="header-li">
                    <button class="header-nav__link">ログアウト</button></li>';
              }
              ?></li>
            </ul>
        </nav>
      </form>
    </div>
  </header>
  <main>
    <div class="content">
      @yield('content')
    </div>
  </main>
</body>
</html>