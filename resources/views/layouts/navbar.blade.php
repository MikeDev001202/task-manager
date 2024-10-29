<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  	<a class="navbar-brand" href="#">
  		<div class="nav-logo">
		    <span class="letter">T</span>
		    <span class="letter">M</span>
		</div>
  	</a>
  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    	<span class="navbar-toggler-icon"></span>
  	</button>
  	<div class="collapse navbar-collapse" id="navbarNav">
  		<div class="ml-auto">
  			<ul class="navbar-nav">
	      		<li class="nav-item">
	        		<a class="nav-link" href="#">{{ Auth::user()->name }} {{ Auth::user()->surname }} Signed In</a>
	      		</li>
	      		<li class="nav-item">
				    <form action="{{ route('logoutUser') }}" method="POST" style="display: inline;">
				        @csrf
				        <button type="submit" class="nav-link" style="border: none; background: none; cursor: pointer;">Logout</button>
				    </form>
				</li>
	    	</ul>
  		</div>
  	</div>
</nav>