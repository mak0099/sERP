@extends('layout')
@section('title', 'Payment Schedule')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Payment Schedule</h2>
                    <a href="{{ route('payment-schedule.index')}}" class="btn btn-sm btn-primary btn-addon pull-right"><i class="fa fa-list-ul" aria-hidden="true"></i> Payment Schedule List</a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form class="form-horizontal form-label-left input_mask">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                {{ BootForm::text('seles_order_no','Seles Order No', null, ['class'=>'form-control input-sm']) }}
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                {{ BootForm::text('seles_date','Seles Date', null, ['class'=>'form-control input-sm']) }}
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Remarks</label>
                                    <textarea name="notes" cols="30" rows="2" class="form-control input-sm"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <br />
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <a href="#" class="btn btn-success btn-sm">Save</a>
                                    <a href="{{ route('payment-schedule.index')}}" class="btn btn-default btn-sm">Cancel</a>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
