<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Brandon Huynh">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="@yield('description')">
    <meta property="og:url"           content="{{url()->current()}}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="@yield('title')" />
    <meta property="og:description"   content="@yield('description')" />
    <meta property="og:image"         content="{{asset('image/logo_beta.png?1')}}" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>@yield('title')</title>

    @if($page === 'index')
        <link rel="canonical" href="https://www.finalfees.com/">
    @else
        <link rel="canonical" href="https://www.finalfees.com/{{$page}}">
    @endif

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('image/favicon.png') }}" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css?'.time().'') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/general.css?'.time().'') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/popup.css?'.time().'') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/platform.css?'.time().'') }}">

    @if(isset($page))
        <link rel="stylesheet" type="text/css" href="{{ asset('css/'.$page.'.css?'.time().'') }}">
    @endif
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>
    @yield('others')
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123725715-2"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-123725715-2');
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    <!-- Start of HubSpot Embed Code -->
  <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/7787599.js"></script>
<!-- End of HubSpot Embed Code -->
</head>
<body>
    @include('inc.header')
    @include('inc.nav')
    <main>
        @if (Session::has('success'))
        <div class="alert alert-dismissible">
            <button type="button" id="close_alert" class="close">&times;</button>
            <div class="alert-message">Thank you for refering! Winners will be announced soon.</div>
         </div>
        @endif

        @yield('content')
        @include('pg_widget.add_sheet')
        @include('pg_widget.request_modal')
        @include('pg_widget.premium')
        
    </main>
    @include('inc.footer')
    <script type="text/javascript" src="{{ asset('js/countUp.js?'.time().'') }}"></script>
    <script type="text/javascript" src="{{ asset('js/general.js?'.time().'') }}"></script>
    @if(isset($page))
        <script type="text/javascript" src="{{ asset('js/'.$page.'.js?'.time().'') }}"></script>
    @endif
    <script type="text/javascript" src="{{ asset('js/graph.js?'.time().'') }}"></script>
    <script type="text/javascript" src="{{ asset('js/ajax.js?'.time().'') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

<script type="text/javascript">

    @if(isset($json["fees"]))

        var fees = @json($json['fees']);
    
    @endif

</script>