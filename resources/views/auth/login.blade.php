<!DOCTYPE html>

<html class="opacity-0" lang="en">
  <!-- BEGIN: Head -->
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="JjEC0dlb1KAtzjleyRP1xklomoU7AFCJRCwqEZAl">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, midone Admin Template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>Login - Midone - Tailwind Admin Dashboard Template</title>
    <!-- BEGIN: CSS Assets-->
    <!-- END: CSS Assets-->
    <link rel="preload" as="style" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" data-navigate-track="reload" />

  </head>
  <!-- END: Head -->
  <body>

    <div class="p-3 sm:px-8 relative h-screen lg:overflow-hidden bg-primary xl:bg-white xl:dark:bg-darkmode-600 before:hidden before:xl:block before:content-[''] before:w-[57%] before:-mt-[28%] before:-mb-[16%] before:-ml-[13%] before:absolute before:inset-y-0 before:left-0 before:transform before:rotate-[-4.5deg] before:bg-primary/20 before:rounded-[100%] before:dark:bg-darkmode-400 after:hidden after:xl:block after:content-[''] after:w-[57%] after:-mt-[20%] after:-mb-[13%] after:-ml-[13%] after:absolute after:inset-y-0 after:left-0 after:transform after:rotate-[-4.5deg] after:bg-primary after:rounded-[100%] after:dark:bg-darkmode-700">
      <div class="container relative z-10 sm:px-10">
        <div class="block grid-cols-2 gap-4 xl:grid">
          <!-- BEGIN: Login Info -->
          <div class="hidden min-h-screen flex-col xl:flex">
            <a class="-intro-x flex items-center pt-5" href="">
              <img style="height : 200px" src="{{ asset('assets/img/ubg.png') }}" alt="Umoja" />

            </a>
            <div class="my-auto">

              <div class="-intro-x mt-10 text-4xl font-medium leading-tight text-white"> A few more clicks to <br /> sign in to your account. </div>
              <div class="-intro-x mt-5 text-lg text-white text-opacity-70"> Manage all your e-commerce accounts in one place </div>
            </div>
          </div>
          <!-- END: Login Info -->
          <!-- BEGIN: Login Form -->
          <div class="my-10 flex h-screen py-5 xl:my-0 xl:h-auto xl:py-0">
            <div class="mx-auto my-auto w-full rounded-md bg-white px-5 py-8 shadow-md sm:w-3/4 sm:px-8 lg:w-2/4 xl:ml-20 xl:w-auto xl:bg-transparent xl:p-0 xl:shadow-none">
              <h2 class="intro-x text-center text-2xl font-bold xl:text-left  text-blue xl:text-3xl"> Sign In </h2>
              <div class="intro-x mt-2 text-center text-slate-400 xl:hidden"> A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place </div>
              <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="intro-x mt-8">
                  <input data-tw-merge type="email" name="email" required="required" autofocus="autofocus" autocomplete="username" placeholder="Email" class="disabled:bg-slate-100 disabled:cursor-not-allowed [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&amp;:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 intro-x block min-w-full px-4 py-3 xl:min-w-[350px] intro-x block min-w-full px-4 py-3 xl:min-w-[350px]" />
                  <input data-tw-merge type="password" name="password" required="required" autocomplete="current-password" placeholder="Password" class="disabled:bg-slate-100 disabled:cursor-not-allowed [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&amp;:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px] intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]" />
                </div>
                <div class="intro-x mt-4 flex text-xs text-slate-600 sm:text-sm">
                  <div class="mr-auto flex items-center">
                    <input data-tw-merge type="checkbox" class="transition-all duration-100 ease-in-out shadow-sm border-slate-200 cursor-pointer rounded focus:ring-4 focus:ring-offset-0 focus:ring-primary focus:ring-opacity-20 [&amp;[type=&#039;radio&#039;]]:checked:bg-primary [&amp;[type=&#039;radio&#039;]]:checked:border-primary [&amp;[type=&#039;radio&#039;]]:checked:border-opacity-10 [&amp;[type=&#039;checkbox&#039;]]:checked:bg-primary [&amp;[type=&#039;checkbox&#039;]]:checked:border-primary [&amp;[type=&#039;checkbox&#039;]]:checked:border-opacity-10 [&amp;:disabled:not(:checked)]:bg-slate-100 [&amp;:disabled:not(:checked)]:cursor-not-allowed [&amp;:disabled:not(:checked)]:dark:bg-darkmode-800/50 [&amp;:disabled:checked]:opacity-70 [&amp;:disabled:checked]:cursor-not-allowed [&amp;:disabled:checked]:dark:bg-darkmode-800/50 mr-2 border mr-2 border" id="remember-me" name="remember" />
                    <label class="cursor-pointer select-none" for="remember-me"> Remember me </label>
                  </div>
                  @if (Route::has('password.request'))
                  <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                  Forgot your password?
                  </a>
                  @endif
                </div>
                <div class="intro-x mt-5 flex justify-end text-center xl:mt-8 xl:text-left">
                <button data-tw-merge class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white px-4 py-3 xl:w-32">Login</button>
             
             
              </div>
              </form>
              <x-jet-validation-errors class="mt-4" />
              <p class="font-normal text-xs text-gray-700  mt-4 flex">

                <svg class="h-8 w-8 mr-2 -mt-2" data-slot="icon" fill="none" stroke-width="1.5" stroke="#FFD700" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"></path>
                </svg>

                All activities are monitored. Unauthorized access is prohibited.
                </p>

            </div>
          </div>
          <!-- END: Login Form -->
        </div>
      </div>
    </div>
    <!-- BEGIN: Vendor JS Assets-->



<script>
  window.addEventListener('load', () => {
    const assets = [
      { rel: 'modulepreload', href: "{{ asset('assets/js/js1.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js1.js') }}", track: "reload" },
      { rel: 'modulepreload', href: "{{ asset('assets/js/js2.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js2.js') }}", track: "reload" },
      { rel: 'modulepreload', href: "{{ asset('assets/js/js3.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js3.js') }}", track: "reload" },
      { rel: 'modulepreload', href: "{{ asset('assets/js/js4.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js4.js') }}", track: "reload" },
      { rel: 'modulepreload', href: "{{ asset('assets/js/js5.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js5.js') }}", track: "reload" },
      { rel: 'modulepreload', href: "{{ asset('assets/js/js6.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js6.js') }}", track: "reload" },
    ];

    const makeElement = (asset) => {
      const element = document.createElement(asset.type === 'module' ? 'script' : 'link');
      if (asset.type === 'module') {
        element.type = 'module';
        element.src = asset.src;
        if (asset.track) element.setAttribute('data-navigate-track', asset.track);
      } else {
        element.rel = asset.rel;
        element.href = asset.href;
      }
      return element;
    };

    const loadAssets = (assets, batchSize = 3) => {
      if (!assets.length) return;

      const fragment = document.createDocumentFragment();
      for (let i = 0; i < batchSize && assets.length; i++) {
        const asset = makeElement(assets.shift());
        if (assets.length) {
          asset.onload = () => loadAssets(assets, 1);
          asset.onerror = () => loadAssets(assets, 1);
        }
        fragment.appendChild(asset);
      }
      document.head.appendChild(fragment);
    };

    setTimeout(() => loadAssets(assets), 0);
  });
</script>


          <script>
        function myFunction() {
            const myDiv = document.getElementById("actionBtn");
            myDiv.classList.add("hidden");

            const myDiv2 = document.getElementById("waitBtn");
            myDiv2.classList.remove("hidden");
        }
    </script>

  </body>



</html>
