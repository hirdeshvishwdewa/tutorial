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
					<a href="{{ route('coupon-add') }}" class="btn btn-primary pull-right">Add</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				<table class="table table-bordered">
					<thead>
						<tr class="row">
							<th class="col-md-1 col-lg-1">{{__('admin.coupon.sno')}}</th>
							<th class="col-md-2 col-lg-2">{{__('admin.coupon.title')}}</th>
							<th class="col-md-2 col-lg-2" >{{__('admin.coupon.code')}}</th>
							<th class="col-md-4 col-lg-4" >{{__('admin.coupon.description')}}</th>
							<th class="col-md-2 col-lg-2" >{{__('admin.coupon.percentage')}}</th>
							<th class="col-md-1 col-lg-1" >{{ __('admin.coupon.actions') }}</th>
						</tr>
					</thead>
					<tbody>
						@if(count($coupons))
							@foreach($coupons as $key=>$coupon)
							<tr class="row">
								<td class="col-md-1 col-lg-1">{{ $key+1 }}</td>
								<td class="col-md-2 col-lg-2">{{ $coupon->title ?? 'N.A' }}</td>
								<td class="col-md-2 col-lg-2">{{ $coupon->code ?? 'N.A' }}</td>
								<td class="col-md-4 col-lg-4">{{ $coupon->shortDescription($coupon->description) ?? 'N.A' }}</td>
								<td class="col-md-2 col-lg-2">{{ $coupon->percentage ?? 'N.A' }}%</td>
								<td class="col-md-1 col-lg-1">
									<a href="javascript:void(0);" data-status="{{ $coupon->id }}" class="status-toggle" title="{{ __('admin.coupon.title_status') }}">
										<i class="fa {{ $coupon->status == 1 ? 'fa-toggle-on' : 'fa-toggle-off'}}"></i>
									</a>
									&nbsp;
									<a href="{{ route('coupon-edit', $coupon->id) }}"  title="{{ __('admin.coupon.title_edit') }}">
										<i class="fa fa-pencil"></i>
									</a>
									&nbsp;
									<a href="javascript:void(0);" class="delete" data-delete="{{ $coupon->id }}" title="{{ __('admin.coupon.title_delete') }}">
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
						{{ $coupons->links() }}
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
			if(confirm("{{__('admin.coupon.sure_to_delete')}}")){
				$("body").append(
					`<form method="post" id="form-delete" action="{{ route('coupon-delete') }}">
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
			if(confirm("{{__('admin.coupon.sure_to_toggel_status')}}")){
				$("body").append(
					`<form method="post" id="form-status" action="{{ route('coupon-toggle-status') }}">
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