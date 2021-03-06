@extends('layout')
@section('title', 'Challan')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Challan</h2>
                    <a href="{{ route('sales-challan.index') }}" class="btn btn-sm btn-primary btn-addon pull-right"><i class="fa fa-list-ul" aria-hidden="true"></i> Challan List</a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="form-horizontal form-label-left input_mask" id='main'>


                      {{-- Product Modal --}}
                      <div class="modal fade in" id="stock_distributions" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
                         <div class="modal-dialog">
                            <div class="modal-content">
                               <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h4 class="modal-title" id="myModalLabel">
                                     Booked Product For Challan
                                  </h4>
                               </div>
                               <div class="modal-body" style="height: 75vh; overflow-y: auto">
                                <div class="table-responsive m-t-20">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Depot Name</th>
                                            <th>Stock Quantity</th>
                                            <th>Booking Quantity</th>
                                        </tr>
                                        <tr v-for="(row, index) in stock_distributions">
                                          <td v-html='row.name'></td>
                                          <td v-html='row.stock_quantity'></td>
                                          <td>
                                              <div class="form-group">
                                                  <input type="number" class="input-sm form-control" v-model="row.booking_quantity" v-on:change="calculate_distribution(index)">
                                              </div>
                                          </td>
                                        </tr>
                                         <tr>
                                             <td colspan="3">
                                                <button type="button" class="btn btn-default btn-sm pull-right" v-on:click="combine_distribution">
                                                  <i class="fa fa-flag fa-lg text-primary" aria-hidden="true"></i> Submit
                                                </button>
                                             </td>
                                         </tr>
                                    </table>
                                </div>
                               </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                      </div><!-- /.modal -->


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
                                <div class="form-group " v-bind:class="{ 'has-error': errors.customer_id }">
                                    <label for="customer_id" class="control-label">Customer</label>
                                    <select class="form-control input-sm bSelect" id="customer_id" name="customer_id" v-model="field.customer_id" v-on:change="fetch_sales_orders">
                                          <option v-for="(customer, index) in resource.customers.data" v-bind:value="customer.id" v-html="customer.name"></option>
                                    </select>
                                    <span
                                        class="help-block"
                                        v-for="row in errors.customer_id"
                                        v-html="row"
                                    ></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group" v-bind:class="{ 'has-error': errors.sales_orders }">
                                    <label for="sales_orders[]" class="control-label">Sales Orders</label>
                                    <select class="form-control input-sm bSelect" id="sales_orders" name="sales_orders" v-model="field.sales_orders" v-on:change="update_sales_order_list" multiple data-max-options="1">
                                        <option v-for="(row, index) in resource.sales_orders" v-bind:value="row.id" v-html="row.sales_order_no"></option>
                                    </select>
                                    <span
                                        class="help-block"
                                        v-for="row in errors.sales_orders"
                                        v-html="row"
                                    ></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group" v-bind:class="{ 'has-error': errors.challan_date }">
                                    <label for="challan_date" class="control-label">Challan Date</label>
                                    <vuejs-datepicker v-model="field.challan_date" input-class="form-control input-sm"></vuejs-datepicker>
                                    <span
                                        class="help-block"
                                        v-for="row in errors.challan_date"
                                        v-html="row"
                                    ></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group" v-bind:class="{ 'has-error': errors.mushak_number_id }">
                                    <label for="mushak_number_id" class="control-label">Mushak No</label>
                                    <select class="form-control input-sm bSelect" id="mushak_number_id" name="mushak_number_id" v-model="field.mushak_number_id">
                                        <option v-for="(row, index) in resource.mushak_numbers.data" v-bind:value="row.id" v-html="row.name"></option>
                                    </select>
                                    <span
                                        class="help-block"
                                        v-for="row in errors.mushak_number_id"
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
                                                        <th>Sales Order Quantity</th>
                                                        <th>Receive Quantity</th>
                                                        <th>Intransit</th>
                                                        <th>Pending</th>
                                                        <th>Challan Quantity</th>
                                                        <th>Remove</th>
                                                    </tr>
                                                </thead>
                                                <tbody v-for="(row, index) in field.sales_order_items">
                                                    <tr>
                                                        <td colspan="7" class="text-center" v-html="'Sales Order No: '+row.sales_order_no"></td>
                                                    </tr>
                                                    <tr v-for="(inner_row, inner_index) in row.items">
                                                        <td v-html="inner_row.product.name"></td>
                                                        <td v-html="inner_row.quantity"></td>
                                                        <td v-html="inner_row.receive_quantity"></td>
                                                        <td v-html="inner_row.in_transit"></td>
                                                        <td v-html="inner_row.pending"></td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input
                                                                    class="form-control input-sm"
                                                                    type="number"
                                                                    v-model="inner_row.challan_quantity"
                                                                    v-on:change="total_challan_quantity"
                                                                    readonly
                                                                />
                                                               <span class="input-group-btn">
                                                                 <button type="button" class="btn btn-default btn-sm" v-on:click="fetch_stock_distributions(index, inner_index)">
                                                                        <i class="fa fa-cubes text-primary"></i>
                                                                        Allocate
                                                                    </button>
                                                               </span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button
                                                                type="button"
                                                                class="btn btn-default btn-sm"
                                                                v-on:click="remove_order_item(index, inner_index)"
                                                            >
                                                                <i class="fa fa-times-circle fa-lg text-danger" aria-hidden="true"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="5" class="text-right">Total Challan Quantity</td>
                                                        <td v-html="field.total_challan_quantity" colspan="2"></td>
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
                sales_orders:"{{ url('api/sales/challan/orders') }}",
                delivery_persons:"{{ url('api/sales/challan/delivery-persons') }}",
                sales_order_items:"{{ url('api/sales/challan/sales-orders-items') }}",
                customer_addresses:"{{ url('api/sales/challan/customer-addresses') }}",
                stock_distributions:"{{ url('api/sales/challan/stock-distributions') }}",
                submit:"{{ route('sales-challan.store') }}"
            },
            field:{
                csrf_token: "{{ csrf_token() }}",
                customer_id:'',
                sales_orders:[],
                challan_date: moment().format('DD-MMM-YYYY'),
                mushak_number_id:'',
                delivery_person_id:'',
                delivery_vehicle:'',
                delivery_vehicles:[],
                sales_order_items:[],
                total_challan_quantity:0,
                shipping_address_id:''
            },
            resource:{
                customers:{
                    data:[{id:0, name:'--Select Customers--'}]
                },
                mushak_numbers:{
                    data:[{id:0, name:'--Select Mushak Number--'}]
                },
                delivery_vehicles:[
                    {id: 'own_vehicle', name: 'Own Vehicle'},
                    {id: 'transport_agency', name: 'Transport Agency'},
                    {id: 'customer', name: 'Customer'},
                    {id: 'others', name: 'Others'},
                ],
                sales_orders:[{id:0, name:'--Select orders--'}],
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
                customer_addresses:{
                    data:[{id:0, address:'--Select Customer Address--'}]
                }
            },
            temp:null,
            errors_msg:false,
            errors:null,
            stock_distributions:[],
            active_record:null
        },
        methods:{
            fetch_sales_orders:function(){

                var ref=this;
                var loading=$.loading();
                loading.open(3000);

                if(!ref.field.customer_id){
                    ref.alert('Please!, select a customer.');
                    loading.close();
                    return false;
                }

                ref.fetch_resource(ref.url.resource + '/customer-address', ref.resource.customer_addresses, function(){
                    ref.field.shipping_address_id='';
                    ref.resource.customer_addresses.data=ref.resource.customer_addresses.data.filter(row=>{
                        return row.customer_id==ref.field.customer_id;
                    });
                });

                axios.get(ref.url.sales_orders + '/' + ref.field.customer_id).then(function(response){

                    ref.resource.sales_orders=response.data;
                    loading.close();

                }).catch(function(){

                    loading.close();
                    ref.alert('Sorry!, failed to fetch remote data.');


                });

            },
            fetch_delivery_persons:function(){
                var ref=this;
                var loading=$.loading();
                loading.open(3000);

                axios.get(ref.url.delivery_persons).then(function(response){

                    ref.resource.delivery_persons=response.data;
                    loading.close();

                }).catch(function(){

                    loading.close();
                    ref.alert('Sorry!, failed to fetch remote data.');


                });
            },
            add_delivery_vehicle:function(){

                var ref=this;

                if(ref.field.delivery_vehicle){
                    var medium_name=ref.resource.delivery_vehicles.find(row=>{
                        return row.id==ref.field.delivery_vehicle;
                    }).name;
                }else ref.alert('Please!, select a delivary vehicle type');

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
                };

                this.field.delivery_vehicle='';

            },
            remove_delivery_vehicle:function(index){
                this.field.delivery_vehicles.splice(index, 1);
            },
            remove_order_item:function(index, inner_index){
                this.field.sales_order_items[index].items.splice(inner_index, 1);
                if(this.field.sales_order_items[index].items.length < 1){
                    this.field.sales_order_items.splice(index, 1);
                }
                this.total_challan_quantity();
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
            update_sales_order_list:function(){
                var ref=this;
                var sales_order_ids=this.field.sales_orders;

                //return console.log(sales_order_ids);

                var loading=$.loading();
                loading.open(3000);

                if(!sales_order_ids){
                    ref.alert('Please!, select a sales order.');
                    loading.close();
                    return false;
                }

                axios.get(ref.url.sales_order_items, {params: sales_order_ids}).then(function(response){

                    ref.total_challan_quantity();
                    ref.field.sales_order_items=response.data;
                    loading.close();

                }).catch(function(){

                    loading.close();
                    ref.alert('Sorry!, failed to fetch remote data.');


                });

            },
            total_challan_quantity:function(){

                var ref=this;
                ref.field.total_challan_quantity=0;
                ref.field.sales_order_items.forEach(function(row){

                    //console.log(row);
                    row.items.forEach(function(inner_row){

                        //console.log(inner_row);

                        if(ref.parse_num(inner_row.challan_quantity) > ref.parse_num(inner_row.pending)){
                            ref.alert('Sorry!, challan quantity can\'t exceed pending quantity');
                            inner_row.challan_quantity=0;
                        }

                        ref.field.total_challan_quantity+=ref.parse_num(inner_row.challan_quantity);
                    });

                });

            },
            submit:function(){

                var ref=this;

                //if(ref.field.total_challan_quantity)

                this.reset_error();

                axios({
                    method: 'post',
                    url: ref.url.submit,
                    data: ref.field,
                    config: { headers: {'Content-Type': 'multipart/form-data' }}
                }).then(function(response){

                    ref.alert(response.data, 'success');
                    window.location.replace("{{ route('sales-challan.index') }}");

                    //console.log(response);
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
                    sales_orders:false,
                    challan_date:false,
                    mushak_number_id:false,
                    delivery_person_id:false,
                    shipping_address_id:false
                }

            },
            fetch_stock_distributions:function(index, inner_index){

                //console.log(this.field.sales_order_items[index].items[inner_index]);
                var ref=this;
                ref.active_record=null;
                ref.active_record=this.field.sales_order_items[index].items[inner_index];
                var product_id=this.field.sales_order_items[index].items[inner_index].product_id;

                //return console.log(sales_order_ids);

                var loading=$.loading();
                loading.open(3000);

                axios.get(ref.url.stock_distributions+ '/' + product_id).then(function(response){

                    ref.stock_distributions=response.data;
                    loading.close();
                    $('#stock_distributions').modal('show');

                }).catch(function(){

                    loading.close();
                    ref.alert('Sorry!, failed to fetch remote data.');


                });
            },
            calculate_distribution:function(index){

                var booking_quantity=this.parse_num(this.stock_distributions[index].booking_quantity);
                var stock_quantity=this.parse_num(this.stock_distributions[index].stock_quantity);

                if(booking_quantity > stock_quantity){
                    this.alert('Sorry! booking quantity can\'t exceed stock quantity');
                    this.stock_distributions[index].booking_quantity=0;
                }

            },
            combine_distribution:function(){


                var ref=this;
                ref.active_record.challan_quantity=0;
                ref.active_record.booking_distributions=ref.stock_distributions.filter(function(row){
                    return row.booking_quantity > 0;
                });
                ref.stock_distributions.forEach(function(row){
                    ref.active_record.challan_quantity+=ref.parse_num(row.booking_quantity);
                });
                ref.total_challan_quantity();

                $('#stock_distributions').modal('hide');

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
            this.fetch_resource(this.url.resource + '/customer', this.resource.customers);
            this.fetch_resource(this.url.resource + '/mushak-number', this.resource.mushak_numbers);
            this.fetch_resource(this.url.resource + '/own-vehicle', this.resource.own_vehicles);
            this.fetch_resource(this.url.resource + '/employee-profile', this.resource.employees);
            this.fetch_resource(this.url.resource + '/vendor', this.resource.vendors);
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

    $('.bSelect').selectpicker({
        liveSearch:true,
        size:5
    });

});
</script>
@endsection