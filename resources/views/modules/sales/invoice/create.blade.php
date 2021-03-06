@extends('layout')
@section('title', 'Challan')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Sales Invoice</h2>
                    <a href="{{ route('sales-challan.index') }}" class="btn btn-sm btn-primary btn-addon pull-right"><i class="fa fa-list-ul" aria-hidden="true"></i> Invoice List</a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="form-horizontal form-label-left input_mask" id='main'>

                        <div class="row" v-show="errors_msg">
                            <div class="col-md-12">
                                    <div class="alert bg-danger text-danger">
                                        <button type="button" class="close" v-on:click="errors_msg=false"><i class="fa fa-times"></i></button>
                                        <span class="font-breeSerif">
                                            <i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i>
                                            <strong>Form submission failed!</strong>
                                        </span>
                                        <ul v-for="row in errors">
                                            <li v-for="inner_row in row" v-html="inner_row"></li>
                                        </ul>
                                    </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group " v-bind:class="{ 'has-error': errors.sales_challan_id }">
                                    <label for="sales_challan_id" class="control-label">Sales Challan</label>
                                    <select class="form-control input-sm bSelect" id="sales_challan_id" v-model="field.sales_challan_id" v-on:change="update_sales_challan">
                                          <option v-for="(row, index) in resource.sales_challans.data" v-bind:value="row.id" v-html="row.sales_challan_no"></option>
                                    </select>
                                    <span
                                        class="help-block"
                                        v-for="row in errors.sales_challan_id"
                                        v-html="row"
                                    ></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group" v-bind:class="{ 'has-error': errors.challan_date }">
                                    <label for="challan_date" class="control-label">Challan Date</label>
                                    <input type="text" class="form-control input-sm" v-model="field.challan_date" readonly/>
                                    <span
                                        class="help-block"
                                        v-for="row in errors.challan_date"
                                        v-html="row"
                                    ></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group" v-bind:class="{ 'has-error': errors.invoice_date }">
                                    <label for="invoice_date" class="control-label">Invoice Date</label>
                                    <vuejs-datepicker v-model="field.invoice_date" input-class="form-control input-sm"></vuejs-datepicker>
                                    <span
                                        class="help-block"
                                        v-for="row in errors.invoice_date"
                                        v-html="row"
                                    ></span>
                                </div>
                            </div>

                            <br>

                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>SL#</th>
                                                <th>Sales Order No</th>
                                                <th>Order Date</th>
                                                <th>Reference</th>
                                            </tr>
                                        </thead>
                                        <tbody v-for="(row, index) in resource.sales_orders.data">
                                            <tr>
                                                <td v-html="index+1"></td>
                                                <td v-html="row.sales_order_no"></td>
                                                <td v-html="dFormat(row.sales_date)"></td>
                                                <td v-html="fetch_reference(row.sales_reference_id)"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>                                    
                            </div>


                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group" v-bind:class="{ 'has-error': errors.customer_id }">
                                    <label for="customer_name" class="control-label">Customer <span class="text-danger hide">*</span></label>
                                    <input type="text" class="form-control input-sm " id="customer_name" v-model="field.customer_name" readonly/>
                                    <span
                                        class="help-block"
                                        v-for="row in errors.customer_name"
                                        v-html="row"
                                    ></span>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group" v-bind:class="{ 'has-error': errors.invoice_address_id }">
                                    <label for="invoice_address_id" class="control-label">Invoice Address</label>
                                    <select class="form-control input-sm bSelect" id="invoice_address_id" v-model="field.invoice_address_id">
                                        <option v-for="(row, index) in resource.customer_addresses.data
                                        " v-bind:value="row.id" v-html="row.address"></option>
                                    </select>
                                    <span
                                        class="help-block"
                                        v-for="row in errors.invoice_address_id"
                                        v-html="row"
                                    ></span>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group" v-bind:class="{ 'has-error': errors.gate_pass_id }">
                                    <label for="gate_pass_id" class="control-label">Gate Pass</label>
                                    <select class="form-control input-sm bSelect" id="gate_pass_id" v-model="field.gate_pass_id">
                                        <option v-for="(row, index) in resource.gate_passes.data
                                        " v-bind:value="row.id" v-html="row.name"></option>
                                    </select>
                                    <span
                                        class="help-block"
                                        v-for="row in errors.gate_pass_id"
                                        v-html="row"
                                    ></span>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group" v-bind:class="{ 'has-error': errors.shipping_address_id }">
                                    <label for="shipping_address_id" class="control-label">Shipping Address</label>
                                    <select class="form-control input-sm bSelect" id="shipping_address_id" v-model="field.shipping_address_id">
                                        <option v-for="(row, index) in resource.customer_addresses.data
                                        " v-bind:value="row.id" v-html="row.address"></option>
                                    </select>
                                    <span
                                        class="help-block"
                                        v-for="row in errors.shipping_address_id"
                                        v-html="row"
                                    ></span>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group" v-bind:class="{ 'has-error': errors.delivery_person_id }">
                                    <label for="delivery_person_id" class="control-label">Delivery Person</label>
                                    <select class="form-control input-sm bSelect" id="delivery_person_id" name="delivery_person_id" v-model="field.delivery_person_id">
                                        <option v-for="(row, index) in resource.delivery_persons" v-bind:value="row.id" v-html="row.name"></option>
                                    </select>
                                    <span
                                        class="help-block"
                                        v-for="row in errors.delivery_person_id"
                                        v-html="row"
                                    ></span>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="">Delivery Vehicle</label>
                                    <div class="input-group">

                                        <select name="delivery_vehicle" class="form-control input-sm bSelect" v-model="field.delivery_vehicle">
                                            <option v-for="(row, index) in resource.delivery_vehicles" v-bind:value="row.id" v-html="row.name"></option>
                                        </select>

                                        <span class="input-group-btn">
                                          <button class="btn btn-default" type="button" v-on:click="add_delivery_vehicle">
                                             <span class="fa fa-lg fa-plus-circle text-primary"></span>
                                          </button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Delivery Vehicles</div>
                                    <div class="panel-body">

                                        <div class="table-responsive">
                                            <table class="table table-condensed table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Delivery Medium</th>
                                                        <th>Select Vehicle</th>
                                                        <th>Vehicle No</th>
                                                        <th>Driver name</th>
                                                        <th>Phone Number</th>
                                                        <th>Remove</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(row, index) in field.delivery_vehicles">
                                                        <td v-html="row.medium_name"></td>
                                                        <td v-if="row.own_vehicle_id">
                                                            <select
                                                                class="form-control input-sm"
                                                                v-model="row.own_vehicle_id"
                                                                v-on:change="update_own_vehicle(index)"
                                                            >
                                                                <option
                                                                    v-for="(row, index) in resource.own_vehicles.data"
                                                                    v-bind:value="row.id"
                                                                    v-html="row.vehicle_no"
                                                                ></option>
                                                            </select>
                                                        </td>
                                                        <td v-else-if="row.transport_agency_id">
                                                            <select class="form-control input-sm" v-model="row.transport_agency_id">
                                                                  <option v-for="(row, index) in resource.vendors.data" v-bind:value="row.id" v-html="row.name"></option>
                                                            </select>
                                                        </td>
                                                        <td v-else></td>
                                                        <td>
                                                            <input
                                                                type="text"
                                                                name="vehicle_no"
                                                                class="form-control input-sm"
                                                                v-model="row.vehicle_no"
                                                                v-bind:readonly="row.own_vehicle_id"
                                                            />
                                                        </td>
                                                        <td>
                                                            <input
                                                                type="text"
                                                                name="driver_name"
                                                                class="form-control input-sm"
                                                                v-model="row.driver_name"
                                                                v-bind:readonly="row.own_vehicle_id"
                                                            />
                                                        </td>
                                                        <td>
                                                            <input
                                                                type="text"
                                                                name="phone_no"
                                                                class="form-control input-sm"
                                                                v-model="row.phone_no"
                                                                {{-- v-bind:readonly="row.own_vehicle_id" --}}
                                                            />
                                                        </td>
                                                        <td>
                                                            <button
                                                                type="button"
                                                                class="btn btn-default btn-sm"
                                                                v-on:click="remove_delivery_vehicle(index)"
                                                            >
                                                                <i class="fa fa-times-circle fa-lg text-danger" aria-hidden="true"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Table Of Product</div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <th>UOM</th>
                                                        <th>Challan Quantity</th>
                                                        <th>Bonus Quantity</th>
                                                        <th>Pending Bonus Quantity</th>
                                                        <th>Bonus Quantity</th>
                                                        <th>Pending Product Quantity</th>
                                                        <th>Invoice Quantity</th>
                                                        <th>Sub Total Quantity</th>
                                                        <th>Unit Price</th>
                                                        <th>Net Price</th>

                                                        <th>Discount</th>
                                                        <th>Sub total</th>
                                                        <th>Remove</th>
                                                    </tr>
                                                </thead>
                                                <tbody v-for="(row, index) in field.sales_invoice_items">
                                                    <td v-html="row.product.name"></td>
                                                    <td v-html="row.product.unit_of_measurement.name"></td>
                                                    <td v-html="row.challan_quantity"></td>
                                                    <td v-html="row.sales_order_bonus_quantity"></td>
                                                    <td v-html="row.pending_bonus_quantity"></td>
                                                    <td>
                                                        <input
                                                            class="form-control input-sm"
                                                            type="number"
                                                            v-model="row.bonus_quantity"
                                                            v-on:change="check_bonus_quantity(index)"
                                                            min='0'
                                                        />
                                                    </td>
                                                    <td v-html="row.pending_product_quantity"></td>
                                                    <td>
                                                        <input
                                                            class="form-control input-sm"
                                                            type="number"
                                                            v-model="row.invoice_quantity"
                                                            v-on:change="check_invoice_quantity(index)"
                                                            min='0'
                                                        />
                                                    </td>
                                                    <td v-html="sub_total_quantity(index)"></td>
                                                    <td v-html="row.unit_price"></td>
                                                    <td v-html="net_price(index)"></td>
                                                    <td v-html="row.discount_amount"></td>
                                                    <td v-html="sub_total(index)"></td>
                                                    <td>
                                                        <button
                                                            type="button"
                                                            class="btn btn-default btn-sm"
                                                            v-on:click="remove_invoice_item(index)"
                                                        >
                                                            <i class="fa fa-times-circle fa-lg text-danger" aria-hidden="true"></i>
                                                        </button>
                                                    </td>
                                                </tbody>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="12" class="text-right">Total Quantity</td>
                                                        <td colspan="2" v-html="field.total_quantity"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="12" class="text-right">Total Amount</td>
                                                        <td colspan="2" v-html="field.total_amount"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="12" class="text-right">Total Vat</td>
                                                        <td colspan="2" v-html="field.total_vat"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="12" class="text-right">Total Discount</td>
                                                        <td colspan="2" v-html="field.total_discount"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="12" class="text-right">Extra Discount</td>
                                                        <td colspan="2" v-html="field.extra_discount"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="12" class="text-right">Grand Total</td>
                                                        <td colspan="2" v-html="field.grand_total"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="12" class="text-right">Invoiced Amount</td>
                                                        <td colspan="2" v-html="field.invoiced_amount"></td>
                                                   </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    {{-- {!! btnSubmitGroup() !!} --}}
                                    <button type="button" class="btn btn-sm btn-success" v-on:click="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(function(){
    //Vue.component('v-select', VueSelect.VueSelect);
    var vue=new Vue({
        mixins: [custom],
        el: '#main',
        components:{
            vuejsDatepicker
        },
        data:{
            url:{
                resource:"{{ url('api/resource') }}",
                delivery_persons:"{{ url('api/sales/challan/delivery-persons') }}",
                sales_challan_items:"{{ url('api/sales/invoice/sales-challan-items') }}",
                customer_addresses:"{{ url('api/sales/challan/customer-addresses') }}",
                submit:"{{ route('sales-invoice.store') }}",
                sales_challan_vehicles:"{{ url('api/sales/invoice/sales-challan-vehicles') }}",
                invoiced_amount:"{{ url('api/sales/invoice/invoiced-amount') }}"
            },
            field:{
                sales_challan_id:'',
                csrf_token: "{{ csrf_token() }}",
                customer_name:'',
                customer_id:'',
                challan_date: '',
                invoice_date: moment().format('DD MMM YYYY'),
                gate_pass_id:'',
                delivery_person_id:'',
                delivery_vehicle:'',
                delivery_vehicles:[],
                sales_invoice_items:[],
                shipping_address_id:'',
                invoice_address_id:'',
                total_quantity:0,
                total_amount:0,
                total_vat:0,
                total_discount:0,
                extra_discount:0,
                grand_total:0,
                invoiced_amount:0
            },
            resource:{
                sales_challans:{
                    data:[{id:0, name:'--Select Customers--'}]
                },
                delivery_vehicles:[
                    {id: 'own_vehicle', name: 'Own Vehicle'},
                    {id: 'transport_agency', name: 'Transport Agency'},
                    {id: 'customer', name: 'Customer'},
                    {id: 'others', name: 'Others'},
                ],
                sales_orders:{
                    data:[]
                },
                delivery_persons:[{id:0, name:'--Select Delivery Persons--'}],
                own_vehicles:{
                    data:[{id:0, vehicle_no:'--Select Own Vehicle--'}]
                },
                employees:{
                    data:[{id:0, name:'--Select Employee--'}]
                },
                vendors:{
                    data:[{id:0, name:'--Select Transport Agency--'}]
                },
                customers:{
                    data:[{id:0, name:'--Select Customer--'}]
                },
                customer_addresses:{
                    data:[{id:0, address:'--Select Customer Address--'}]
                },
                gate_passes:{
                    data:[{id:0, name:'--Select Gate Pass--'}]
                }
            },
            temp:null,
            errors_msg:false,
            errors:null
        },
        methods:{
            update_sales_challan:function(){

                var ref=this;

                if(!ref.field.sales_challan_id){
                    ref.alert('Please!, select a challan.');
                    return false;
                }

                var selected_challan=this.resource.sales_challans.data.find(row=>{
                    return row.id==this.field.sales_challan_id;
                });

                //console.log(selected_challan);

                this.resource.sales_orders.data=selected_challan.sales_orders;
                this.field.challan_date=moment(selected_challan.challan_date).format('DD MMM YYYY');

                var related_customer=this.resource.customers.data.find(row=>{
                    return row.id==selected_challan.customer_id;
                });

                this.field.customer_id='';
                this.field.customer_name='';

                this.resource.customer_addresses.data=[{id:0, address:'--Select Customer Address--'}];

                if(related_customer){

                    this.field.customer_id=related_customer.id;
                    this.field.customer_name=related_customer.name;

                    ref.fetch_resource(ref.url.resource + '/customer-address', ref.resource.customer_addresses, function(){
                        ref.field.shipping_address_id='';
                    }, {query:{customer_id:related_customer.id}});

                }else this.alert('This challan does\'t associate with any customer');

                //this.fetch_resource(this.resource + '/sales-orders', this.resource.sales_orders);

                //fetch challan delivery vehicles list
                ref.field.delivery_vehicles=[];
                this.fetch_remote(this.url.sales_challan_vehicles + '/' + selected_challan.id, function(response){
                    ref.field.delivery_vehicles=response.data;
                    ref.field.delivery_vehicles.forEach(function(row, index){
                        var medium_name=ref.resource.delivery_vehicles.find(inner_row=>{
                            return inner_row.id==row.delivery_medium;
                        }).name;
                        ref.field.delivery_vehicles[index].medium_name=medium_name;
                    });
                });

                this.fetch_remote(this.url.invoiced_amount + '/' + selected_challan.id, function(response){
                    ref.field.invoiced_amount=response.data;
                });

                this.update_sales_challan_list();

            },
            fetch_reference:function(id){
                var referer=this.resource.employees.data.find(row=>{
                    return row.id==id;
                })

                return referer.name;
            },
            fetch_delivery_persons:function(){

                var ref=this;

                ref.fetch_remote(ref.url.delivery_persons, function(response){
                    ref.resource.delivery_persons=response.data;
                });

            },
            add_delivery_vehicle:function(){

                var ref=this;

                var medium_name=ref.resource.delivery_vehicles.find(row=>{
                    return row.id==ref.field.delivery_vehicle;
                }).name;

                if(this.field.delivery_vehicle=='own_vehicle'){

                    first_own_vehicle=this.resource.own_vehicles.data[0];
                    var driver=this.resource.employees.data.find(row=>{
                        return row.id==first_own_vehicle.employee_profile_id;
                    });

                    this.field.delivery_vehicles.push({
                        medium_name: medium_name,
                        delivery_medium: ref.field.delivery_vehicle,
                        own_vehicle_id: first_own_vehicle.id,
                        vehicle_no: first_own_vehicle.vehicle_no,
                        driver_name: driver.name,
                        phone_no: ''
                    });

                }else if(this.field.delivery_vehicle=='transport_agency'){

                    this.field.delivery_vehicles.push({
                        medium_name: medium_name,
                        delivery_medium: ref.field.delivery_vehicle,
                        transport_agency_id: 1,
                        vehicle_no: '',
                        driver_name: '',
                        phone_no: ''
                    });

                }else if(this.field.delivery_vehicle=='customer'){

                    this.field.delivery_vehicles.push({
                        medium_name: medium_name,
                        delivery_medium: ref.field.delivery_vehicle,
                        vehicle_no: '',
                        driver_name: '',
                        phone_no: ''
                    });

                }else if(this.field.delivery_vehicle=='others'){

                    this.field.delivery_vehicles.push({
                        medium_name: medium_name,
                        delivery_medium: ref.field.delivery_vehicle,
                        vehicle_no: '',
                        driver_name: '',
                        phone_no: ''
                    });
                }

                this.field.delivery_vehicle='';

            },
            remove_delivery_vehicle:function(index){
                this.field.delivery_vehicles.splice(index, 1);
            },
            remove_invoice_item:function(index){
                this.field.sales_invoice_items.splice(index, 1);
                this.total();
            },
            sub_total_quantity:function(index){
                return this.parse_num(this.field.sales_invoice_items[index].invoice_quantity)+this.parse_num(this.field.sales_invoice_items[index].bonus_quantity);
            },
            net_price:function(index){
                return (this.sub_total_quantity(index) * this.parse_num(this.field.sales_invoice_items[index].unit_price))-(this.parse_num(this.field.sales_invoice_items[index].bonus_quantity) * this.parse_num(this.field.sales_invoice_items[index].unit_price));
            },
            sub_total:function(index){

                //var sub_total=this.net_price(index) - this.parse_num(this.field.sales_invoice_items[index].discount_amount);
                var sub_total=this.net_price(index);
                return sub_total < 0?0:sub_total;

            },
            total:function(){

                var items=this.field.sales_invoice_items;
                var ref=this;

                ref.field.total_amount=0;
                ref.field.total_discount=0;
                ref.field.total_quantity=0;
                ref.field.grand_total=0;
                ref.field.extra_discount=0;
                ref.field.total_vat=0;

                items.forEach(function(row, index){
                    ref.field.total_amount+=ref.sub_total(index);
                    ref.field.total_discount+=ref.parse_num(row.discount_amount);
                    ref.field.total_quantity+=ref.sub_total_quantity(index);
                });


                //Process to fetch sales order pre extra discount amount

                var total_sales_order_amount=0;
                var sales_orders={
                    data:[]
                };

                ref.fetch_resource(ref.url.resource + '/sales-order', sales_orders, function(){

                    sales_orders.data.forEach(function(row, index){

                        row.items.forEach(function(inner_row){
                            total_sales_order_amount+=((ref.parse_num(inner_row.total_quantity) * ref.parse_num(inner_row.unit_price)) - ref.parse_num(inner_row.discount));
                        });

                        total_sales_order_amount-=ref.parse_num(row.vat);

                    });

                    ref.resource.sales_orders.data.forEach(function(row, index){
                        ref.field.extra_discount=ref.parse_num(row.extra_discount);
                    });

                    if(ref.field.extra_discount && total_sales_order_amount){
                        var pre_extra_discount_total=ref.field.total_amount - ref.field.total_discount;
                        ref.field.extra_discount=((ref.field.extra_discount*pre_extra_discount_total)/total_sales_order_amount).toFixed(2);
                    }

                    ref.field.grand_total=ref.field.total_amount - ref.field.total_discount - ref.field.extra_discount - ref.field.total_vat;

                }, {
                    field: 'id',
                    where_in:ref.resource.sales_orders.data.map(row => row.id),
                    with:['items']
                });

            },
            check_bonus_quantity:function(index){

                var row=this.field.sales_invoice_items[index];

                if(this.parse_num(row.sales_order_bonus_quantity) < this.parse_num(row.bonus_quantity)){
                    this.alert('Sorry!, bonus quantity cant not exceed pending bonus quantity');
                    this.field.sales_invoice_items[index].bonus_quantity=0;
                }

                this.total();

            },
            check_invoice_quantity:function(index){

                var row=this.field.sales_invoice_items[index];

                if(this.parse_num(row.pending_product_quantity) < this.parse_num(row.invoice_quantity)){
                    this.alert('Sorry!, invoice quantity can\'t not exceed pending product quantity');
                    this.field.sales_invoice_items[index].invoice_quantity=0;
                }

                this.field.sales_invoice_items[index].discount_amount=((row.sales_order_discount*(row.invoice_quantity*row.unit_price))/(row.sales_order_quantity*row.unit_price)).toFixed(2);

                this.total();
                
            },
            update_own_vehicle:function(index){

                var own_vehicle_id=this.field.delivery_vehicles[index].own_vehicle_id;

                var own_vehicle=this.resource.own_vehicles.data.find(row=>{
                    return row.id==own_vehicle_id;
                });

                var driver=this.resource.employees.data.find(row=>{
                    return row.id==own_vehicle.employee_profile_id;
                });

                this.field.delivery_vehicles[index].driver_name=driver.name;
                this.field.delivery_vehicles[index].vehicle_no=own_vehicle.vehicle_no;

            },
            update_sales_challan_list:function(){

                var ref=this;

                if(!this.field.sales_challan_id){
                    ref.alert('Please!, select a sales challan number.');
                    loading.close();
                    return false;
                }

                ref.fetch_remote(ref.url.sales_challan_items + '/' + this.field.sales_challan_id, function(response){
                    ref.field.sales_invoice_items=response.data;
                });

            },
            submit:function(){

                var ref=this;

                this.reset_error();

                axios({
                    method: 'post',
                    url: ref.url.submit,
                    data: ref.field,
                    config: { headers: {'Content-Type': 'multipart/form-data' }}
                }).then(function(response){

                    ref.alert(response.data, 'success');
                    window.location.replace("{{ route('sales-invoice.index') }}");

                }).catch(function (error){

                    if(error.response.status==422){
                        ref.errors_msg=true;
                        ref.errors=error.response.data;                        
                    }else ref.alert('Sorry!, form submit failed internal server error.');


                });

            },
            reset_error:function(){

                this.errors_msg=false;

                this.errors={
                    customer_id:false,
                    challan_date:false,
                    delivery_person_id:false,
                    shipping_address_id:false,
                    sales_challan_id:false,
                    invoice_date:false,
                    invoice_address_id:false,
                    gate_pass_id:false
                }

            }


        },
        watch:{

            field:{
                deep:true,
                handler:function(val, oldVal){
                    
                    //if(val.field.delivery_vehicles) val.flag.add_vehicle_indication=false;
                    //else val.flag.add_vehicle_indication=true;

                }
            }

        },
        beforeMount(){
            this.fetch_resource(this.url.resource + '/sales-challan', this.resource.sales_challans, null, {with:['sales_orders']});
            //this.fetch_resource(this.url.resource + '/sales-order', this.resource.sales_orders);
            this.fetch_resource(this.url.resource + '/own-vehicle', this.resource.own_vehicles);
            this.fetch_resource(this.url.resource + '/employee-profile', this.resource.employees);
            this.fetch_resource(this.url.resource + '/vendor', this.resource.vendors);
            this.fetch_resource(this.url.resource + '/customer', this.resource.customers);
            this.fetch_resource(this.url.resource + '/gate-pass', this.resource.gate_passes);
            //this.fetch_resource(this.url.resource + '/customer-address', this.resource.customer_addresses);
            this.fetch_delivery_persons();
            this.reset_error();
            //this.resource.customers=this.temp.data;
            //this.model.customers=this.temp;
        },//End of beforeMount
        updated(){
            $('.bSelect').selectpicker('refresh');
        }//end of updated
    });//End of vue js

    //$('.datepicker').datetimepicker();

    $('.bSelect').selectpicker({
        liveSearch:true,
        size:5
    });

});
</script>
@endsection