<nav class="navbar navbar-expand-md bg-light navbar-light sticky-top">
	<div class="container">
		
		<a class="navbar-brand" href="#">EMS</a>
		
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav ">
				<li class="nav-item">
					<a class="nav-link" href="#">Home</a>
				</li>
			</ul>
			<ul class="navbar-nav ml-auto">
				<div class="dropdown">
					<button class="btn btn-info dropdown-toggle" data-toggle="dropdown">
						Welcome <?php if(isset($_SESSION['username'])) echo $_SESSION['username']; else echo "User";?>
					</button>
					<div class="dropdown-menu">
						<a class="dropdown-item text-danger" style="cursor:pointer" id="logout-btn">Logout</a>
					</div>
				</div>
			</ul>
		</div
		>
	</div>
</nav>