<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <a class="navbar-brand ml-5 mr-2" href="{{ route('index') }}"><h3>InfoSystem</h3></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{isActive(route('index')."/",14)}}">
                <a class="nav-link" href="{{ route('index') }}">主页</a>
            </li>
            <li class="nav-item {{isActive(route('users.index')."/",14)}}">
                <a class="nav-link" href="{{ route('users.index') }}">用户列表</a>
            </li>
        </ul>

        <ul class="navbar-nav mr-5 justify-content-end">
            @auth
                @if(\App\Models\Role::is_teacher(\Illuminate\Support\Facades\Auth::user()))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown_teacher" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            教师中心
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('teachers.index') }}">学生列表</a>
                            <a class="dropdown-item" href="{{ route('teachers.create') }}">学生添加</a>
                            <a class="dropdown-item" href="#">通知模块</a>
                        </div>
                    </li>
                @endif
                @if(\App\Models\Role::is_manager(\Illuminate\Support\Facades\Auth::user()))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown_manager" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           管理中心
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('managers.index') }}">用户管理</a>
                            <a class="dropdown-item" href="{{ route('managers.role') }}">角色管理</a>
                            <a class="dropdown-item" href="{{ route('managers.create') }}">教师添加</a>
                        </div>
                    </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown_normal" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ \Illuminate\Support\Facades\Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('users.show',\Illuminate\Support\Facades\Auth::user()) }}">个人中心</a>
                        <a class="dropdown-item" href="{{ route('users.edit',\Illuminate\Support\Facades\Auth::user()) }}">编辑资料</a>
                        <a class="dropdown-item" href="#">通知列表</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}">退出登入</a>
                </div>
                </li>
            @endauth

            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.create') }}">注册</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">登入</a>
                </li>
            @endguest
        </ul>
    </div>
</nav>
