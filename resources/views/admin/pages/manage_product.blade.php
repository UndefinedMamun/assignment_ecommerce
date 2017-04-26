@extends('admin.admin')
@section('main_content')


<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="index.html">Home</a> 
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="#">Manage Product</a></li>
</ul>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>Manage Product</h2>
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
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Publication Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>   
                <tbody>
                    @foreach($all_product as $v_product)
                    <tr>
                        <td><img src="{{asset($v_product->product_image)}}" width="100" height="100"></td>
                        <td class="center">{{$v_product->product_name}}</td>
                        
                        <td class="center">
                            <?php
                            if($v_product->publication_status == 1){
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
                            if($v_product->publication_status == 1){
                            ?>
                            <a class="btn btn-danger" href="{{url('/unpublished-product/'.$v_product->product_id)}}">
                                <i class="halflings-icon white thumbs-down"></i>  
                            </a>
                            <?php
                            }
                            else{
                            ?>
                            <a class="btn btn-success" href="{{url('/published-product/'.$v_product->product_id)}}">
                                <i class="halflings-icon white thumbs-up"></i>  
                            </a>
                            <?php }?>
                            <a class="btn btn-info" href="{{url('/edit-product/'.$v_product->product_id)}}">
                                <i class="halflings-icon white edit"></i>  
                            </a>
                            <a class="btn btn-danger" href="{{url('/delete-product/'.$v_product->product_id)}}" onclick="return confirm('Are you sure !!')">
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

