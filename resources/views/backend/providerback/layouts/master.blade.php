<!DOCTYPE html>
<html lang="en">

@include('backend.layouts.head')

<body id="page-top">

  {{-- <!-- Page Wrapper --> --}}
  <div id="wrapper">

  {{--   <!-- Sidebar --> --}}
    @include('backend.providerback.layouts.sidebar')
    {{-- <!-- End of Sidebar --> --}}

   {{--  <!-- Content Wrapper --> --}}
    <div id="content-wrapper" class="d-flex flex-column">

      {{-- <!-- Main Content --> --}}
      <div id="content">

      {{--   <!-- Topbar --> --}}
        @include('backend.providerback.layouts.header')
      {{--   <!-- End of Topbar --> --}}

       {{--  <!-- Begin Page Content --> --}}
        @yield('main-content')
     {{--   <!-- /.container-fluid --> --}}

      </div>
      {{-- <!-- End of Main Content --> --}}
      @include('backend.providerback.layouts.footer')

</body>

</html>
