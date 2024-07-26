
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vayujal</title>
    <link rel="icon" type="image/png" href="logo.jpg ">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
           * {
            padding: 0;
            margin: 0;
        }

        html {
            padding: 0;
            margin: 0;
            scroll-behavior: smooth;
        }
       
.loginCard
{
    float: right;
    top: 50px;
    right: 50px;
    width: 400px;
   
}
.demo-wrap {
  overflow: hidden;
  position: relative;
  height: 100%;
 
}

.demo-bg {

  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  z-index: -2;
}

.demo-content {
  position: relative;
}
#loading {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1000;
    }



    </style>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
    <div class="demo-wrap" id="demo-wrap">
        <img
          class="demo-bg"
          src="{{URL('/images/background.png')}}"
          alt=""
        >
        <div class="demo-content">
            <div class="card loginCard border-1 border-secondary w3-animate-zoom" >
                <div class="card-img-top border-bottom border-1 border-secondary d-flex justify-content-center pb-4 pt-3">  
                    <img src="{{URL('/images/logo.jpg')}}" alt="Vayujal" width="300px" height="300px" class="img-fluid" height="150px"></div>
                    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit">Login</button>
        </div>
    </form>


        </div>
      </div>
      <div class="container-fluid mt-1" style="position: absolute;bottom: 0;justify-content: center;">
        <div class="row">
            <footer>
                <p class="bg-muted text-light text-center">&copy;All Rights Reserved By Olive IOT</p>
            </footer>
        </div>
    </div>
    </div>

      
      <div id="loading"  >
        <div class="row mt-2  d-flex justify-content-center"><div class="spinner-grow text-info"></div>
        <div class="spinner-grow text-warning"></div>
        <div class="spinner-grow text-danger"></div></div></div>

    
   
</body>
<script>

</script>

</html>