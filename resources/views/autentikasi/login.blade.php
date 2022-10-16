
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login | PT.Media Global Kencana</title>
		<meta charset="utf-8" />
		<meta name="description" content="PT.Media Global Kencana." />
		<meta name="keywords" content="PT.Media Global Kencana" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Login | PT.Media Global Kencana" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Keenthemes | Metronic" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="{{ asset('/assets/images/icon.png') }}" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<link href="{{ asset('/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-5FS8GGP');</script>
	</head>
	<body id="kt_body" class="app-blank">
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-theme-mode")) { themeMode = document.documentElement.getAttribute("data-theme-mode"); } else { if ( localStorage.getItem("data-theme") !== null ) { themeMode = localStorage.getItem("data-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-theme", themeMode); }</script>
		<noscript>
			<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0" style="display:none;visibility:hidden"></iframe>
		</noscript>
		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
					<div class="d-flex flex-center flex-column flex-lg-row-fluid">
						<div class="w-lg-500px p-10">
							<form class="form w-100" novalidate="novalidate" action="#" method="POST">
                                @csrf
								<div class="text-center mb-11">
                                    <img src="{{ asset('/assets/images/icon.png') }}" style="width: 100px; height: 100px; object-fit: contain" alt="">
									<h1 class="text-dark fw-bolder mb-3 mt-7">Sign In</h1>
									<div class="text-gray-500 fw-semibold fs-6">Sign in with the given account</div>
								</div>
								<div class="separator separator-content my-14">
									<span class="w-150px text-gray-500 fw-semibold fs-7">With Username</span>
								</div>
								<div class="fv-row mb-8">
									<input type="text" placeholder="Username" name="username" autocomplete="off" class="form-control bg-transparent" />
								</div>
								<div class="fv-row mb-3">
									<input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" />
								</div>
								<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
									<div></div>
									<a href="#" class="link-primary">Forgot Password ?</a>
								</div>
								<div class="d-grid mb-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</form>
						</div>
					</div>
					<div class="d-flex flex-center flex-wrap px-5">
						<div class="d-flex fw-semibold text-primary fs-base">
							<a href="#" class="px-5" target="_blank">Terms</a>
							<a href="#" class="px-5" target="_blank">Plans</a>
							<a href="#" class="px-5" target="_blank">Contact Us</a>
						</div>
					</div>
				</div>
				<div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url({{ asset('/assets/media/misc/auth-bg.png') }})">
					<div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
						<a href="#" class="mb-0 mb-lg-12">
							<img alt="Logo" src="{{ asset('/assets/media/logos/custom-1.png') }}" class="h-60px h-lg-75px" />
						</a>
						<img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="{{ asset('/assets/media/misc/auth-screens.png') }}" alt="" />
						<h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">Fast, Efficient and Productive</h1>
						<div class="d-none d-lg-block text-white fs-base text-center">In this kind of post,
						<a href="#" class="opacity-75-hover text-warning fw-bold me-1">the blogger</a>introduces a person they’ve interviewed
						<br />and provides some background information about
						<a href="#" class="opacity-75-hover text-warning fw-bold me-1">the interviewee</a>and their
						<br />work following this is a transcript of the interview.</div>
					</div>
				</div>
			</div>
		</div>
		<script src="{{ asset('/assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('/assets/js/scripts.bundle.js') }}"></script>
        <script src="{{ asset('/assets/js/custom.js') }}"></script>
        <script>
            $(document).ready(function () {
            });

            if("{{ session()->has('success') }}"){
                alertMessage(1, "{{ session('success') }}")
            }

            if("{{ session()->has('fail') }}"){
                alertMessage(0, "{{ session('fail') }}")
            }
        </script>
	</body>
</html>
