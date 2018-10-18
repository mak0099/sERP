@extends('layout')
@section('title', 'Rule Setup')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Rule Setup</h2>
                    
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-xs-3">
                        <!-- Nav tabs -->
                        @include('modules.sales.setting.rule_setup.tabs')
                    </div>

                    <div class="col-xs-9">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="credit_rule">
                                <div class="x_title">
                                    <h2>Credit Rule</h2>
                                    <a href="#" class="btn btn-sm btn-default btn-addon pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New</a>
                                    <div class="clearfix"></div>
                                </div>
                                {{-- @include('partials/flash_msg') --}}
                                {{ BootForm::open(['model' => $credit_rule, 'store' => 'credit-rule.store', 'update' => 'credit-rule.update']) }}
                                    <input type="hidden" name="rule_type" value="credit-rule">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                            {{ BootForm::select('customer_id', 'Customer', $customer_list, null, ['class'=>'form-control input-sm select2','style'=>"width: 100%;", 'data-placeholder'=>'Select Customer']) }}
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                            {{ BootForm::number('credit_amount','Credit Amount', null, ['class'=>'form-control input-sm']) }}
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                            {{ BootForm::text('deadline','Deadline', null, ['class'=>'form-control input-sm datepicker']) }}
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <br />
                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success btn-sm">Save</button>
                                                <button type="button" class="btn btn-default btn-sm">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                {{ BootForm::close() }}
                                <div class="table-responsive m-t-30">
                                    <table class="table table-bordered table-hover">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th width="40">#</th>
                                                <th>Customer</th>
                                                <th>Amount</th>
                                                <th>Deadline</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($credit_rule_list as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->customer->name }}</td>
                                                <td>{{ $item->credit_amount }}</td>
                                                <td>{{ $item->deadline }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!--end table-->
                            </div>
                            <div class="tab-pane {{ (Request::is('sales/discount-customer-wise')) ? "active" : null }}" id="discount_customer">
                                <div class="x_title">
                                    <h2>Discount Customer Wise</h2>
                                    <a href="#" class="btn btn-sm btn-default btn-addon pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New</a>
                                    <div class="clearfix"></div>
                                </div>
                                <form class="form-horizontal form-label-left input_mask">
                                    <div class="row">
                                        <div class="well">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-3 col-md-offset-3">
                                                    {{ BootForm::select('customer_id', 'Customer Id', [], null, ['class'=>'form-control input-sm select2','style'=>"width: 100%;"]) }}
                                                </div>
                                                <div class="col-lg-6 ol-md-6 col-sm-6 col-xs-12 col-lg-offset-3 col-md-offset-3">
                                                    {{ BootForm::text('add_product', null, null, ['class'=>'form-control input-sm select2', 'suffix'=>BootForm::addonButton(fa('fa-plus-circle fa-lg text-primary'), ['class' => 'btn-default btn-sm'])]) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <th>Discount Type</th>
                                                        <th>Amount</th>
                                                        <th>Active</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Tyre</td>
                                                        <td>
                                                            <select class="form-control input-sm">
                                                                <option value="">one1</option>
                                                                <option value="">one2</option>
                                                            </select>
                                                        </td>
                                                        <td>125</td>
                                                        <td>
                                                            <label>
                                                                <input type="checkbox" class="js-switch" checked />
                                                            </label>
                                                        </td>
                                                        <td class="text-center"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-close"></i></button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <br />
                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                                                    <button type="button" class="btn btn-default btn-sm">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                {{ BootForm::close() }}
                                <div class="table-responsive m-t-30">
                                    <table class="table table-bordered table-hover">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>#</th>		
                                                <th>Product Name</th>		
                                                <th>Discount Type</th>
                                                <th>Amount</th>
                                                <th>Active</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>01</td>
                                                <td>Customer</td>
                                                <td>02</td>
                                                <td>03</td>
                                                <td>03</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--end table-->
                            </div>
                            <div class="tab-pane {{ (Request::is('sales/discount-generic')) ? "active" : null }}" id="discount_generic">Discount Generic</div>
                            <div class="tab-pane {{ (Request::is('sales/free-bonus-customer-wise')) ? "active" : null }}" id="free_bonus_customer">
                                <div class="x_title">
                                    <h2>Free/Bonus(Customer Wise)</h2>
                                    <a href="#" class="btn btn-sm btn-default btn-addon pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New</a>
                                    <div class="clearfix"></div>
                                </div>
                                <form class="form-horizontal form-label-left input_mask">
                                    <div class="row">
                                        <div class="well">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-3 col-md-offset-3">
                                                    {{ BootForm::select('customer_id', 'Customer Id', [], null, ['class'=>'form-control input-sm select2','style'=>"width: 100%;"]) }}
                                                </div>
                                                <div class="col-lg-6 ol-md-6 col-sm-6 col-xs-12 col-lg-offset-3 col-md-offset-3">
                                                    {{ BootForm::text('add_product', null, null, ['class'=>'form-control input-sm select2', 'suffix'=>BootForm::addonButton(fa('fa-plus-circle fa-lg text-primary'), ['class' => 'btn-default btn-sm'])]) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <th>Type</th>
                                                        <th>Bonus</th>
                                                        <th>Active</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Tyre</td>
                                                        <td>
                                                            <select name="" id="" class="form-control input-sm">
                                                                <option value="" readonly>--select--</option>
                                                                <option value="">Ratio</option>
                                                                <option value="">Fixed</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control input-sm" name="msg">
                                                                <span class="input-group-addon">&ratio;</span>
                                                                <input type="text" class="form-control input-sm" name="msg">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <label>
                                                                <input type="checkbox" class="js-switch" checked />
                                                            </label>
                                                        </td>
                                                        <td class="text-center"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-close"></i></button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tyre</td>
                                                        <td>
                                                            <select name="" id="" class="form-control input-sm">
                                                                <option value="">Ratio</option>
                                                                <option value="">Fixed</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control input-sm" name="">
                                                        </td>
                                                        <td>
                                                            <label>
                                                                <input type="checkbox" class="js-switch" checked />
                                                            </label>
                                                        </td>
                                                        <td class="text-center"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-close"></i></button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <br />
                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                                                    <button type="button" class="btn btn-default btn-sm">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive m-t-30">
                                    <table class="table table-bordered table-hover">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>#</th>
                                                <th>Product Name</th>		
                                                <th>Type</th>
                                                <th>Bonus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>01</td>
                                                <td>Customer</td>
                                                <td>02</td>
                                                <td>03</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--end table-->
                            </div>
                            <div class="tab-pane {{ (Request::is('sales/free-bonus-generic')) ? "active" : null }}" id="free_bonus_generic">Free/Bonus(Generic)</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection