@extends('layout')
@section('title', 'Quotation')
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
        <!--{{-- Content here --}}-->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" ng-app="myApp">
                   <div class="x_title">
                            <h2>Quotation</h2>
                            <a href="{{ route('quotation.index') }}" class="btn btn-sm btn-primary btn-addon pull-right"><i class="fa fa-list" aria-hidden="true"></i> Quotation List</a>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content" ng-controller="myCtrl">
                            @include('partials/flash_msg')
                            <form class="form-horizontal form-label-left input_mask" action="{{ route('quotation.store') }}" method="POST" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 item">
                                        {{ BootForm::select('vendor_id', 'Vendor', $vendor_list, null, ['class'=>'form-control input-sm select2', 'ng-model'=>'vendor_id', 'data-placeholder'=>'Select Vendor', 'required','data-popup'=> route('vendor.index')]) }}
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 item">
                                        {{ BootForm::text('delivery_date','Delivery Date', null, ['class'=>'form-control input-sm datepicker', 'ng-model'=>'delivery_date', 'required']) }}
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 item">
                                            {{ BootForm::select('local_requisition_id', 'Requisitions', $local_requisition_list, null, ['class'=>'form-control input-sm select2', 'data-placeholder'=>'Select Requisition', 'ng-model'=>'local_requisition_id', 'ng-change'=>'searchReqItem()', 'required','data-popup'=> route('local-requisition.index')]) }}
                                        </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" ng-if="itemlist.length >=1">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead class="bg-primary">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Product Name</th>
                                                        <th>UOM</th>
                                                        <th>Unit Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <tr ng-repeat='item in itemlist'>
                                                    <td><% $index+1 %><input type="hidden" class="form-control" name="items[<% $index %>][product_id]" value="<% item.product_id %>">
                                                    </td>
                                                    <td><% item.name %></td>
                                                    <td><% item.uom %></td>
                                                    <td>
                                                        <input ng-model="unit_price[$index]" ng-init="unit_price[$index]= 0" class="form-control input-sm" type="number" name="items[<% $index %>][unit_price]" required>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-15">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3">
                                            <div class="form-group">
                                                <label data-popup = "{{ route('payment-type.index') }}" class="link">Payment Type</label>
                                                <select class="form-control input-sm select2" ng-model="payment_type"  required>
                                                    <option value="" disabled>--Select Payment Type--</option>
                                                    @foreach($payment_type_list as $item)
                                                    <option value="{{$item}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover">
                                                    <thead class="bg-primary">
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Description</th>
                                                            <th colspan="2">% or Fixed Amount</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th>
                                                                {{ BootForm::text('payment_date','Date', null, ['class'=>'form-control input-sm datepicker','ng-model'=>'payment_terms_date']) }}
                                                            </th>
                                                            <th>
                                                                {{ BootForm::text('payment_terms_description','Payment Description',null,['class'=>'form-control input-sm','rows'=>'1', 'ng-model' => 'payment_terms_description']) }}
                                                            </th>
                                                            <th>
                                                                {{ BootForm::number('payment_terms_amount','Payment Amount', null, ['class'=>'form-control input-sm', 'ng-model' => 'payment_terms_amount']) }}
                                                            </th>
                                                            <th  class="text-center"><button type="button" ng-click="add_terms()" class="btn btn-sm btn-primary m-t-10">Add</button></th>
                                                        </tr>
                                                        </tbody>
                                                </table>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover m-t-15">
                                                    <thead class="bg-primary" ng-if="payment_terms.length >=1">
                                                        <tr>
                                                            <th width="40">#</th>
                                                            <th>Payment term</th>
                                                            <th>Date</th>
                                                            <th>Description</th>
                                                            <th class="text-center">% or Fixed Payment Amount</th>
                                                            <th width="40" class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr ng-repeat="terms in payment_terms">
                                                            <td><% $index+1 %></td>
                                                            <td><% terms.name %> <input name="payment_terms[<% $index %>][payment_type_id]" type="hidden" value="<% terms.id %>"></td>
                                                            <td><% terms.date %> <input name="payment_terms[<% $index %>][payment_date]" type="hidden" value="<% terms.date %>"></td>
                                                            <td><% terms.description %> <input name="payment_terms[<% $index %>][description]" type="hidden" value="<% terms.description %>"></td>
                                                            <td class="text-right"><% terms.amount %> <input name="payment_terms[<% $index %>][amount]" type="hidden" value="<% terms.amount %>"></td>
                                                            <td  class="text-center">
                                                                <button type="button" class="btn btn-xs btn-danger" ng-click="removeTerms($index)"><i class="fa fa-times"></i></button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <legend>Terms and Conditions</legend>
                                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label data-popup = "{{ route('terms-and-condition-type.index') }}" class="link">Terms and Conditions Type</label>
                                                    <select class="form-control input-sm select2" ng-model="terms_and_condition_type"  required>
                                                        <option value="" disabled>--Select Terms and Conditions Type--</option>
                                                        @foreach($terms_conditions_type_list as $item)
                                                        <option value="{{$item}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                                                {{ BootForm::textarea(null,'Description',null,['id'=>'description','class'=>'form-control input-sm','rows'=>'1', 'ng-model' => 'condition_description']) }}
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                                <button type="button" ng-click="add_condition()" class="btn btn-sm btn-primary m-t-25"><strong>Add T.C.</strong></button>
                                            </div>
                                            </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" ng-if="conditions.length >=1">
                                            <div class="table-responsive m-t-15">
                                                <table class="table table-bordered">
                                                    <thead class="bg-primary">
                                                        <tr>
                                                            <th width="40">#</th>
                                                            <th>Term & Condition</th>
                                                            <th>Description</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="mytable1">
                                                        <tr ng-repeat="condition in conditions">
                                                            <td><% $index+1 %></td>
                                                            <td><% condition.name %><input name="terms_conditions[<% $index %>][terms_and_condition_type_id]" type="hidden" value="<% condition.id %>"></td>
                                                            <td><% condition.description %> <input name="terms_conditions[<% $index %>][description]" type="hidden" value="<% condition.description %>"></td>
                                                            <td width="40" class="text-center"><button class="btn btn-danger btn-xs" ng-click="removeCondition($index)"><i class="fa fa-times"></i></button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        </div>
                                    </fieldset>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <br />
                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success" ng-disabled="itemlist.length < 1">Save</button>
                                                <a class="btn btn-default" href="{{route('quotation.index')}}">Cancel</a>
                                            </div>
                                        </div>     
                                    </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>

        {{-- Content end --}}
    </div>
    <div class="clearfix"></div>
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
        $scope.unit_price = [];
        $scope.payment_terms = [];
        $scope.conditions = [];


        $scope.searchReqItem = function(){
            $scope.itemlist = [];
            let url = "{{ URL::to('get-requisition-items-by-requisition-id') }}/" + $scope.local_requisition_id;
            $http.get(url)
                    .then(function(response) {
                        $scope.itemlist = response.data.items;
                    });
        }


        $scope.add_terms = function(){
            var term = {};
            if(!$scope.payment_type){
                $scope.warning('Please select a payment type first');
                return;
            }

            if(!$scope.payment_terms_amount){
                $scope.warning('Payment amount is empty');
                return;
            }

            if(!$scope.payment_terms_description){
                $scope.warning('Payment description is empty');
                return;
            }

            if(!$scope.payment_terms_date){
                $scope.warning('Payment date is empty');
                return;
            }

            var item = JSON.parse($scope.payment_type);

            term.id = item.id;
            term.name = item.name;
            term.date = $scope.payment_terms_date;
            term.description = $scope.payment_terms_description;
            term.amount = $scope.payment_terms_amount;
            $scope.payment_terms.push(term);
            $scope.payment_terms_description = null;
            $scope.payment_terms_amount = null;
        }

        $scope.removeTerms = function(index){
            $scope.payment_terms.splice(index, 1);
        }



        $scope.add_condition = function(){
            var condition = {};
            if(!$scope.terms_and_condition_type){
                $scope.warning('Please select terms and condition type first');
                return;
            }

            if(!$scope.condition_description){
                $scope.warning('Description of terms and condition is empty');
                return;
            }

            var item = JSON.parse($scope.terms_and_condition_type);

            index = $scope.conditions.findIndex(value => value.id == item.id);

            if(index >= 0){
                $scope.warning('Terms and conditions already exist');
                return;
            }

            condition.id = item.id;
            condition.name = item.name;
            condition.description = $scope.condition_description;
            $scope.conditions.push(condition);
            $scope.condition_description = null;
        }

        $scope.removeCondition = function(index){
            $scope.conditions.splice(index, 1);
        }

        $scope.warning = function(msg){
            var data = {
                'title': 'Warning!',
                'text': msg,
                'type': 'notice',
                'styling': 'bootstrap3',
            };
            new PNotify(data);
        }

        // for old data holding in the field start

        $scope.vendor_id = '{{ old('vendor_id') }}';
        $scope.local_requisition_id = '{{ old('local_requisition_id') }}';
        $scope.delivery_date = '{{ old('delivery_date') }}';
        $scope.payment_type = '{{ old('payment_type') }}';
        if($scope.local_requisition_id){
            $scope.searchReqItem();
        }

        // for old data holding in the field end

    });
</script>
@endsection
