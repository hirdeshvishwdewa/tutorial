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
						<form action="{{ route('customer-update') }}" method="POST" novalidate="">
							@csrf
							<div class="box-body">
								<p class="text-red pull-right">Fields marked with <b>*</b> are mendatory</p><br>
								<div class="form-group">
									<label for="name">
										{{ __('admin.customer.name') }}
										<sup class="text-red">*</sup>
									</label>
									<input type="text" class="form-control" id="name" name="name" max="256" min="3" placeholder="{{ __('admin.customer.name_placeholder') }}" value="{{ old('name') ?? $customer->name ?? '' }}" autofocus="true">
									<p class="error-message text-red">
										@if($errors->has('name'))
											{{ $errors->first('name') }}
										@endif
									</p>
								</div>
								
								<div class="form-group">
									<label for="email">
										{{ __('admin.customer.email') }}
										<sup class="text-red">*</sup>
									</label>
									<input type="text" class="form-control" id="email" name="email" max="255" min="8" placeholder="{{ __('admin.customer.email_placeholder') }}" value="{{ old('email') ?? $customer->email ?? '' }}">
									<p class="error-message text-red">
										@if($errors->has('email'))
											{{ $errors->first('email') }}
										@endif
									</p>
								</div>

								<div class="form-group">
									<label for="password">
										{{ __('admin.customer.password') }}
										<sup class="text-red">*</sup>
									</label>
									<input type="password" class="form-control" id="password" name="password" max="16" min="8" placeholder="{{ __('admin.customer.password_placeholder') }}">
									<p class="error-message text-red">
										@if($errors->has('password'))
											{{ $errors->first('password') }}
										@endif
									</p>
								</div>
								
								<div class="form-group">
									<label for="password_confirmation">
										{{ __('admin.customer.password_confirmation') }}
										<sup class="text-red">*</sup>
									</label>
									<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" max="16" min="8" placeholder="{{ __('admin.customer.password_confirmation_placeholder') }}">
									<p class="error-message text-red">
										@if($errors->has('password_confirmation'))
											{{ $errors->first('password_confirmation') }}
										@endif
									</p>
								</div>
								
								<div class="form-group">
									<label for="phone">
										{{ __('admin.customer.phone') }}
										<sup class="text-red">*</sup>
									</label>
									<input type="text" class="form-control" id="phone" name="phone" max="10" min="10" placeholder="{{ __('admin.customer.phone_placeholder') }}" value="{{ old('phone') ?? $customer->phone ?? '' }}">
									<p class="error-message text-red">
										@if($errors->has('phone'))
											{{ $errors->first('phone') }}
										@endif
									</p>
								</div>

								<div class="form-group">
									<label for="gender">
										{{ __('admin.customer.gender') }}
										<sup class="text-red">*</sup>
									</label>
									<select class="form-control" id="gender" name="gender">
										<option value="">{{ __('admin.customer.gender_placeholder') }}</option>
										<option value="female" {{ (old('gender') ?? $customer->gender) == 'female' ? 'selected' : '' }}>Female</option>
										<option value="male" {{ (old('gender') ?? $customer->gender) == 'male' ? 'selected' : '' }}>Male</option>
										<option value="others" {{ (old('gender') ?? $customer->gender) == 'others' ? 'selected' : '' }}>Others</option>
									</select>
									<p class="error-message text-red">
										@if($errors->has('gender'))
											{{ $errors->first('gender') }}
										@endif
									</p>
								</div>

								<div class="form-group">
									<label for="class">
										{{ __('admin.customer.class') }}
									</label>
									<select class="form-control" id="class" name="class">
										<option value="">{{ __('admin.customer.class_placeholder') }}</option>
										@php($classes = $classList)
										@if(count($classes))
											@foreach($classes as $key=>$class)
												<option value="{{ $key }}" {{ (old('class') ?? $customer->class) == $key ? 'selected' : '' }}>{{ $class }}</option>
											@endforeach
										@endif
									</select>
									<p class="error-message text-red">
										@if($errors->has('class'))
											{{ $errors->first('class') }}
										@endif
									</p>
								</div>

								<div class="form-group">
									<label for="school">
										{{ __('admin.customer.school') }}
									</label>
									<input type="text" class="form-control" id="school" name="school" maxlength="256" minlength="3" placeholder="{{ __('admin.customer.school_placeholder') }}" value="{{ old('school') ?? $customer->school ?? '' }}">
									<p class="error-message text-red">
										@if($errors->has('school'))
											{{ $errors->first('school') }}
										@endif
									</p>
								</div>

								<div class="form-group">
									<label for="status">{{ __('admin.customer.status') }}</label>
									<select class="form-control form-select" id="status" name="status">
										<option value="" {{ (old('status') ?? $customer->status) === '' ? 'selected' : '' }}>{{ __('admin.customer.select_status') }}</option>
										<option value="1" {{ (old('status') ?? $customer->status) === 1 ? 'selected' : '' }}>{{ __('admin.customer.status_enable') }}</option>
										<option value="0" {{ (old('status') ?? $customer->status) === 0 ? 'selected' : '' }}>{{ __('admin.customer.status_disable') }}</option>
									</select>
									@if($errors->has('status'))
										{{ $errors->first('status') }}
									@endif
								</div>
								<div class="form-group">
									<input type="hidden" name="id" value="{{ $customer->id }}">
									<input type="submit" class="btn btn-primary pull-right" name="submit" value="Update">
									<a href="{{ route('customer-list') }}" class="btn btn-warning pull-right mr-10">Cancle</a>
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