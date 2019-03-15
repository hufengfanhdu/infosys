<div class="card-body">
    @include('layouts._errors')
    <form method="POST" action="{{ route('users.store') }}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="Email" class="col-form-label">邮箱</label>
            <input type="email" class="form-control" name="email" id="Email" aria-describedby="emailHelp"
                   placeholder="请输入邮箱" value="{{ old('email') }}">
            <small id="emailHelp" class="form-text text-muted">我们不会向其他人透露您的邮箱</small>
        </div>
        <div class="form-group">
            <label for="name" class="col-form-label">用户名</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="请输入用户名"
                   value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="password" class="col-form-label">密码</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="请输入密码">
        </div>
        <div class="form-group">
            <label for="password_confirmation" class="col-form-label">确认密码</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="确认密码">
        </div>
        <button type="submit" class="btn btn-primary">注册</button>
    </form>
</div>
