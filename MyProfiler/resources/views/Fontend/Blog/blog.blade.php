<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MYFROFILE - Blog</title>
	<base href="{{env('APP_URL') }}">

	<!-- Meta Data -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <meta name="author" content="ArtTemplate">
    <meta name="description" content="vCard">

    <!-- Twitter data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@ArtTemplates">
    <meta name="twitter:title" content="vCard">
    <meta name="twitter:description" content="vCard">
    <meta name="twitter:image" content="Fontend/assets/images/social.jpg">

    <!-- Open Graph data -->
    <meta property="og:title" content="ArtTemplate">
    <meta property="og:type" content="website">
    <meta property="og:url" content="your url website">
    <meta property="og:image" content="Fontend/assets/images/social.jpg">
    <meta property="og:description" content="vCard">
    <meta property="og:site_name" content="vCard">

	<!-- Favicons -->
	<link rel="apple-touch-icon" sizes="144x144" href="Fontend/assets/images/favicons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="114x114" href="Fontend/assets/images/favicons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="72x72" href="Fontend/assets/images/favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="57x57" href="Fontend/assets/images/favicons/apple-touch-icon-57x57.png">
	<link rel="shortcut icon" href="Fontend/assets/images/favicons/favicon.png" type="image/png">

    <!-- Styles -->
	<link rel="stylesheet" type="text/css" href="Fontend/assets/styles/style.css">
	<link rel="stylesheet" type="text/css" href="Fontend/assets/styles/style-dark.css">
	<link rel="stylesheet" type="text/css" href="Fontend/assets/demo/style-demo.css">
	<link rel="stylesheet" type="text/css" href="Fontend/assets/css/login.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
	
</head>
<body>
    <!-- Preloader -->
    <div class="preloader">
	    <div class="preloader__wrap">
		    <div class="circle-pulse">
                <div class="circle-pulse__1"></div>
                <div class="circle-pulse__2"></div>
            </div>
		    <div class="preloader__progress"><span></span></div>
		</div>
	</div>

    <main class="main">
	    <!-- Header Image -->
		<div class="header-image">
			<img src="Fontend/assets/img/image_header.jpg" alt="Header Image">
		</div>
		
	    <div class="container gutter-top">
		    <!-- Header -->
			<header class="header box">
				<div class="header__left">
					<div class="header__photo">
						<img class="header__photo-img" 
							src="{{ $user->image ?? asset('default-avatar.jpg') }}" 
							alt="{{ $user->name }}">
					</div>
					<div class="header__base-info">
						<h4 class="title title--h4">{{ $user->name }}</h4>
						<div class="status">{{ $user->congviec ?? 'Chưa cập nhật' }}</div>
						@if($links->isNotEmpty())
							<ul class="header__social">
								@foreach ($links as $link)
									@if($link->url && $link->icon)
										<li><a href="{{ $link->url }}" target="_blank" rel="noopener">
											<i class="{{ $link->icon }}"></i>
										</a></li>
									@endif
								@endforeach
							</ul>
						@endif
					</div>
				</div>

				<div class="header__right">
					<ul class="header__contact">
						<li><span class="overhead">Email</span> {{ $user->email ?? 'Chưa cập nhật' }}</li>
						<li><span class="overhead">Phone</span> {{ $user->phone ?? 'Chưa cập nhật' }}</li>
					</ul>
					<ul class="header__contact">
						<li>
							<span class="overhead">Birthday</span> 
							{{ $user->birthday ?? 'Chưa cập nhật' }}
						</li>
						<li><span class="overhead">Address</span> {{ $user->address ?? 'Chưa cập nhật' }}</li>
					</ul>
				</div>
			</header>  
			<div class="row sticky-parent">
			    <!-- Sidebar nav -->
                <aside class="col-12 col-md-12 col-lg-2">
				    <div class="sidebar box sticky-column">
	                    <ul class="nav">
                            <li class="nav__item"><a href="{{route('showUser',['id' => $user->id])}}"><i class="icon-user"></i>Cá nhân</a></li>
							<li class="nav__item"><a href="{{route('resume.user',['id' => $user->id])}}"><i class="icon-file-text"></i>Tóm tắt</a></li>
                            <li class="nav__item"><a href="{{route('picture.index')}}"><i class="icon-codesandbox"></i> Kho ảnh</a></li>
                            <li class="nav__item"><a href="{{ route('blog.user', ['id' => $user->id]) }}" class="active"><i class="icon-book-open"></i>Blog</a></li>
                            <li class="nav__item"><a href="contact.html"><i class="icon-book"></i>Contact</a></li>
                        </ul>
					</div>
		        </aside>
				<!-- Content -->
		        <div class="col-12 col-md-12 col-lg-10">
				    <div class="box box-content">
					    <div class="pb-2">
		                    <h1 class="title title--h1 first-title title__separate">Blog</h1>
					    </div>

						<!-- News -->
						<div class="news-grid">
							<!-- Post -->
							@foreach ($posts as $post)
							<article class="news-item box">
								<div class="news-item__image-wrap overlay overlay--45">
								<div class="news-item__date">
									{{ $post->created_at->format('d') }}
									<span>{{ $post->created_at->format('M') }}</span>
									<small>{{ $post->created_at->format('Y') }}</small>  <!-- Thêm năm vào đây -->
								</div>
									<a class="news-item__link" href="{{ route('user.blog.show', ['userId' => $user->id, 'postId' => $post->id]) }}"></a>
								    <img class="cover lazyload" src="{{ $post->image ?? asset('images/default.png') }}" alt="">
								</div>
								<div class="news-item__caption">
								    <h2 class="title title--h4">{{ $post->title }}</h2>
									<p>{{ $post->summary }}</p>
								</div>
							</article>
							@endforeach
						</div>
					</div>
					
					<!-- Footer -->
					<footer class="footer">© 2020 vCard</footer>
		        </div>
			</div>
		</div>	
    </main>

    <div class="back-to-top"></div>
	
    <!-- SVG masks -->
    <svg class="svg-defs">
        <clippath id="avatar-box">
            <path d="M1.85379 38.4859C2.9221 18.6653 18.6653 2.92275 38.4858 1.85453 56.0986.905299 77.2792 0 94 0c16.721 0 37.901.905299 55.514 1.85453 19.821 1.06822 35.564 16.81077 36.632 36.63137C187.095 56.0922 188 77.267 188 94c0 16.733-.905 37.908-1.854 55.514-1.068 19.821-16.811 35.563-36.632 36.631C131.901 187.095 110.721 188 94 188c-16.7208 0-37.9014-.905-55.5142-1.855-19.8205-1.068-35.5637-16.81-36.63201-36.631C.904831 131.908 0 110.733 0 94c0-16.733.904831-37.9078 1.85379-55.5141z"></path>
        </clippath>
        <clippath id="avatar-hexagon">
             <path d="M0 27.2891c0-4.6662 2.4889-8.976 6.52491-11.2986L31.308 1.72845c3.98-2.290382 8.8697-2.305446 12.8637-.03963l25.234 14.31558C73.4807 18.3162 76 22.6478 76 27.3426V56.684c0 4.6805-2.5041 9.0013-6.5597 11.3186L44.4317 82.2915c-3.9869 2.278-8.8765 2.278-12.8634 0L6.55974 68.0026C2.50414 65.6853 0 61.3645 0 56.684V27.2891z"></path>
        </clippath>		
    </svg>
    
	<!-- Demo Menu -->
	<div class="btnSlideNav slideOpen"></div>
    <div class="btnSlideNav slideClose"></div>
    <div class="slideNav">
		<ul class="list-unstyled">
			<li class="slideNav__item rtl-mode"><h4 class="title title--5">More pages</h4> <a href="..\rtl-dark\about.html">RTL</a></li>
			<li class="slideNav__item"><a href="one-page.html">One page</a></li>
			<li class="slideNav__item"><a href="background-2.html">Background triangles</a></li>
			<li class="slideNav__item"><a href="works_v2.html">Works v2</a></li>
        </ul>
		<a href="{{route('auth.admin')}}" class="btn">Quản lý trang cá nhân</a>
	</div>
	<div class="overlay-slideNav"></div>
    <!-- Demo Menu -->
	
	<!-- JavaScripts -->
	<script src="Fontend/assets/js/jquery-3.4.1.min.js"></script>
	<script src="Fontend/assets/js/plugins.min.js"></script>
	<script src="Fontend/assets/js/common.js"></script>
	<script src="Fontend/assets/demo/plugins-demo.js"></script>
</body>
</html>