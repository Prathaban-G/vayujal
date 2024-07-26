
<header class="fixed-top">
    <div class="row">
        <div class="col-8 title">
            <div class="row">
                <i class="fa fa-bars col-1 pt-3 ps-4 nav-bar" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo" aria-hidden="true"></i>
                <h1 class="ps-5 pt-1 col-4">VAYU<span>JAL</span></h1>
            </div>
        </div>
        <div class="col-4 d-flex justify-content-end pt-3 pe-4">
            @if(Auth::check())
                <div class="d-flex align-items-center">
                    <span class="text-light me-3">{{ Auth::user()->username }}</span>
                   
                    <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button :href="route('logout')" class="btn p-1 "
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                               <i class="fa fa-sign-out text-light" aria-hidden="true" style="font-size: 25px;"></i>
                            </button>
                        </form>   
                    
                    
                    
                   
                </div>
            @endif
            <div id="logoutCard1" style="display: none;">
                <i class="ms-5 fa fa-user text-primary" aria-hidden="true" style="font-size: 50px;"></i>
                <p class="text-dark">Are you sure<br> you want to logout?</p>
                <button id="logOut" class="btn btn-danger text-white">Logout</button>
            </div>
        </div>
    </div>
</header>

<script>
document.getElementById('logoutIcon').addEventListener('click', () => {
    document.getElementById('logoutCard1').style.display = 'block';
});

document.getElementById('logOut').addEventListener('click', () => {
    // Create a form to send a POST request
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route('logout') }}'; // Update to the correct logout route

    // Add CSRF token for security
    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = '{{ csrf_token() }}';
    form.appendChild(csrfToken);

    // Append form to the body and submit
    document.body.appendChild(form);
    form.submit();
});
</script>

<!-- Logout form -->
<form id="logoutForm" method="POST" action="{{ route('logout') }}" style="display: none;">
    @csrf
</form>
