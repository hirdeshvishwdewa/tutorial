<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ $pageInfo['topHeading'] }}
    </h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol> -->
    @php ($status = session('alert-success') ?? session('alert-warning') ?? session('alert-info') ?? session('alert-danger') ?? false)

    @if(session('alert-success'))
	    <div class="alert alert-success fade in alert-dismissible mt-20">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
		    {{ session('alert-success') }}
		</div>
	@elseif(session('alert-warning'))
		<div class="alert alert-warning fade in alert-dismissible mt-20">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
		    {{ session('alert-warning') }}
		</div>
	@elseif(session('alert-info'))
		<div class="alert alert-info fade in alert-dismissible mt-20">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
		    {{ session('alert-info') }}
		</div>
	@elseif(session('alert-danger'))
		<div class="alert alert-danger fade in alert-dismissible mt-20">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
		    {{ session('alert-danger') }}
		</div>
	@endif
</section>