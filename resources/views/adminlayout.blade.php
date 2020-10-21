<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
<nav class="nav">
  <a class="nav-link active" href="{{ url('') }}">Home</a>
  <a class="nav-link" href="{{ url('/holiday') }}">勤務・休日設定</a>
  <a class="nav-link" href="#">その他</a>
  <a class="nav-link disabled">ログアウト</a>
</nav>
   
<form action="admin/logout" method="POST">
        @csrf
        <button>ログアウト</button>
    </form>

<div class="container">
    @yield('content')
</div>
</body>
</html>