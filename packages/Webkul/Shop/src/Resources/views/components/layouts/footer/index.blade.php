{!! view_render_event('bagisto.shop.layout.footer.before') !!}

<!--
    The category repository is injected directly here because there is no way
    to retrieve it from the view composer, as this is an anonymous component.
-->
@inject('themeCustomizationRepository', 'Webkul\Theme\Repositories\ThemeCustomizationRepository')

<!--
    This code needs to be refactored to reduce the amount of PHP in the Blade
    template as much as possible.
-->
@php
$channel = core()->getCurrentChannel();

$customization = $themeCustomizationRepository->findOneWhere([
'type' => 'footer_links',
'status' => 1,
'theme_code' => $channel->theme,
'channel_id' => $channel->id,
]);
@endphp

<footer class="bg-dark text-light pt-5 pb-4">
  <div class="container">
    <div class="row text-left">
      <!-- Dynamic Footer Sections -->
      @if ($customization?->options)
      @foreach ($customization->options as $footerLinkSection)
      <div class="col-md-3 mb-4">
        <ul class="list-unstyled text-muted">
          @php
          usort($footerLinkSection, fn ($a, $b) => $a['sort_order'] - $b['sort_order']);
          @endphp

          @foreach ($footerLinkSection as $link)
          <li>
            <a href="{{ $link['url'] }}" class="text-light text-decoration-none">
              {{ $link['title'] }}
            </a>
          </li>
          @endforeach
        </ul>
      </div>
      @endforeach
      @endif
    </div>

    <!-- Logo and Description -->
    <div class="text-center mt-4 mb-3">
      <h2><span class="text-danger">THE</span> <strong>Big Store</strong></h2>
      <p class="small text-uppercase text-muted">@lang('shop::app.components.layouts.footer.store-tagline')</p>
      <p class="text-muted">@lang('shop::app.components.layouts.footer.store-description-1')</p>
      <p class="text-muted">@lang('shop::app.components.layouts.footer.store-description-2')</p>
    </div>

    <!-- Social Icons -->
    <div class="text-center mb-4">
      <a href="#" class="text-light me-3"><i class="fab fa-facebook-f fa-lg"></i></a>
      <a href="#" class="text-light me-3"><i class="fab fa-twitter fa-lg"></i></a>
      <a href="#" class="text-light me-3"><i class="fab fa-pinterest-p fa-lg"></i></a>
      <a href="#" class="text-light"><i class="fab fa-dribbble fa-lg"></i></a>
    </div>

    <!-- Contact Info -->
    <div class="row text-center text-muted mb-3">
      <div class="col-md-4 mb-2">
        <i class="fas fa-home me-2"></i>@lang('shop::app.components.layouts.footer.contact-address')
      </div>
      <div class="col-md-4 mb-2">
        <i class="fas fa-phone me-2"></i>@lang('shop::app.components.layouts.footer.contact-phone')
      </div>
      <div class="col-md-4 mb-2">
        <i class="fas fa-envelope me-2"></i>@lang('shop::app.components.layouts.footer.contact-email')
      </div>
    </div>

    <!-- Footer Bottom -->
    <div class="text-center text-muted small">
      &copy; {{ date('Y') }} Big Store. @lang('shop::app.components.layouts.footer.rights')
      | @lang('shop::app.components.layouts.footer.design-by')
      <a href="https://w3layouts.com/" class="text-light text-decoration-none">W3layouts</a>
    </div>
  </div>
</footer>

<!-- Add Bootstrap and FontAwesome -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>


{!! view_render_event('bagisto.shop.layout.footer.after') !!}