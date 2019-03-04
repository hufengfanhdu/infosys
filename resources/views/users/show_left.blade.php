<div class="card w-25" >
    <img class="card-img-top" src="/uploads/images/avatars/normal.png" alt="头像未能正常显示">
    <div class="card-body">
        <h3 class="card-title">
            @foreach( $user->roles->all() as $role)
                @if($role->role)
                    <strong class="text-primary">{{ \App\Models\Role::show_roles($role->role) }}</strong>
                @endif
            @endforeach
            {{ $user->name }}
        </h3>
        <p class="card-text">{{ $user->introduction }}</p>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <h5 class="text-primary ">创建时间</h5>
            {{ $user->created_at->diffForHumans() }}
        </li>
        <li class="list-group-item">
            <h5 class="text-primary ">绑定邮箱</h5>
            {{ $user->email }}
        </li>
    </ul>
</div>