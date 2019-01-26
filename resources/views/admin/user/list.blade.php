@extends('layouts.admin.app')

@section('content')
<!-- Main content -->
<section class="content">
	<!-- Info boxes -->
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">{{ $pageInfo['smallHeading'] }}</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="width: 40px">{{__('admin.user.sno')}}</th>
							<th>{{__('admin.user.name')}}</th>
							<th>{{__('admin.user.email')}}</th>
							<th style="width: 150px">{{ __('admin.user.actions') }}</th>
						</tr>
					</thead>
					<tbody>
						@if($users)
							@foreach($users as $key=>$user)
							<tr>
								<td>{{ $key+1 }}</td>
								<td>{{ $user->name ?? 'N.A' }}</td>
								<td>{{ $user->email ?? 'N.A' }}</td>
								<td>
									<a href="javascript:void(0);" class="status-toggle" data-status="{{ $user->id }}">
										<i class="fa {{ $user->status == 1 ? 'fa-toggle-on' : 'fa-toggle-off'}}"></i>
									</a>
								</td>
							</tr>
							@endforeach
						@endif
					</tbody>
				</table>
				</div>
				<!-- /.box-body -->
				<div class="box-footer clearfix">
				
				</div>
			</div>
			<!-- /.box -->
		</div>
	</div>
	<!-- /.row -->
</section>
<!-- /.content -->
@endsection
@section('script')
<script type="text/javascript">
	$(this).on('click','.status-toggle', function(){
		var id = $(this).attr('data-status');
		if(confirm("{{__('admin.video_category.sure_to_toggel_status')}}")){
			$("body").append(
				`<form method="post" id="form-status" action="{{ route('user-toggle-status') }}">
					@csrf
					<input type='hidden' name="id" value="`+id+`">
				</form>
				`
			);
			$("#form-status").submit();
		}
	});
</script>
@endsection