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
					<a href="{{ route('video-category-add') }}" class="btn btn-primary pull-right">Add</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				<table class="table table-bordered">
					<thead>
						<tr class="row">
							<th class="col-sm-1 col-md-1 col-lg-1">{{__('admin.video_category.sno')}}</th>
							<th class="col-sm-1 col-md-1 col-lg-1">{{__('admin.video_category.featured')}}</th>
							<th class="col-sm-4 col-md-4 col-lg-4">{{__('admin.video_category.category_name')}}</th>
							<th class="col-sm-4 col-md-4 col-lg-4">{{__('admin.video_category.parent')}}</th>
							<th class="col-sm-2 col-md-2 col-lg-2">{{ __('admin.video_category.actions') }}</th>
						</tr>
					</thead>
					<tbody>
						@if(count($videoCategories))
							@foreach($videoCategories as $key=>$videoCategory)
							<tr class="row">
								<td class="col-sm-1 col-md-1 col-lg-1">{{ $key+1 }}</td>
								<td class="col-sm-1 col-md-1 col-lg-1">
									<a href="javascript:void(0);" data-featured="{{ $videoCategory->id }}" class="featured-toggle" title="{{ __('admin.video_category.title_featured') }}">
										<i class="fa {{ $videoCategory->featured == 1 ? 'fa-toggle-on' : 'fa-toggle-off'}}"></i>
									</a>
								</td>
								<td class="col-sm-4 col-md-5 col-lg-5">
									<img src="{{ $videoCategory->getSmallThumbURL() }}" class="img img-thumbnail">
									{{ $videoCategory->category_name ?? 'N.A' }}
								</td>
								<td class="col-sm-4 col-md-4 col-lg-4">{{ $videoCategory->parent->category_name ?? 'N.A' }}</td>
								<td class="col-sm-2 col-md-1 col-lg-1">
									<div class="row">
										<div class="col-sm-12 col-md-12 col-lg-4">
											<a href="javascript:void(0);" data-status="{{ $videoCategory->id }}" class="status-toggle aligned-center" title="{{ __('admin.video_category.title_status') }}">
												<i class="fa {{ $videoCategory->status == 1 ? 'fa-toggle-on' : 'fa-toggle-off'}}"></i>
											</a>
										</div>
										<div class="col-sm-12 col-md-12 col-lg-4">
											<a href="{{ route('video-category-edit', $videoCategory->id) }}" title="{{ __('admin.video_category.title_edit') }}" class="aligned-center">
												<i class="fa fa-pencil"></i>
											</a>
										</div>
										<div class="col-sm-12 col-md-12 col-lg-4">
											<a href="javascript:void(0);" class="delete aligned-center" data-delete="{{ $videoCategory->id }}" title="{{ __('admin.video_category.title_delete') }}">
												<i class="fa fa-trash"></i>
											</a>
										</div>
									</div>
								</td>
							</tr>
							@endforeach
						@else
							<tr class="row">
								<td class="col-sm-12 col-md-12 col-lg-12 col-xl-12" colspan="6" style="text-align: center;">
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
						{{ $videoCategories->links() }}
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
			if(confirm("{{__('admin.video_category.sure_to_delete')}}")){
				$("body").append(
					`<form method="post" id="form-delete" action="{{ route('video-category-delete') }}">
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
			if(confirm("{{__('admin.video_category.sure_to_toggel_status')}}")){
				$("body").append(
					`<form method="post" id="form-status" action="{{ route('video-category-toggle-status') }}">
						@csrf
						<input type='hidden' name="id" value="`+id+`">
					</form>
					`
				);
				$("#form-status").submit();
			}
		});
		
		$(this).on('click','.featured-toggle', function(){
			var id = $(this).attr('data-featured');
			if(confirm("{{__('admin.video_category.sure_to_toggel_featured')}}")){
				$("body").append(
					`<form method="post" id="form-featured" action="{{ route('video-category-toggle-featured') }}">
						@csrf
						<input type='hidden' name="id" value="`+id+`">
					</form>
					`
				);
				$("#form-featured").submit();
			}
		});

	});
</script>
@endsection