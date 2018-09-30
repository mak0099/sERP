@extends('layout')
@section('title', 'Foreign Purchase order')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Procurement</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" ng-app="myApp">
                    <div class="x_title">
                        <h2>Foreign Purchase Order</h2>
                        <a href="{{route('purchase-order.index')}}" class="btn btn-sm btn-primary btn-addon pull-right"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;Foreign Purchase Order List</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" ng-controller="myCtrl">
                        <br />
                        <form class="form-horizontal form-label-left" name="po" action="{{route('purchase-order.store')}}" method="POST" autocomplete="off">
                        @csrf
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    {{ BootForm::select('vendor_id', 'Vendor', $vendor_list, null, ['class'=>'form-control input-sm select2','style'=>"width: 100%;",'required']) }}
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    {{ BootForm::text('requisition_date','Requisition date', null, ['class'=>'form-control input-sm datepicker' ,'required']) }}
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                        {{ BootForm::text('purchase_order_date','Purchase Order date', null, ['class'=>'form-control input-sm datepicker' ,'required']) }}
                                </div>
                            </div>
                            <fieldset class="m-t-20">
                                <legend>Table of Terms and Conditions:</legend>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    {{ BootForm::select('port_of_loading_port_id', 'Port of Loading', $port_list, null, ['class'=>'form-control input-sm select2','style'=>"width: 100%;",'required']) }}
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    {{ BootForm::select('port_of_discharge_port_id', 'Port of Discharge', $port_list, null, ['class'=>'form-control input-sm select2','style'=>"width: 100%;",'required']) }}
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    {{ BootForm::select('final_destination_country_id', 'Country of Final Destination', $country_list, null, ['class'=>'form-control input-sm select2','style'=>"width: 100%;",'required']) }}
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    {{ BootForm::select('final_destination_city_id', 'Final Destination', $city_list, null, ['class'=>'form-control input-sm select2','style'=>"width: 100%;",'required']) }}
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    {{ BootForm::select('origin_of_goods_country_id', 'Country of Origin of Goods', $country_list, null, ['class'=>'form-control input-sm select2','style'=>"width: 100%;",'required']) }}
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    {{ BootForm::select('shipment_allow', 'Shipment Allow', ['Multi shipment'=>'Multi shipment','Partial'=>'Partial'], null, ['class'=>'form-control input-sm select2','style'=>"width: 100%;",'required']) }}
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    {{ BootForm::select('payment_type', 'Payment Type', ['Cash'=>'Cash'], null, ['class'=>'form-control input-sm select2','style'=>"width: 100%;",'required']) }}
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    {{ BootForm::select('pre_carriage_by', 'Pre Carriage By', ['Ship'=>'Ship','Air'=>'Air'], null, ['class'=>'form-control input-sm select2','style'=>"width: 100%;",'required']) }}
                                    </div>
                                </div>
                            </fieldset>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    {{ BootForm::text('subject','Subject', null, ['class'=>'form-control input-sm']) }}
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    {{ BootForm::text('letter_header','Letter Header', null, ['class'=>'form-control input-sm']) }}
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive m-t-15">
                                    <div class="col-sm-6 col-sm-offset-3">
                                         <div class="well">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Select Req. No</span>
                                                    <select data-placeholder="Select Req No" multiple required class="form-control input-sm select2" style="width: 100%" name="foreign_requisition_ids[]" ng-model="req_id" ng-change="searchReqNo()">
                                                        <option value=""></option>
                                                        @foreach($requisition_list as $item)
                                                        <option value="{{$item->id}}">{{$item->requisition_no}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                        </div>
                                    </div>
                                    <table class="table table-bordered table-hover" ng-if="itemlist.length >=1">
                                            <thead class="bg-default">
                                                <tr>
                                                    <th colspan="8">Product Table</th>
                                                </tr>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Product Name</th>
                                                    <th>UOM</th>
                                                    <th>Quantity</th>
                                                    <th>Unit Price</th>
                                                    <th class="text-center">Total Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="item in itemlist">
                                                    <td class="text-center"><% $index+1 %><input type="hidden" class="form-control" name="items[<% $index %>][product_id]" value="<% item.product_id %>"></td>
                                                    <td class="checkbox">
                                                        <label class="control-label">
                                                            <input type="checkbox" ng-init="checked[$index] = true" ng-model="checked[$index]"><% item.name %>
                                                        </label>
                                                    </td>
                                                    <td><% item.uom %></td>
                                                    <td><input ng-disabled="!checked[$index]" ng-model="quantity[$index]" ng-init="quantity[$index]=item.quantity" class="form-control input-sm" required type="number" name="items[<% $index %>][quantity]"></td>
                                                    <td><input ng-disabled="!checked[$index]" ng-model="unit_price[$index]" class="form-control input-sm" type="number" name="items[<% $index %>][unit_price]" required></td>
                                                    <td class="text-right">
                                                    <% quantity[$index]*unit_price[$index] %>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!-- <tfoot class="font-bold">
                                                <tr>
                                                    <td colspan="3">Total</td>
                                                    <td>324</td>
                                                    <td>324</td>

                                                    <td colspan="1"></td>
                                                </tr>
                                            </tfoot> -->
                                    </table>
                                </div>
                                </div>
                                 <!--end table-->
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    {{ BootForm::text('letter_footer','Letter Footer', null, ['class'=>'form-control input-sm']) }}
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        {{ BootForm::textarea('notes','Notes', null, ['class'=>'form-control input-sm','rows'=>2]) }}
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        
                                        <br />
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-sm">Save</button>
                                            <a class="btn btn-default btn-sm" href="{{route('purchase-order.index')}}">Cancel</a>
                                        </div>
                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
@endsection
@section('script')
<script>
    var app = angular.module('myApp', [], function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });
    app.controller('myCtrl', function($scope, $http) {
        
        $scope.itemlist = [];
        $scope.searchReqNo = function () {
            $scope.itemlist = [];
            $scope.addToItemList($scope.req_id.join());
        }
        $scope.addToItemList = function(ids){
            let url = "{{URL::to('get-foreign-requisition')}}/" + ids;
            $http.get(url)
                    .then(function(response) {
                        $scope.itemlist = response.data;
                    });
        }
        $scope.removeItem = function(index){
            $scope.itemlist.splice(index);
        }
    });
</script>
@endsection
