@props([
'hasHeader' => true,
'hasFeature' => true,
'hasFooter' => true,
])

<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">

<head>

  {!! view_render_event('bagisto.shop.layout.head.before') !!}

  <title>{{ $title ?? '' }}</title>

  <meta charset="UTF-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="content-language" content="{{ app()->getLocale() }}">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="base-url" content="{{ url()->to('/') }}">
  <meta name="currency" content="{{ core()->getCurrentCurrency()->toJson() }}">

  @stack('meta')

  <link rel="icon" sizes="16x16"
    href="{{ core()->getCurrentChannel()->favicon_url ?? bagisto_asset('images/favicon.ico') }}" />

  @bagistoVite(['src/Resources/assets/css/app.css', 'src/Resources/assets/js/app.js'])

  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
    as="style">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap">

  <link rel="preload" href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" as="style">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap">

  @stack('styles')

  <style>
  {
     ! ! core()->getConfigData('general.content.custom_scripts.custom_css') ! !
  }
  </style>

  {!! view_render_event('bagisto.shop.layout.head.after') !!}

</head>

<body>
  {!! view_render_event('bagisto.shop.layout.body.before') !!}

  <a href="#main" class="skip-to-main-content-link">
    Skip to main content
  </a>

  <div id="app">
    <!-- Flash Message Blade Component -->
    <x-shop::flash-group />

    <!-- Confirm Modal Blade Component -->
    <x-shop::modal.confirm />







    <div class="flex flex-col gap-5 items-center justufy-between pt-5">

      {{-- icon --}}
      {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.logo.before') !!}

      <a href="{{ route('shop.home.index') }}" aria-label="@lang('shop::app.components.layouts.header.bagisto')">
        <img src="{{ core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg') }}" width="131"
          height="29" alt="{{ config('app.name') }}">
      </a>
      {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.logo.after') !!}




      <div class="flex items-center gap-5">

        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.compare.before') !!}

        <!-- Compare -->
        @if(core()->getConfigData('catalog.products.settings.compare_option'))
        <a href="{{ route('shop.compare.index') }}" aria-label="@lang('shop::app.components.layouts.header.compare')">
          <span class="icon-compare inline-block cursor-pointer text-2xl" role="presentation"></span>
        </a>
        @endif

        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.compare.after') !!}

        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.mini_cart.before') !!}

        <!-- Mini cart -->
        @if(core()->getConfigData('sales.checkout.shopping_cart.cart_page'))
        @include('shop::checkout.cart.mini-cart')
        @endif

        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.mini_cart.after') !!}
      </div>
    </div>










    <!-- Page Header Blade Component -->
    @if ($hasHeader)
    <x-shop::layouts.header />
    @endif

    {!! view_render_event('bagisto.shop.layout.content.before') !!}

    <!-- Page Content Blade Component -->
    <main id="main" class="bg-white">
      {{ $slot }}
    </main>

    {!! view_render_event('bagisto.shop.layout.content.after') !!}


    <!-- Page Services Blade Component -->
    @if ($hasFeature)
    <x-shop::layouts.services />
    @endif

    <!-- Page Footer Blade Component -->
    @if ($hasFooter)
    <x-shop::layouts.footer />
    @endif
  </div>

  {!! view_render_event('bagisto.shop.layout.body.after') !!}

  @stack('scripts')

  {!! view_render_event('bagisto.shop.layout.vue-app-mount.before') !!}
  <script>
  /**
   * Load event, the purpose of using the event is to mount the application
   * after all of our `Vue` components which is present in blade file have
   * been registered in the app. No matter what `app.mount()` should be
   * called in the last.
   */
  window.addEventListener("load", function(event) {
    app.mount("#app");
  });
  </script>

  {!! view_render_event('bagisto.shop.layout.vue-app-mount.after') !!}

  <script type="text/javascript">
  {
    !!core() - > getConfigData('general.content.custom_scripts.custom_javascript') !!
  }
  </script>
</body>

</html>