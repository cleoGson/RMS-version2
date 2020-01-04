@extends('layouts.admin')
@section('content')
<section class="content-wrapper">
    <div class="content-header">
    <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=" m-0 text-dark">
                        <p class="blue">
                        Edit staff  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </p>
                    </h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                        <a  class="blue" href="{{ url('/') }}">Home</a>
       
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.staff.index') }}" class="blue">staff List</a>
                        </li>
                        <li class="breadcrumb-item active" class="blue">
                            Edit staff
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-body card card-accent-primary">
                    {!! Form::model($show,['method'=>'PATCH','route'=>['admin.staff.update',encrypt($show->id)],'files'=>true]); !!}
                    @include('admin.staffs.form')
                    <div class="row">
                        <div class="col-md-12 form-group text-right">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-success">
                                    Update
                                </button>

                                <a href="{{route('admin.staff.index')}}" class="btn btn-primary">
                            Back to List <i class="fas fa-fast-forward"></i>
                              </a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close()!!}
                </div>
            </div>
            <br /><br /><br /><br />
        </div>
    </section>
</section>
@endsection

@section('scripts')
<script>
// ajax select from the database with page nation
           $(document).ready(function () {
            $('#disability').select2({
                ajax: {
                    method:'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{'/admin/disabilitydata'}}',
                    data: function (params) {
                        return {
                            search: params.term,
                            page: params.page || 1
                        };
                    },
                    dataType: 'json',
                    processResults: function (data) {
                        data.page = data.page || 1;
                        return {
                            results: data.items.map(function (item) {
                                return {
                                    id: item.id,
                                    text: item.name,
                                };
                            }),
                            pagination: {
                                more: data.pagination
                            }
                        }
                    },
                    cache: true,
                    delay: 250
                },
                placeholder: 'search Disability',
                minimumInputLength: 3,
                multiple: false
            });


        });
    </script>
@stop