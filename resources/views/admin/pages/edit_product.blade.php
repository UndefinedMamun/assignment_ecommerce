@extends('admin.admin')
@section('main_content')

<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="index.html">Home</a>
        <i class="icon-angle-right"></i> 
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">Add Product</a>
    </li>
</ul>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Product</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <h2 style="color:green"><?php
                $message = Session::get('message');
                if($message){
                    echo $message;
                    Session::put('message','');
                }
            ?></h2>
            {!! Form::open(['url'=>'/update-product','name'=>'edit_product_form','class'=>'form-horizontal', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Product Name </label>
                        <div class="controls">
                            <input type="text" value="{{$product_info->product_name}}" class="span6 typeahead" name="product_name" id="typeahead"  />
                            <input type="hidden" value="{{$product_info->product_id}}" class="span6 typeahead" name="product_id" id="typeahead"  />
                            
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Category Name </label>
                        <div class="controls">
                            <select id="selectError3" name="category_id">
                                <option>Select Category</option>
                                @foreach($all_published_category as $v_category)
                                <option value="{{$v_category->category_id}}">{{$v_category->category_name}}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Manufacturer Name </label>
                        <div class="controls">
                            <select id="selectError3" name="manufacturer_id">
                                <option>Select Manufacturer</option>
                                @foreach($all_published_manufacturer as $v_manufacturer)
                                <option value="{{$v_manufacturer->manufacturer_id}}">{{$v_manufacturer->manufacturer_name}}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Product Old Price </label>
                        <div class="controls">
                            <input type="text" value="{{$product_info->product_old_price}}" class="span6 typeahead" name="product_old_price" id="typeahead"  />
                            
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Product New Price </label>
                        <div class="controls">
                            <input type="text" value="{{$product_info->product_new_price}}" class="span6 typeahead" name="product_new_price" id="typeahead"  />
                            
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Product Quantity</label>
                        <div class="controls">
                            <input type="number" value="{{$product_info->product_quantity}}" class="span6 typeahead" name="product_quantity" id="typeahead"  />
                            
                        </div>
                    </div>
                    <div class="control-group hidden-phone">
                        <label class="control-label" for="textarea2">Product Short Description</label>
                        <div class="controls">
                            <textarea class="cleditor" id="textarea2" name="product_short_description" rows="3">{{$product_info->product_short_description}}</textarea>
                        </div>
                    </div>
                    <div class="control-group hidden-phone">
                        <label class="control-label" for="textarea2">Product Long Description</label>
                        <div class="controls">
                            <textarea class="cleditor" id="textarea2" name="product_long_description" rows="3">{{$product_info->product_long_description}}</textarea>
                        </div>
                    </div>
                    <div class="control-group hidden-phone">
                        <label class="control-label" for="textarea2">Product Image</label>
                        <div class="controls">
                            <input type="file" name="product_image">
                            <img src="{{asset($product_info->product_image)}}" width="100" height="100">
                            <input type="hidden" name="product_old_image_path" value="{{$product_info->product_image}}">
                        </div>
                    </div>
                    <div class="control-group hidden-phone">
                        <label class="control-label" for="textarea2">Is Featured</label>
                        <div class="controls">
                            <input type="checkbox" class="span6 typeahead" name="is_featured" id="typeahead"/> Featured
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="selectError3">Publication Status</label>
                        <div class="controls">
                            <select id="selectError3" name="publication_status">
                                <option>Select From Here</option>
                                <option value="0">Unpublished</option>
                                <option value="1" >Published</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Update Product</button>
                        <button type="reset" class="btn">Reset</button>
                    </div>
                </fieldset>
            {!! Form::close() !!} 

        </div>
    </div><!--/span-->

</div>
<script>
    document.forms['edit_product_form'].elements['manufacturer_id'].value = {{$product_info->manufacturer_id}};
    document.forms['edit_product_form'].elements['category_id'].value = {{$product_info->category_id}};
    document.forms['edit_product_form'].elements['publication_status'].value = {{$product_info->publication_status}};
</script>

@endsection
