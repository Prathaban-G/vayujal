<div class="aside border-end border-top border-1 border-light">
    <div class="container-fluid mt-2 pb-3 pt-3 border-bottom border-1 border-light">
        <div class="row d-flex text-center">
            <i class="fa fa-user-circle pb-2" aria-hidden="true" style="font-size: 100px;color: white;"></i>
        </div>
        <div class="h5 text-center text-white">
            {{ Auth::user()->type === 'superadmin' ? 'Super Admin' : 'Admin' }}
        </div>
    </div>
    <div class="container-fluid navigation">
        <div class="row p-2 border-bottom border-1 border-light aside-nav-bar">
            <a href="{{ url('superhome') }}" class="h5 text-center text-light">Home</a>
        </div>
        <div class="row p-2 border-bottom border-1 border-light aside-nav-bar">
            <a href="{{ route('superadmin.products.index') }}" class="h5 text-center text-light">Products</a>
        </div>
        
        @if (Auth::user()->type === 'superadmin')
        <div class="row p-2 border-bottom border-1 border-light aside-nav-bar">
            <a href="{{ url('superadmin/admins/index') }}" class="h5 text-center text-light">Admin</a>
        </div>
        @endif

        <div class="row p-2 border-bottom border-1 border-light aside-nav-bar">
            <a href="{{ url('superadmin/users/index') }}" class="h5 text-center text-light">User</a>
        </div>
        <div class="row p-2 border-bottom border-1 border-light aside-nav-bar">
            <a href="{{ url('superadmin/alarmlog') }}" class="h5 text-center text-light">Alarms</a>
        </div>
        <div class="row p-2 border-bottom border-1 border-light aside-nav-bar">
            <a href="{{ url('superadmin/data') }}" class="h5 text-center text-light">History</a>
        </div>
    </div>
</div>
