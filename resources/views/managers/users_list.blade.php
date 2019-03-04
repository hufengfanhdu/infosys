<h3 class="card-title mb-3">系统用户列表</h3>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">id</th>
        <th scope="col">姓名</th>
        <th scope="col">邮箱</th>
        <th scope="col">权限</th>
        <th scope="col">更新时间</th>
        <th scope="col">管理操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @foreach( $user->roles->all() as $role)
                    @if($role->role)
                        <strong class="text-primary">{{ \App\Models\Role::show_roles($role->role) }}</strong>
                    @endif
                @endforeach
            </td>
            <td>{{ $user->updated_at->diffForHumans() }}</td>
            <td>
                <a href="{{ route('users.edit',compact('user')) }}" class="btn btn-light">编辑</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                      style="display: inline-block;"
                      onsubmit="return confirm('您确定要删除吗？');">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-light">
                        删除
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $users->links() }}
