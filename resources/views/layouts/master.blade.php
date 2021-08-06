<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Gridlock</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<!-- <link rel="icon" href="{{asset('assets/img/icon.ico')}}" type="image/x-icon"/>
	 -->

	<!-- Fonts and icons -->
	
    
   @stack('script')

	<script src="{{asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>
	
  
	<script>
		WebFont.load({
			
			
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{asset('assets/css/fonts.min.css')}}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>


	<!-- CSS Files -->
	
	<link rel="stylesheet" href="{{asset('assets/css/google-fonts.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/atlantis.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
 

  
</head>
<body data-background-color="dark">

   <div class="wrapper">
	   @include('header')

	   @include('sidebar')
        
		
		<div class="main-panel">

		  @yield('content')
		
		</div>  
		

		
		 
		
    </div>

  <!--   Core JS Files   -->

  
   
	<script src="{{asset('assets/js/core/jquery.3.2.1.min.js')}}"></script>

    <script src="{{asset('assets/js/core/popper.min.js')}}"></script>

	<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
    


	<!-- Atlantis JS -->
	<script src="{{asset('assets/js/atlantis.min.js')}}"></script>


	<script>
		 

		$('.error').delay(2100).fadeOut('fast');

		$('#ext').delay(2100).fadeOut('fast');

		$('#id').delay(2100).fadeOut('fast');
		
	</script>
    
	
</body>


</html>
