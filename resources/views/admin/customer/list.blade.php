@extends('layouts.admin.app')

@section('content')
<!-- Main content -->
<section class="content">
	<!-- Info boxes -->
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<div class="row">
						<div class="col-sm-12 col-md-4 col-lg-5 col-xl-5">
							<h3 class="box-title">{{ $pageInfo['smallHeading'] }}</h3>
						</div>
						<form method="GET" action="" id="filter-form">
							<div class="col-sm-12 col-md-2 col-lg-2 col-xl-2">
								<select name="gender" class="form-control" id="gender-filter">
									<option value="">{{ __('admin.customer.gender_placeholder') }}</option>
									<option value="male" {{ (old('gender') ?? $gender) === 'male' ? 'selected':'' }}>Male</option>
									<option value="female" {{ (old('gender') ?? $gender) === 'female' ? 'selected':'' }}>Female</option>
									<option value="others" {{ (old('gender') ?? $gender) === 'others' ? 'selected':'' }}>Others</option>
								</select>
								<p class="error-message text-red">
									@if($errors->has('gender'))
										{{ $errors->first('gender') }}
									@endif
								</p>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-5 col-xl-5">
								<div class="row">
									<div class="col-sm-6 col-md-6 col-lg-7 col-xl-7">
										<input type="text" class="form-control" placeholder="{{ __('admin.customer.search_placeholder') }}" name="search" value="{{ $search ?? '' }}" autofocus="true">
										<p class="error-message text-red">
											@if($errors->has('search'))
												{{ $errors->first('search') }}
											@endif
										</p>
									</div>
									<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
										<input type="submit" class="btn btn-primary pull-right" value="search">
									</div>
									<div class="col-sm-2 col-md-2 col-lg-1 col-xl-1">
										<a href="{{ route('customer-list') }}" class="btn btn-default pull-right" title="{{ __('admin.customer.remove_filter') }}">x</a>
									</div>
									<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
										<a href="{{ route('customer-add') }}" class="btn btn-primary pull-right">Add</a>
									</div>
								</div>
							</div>
						</form>
						<!-- <div class="col-sm-12 col-md-1 col-lg-1 col-xl-1">
						</div> -->
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				<table class="table table-bordered">
					<thead>
						<tr class="row">
							<th class="col-md-1 col-lg-1">{{__('admin.customer.sno')}}</th>
							<th class="col-md-2 col-lg-2">{{__('admin.customer.name')}}</th>
							<th class="col-md-2 col-lg-2">{{__('admin.customer.email')}}</th>
							<th class="col-md-4 col-lg-1">{{__('admin.customer.phone')}}</th>
							<th class="col-md-1 col-lg-1">{{__('admin.customer.gender')}}</th>
							<th class="col-md-1 col-lg-1">{{__('admin.customer.class')}}</th>
							<th class="col-md-4 col-lg-3">{{__('admin.customer.school')}}</th>
							<th class="col-md-1 col-lg-1">{{ __('admin.customer.actions') }}</th>
						</tr>
					</thead>
					<tbody>
						@if(count($customers))
							@foreach($customers as $key=>$customer)
							<tr class="row">
								<td class="col-md-1 col-lg-1">{{ $key+1 }}</td>
								<td class="col-md-3 col-lg-3">{{ $customer->name 	?? 'Name N.A' }}</td>
								<td class="col-md-3 col-lg-3"><a href="mailto:{{ $customer->email ?? '' }}">{{ $customer->email ?? 'Email N.A' }}</a></td>
								<td class="col-md-1 col-lg-1"><a href="tel:{{ $customer->phone ?? '' }}">{{ $customer->phone ?? 'Phone N.A' }}</a></td>
								<td class="col-md-1 col-lg-1">
									<!-- <i class="fa fa-{{ isset($customer->gender) && $customer->gender == 'male' ? 'male' : 'female' }}"></i> --> 
									{{ $customer->getPrettyGender() ?? 'Gender N.A' }}</td>
								<td class="col-md-1 col-lg-1">{{ $classList[$customer->class] ?? 'Class N.A' }}</td>
								<td class="col-md-2 col-lg-2">{{ $customer->school?? 'School N.A' }}</td>
								<td class="col-md-1 col-lg-1">
									<a href="javascript:void(0);" data-status="{{ $customer->id }}" class="status-toggle" title="{{ __('admin.customer.title_status') }}">
										<i class="fa {{ $customer->status == 1 ? 'fa-toggle-on' : 'fa-toggle-off'}}"></i>
									</a>
									&nbsp;
									<a href="{{ route('customer-edit', $customer->id) }}"  title="{{ __('admin.customer.title_edit') }}">
										<i class="fa fa-pencil"></i>
									</a>
									&nbsp;
									<a href="javascript:void(0);" class="delete" data-delete="{{ $customer->id }}" title="{{ __('admin.customer.title_delete') }}">
										<i class="fa fa-trash"></i>
									</a>

								</td>
							</tr>
							@endforeach
						@else
							<tr>
								<td colspan="9" style="text-align: center;">
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
						{{ $customers->links() }}
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
			if(confirm("{{__('admin.customer.sure_to_delete')}}")){
				$("body").append(
					`<form method="post" id="form-delete" action="{{ route('customer-delete') }}">
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
			if(confirm("{{__('admin.customer.sure_to_toggel_status')}}")){
				$("body").append(
					`<form method="post" id="form-status" action="{{ route('customer-toggle-status') }}">
						@csrf
						<input type='hidden' name="id" value="`+id+`">
					</form>
					`
				);
				$("#form-status").submit();
			}
		});
		$(this).on('change', '#gender-filter', function(){
			$("#filter-form").submit();
		});
	});
</script>
@endsection