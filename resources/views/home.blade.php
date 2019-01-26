@extends('layouts.admin.app')

@section('content')
<!-- Main content -->
<section class="content">
  <!-- Info boxes -->
  <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Recent Videos</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tbody><tr>
              <th style="width: 10px">#</th>
              <th>Title</th>
              <th>Description</th>
              <th style="width: 40px">Category</th>
            </tr>
            @if(count($videos))
              @foreach($videos as $k=>$video)
                <tr>
                  <td>{{ $k+1 }}</td>
                  <td>{{ $video->title ?? 'N.A' }}</td>
                  <td>{{ $video->shortDescription($video->description, 100) ?? 'N.A' }}</td>
                  <td><span class="badge bg-yellow">{{ $video->category->category_name ?? 'N.A' }}</span></td>
                </tr>
              @endforeach
            @endif
          </tbody></table>
        </div>
      </div>
      <!-- /.box -->
    </div>
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Recent Video Categories</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th style="width: 10px">#</th>
                <th>Title</th>
                <th style="width: 40px">Status</th>
              </tr>
              @if(count($videoCategories))
                @foreach($videoCategories as $k=>$category)
                  <tr>
                    <td>{{ $k+1 }}</td>
                    <td>{{ $category->category_name ?? 'N.A' }}</td>
                    <td>
                      <span class="badge {{$category->status==1?'bg-green':'bg-red'}}">
                        {{ $category->enabledDisabled($category->status) ?? 'N.A' }}
                      </span>
                    </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.box -->
    </div>
    
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
@endsection
