<h3 class="card-title mb-3">系统角色列表</h3>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">id</th>
        <th scope="col">权限名称</th>
        <th scope="col">所属用户</th>
        <th scope="col">更新时间</th>
        <th scope="col">管理操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($roles as $role)
        <tr>
            <th scope="row">{{ $role->id }}</th>
            <td>{{ \App\Models\Role::show_roles($role->role) }}</td>
            <td>{{ $role->user->name }}</td>
            <td>{{ $role->updated_at->diffForHumans() }}</td>
            <td>
                @if(\App\Models\Role::is_manager($role->user))
                    <div class="btn btn-light disabled" >删除</div>
                @else
                    <form action="{{ route('managers.destroy', $role->id) }}" method="POST"
                          style="display: inline-block;"
                          onsubmit="return confirm('您确定要删除吗？');">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-light">
                            删除
                        </button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $roles->links() }}
