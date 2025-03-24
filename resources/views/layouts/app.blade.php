<!DOCTYPE html>

<html class="opacity-0" lang="en">
  <!-- BEGIN: Head -->
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="ZimaLtd">
    <title>Umoja - Ticketing System</title>

    <livewire:styles />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preload" as="style" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" data-navigate-track="reload" />

    <link rel="preload" as="style" href="{{ asset('assets/css/main2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main2.css') }}" data-navigate-track="reload" />

    <link rel="preload" as="style" href="{{ asset('assets/css/main3.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main3.css') }}" data-navigate-track="reload" />

    <link rel="preload" as="style" href="{{ asset('assets/css/main4.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main4.css') }}" data-navigate-track="reload" />

    <link rel="preload" as="style" href="{{ asset('assets/css/main5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main5.css') }}" data-navigate-track="reload" />

    <link rel="preload" as="style" href="{{ asset('assets/css/main6.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main6.css') }}" data-navigate-track="reload" />


    <link rel="preload" as="style" href="{{ asset('assets/css/main7.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main7.css') }}" data-navigate-track="reload" />

      <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
  <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>


  </head>
  <!-- END: Head -->
  <body>

    <div class="rubick px-5 sm:px-8 py-5 before:content-[''] before:bg-gradient-to-b before:from-theme-1 before:to-theme-2 before:fixed before:inset-0 before:z-[-1]">

      <div class="mt-[4.7rem] flex md:mt-0">
        <!-- BEGIN: Side Menu -->
      <livewire:sidebar.sidebar />
      <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        {{ $slot }}
   <!-- END: Content -->
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

    { rel: 'modulepreload', href: "{{ asset('assets/js/js7.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js7.js') }}", track: "reload" },
    { rel: 'modulepreload', href: "{{ asset('assets/js/8.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js8.js') }}", track: "reload" },
    { rel: 'modulepreload', href: "{{ asset('assets/js/js9.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js9.js') }}", track: "reload" },
    { rel: 'modulepreload', href: "{{ asset('assets/js/js10.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js10.js') }}", track: "reload" },
    { rel: 'modulepreload', href: "{{ asset('assets/js/js11.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js11.js') }}", track: "reload" },
    { rel: 'modulepreload', href: "{{ asset('assets/js/js12.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js12.js') }}", track: "reload" },
    { rel: 'modulepreload', href: "{{ asset('assets/js/js13.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js13.js') }}", track: "reload" },
    { rel: 'modulepreload', href: "{{ asset('assets/js/js14.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js14.js') }}", track: "reload" },
    { rel: 'modulepreload', href: "{{ asset('assets/js/js15.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js15.js') }}", track: "reload" },
    { rel: 'modulepreload', href: "{{ asset('assets/js/js16.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js16.js') }}", track: "reload" },
    { rel: 'modulepreload', href: "{{ asset('assets/js/js17.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js17.js') }}", track: "reload" },
    { rel: 'modulepreload', href: "{{ asset('assets/js/js18.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js18.js') }}", track: "reload" },
    { rel: 'modulepreload', href: "{{ asset('assets/js/js19.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js19.js') }}", track: "reload" },
    { rel: 'modulepreload', href: "{{ asset('assets/js/js20.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js20.js') }}", track: "reload" },
    { rel: 'modulepreload', href: "{{ asset('assets/js/js21.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js21.js') }}", track: "reload" },
    { rel: 'modulepreload', href: "{{ asset('assets/js/js22.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js22.js') }}", track: "reload" },
    { rel: 'modulepreload', href: "{{ asset('assets/js/js23.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js23.js') }}", track: "reload" },
    { rel: 'modulepreload', href: "{{ asset('assets/js/js24.js') }}" },
      { type: 'module', src: "{{ asset('assets/js/js24.js') }}", track: "reload" },
    {{--{ rel: 'modulepreload', href: "{{ asset('assets/js/js25.js') }}" },--}}
    {{--  { type: 'module', src: "{{ asset('assets/js/js25.js') }}", track: "reload" },--}}
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
<livewire:scripts />




  </body>
</html>
