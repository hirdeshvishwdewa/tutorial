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
					<a href="{{ route('video-add') }}" class="btn btn-primary pull-right">Add</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="width: 40px">{{__('admin.video.sno')}}</th>
							<th>{{__('admin.video.title')}}</th>
							<th>{{__('admin.video.category')}}</th>
							<th>{{__('admin.video.description')}}</th>
							<th style="width: 150px">{{ __('admin.video.actions') }}</th>
						</tr>
					</thead>
					<tbody>
						@if(count($videos))
							@foreach($videos as $key=>$video)
							<tr>
								<td>{{ $key+1 }}</td>
								<td>{{ $video->title ?? 'N.A' }}</td>
								<td><span class="badge bg-yellow">{{ $video->category->category_name ?? 'N.A' }}</span></td>
								<td>{{ $video->shortDescription($video->description) ?? 'N.A' }}</td>
								<td>
									<a href="javascript:void(0);" data-status="{{ $video->id }}" class="status-toggle" title="{{ __('admin.video.title_status') }}">
										<i class="fa {{ $video->status == 1 ? 'fa-toggle-on' : 'fa-toggle-off'}}"></i>
									</a>
									&nbsp;
									<a href="{{ route('video-edit', $video->id) }}"  title="{{ __('admin.video.title_edit') }}">
										<i class="fa fa-pencil"></i>
									</a>
									&nbsp;
									<a href="javascript:void(0);" class="delete" data-delete="{{ $video->id }}" title="{{ __('admin.video.title_delete') }}">
										<i class="fa fa-trash"></i>
									</a>

								</td>
							</tr>
							@endforeach
						@else
							<tr>
								<td colspan="5" style="text-align: center;">
									Empty List
								</td>
							</tr>
						@endif
					</tbody>
				</table>
				</div>
				<!-- /.box-body -->
				<div class="box-footer clearfix">
					<div class="aligned-center">
						{{ $videos->links() }}
					</div>
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
	$(document).ready(function(){
		$(this).on('click','.delete', function(){
			var id = $(this).attr('data-delete');
			if(confirm("{{__('admin.video.sure_to_delete')}}")){
				$("body").append(
					`<form method="post" id="form-delete" action="{{ route('video-delete') }}">
						@csrf
						<input type='hidden' name="id" value="`+id+`">
					</form>
					`
				);
				$("#form-delete").submit();
			}
		});
		$(this).on('click','.status-toggle', function(){
			var id = $(this).attr('data-status');
			if(confirm("{{__('admin.video.sure_to_toggel_status')}}")){
				$("body").append(
					`<form method="post" id="form-status" action="{{ route('video-toggle-status') }}">
						@csrf
						<input type='hidden' name="id" value="`+id+`">
					</form>
					`
				);
				$("#form-status").submit();
			}
		});

	});
</script>
@endsection