@extends('layout')
@section('title', 'Port')
@section('content')
<div class="right_col" role="main">
    <div class="">
      <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                      <h2>Port</h2>
                      <a class="btn btn-primary btn-sm pull-right" href="{{route('port.index')}}"><i class="fa fa-list-ul"></i> Port List</a>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <br />
                      @include('partials.flash_msg')
                  <form class="form-horizontal form-label-left" action="{{ route('port.store') }}" method="POST" autocomplete="off">
                      {{ csrf_field() }}
                          <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ BootForm::text('name', 'Port Name', null, ['class'=>'form-control input-sm']) }}
                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ BootForm::select('country_id', 'Country', $country_list, null, ['class'=>'form-control input-sm select2']) }}
                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ BootForm::select('city_id', 'City', $city_list, null, ['class'=>'form-control input-sm select2']) }}
                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ BootForm::text('contact_person', 'Contact Person Name', null, ['class'=>'form-control input-sm']) }}
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ BootForm::text('contact_person_number', 'Contact Person Phone Number', null, ['class'=>'form-control input-sm']) }}
                            </div>
                        </div>
                          <br>
                          <hr>
                          <div class="col-md-12">
                              <button type="submit" class="btn btn-success btn-sm">Save</button>
                              <a class="btn btn-default btn-sm" href="{{route('port.index')}}">Cancel</a>
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
