@extends('layout')
@section('title', 'Sales return Reason')

@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Sales return Reason</h2>
                        <a class="btn btn-primary btn-sm pull-right" href="{{route('sales-return-reason.index')}}"><i class="fa fa-list-ul"></i> Sales return Reason List</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        @include('partials.flash_msg')
                        <form class="form-horizontal form-label-left" action="{{ route('sales-return-reason.store') }}" method="POST" autocomplete="off">
                            {{ csrf_field() }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ BootForm::text('reason','Reason', null, ['class'=>'form-control input-sm']) }}
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ BootForm::textarea('description','Description', null, ['class'=>'form-control input-sm','rows'=>'2']) }}
                            </div>
                            <br>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <br />
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                                <a class="btn btn-default btn-sm" href="{{route('sales-return-reason.index')}}">Cancel</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@endsection
