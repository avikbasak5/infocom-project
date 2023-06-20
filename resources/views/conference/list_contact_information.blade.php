@extends('layouts.main')
@section('title', __('admin.manage').' '.$page_name.' '.__('admin.contact_information'))
@section('body')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-4">
        <h4 class="m-0">{{ $row_conference->title }} : {{ __('admin.contact_information') }}</h4>
      </div><!-- /.col -->
      <div class="col-sm-8">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{ __('admin.home') }}</a></li>
          <li class="breadcrumb-item"><a href="{{$page_url}}">{{ __('admin.manage') }} {{ $page_name }}</a></li>
          <li class="breadcrumb-item"><a href="{{route($page_update,$row_conference->id)}}">{{ $row_conference->title }}</a></li>
          <li class="breadcrumb-item active">{{ __('admin.contact_information') }}</li>
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
            <i class="icon fas fa-check"></i> {{ __('admin.sponsors') }} {{ Session::get('success') }}
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
          <a class="nav-link" id="tab1" href="{{route($page_update,$row_conference->id)}}" role="tab" aria-controls="tab1" aria-selected="true"><i class="fa fa-users"></i> {{ __('admin.conference') }} {{ __('admin.details') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="tab2" href="{{ route('event',$row_conference->id) }}" role="tab" aria-controls="tab2" aria-selected="false"><i class="fa fa-calendar"></i> {{ __('admin.conference') }} {{ __('admin.events') }}</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" id="tab3" href="{{ route('conference_sponsors',$row_conference->id) }}" role="tab" aria-controls="tab3" aria-selected="false"><i class="fa fa-user"></i> {{ __('admin.conference') }} {{ __('admin.sponsors') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="tab4" href="{{ route('conference_speakers',$row_conference->id) }}" role="tab" aria-controls="tab4" aria-selected="false"><i class="fa fa-volume-up"></i> {{ __('admin.conference') }} {{ __('admin.speakers') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" id="tab5" data-toggle="pill" href="javascript:void(0);" role="tab" aria-controls="tab4" aria-selected="false"><i class="fa fa-user"></i> {{ __('admin.contact_information') }}</a>
        </li>
      </ul>
      <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <table id="list_table" class="table table-bordered table-striped w-100">
            <thead>
            <tr>
              <th>#</th>
              <th>{{ __('admin.name') }}</th>
              <th>{{ __('admin.email') }}</th>
              <th>{{ __('admin.mobile') }}</th>
              <th class="text-center">{{ __('admin.action') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rows as $key => $row)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$row->name}}</td>
              <td>{{$row->email}}</td>
              <td>{{$row->mobile}}</td>
              <td class="text-center">
                <button type="button" class="btn btn-xs bg-gradient-{{($row->conference_contact_information_id)?'danger':'primary'}} toggle-assigned"  data-bs-toggle="tooltip" title="{{ ($row->conference_contact_information_id) ? __('admin.remove') : __('admin.assign') }}" data-id="{{$row->conference_contact_information_id}}" data-conference-id="{{$row_conference->id}}" data-contact-information-id="{{($row->id)}}"><i class="fa fa-{{($row->conference_contact_information_id)?'minus-circle':'plus-circle'}}"></i></button>
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
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": false,
      "autoWidth": true,
      "responsive": true,
      "columnDefs": [
        { "width": "5%", "targets": 0 },
        { "width": "30%", "targets": 1 },
        { "width": "30%", "targets": 2 },
        { "width": "25%", "targets": 3 },
        { "width": "10%", "targets": 4 },
      ],
      fnDrawCallback: function (oSettings) {
        $('#list_table_wrapper .row:first div:first').html('<a href="{{route('contact_information_create',$row_conference->id)}}" class="btn btn-warning btn-sm"><i class="fas fa-plus"></i> {{ __("admin.add") }} & {{ __("admin.assign") }} {{ __("admin.contact_information") }}</a>');
      }
    });
  });

  $(function () {
    $('.toggle-assigned').on('click',function() {
      var buttonObject = $(this);
      var id = $(this).data('id');
      var contactInformationId = $(this).data('contact-information-id');
      $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:"POST",
        url: "{{route('conference_contact_information',$row_conference->id)}}", 
        data:{'id':id,'contact_information_id':contactInformationId},
        success:function(data){
          if(data.error) {
            toastr.error(data.error)
          } else {
            toastr.success("{{ __('admin.contact_information') }} "+data.success)
            $(buttonObject).data('id',data.id)
            $(buttonObject).toggleClass('bg-gradient-primary bg-gradient-danger')
            $(buttonObject).tooltip('hide').attr('data-original-title', data.id ? "{{ __('admin.remove') }} " : "{{ __('admin.assign') }} ").tooltip('show');
            $(buttonObject).find('i').toggleClass('fa-plus-circle fa-minus-circle')
          }
        },  
        error: function(XMLHttpRequest, textStatus, errorThrown) {

        }
      })
    })
  });
</script>
@endsection