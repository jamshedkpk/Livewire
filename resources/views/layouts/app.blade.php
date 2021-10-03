<!--Adding Header-->
@include('layouts.partials.header')
  <!-- Adding of Navbar -->
@include('layouts.partials.navbar')
  <!-- Adding of sidebar-->
@include('layouts.partials.sidebar')
  <div class="content-wrapper">
  {{ $slot }}
  </div>
@include('layouts.partials.footer')