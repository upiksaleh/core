@extends('laravel-enso/core::layouts.app')

@section('pageTitle', __("Users"))

@section('content')

    <section class="content-header">
        @include('laravel-enso/menumanager::breadcrumbs')
    </section>
    <section class="content">
        <div class="row" v-cloak>
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border" style="text-align:center">
                        <div class="box-title">
                            {{ __("Create a new User") }}
                        </div>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        {!! Form::open(['method' => 'POST', 'url' => '/administration/users']) !!}
                        <div class="row">
                            @include('laravel-enso/core::administration.users.form')
                        </div>
                        <center>
                            {!! Form::submit(__("Create"), ['class' => 'btn btn-primary']) !!}
                        </center>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
</section>

@endsection

@push('scripts')

    <script>

        var vue = new Vue({
            el: '#app',
            data: {
                customParams: { owner_id: null }
            }
        });

    </script>

@endpush
