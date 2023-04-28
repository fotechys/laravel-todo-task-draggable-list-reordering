@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tasks</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('tasks.create') }}">
                        Add New
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="card">
            {!! Form::open(array('route' => "tasks.filter")) !!}


            <div class="card-body">
                <div class="row">
                    @include('tasks.fields_filter')
                </div>
            </div>

            {!! Form::close() !!}


        </div>

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('tasks.table')

                <div class="card-footer clearfix">
                    <div class="float-right">

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('third_party_scripts')
    <script type="text/javascript">
        $(function () {
            $("#project_id").change(function () {
                console.log("changed");
                $("#project_id").closest("form").submit();
            })

        });
    </script>
@endpush
