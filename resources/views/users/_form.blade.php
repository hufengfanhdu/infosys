<div class="card-body">
    @include('layouts._errors')
    <form method="POST" action="{{ route('users.store') }}">
        {{ csrf_field() }}

        <div class="form-group">
            <div class="row">
                <label for="Email" class="col-sm-1 col-form-label">邮箱</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="Email" aria-describedby="emailHelp"
                           placeholder="请输入邮箱" value="{{ old('email') }}">
                </div>
            </div>
            <small id="emailHelp" class="form-text text-muted offset-1">我们不会向其他人透露您的邮箱</small>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="name" class="col-form-label col-sm-1">用户名</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" placeholder="请输入用户名"
                           value="{{ old('name') }}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="password" class="col-form-label col-sm-1">密码</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" id="password" placeholder="请输入密码">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="password_confirmation" class="col-form-label col-sm-1">确认密码</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="确认密码">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary offset-sm-10">注册</button>
    </form>
</div>