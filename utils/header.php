<nav class="navbar navbar-expand-md bg-light navbar-light sticky-top">
	<div class="container">
		
		<?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == "ADMIN"): ?>
		<a class="navbar-brand" href="http://intimasia.co.in/ems/exhibitor">EMS</a>
		<?php elseif(isset($_SESSION['user_type']) && $_SESSION['user_type'] == "EXHIBITOR"): ?>
		<a class="navbar-brand" href="http://intimasia.co.in/ems/admin">EMS</a>
		<?php else :?>
		<a class="navbar-brand" href="http://intimasia.co.in/ems/">EMS</a>
		<?php endif ?>
		
		
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav ">
				<li class="nav-item">
					<?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == "EXHIBITOR"): ?>
					<a class="nav-link" href="http://intimasia.co.in/ems/exhibitor">Home</a>
					<?php elseif(isset($_SESSION['user_type']) && $_SESSION['user_type'] == "ADMIN"): ?>
					<a class="nav-link" href="http://intimasia.co.in/ems/admin">Home</a>
					<?php else :?>
					<a class="nav-link" href="http://intimasia.co.in/ems/">Home</a>
					<?php endif ?>
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