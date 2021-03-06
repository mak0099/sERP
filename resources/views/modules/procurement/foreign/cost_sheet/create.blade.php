@extends('layout')
@section('title', 'Cost Sheet')
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
                        <h2>Cost Sheet</h2>
                        <a href="{{route('cost-sheet.index')}}" class="btn btn-sm btn-primary btn-addon pull-right"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Cost Sheet List</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" ng-controller="myCtrl">
                        <br />
                        @include('partials.flash_msg')
                        <form class="form-horizontal form-label-left" action="{{ route('cost-sheet.store') }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 item">
                                    <div class="form-group">
                                        <label>LC No.</label>
                                        <select class="form-control input-sm select2" name="letter_of_credit_id" ng-model="letter_of_credit_id" ng-change="getLc()">
                                            <option value="">--Select LC No--</option>
                                            @foreach($lc_list as $item)
                                            <option value="{{$item->id}}">{{$item->letter_of_credit_no}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 item">
                                    {{ BootForm::text('letter_of_credit_date','LC Opening Date', null, ['class'=>'form-control input-sm', 'ng-model'=>'letter_of_credit_date', 'readonly']) }}
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 item">
                                    {{ BootForm::select('currency_id', 'Currency', $currency_list, null, ['class'=>'form-control input-sm select2', 'data-placeholder'=>'Select Currency','required']) }}
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">LC Bank Info</div>
                                        <div class="panel-body">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                {{ BootForm::text('issue_ac_no','A/C No ', null, ['class'=>'form-control input-sm', 'ng-model'=>'issue_ac_no', 'readonly']) }}
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                {{ BootForm::text('issue_ac_name','A/C Name', null, ['class'=>'form-control input-sm', 'ng-model'=>'issue_ac_name', 'readonly']) }}
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                {{ BootForm::text('issue_bank_name','Bank Name', null, ['class'=>'form-control input-sm', 'ng-model'=>'issue_bank_name', 'readonly']) }}
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                {{ BootForm::text('issue_branch_name','Branch Name', null, ['class'=>'form-control input-sm', 'ng-model'=>'issue_branch_name', 'readonly']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 item">
                                    {{ BootForm::number('letter_of_credit_value','LC Amount (USD)', null, ['class'=>'form-control input-sm', 'ng-model'=>'letter_of_credit_value', 'readonly']) }}
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 item">
                                    {{ BootForm::number('exchange_rate','Exchange Rate', null, ['class'=>'form-control input-sm', 'ng-model'=>'exchange_rate']) }}
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 item">
                                    <div class="form-group">
                                        <label>BDT Amount</label>
                                        <input type="number" class="form-control input-sm" name="bdt_amount" ng-model="bdt_amount" value="<% amount_in_bdt() %>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    {{ BootForm::textarea('note','Note', NULL, ['class'=>'form-control input-sm','rows'=>2]) }}
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <div class="panel panel-default">
                                        <div class="panel-heading">Cost Particulars</div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    {{ BootForm::select(NULL, 'Cost Particulars', $cost_particulars, null, ['class'=>'form-control input-sm select2', 'data-placeholder'=>'Select Cost Particulars', 'ng-model'=>'cost_particular.id']) }}
                                                </div>
                                               <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    {{ BootForm::text(NULL, 'Percentage', NULL, ['class'=>'form-control input-sm', 'ng-model'=>'cost_particular.percentage']) }}
                                                </div>
                                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                    {{ BootForm::number(NULL, 'Amount', NULL, ['class'=>'form-control input-sm', 'ng-model'=>'cost_particular.amount','suffix' => BootForm::addonButton(fa('fa-plus'), ['class' => 'btn-primary btn-sm', 'ng-click'=>'addParticular()']) ]) }}
                                                    
                                                </div>
                                            </div>
                                            <br />
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover">
                                                    <thead class="bg-primary">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Cost Particulars</th>
                                                            <th>Percent (%)</th>
                                                            <th>Amount</th>
                                                            <th>Amt. in round Figure</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>01</td>
                                                            <td>LC Margin</td>
                                                            <td>{{ Form::number('percent_of_lc_margin', null, ['class'=>'form-control input-sm', 'ng-model'=>'percent_of_lc_margin']) }}</td>
                                                            <td><input type="number" class="form-control input-sm" name="amount_of_lc_margin" ng-model="amount_of_lc_margin" value="<% amount_of_lc_margin = bdt_amount * (percent_of_lc_margin/100) %>" readonly></td>
                                                            <td><input type="number" class="form-control input-sm" name="round_amount_of_lc_margin" ng-model="round_amount_of_lc_margin"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>02</td>
                                                            <td>LC Commision</td>
                                                            <td>{{ Form::number('percent_of_lc_commision', null, ['class'=>'form-control input-sm', 'ng-model'=>'percent_of_lc_commision']) }}</td>
                                                            <td><input type="number" class="form-control input-sm" name="amount_of_lc_commision" ng-model="amount_of_lc_commision" value="<% amount_of_lc_commision = bdt_amount * (percent_of_lc_commision/100) %>" readonly></td>
                                                            <td><input type="number" class="form-control input-sm" name="round_amount_of_lc_commision" ng-model="round_amount_of_lc_commision" ></td>
                                                        </tr>
                                                        <tr>
                                                            <td>03</td>
                                                            <td>VAT</td>
                                                            <td>
                                                                {{ Form::number('percent_of_vat', null, ['class'=>'form-control input-sm', 'ng-model'=>'percent_of_vat']) }}
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control input-sm" name="amount_of_vat" ng-model="amount_of_vat" value="<% amount_of_vat = amount_of_lc_commision * (percent_of_vat/100) %>" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control input-sm" name="round_amount_of_vat" ng-model="round_amount_of_vat">
                                                            </td>

                                                        </tr>

                                                        <tr ng-repeat="other in others">
                                                            <td scope="row">0<% $index+4 %></td>
                                                            <td>
                                                                <input type="hidden" name="others[<% $index %>][id]" value="<% other.id %>">
                                                                <input type="hidden" name="others[<% $index %>][name]" value="<% other.name %>">
                                                                <% other.name %>
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control input-sm" name="others[<% $index %>][percentage]" ng-model="other.percentage"/>
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control input-sm" name="others[<% $index %>][amount]" ng-model="other.amount"/>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control input-sm" name="others[<% $index %>][round_figure]" ng-model="other.round_figure"/>
                                                                    <span class="input-group-btn">
                                                                        <button type="button" class="btn btn-default btn-sm" ng-click="remove($index)">
                                                                            <span class="fa fa-times fa-lg text-danger"></span>
                                                                        </button>
                                                                    </span>
                                                                </div>

                                                            </td>
        {{--                                                     <td class="text-center">
                                                                <a href="" class="btn btn-danger btn-xs" ng-click="remove($index)">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </td> --}}
                                                        </tr>
        {{--                                                 <tr>
                                                            <td>04</td>
                                                            <td>SWIFT</td>
                                                            <td>{{ Form::number('percent_of_swift', null, ['class'=>'form-control input-sm', 'ng-model'=>'percent_of_swift', 'ng-init'=>"percent_of_swift = 0"]) }}</td>
                                                            <td><input type="number" class="form-control input-sm" name="amount_of_swift" ng-model="amount_of_swift" ng-init="amount_of_swift = 0"></td>
                                                            <td><input type="number" class="form-control input-sm" name="round_amount_of_swift" ng-model="round_amount_of_swift" ng-init="round_amount_of_swift = 0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>05</td>
                                                            <td>Stamp Charge</td>
                                                            <td>{{ Form::number('percent_of_stamp_charge', null, ['class'=>'form-control input-sm', 'ng-model'=>'percent_of_stamp_charge', 'ng-init'=>"percent_of_stamp_charge = 0"]) }}</td>
                                                            <td><input type="number" class="form-control input-sm" name="amount_of_stamp_charge" ng-model="amount_of_stamp_charge" ng-init="amount_of_stamp_charge = 0"></td>
                                                            <td><input type="number" class="form-control input-sm" name="round_amount_of_stamp_charge" ng-model="round_amount_of_stamp_charge" ng-init="round_amount_of_stamp_charge = 0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>06</td>
                                                            <td>LCAF Issue Charge</td>
                                                            <td>{{ Form::number('percent_of_lcaf_issue_charge', null, ['class'=>'form-control input-sm', 'ng-model'=>'percent_of_lcaf_issue_charge', 'ng-init'=>"percent_of_lcaf_issue_charge = 0"]) }}</td>
                                                            <td><input type="number" class="form-control input-sm" name="amount_of_lcaf_issue_charge" ng-model="amount_of_lcaf_issue_charge" ng-init="amount_of_lcaf_issue_charge = 0"></td>
                                                            <td><input type="number" class="form-control input-sm" name="round_amount_of_lcaf_issue_charge" ng-model="round_amount_of_lcaf_issue_charge" ng-init="round_amount_of_lcaf_issue_charge = 0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>07</td>
                                                            <td>IMP</td>
                                                            <td>{{ Form::number('percent_of_imp', null, ['class'=>'form-control input-sm', 'ng-model'=>'percent_of_imp', 'ng-init'=>"percent_of_imp = 0"]) }}</td>
                                                            <td><input type="number" class="form-control input-sm" name="amount_of_imp" ng-model="amount_of_imp" ng-init="amount_of_imp = 0"></td>
                                                            <td><input type="number" class="form-control input-sm" name="round_amount_of_imp" ng-model="round_amount_of_imp" ng-init="round_amount_of_imp = 0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>08</td>
                                                            <td>LC Application Form</td>
                                                            <td>{{ Form::number('percent_of_lc_application_form', null, ['class'=>'form-control input-sm', 'ng-model'=>'percent_of_lc_application_form', 'ng-init'=>"percent_of_lc_application_form = 0"]) }}</td>
                                                            <td><input type="number" class="form-control input-sm" name="amount_of_lc_application_form" ng-model="amount_of_lc_application_form" ng-init="amount_of_lc_application_form = 0"></td>
                                                            <td><input type="number" class="form-control input-sm" name="round_amount_of_lc_application_form" ng-model="round_amount_of_lc_application_form" ng-init="round_amount_of_lc_application_form = 0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>09</td>
                                                            <td>Other Charge(If any)</td>
                                                            <td>{{ Form::number('percent_of_others', null, ['class'=>'form-control input-sm', 'ng-model'=>'percent_of_others', 'ng-init'=>"percent_of_others = 0"]) }}</td>
                                                            <td><input type="number" class="form-control input-sm" name="amount_of_others" ng-model="amount_of_others" ng-init="amount_of_others = 0"></td>
                                                            <td><input type="number" class="form-control input-sm" name="round_amount_of_others" ng-model="round_amount_of_others" ng-init="round_amount_of_others = 0"></td>
                                                        </tr> --}}
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="3">Total</td>
                                                            <td class="text-right"><% get_total_amount() %></td>
                                                            <td class="text-right"><% get_total_amount_round() %></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12">

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Save</button>
                                        <a class="btn btn-default" href="{{ route('cost-sheet.index') }}">Cancel</a>
                                    </div>
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

    var app=angular.module('myApp', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    var parseNum=function(value=0){
        value=parseFloat(value);
        if(isNaN(value)) return 0;
        return value;
    }

    app.controller('myCtrl', function($scope, $http) {

        $scope.letter_of_credit_id='{{ old('letter_of_credit_id') }}';
        $scope.others={!! old('others')?collect(old('others'))->toJson():'[]' !!};
        $scope.amount_of_lc_margin=0;
        $scope.amount_of_lc_commision=0;
        $scope.amount_of_vat=0;
        $scope.bdt_amount=0;
        $scope.exchange_rate={{ old('exchange_rate') ?? 0}};
        $scope.cost_particulars={!! $cost_particulars_array->toJson() !!};

        $scope.percent_of_lc_margin={{ old('percent_of_lc_margin') ?? 0 }};
        $scope.round_amount_of_lc_margin={{ old('round_amount_of_lc_margin') ?? 0 }};
        $scope.percent_of_lc_commision={{ old('percent_of_lc_commision') ?? 0 }};
        $scope.round_amount_of_lc_commision={{ old('round_amount_of_lc_commision') ?? 0 }};
        $scope.percent_of_vat={{ old('percent_of_vat') ?? 0 }};
        $scope.round_amount_of_vat={{ old('round_amount_of_vat') ?? 0 }};

        $scope.cost_particular={
            id:'',
            name:'',
            percentage:'',
            amount:''
        };

        $scope.getLcDetails = function(id){

            if(id){

                $http.get("{{ url('get-lc') }}/" + id).then(function(response){

                    $scope.letter_of_credit_date = response.data.letter_of_credit_date;
                    $scope.letter_of_credit_value = parseNum(response.data.letter_of_credit_value);
                    $scope.issue_ac_no = response.data.issue_ac_no;
                    $scope.issue_ac_name = response.data.issue_ac_name;
                    $scope.issue_bank_name = response.data.issue_bank_name;
                    $scope.issue_branch_name = response.data.issue_branch_name;

                });

            }

            $scope.amount_in_bdt = function () {
                var total = 0;
                total = parseNum($scope.letter_of_credit_value) * parseNum($scope.exchange_rate);
                $scope.bdt_amount = total;
                return $scope.bdt_amount;
            }
        }

        $scope.getLc = function () {
            $scope.getLcDetails($scope.letter_of_credit_id);
        }

        $scope.getLc();

        //$scope.getLc();
        /*$scope.get_total_amount = function () {
            var total = 0;
            total = $scope.amount_of_lc_margin + $scope.amount_of_lc_commision + $scope.amount_of_vat + $scope.amount_of_swift + $scope.amount_of_stamp_charge + $scope.amount_of_lcaf_issue_charge + $scope.amount_of_imp + $scope.amount_of_lc_application_form + $scope.amount_of_others;
            return total;
        }*/

        $scope.get_total_amount = function () {
            var total = 0;
            total = parseNum($scope.amount_of_lc_margin) + parseNum($scope.amount_of_lc_commision) + parseNum($scope.amount_of_vat);

            var others_total_amount=0.00;

            $scope.others.forEach(function(row){
                if(row.amount) others_total_amount+=parseNum(row.amount);
            });

            return total+others_total_amount;
        }

        /*
        $scope.get_total_amount_round = function () {
            var total = 0;
            total = $scope.round_amount_of_lc_margin + $scope.round_amount_of_lc_commision + $scope.round_amount_of_vat + $scope.round_amount_of_swift + $scope.round_amount_of_stamp_charge + $scope.round_amount_of_lcaf_issue_charge + $scope.round_amount_of_imp + $scope.round_amount_of_lc_application_form + $scope.round_amount_of_others;
            return total;
        }
        */

        $scope.get_total_amount_round = function () {
            var total = 0;
            total = parseNum($scope.round_amount_of_lc_margin + $scope.round_amount_of_lc_commision + $scope.round_amount_of_vat);

            var others_round_amount=0.00;

            $scope.others.forEach(function(row){
                if(row.round_figure) others_round_amount+=parseNum(row.round_figure);
            });

            return total+others_round_amount;
        }

        $scope.addParticular=function(){


            $scope.cost_particulars.forEach(function(row){
                if(row.id==$scope.cost_particular.id){
                    $scope.cost_particular.name=row.name;
                    //break;
                }
            });

            if(!$scope.cost_particular.id){
                $scope.warning('Please select a particular first');
                return;
            }


            var exists=false;
            var other={};


            $scope.others.forEach(function(row){

                if(row.id==$scope.cost_particular.id) exists=true;

            });


            if(exists){

                $scope.warning('This particular cost already exists.');

            }else{

                other.id=$scope.cost_particular.id;
                other.name=$scope.cost_particular.name;
                other.percentage=$scope.cost_particular.percentage;
                other.amount=$scope.cost_particular.amount;
                other.round_figure=0;
                $scope.others.push(other);

                $scope.cost_particular={
                    id:'',
                    name:'',
                    percentage:'',
                    amount:''
                };

            }

            //console.log($scope.others);

        }

        $scope.remove = function(index){
            $scope.others.splice(index,1);
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

    });
</script>
@endsection
