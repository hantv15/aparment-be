@include('layouts.includes.head')
<div class="wrapper">
    @include('layouts.includes.header')
    @include('layouts.includes.sidebar')
    <main class="page-content">
        @yield('content')
    </main>
   @include('layouts.includes.component')
</div>
@include('layouts.includes.foot')

