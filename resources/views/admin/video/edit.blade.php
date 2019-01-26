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
						<form action="{{ route('video-update') }}" method="POST" novalidate="">
							@csrf
							<div class="box-body">
								<p class="text-red pull-right">Fields marked with <b>*</b> are mendatory</p><br>
								<div class="form-group">
									<label for="title">
										{{ __('admin.video.title') }}
										<sup class="text-red">*</sup>
									</label>
									<input type="text" class="form-control" id="title" name="title" maxlength="256" minlength="3" placeholder="{{ __('admin.video.title_placeholdor') }}" value="{{ old('title') ?? $video->title ?? '' }}" autofocus="true">
									<p class="error-message text-red">
										@if($errors->has('title'))
											{{ $errors->first('title') }}
										@endif
									</p>
								</div>
								<div class="form-group">
									<label for="description">
										{{ __('admin.video.description') }}
									</label>
									<textarea type="text" class="form-control" id="description" name="description" rows="6"placeholder="{{ __('admin.video.description_placeholdor') }}" autofocus="true">{{ old('description') ?? $video->description ?? '' }}</textarea>
									<p class="error-message text-red">
										@if($errors->has('description'))
											{{ $errors->first('description') }}
										@endif
									</p>
								</div>
								<div class="form-group">
									<label for="embedURL">
										{{ __('admin.video.embed_url') }}
										<sup class="text-red">*</sup>
									</label>
									<input type="text" class="form-control" id="embedURL" name="embed_url" maxlength="256" minlength="3" placeholder="{{ __('admin.video.embed_url_placeholdor') }}" value="{{ old('embed_url') ?? $video->embed_url ?? '' }}" autofocus="true">
									<p class="error-message text-red">
										@if($errors->has('embed_url'))
											{{ $errors->first('embed_url') }}
										@endif
									</p>
								</div>

								<div class="form-group">
									<label for="category_id">{{ __('admin.video.category') }}</label>
									<select class="form-control form-select" id="category_id" name="category_id">
										<option value="" {{ old('category_id') === '' ? 'selected' : '' }}>{{ __('admin.video.select_category') }}</option>
										@if(count($videoCategories))
											@foreach($videoCategories as $category)
												<option value="{{ $category->id }}" {{ ( old('category_id') ?? $video->category_id ?? '' ) == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
											@endforeach
										@endif
									</select>
									@if($errors->has('category_id'))
										{{ $errors->first('category_id') }}
									@endif
								</div>

								<div class="form-group">
									<label for="status">{{ __('admin.video.status') }}</label>
									<select class="form-control form-select" id="status" name="status">
										<option value="" {{ ( old('status') ?? $video->status ?? '') === '' ? 'selected' : '' }}>{{ __('admin.video.select_status') }}</option>
										
										<option value="1" {{ ( old('status') ?? $video->status ?? '') === 1 ? 'selected' : '' }}>{{ __('admin.video.status_enable') }}</option>
										
										<option value="0" {{ ( old('status') ?? $video->status ?? '') === 0 ? 'selected' : '' }}>{{ __('admin.video.status_disable') }}</option>
									</select>
									@if($errors->has('status'))
										{{ $errors->first('status') }}
									@endif
								</div>
								<div class="form-group">
									<input type="submit" class="btn btn-primary pull-right" name="submit" value="Update">
									<a href="{{ route('video-list') }}" class="btn btn-warning pull-right mr-10">Cancle</a>
									<input type="hidden" value="{{ $video->id }}" name="id">
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