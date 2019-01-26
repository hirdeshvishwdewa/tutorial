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
						<form action="{{ route('coupon-update') }}" method="POST" novalidate="">
							@csrf
							<div class="box-body">
								<p class="text-red pull-right">Fields marked with <b>*</b> are mendatory</p><br>
								<div class="form-group">
									<label for="title">
										{{ __('admin.coupon.title') }}
										<sup class="text-red">*</sup>
									</label>
									<input type="text" class="form-control" id="title" name="title" maxlength="256" minlength="3" placeholder="{{ __('admin.coupon.title_placeholdor') }}" value="{{ old('title') ?? $coupon->title ?? '' }}" autofocus="true">
									<p class="error-message text-red">
										@if($errors->has('title'))
											{{ $errors->first('title') }}
										@endif
									</p>
								</div>
								<div class="form-group">
									<label for="description">
										{{ __('admin.coupon.description') }}
									</label>
									<textarea type="text" class="form-control" id="description" name="description" rows="6"placeholder="{{ __('admin.coupon.description_placeholdor') }}" >{{ old('description') ?? $coupon->description ?? '' }}</textarea>
									<p class="error-message text-red">
										@if($errors->has('description'))
											{{ $errors->first('description') }}
										@endif
									</p>
								</div>
								<div class="form-group">
									<label for="code">
										{{ __('admin.coupon.code') }}
										<sup class="text-red">*</sup>
									</label>
									<input type="text" class="form-control" id="code" name="code" maxlength="256" minlength="3" placeholder="{{ __('admin.coupon.code_placeholdor') }}" value="{{ old('code') ?? $coupon->code ?? '' }}" >
									<p class="error-message text-red">
										@if($errors->has('code'))
											{{ $errors->first('code') }}
										@endif
									</p>
								</div>

								<div class="form-group">
									<label for="percentage">
										{{ __('admin.coupon.percentage') }}
									</label>
									<input type="number" class="form-control" id="percentage" name="percentage" maxlength="10" minlength="4" placeholder="{{ __('admin.coupon.percentage_placeholdor') }}" value="{{ old('percentage') ?? $coupon->percentage ?? '' }}"  max="100" min="1" maxlength="3" minlength="1">
									<p class="error-message text-red">
										@if($errors->has('percentage'))
											{{ $errors->first('percentage') }}
										@endif
									</p>
								</div>

								<div class="form-group">
									<label for="status">{{ __('admin.coupon.status') }}</label>
									<select class="form-control form-select" id="status" name="status">
										<option value="" {{ ( old('status') ?? $coupon->status ?? '') === '' ? 'selected' : '' }}>{{ __('admin.coupon.select_status') }}</option>
										
										<option value="1" {{ ( old('status') ?? $coupon->status ?? '') === 1 ? 'selected' : '' }}>{{ __('admin.coupon.status_enable') }}</option>
										
										<option value="0" {{ ( old('status') ?? $coupon->status ?? '') === 0 ? 'selected' : '' }}>{{ __('admin.coupon.status_disable') }}</option>
									</select>
									@if($errors->has('status'))
										{{ $errors->first('status') }}
									@endif
								</div>
								<div class="form-group">
									<input type="submit" class="btn btn-primary pull-right" name="submit" value="Update">
									<a href="{{ route('coupon-list') }}" class="btn btn-warning pull-right mr-10">Cancle</a>
									<input type="hidden" value="{{ $coupon->id }}" name="id">
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