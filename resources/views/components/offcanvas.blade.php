<div class="offcanvas offcanvas-start" id="demo">
    <div class="offcanvas-header">
        <h1 class="offcanvas-title ps-5 pt-1 col-4">VAYU<span>JAL</span></h1>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <div class="container-fluid navigation">
            <div class="row p-2 border-bottom border-1 border-dark">
                <a href="{{ url('home') }}" class="h5 text-center text-dark">Home</a>
            </div>
            <div class="row p-2 border-bottom border-1 border-dark">
                <a href="{{ url('products') }}" class="h5 text-center text-dark">Products</a>
            </div>
            <div class="row p-2 border-bottom border-1 border-light aside-nav-bar">
                <a href="{{ url('admin') }}" class="h5 text-center text-light">Admin</a>
            </div>
            <div class="row p-2 border-bottom border-1 border-dark">
                <a href="{{ url('users') }}" class="h5 text-center text-dark">User</a>
            </div>
            <div class="row p-2 border-bottom border-1 border-dark">
                <a href="{{ url('alarmlog') }}" class="h5 text-center text-dark">Alarms</a>
            </div>
            <div class="row p-2 border-bottom border-1 border-dark">
                <a href="{{ url('historic') }}" class="h5 text-center text-dark">Historic</a>
            </div>
        </div>
    </div>
</div>
