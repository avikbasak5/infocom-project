@extends('layouts.main')
@section('title', __('admin.manage').' '.$page_name)
@section('body')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-4">
        <h4 class="m-0">{{$parent_row->title}} : {{ $page_name }}</h4>
      </div><!-- /.col -->
      <div class="col-sm-8">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{ __('admin.home') }}</a></li>
          <li class="breadcrumb-item"><a href="{{$parent_page_url}}">{{ __('admin.manage') }} {{ $parent_page_name }}</a></li>
          <li class="breadcrumb-item"><a href="{{$parent_page_single_url}}">{{$parent_row->title}}</a></li>
          <li class="breadcrumb-item active">{{ __('admin.manage') }} {{ $page_name }}</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Error content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        @if(Session::has('success'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fas fa-check"></i> {{ $page_name }} {{ Session::get('success') }}
              @php
                  Session::forget('success');
              @endphp
          </div>
          @endif
      </div>
    </div>
  </div>
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link" id="tab1" href="{{ route('conference_update',$parent_id) }}" role="tab" aria-controls="tab1" aria-selected="true"><i class="fa fa-users"></i> {{ __('admin.conference') }} {{ __('admin.details') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" id="tab2" data-toggle="pill" href="javascript:void(0);" role="tab" aria-controls="tab2" aria-selected="false"><i class="fa fa-calendar"></i> {{ __('admin.conference') }} {{ __('admin.events') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="tab3" href="{{ route('conference_sponsors',$parent_id) }}" role="tab" aria-controls="tab3" aria-selected="false"><i class="fa fa-user"></i> {{ __('admin.conference') }} {{ __('admin.sponsors') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="tab4" href="{{ route('conference_speakers',$parent_id) }}" role="tab" aria-controls="tab4" aria-selected="false"><i class="fa fa-volume-up"></i> {{ __('admin.conference') }} {{ __('admin.speakers') }}</a>
        </li>
      </ul>
      <div class="card card-warning card-outline direct-chat-warning">
        <div class="card-header">
          <h3 class="card-title"><a href="{{route($page_add,$parent_id)}}" class="btn btn-block btn-warning btn-sm"><i class="fas fa-plus"></i> {{ __('admin.add') }} {{ $page_name }}</a></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="list_table" class="table table-bordered table-striped w-100">
            <thead>
            <tr>
              <th>#</th>
              <th>{{ __('admin.date') }}</th>
              <th>{{ __('admin.title') }}</th>
              <th>{{ __('admin.type') }}</th>
              <th>{{ __('admin.day') }}</th>
              <th>{{ __('admin.venue') }}</th>
              <th class="text-center">{{ __('admin.action') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rows as $key => $row)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$row->event_date}}</td>
              <td>{{$row->event_title}}</td>
              <td>{{$row->event_type_name}}</td>
              <td>{{$row->event_day}}</td>
              <td>{{$row->event_venue}}</td>
              <td class="text-center">
                <a href="{{route($page_update,[$parent_id,$row->id])}}" class="btn btn-xs bg-gradient-primary" data-bs-toggle="tooltip" title="{{ __('admin.edit') }}"><i class="fas fa-edit"></i></a>
                <form class="d-inline-block" id="form_{{$row->id}}" action="{{route($page_delete,[$parent_id,$row->id])}}" method="post">
                  @csrf
                  <button type="button" data-form="#form_{{$row->id}}" class="btn btn-xs bg-gradient-danger delete-btn" data-bs-toggle="tooltip" title="{{ __('admin.delete') }}"><i class="fas fa-trash"></i></button>
                </form>
                <button type="button" class="btn btn-xs bg-gradient-{{($row->published)?'success':'warning'}} toggle-published"  data-bs-toggle="tooltip" title="{{ ($row->published) ? __('admin.unpublish') : __('admin.publish') }}" data-id="{{$row->id}}" data-is-published="{{($row->published)}}"><i class="fas fa-{{($row->published)?'check-circle':'ban'}}"></i></button>
                <!-- <a href="{{route('event_sponsors',[$parent_id,$row->id])}}" class="btn btn-sm bg-gradient-secondary" data-bs-toggle="tooltip" title="{{ __('admin.sponsors') }}"><i class="fas fa-handshake"></i></a>
                <a href="{{route('event_speakers',[$parent_id,$row->id])}}" class="btn btn-sm bg-gradient-primary" data-bs-toggle="tooltip" title="{{ __('admin.speakers') }}"><i class="fas fa-volume-up"></i></a> -->
              </td>
            </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('script')
<script>
  $(function () {
    $('#list_table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });

  $(function () {
    $('.toggle-published').on('click',function() {
      var buttonObject = $(this);
      var id = $(this).data('id');
      var isPublished = $(this).data('is-published') ? 0 : 1;
      $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:"POST",
        url: "{{route($page_publish_unpublish,$parent_id)}}",
        data:{'id':id,'published':isPublished},
        success:function(data){
          if(data.error) {
            toastr.error(data.error)
          } else {
            toastr.success("{{ $page_name }} "+data.success)
            $(buttonObject).data('is-published',isPublished)
            $(buttonObject).toggleClass('bg-gradient-success bg-gradient-warning')
            $(buttonObject).tooltip('hide').attr('data-original-title', isPublished ? 'Unpublish' : 'Publish').tooltip('show');
            $(buttonObject).find('i').toggleClass('fa-check-circle fa-ban')
          }
        },  
        error: function(XMLHttpRequest, textStatus, errorThrown) {

        }
      })
    })
  });

  $(function () {
    $(".delete-btn").on('click', function(e) {
      var form = $(this).data('form');
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $(form).submit()
        }
      })
    })
  })
</script>
@endsection