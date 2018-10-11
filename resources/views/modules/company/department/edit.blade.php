@extends('layout')
@section('title', 'Department')
@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Department</h2>
                        <a class="btn btn-primary btn-sm pull-right" href="{{route('department.index')}}"><i class="fa fa-list-ul"></i> Department List</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        @include('partials.flash_msg')
                        <form class="form-horizontal form-label-left" action="{{ route('department.update', $department) }}" method="POST" autocomplete="off">
                        <input name="_method" type="hidden" value="PUT"> 
                         {{csrf_field()}}
                            <div class="col-md-6 offset-md-3 col-sm-6 col-xs-12">
                                {{ BootForm::text('name', 'Department Name', $department->name, ['class'=>'form-control input-sm']) }}
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ BootForm::textarea('description', 'Description', $department->description, ['class'=>'form-control input-sm','rows'=>1]) }}
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <br />
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-sm">Update</button>
                                    <a class="btn btn-default btn-sm" href="{{route('department.index')}}">Cancel</a>
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
