<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <a class="navbar-brand ml-5" href="{{ route('index') }}"><h3>InfoSystem</h3></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{isActive(route('index'))}}">
                <a class="nav-link ml-2" href="{{ route('index') }}">主页</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">动态</a>
            </li>
        </ul>

        <ul class="navbar-nav mr-5 justify-content-end">
            @if(\App\Models\Role::is_teacher($user))
                <li class="nav-item">
                    <a class="nav-link" href="#">学生管理</a>
                </li>
            @endif
            @if(\Illuminate\Support\Facades\Auth::check())
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ \Illuminate\Support\Facades\Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('users.show',\Illuminate\Support\Facades\Auth::user()) }}">个人中心</a>
                    <a class="dropdown-item" href="{{ route('users.edit',\Illuminate\Support\Facades\Auth::user()) }}">编辑资料</a>
                <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}">退出登出</a>
                </div>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.create') }}">注册</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">登入</a>
                </li>
            @endif
        </ul>
    </div>
</nav>