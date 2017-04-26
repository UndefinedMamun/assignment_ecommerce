@extends('admin.admin')
@section('main_content')


<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="index.html">Home</a> 
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="#">Manage Manufacturer</a></li>
</ul>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Manufacturer Image</th>
                        <th>Manufacturer Name</th>
                        <th>Manufacturer Description</th>
                        <th>Publication Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>   
                <tbody>
                    @foreach($all_manufacturer as $v_manufacturer)
                    <tr>
                        <td><img src="{{asset($v_manufacturer->manufacturer_image)}}" width="100" height="100"></td>
                        <td class="center">{{$v_manufacturer->manufacturer_name}}</td>
                        <td class="center">{{$v_manufacturer->manufacturer_description}}</td>
                        <td class="center">
                            <?php
                            if($v_manufacturer->publication_status == 1){
                            ?>
                            <span class="label label-success">Published</span>
                            <?php
                            }
                            else{
                            ?>
                            <span class="label label-important">Unublished</span>
                            <?php } ?>
                        </td>
                        <td class="center">
                            <?php
                            if($v_manufacturer->publication_status == 1){
                            ?>
                            <a class="btn btn-danger" href="{{url('/unpublished-manufacturer/'.$v_manufacturer->manufacturer_id)}}">
                                <i class="halflings-icon white thumbs-down"></i>  
                            </a>
                            <?php
                            }
                            else{
                            ?>
                            <a class="btn btn-success" href="{{url('/published-manufacturer/'.$v_manufacturer->manufacturer_id)}}">
                                <i class="halflings-icon white thumbs-up"></i>  
                            </a>
                            <?php }?>
                            <a class="btn btn-info" href="{{url('/edit-manufacturer/'.$v_manufacturer->manufacturer_id)}}">
                                <i class="halflings-icon white edit"></i>  
                            </a>
                            <a class="btn btn-danger" href="{{url('/delete-manufacturer/'.$v_manufacturer->manufacturer_id)}}" onclick="return confirm('Are you sure !!')">
                                <i class="halflings-icon white trash"></i> 
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>            
        </div>
    </div><!--/span-->

</div>

@endsection