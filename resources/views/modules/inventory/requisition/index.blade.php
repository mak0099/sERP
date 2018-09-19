@extends('layout')
@section('title', 'Working Unit')
@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Inventory</h3>
    </div>
</div>
<div class="clearfix"></div>
{{-- Content here --}}

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Inventory Requisition <small>List</small></h2>
                {!! btnAddNew(['url'=>route('requisition.create')]) !!}
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <br/>
            {{-- Main content area --}}
            @include('partials.paginate_header')
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr class='primary'>
                            <th>Requisition No</th>
                            <th>Type</th>
                            <th>Sender</th>
                            <th>Requested To</th>
                            <th>Item Status</th>
                            <th>Initial Approver</th>
                            <th>Final Approver</th>
                            <th>Remarks</th>
                            <th>Requisition Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($paginate->table as $row)
                        <tr>
                            <td>{{ $row->inventory_requisition_id }}</td>
                            <td>{{ $row->type->name }}</td>
                            <td>{{ $row->sender->name }}</td>
                            <td>{{ $row->requested_to->name }}</td>
                            <td>{{ $row->item_status->name }}</td>
                            <td>{{ $row->initial_approver->name }}</td>
                            <td>
                            @if($row->final_approver()->exists())
								{{ $row->initial_approver->name }}
                            @else
                            	{!! btnCustom(['title'=>'Final Submit', 'url'=>route('requisition.edit', ['requisition'=>$row->id]), 'btnClass'=>'btn btn-default btn-sm btn-block']) !!}
                            @endif
                        	</td>
                            <td>{{ $row->remarks ?? 'Not Specified' }}</td>
                            <td>{{ $carbon->parse($row->date)->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @include('partials.paginate_footer')
            {{-- End of Main content area --}}
           </div>
       </div>
   </div>
</div>


{{-- Content end --}}
</div>
</div>
@endsection