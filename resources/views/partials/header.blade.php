<header class="site-header default-header-style style-one intro-element">

	<div class="header-top-area">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-12">
					
<div class="header-logo-area">
	<div class="container">
		<div class="row align-items-center justify-content-center">
			<div class="col-3 d-md-block d-lg-none pd-0">
				<a href="#" class="search-bar"><i class="fas fa-search"></i></a>
			</div>
			<div class="col-6">		
				<div class="site-branding text-center">
						<a href="https://www.vetro.co.za/">
							<!-- <img src="https://www.vetro.co.za/wp-content/uploads/2017/09/VetroMedia-WhiteLogo.png" width="430" height="100" alt="Vetro Blog" /> -->
							<img src="https://www.vetro.co.za/wp-content/uploads/2017/09/VetroMedia-BlackLogo.png" alt="Vetro Media" class="logo-dark" />
							<p class="site-slogan">multi disciplinary Agency</p>
						</a>
				</div><!-- /.site-branding -->
			</div>
			<div class="col-3 d-md-block d-lg-none pd-0">
				<div class="header-right-area">
					<div class="hamburger-menus">
						<span></span>
						<span></span>
						<span></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- /.header-logo-area --> 
				</div>
			</div>
		</div>
	</div><!-- /.header-top-area -->

	<div class="navigation-area">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 pd-0">
					<div class="site-navigation">
						<div class="navigation-area">
	<div class="site-navigation">
		<nav class="navigation">
			<div class="menu-wrapper">
				<div class="menu-content">
					<div class="mainmenu bg-white d-flex align-items-center">					
						    <ul class="nav">
    <li class="nav-home nav-current"><a href="{{ url('/') }}">Home</a></li>
    <li class="nav-tags"><a href="{{ url('home') }}">Blogs</a></li>
    <li class="nav-authors"><a href="#">Authors</a></li>
    <li class="nav-contact"><a href="#">Contact</a></li>


            @if (Auth::guest())
            <li>
              <a href="{{ url('/auth/login') }}">Login</a>
            </li>
            <li>
              <a href="{{ url('/auth/register') }}">Register</a>
            </li>
            @else
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="user-dropdown" role="button" aria-expanded="false">Welcome {{ Auth::user()->name }} <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                @if (Auth::user()->can_post())
                <li>
                  <a href="{{ url('/new-post') }}">Add new post</a>
                </li>
                <li>
                  <a href="{{ url('/user/'.Auth::id().'/posts') }}">My Posts</a>
                </li>
                @endif
                <li>
                  <a href="{{ url('/user/'.Auth::id()) }}">My Profile</a>
                </li>
                <li>
                  <a href="{{ url('/logout') }}">Logout</a>
                </li>
              </ul>
            </li>
            @endif


</li>
</ul>


						<a href="#" class="search-bar"><i class="fas fa-search"></i></a>
					</div>
				</div> <!-- /.hours-content-->
			</div><!-- /.menu-wrapper -->
		</nav>
	</div><!-- /.site-navigation -->
</div><!-- /.navigation-area -->

<div class="mobile-sidebar-menu sidebar-menu">
	<div class="overlaybg"></div>
</div>
<!--~~./ end site header ~~-->
<!--~~~ Sticky Header ~~~-->
<div id="sticky-header" class="active"></div>
<!--~./ end sticky header ~--> 
					</div><!-- /.site-navigation -->
				</div><!-- /.col-12 -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.navigation-area -->

	<div class="mobile-sidebar-menu sidebar-menu">
		<div class="overlaybg"></div>
	</div>
</header>