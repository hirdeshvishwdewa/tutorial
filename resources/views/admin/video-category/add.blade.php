@extends('layouts.admin.app')

@section('content')
<!-- Main content -->
<section class="content">
	<!-- Info boxes -->
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">{{ $pageInfo['smallHeading'] }}</h3>
				</div>
				<!-- /.box-header -->
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<form action="{{ route('video-category-create') }}" method="POST" enctype="multipart/form-data" novalidate="">
							@csrf
							<div class="box-body">
								<p class="text-red pull-right">Fields marked with <b>*</b> are mendatory</p><br>
								<div class="form-group">
									<label for="categoryName">
										{{ __('admin.video_category.category_name') }}
										<sup class="text-red">*</sup>
									</label>
									<input type="text" class="form-control" id="categoryName" name="category_name" maxlength="256" minlength="3" placeholder="{{ __('admin.video_category.category_name_placeholdor') }}" value="{{ old('category_name') ?? '' }}" autofocus="true">
									<p class="error-message text-red">
										@if($errors->has('category_name'))
											{{ $errors->first('category_name') }}
										@endif
									</p>
								</div>

								<div class="form-group">
									<label for="parent_id">{{ __('admin.video_category.parent') }}</label>
									<select class="form-control form-select" id="parent_id" name="parent_id">
										<option value="" {{ old('parent_id') === '' ? 'selected' : '' }}>{{ __('admin.video_category.select_parent') }}</option>
										@if(count($videoCategories))
											@foreach($videoCategories as $category)
												<option value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
											@endforeach
										@endif
									</select>
									@if($errors->has('parent_id'))
										{{ $errors->first('parent_id') }}
									@endif
								</div>

								<div class="form-group">
									<label for="status">{{ __('admin.video_category.category_status') }}</label>
									<select class="form-control form-select" id="status" name="status">
										<option value="" {{ old('status') === '' ? 'selected' : '' }}>{{ __('admin.video_category.category_select_status') }}</option>
										<option value="1" {{ old('status') === 1 ? 'selected' : '' }}>{{ __('admin.video_category.category_status_enable') }}</option>
										<option value="0" {{ old('status') === 0 ? 'selected' : '' }}>{{ __('admin.video_category.category_status_disable') }}</option>
									</select>
									@if($errors->has('status'))
										{{ $errors->first('status') }}
									@endif
								</div>

								<div class="form-group">
									<label for="status">{{ __('admin.video_category.category_image') }}</label><br>
									<input type="file" name="image" class="form-control form-file">
								</div>

								<div class="form-group">
									<input type="submit" class="btn btn-primary pull-right" name="submit" value="Add">
									<a href="{{ route('video-category-list') }}" class="btn btn-warning pull-right mr-10">Cancle</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection