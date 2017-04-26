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
        <a href="{{url('/edit-manufacturer/'.$manufacturer_info->manufacturer_id)}}">Edit Manufacturer</a>
    </li>
</ul>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Form Elements</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <h2 style="color:green;"><?php
                $message = Session::get('message');
                if($message){
                    echo $message;
                    Session::put('message','');
                }
            ?></h2>
            {!! Form::open(['url'=>'/update-manufacturer', 'method'=>'POST', 'name'=>'edit_manufacturer_form','enctype'=>'multipart/form-data', 'class'=>'form-horizontal']) !!}
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Manufacturer Name </label>
                        <div class="controls">
                            <input type="text" value="{{$manufacturer_info->manufacturer_name}}" class="span6 typeahead" name="manufacturer_name" id="typeahead"  />
                            <input type="hidden" value="{{$manufacturer_info->manufacturer_id}}" class="span6 typeahead" name="manufacturer_id" id="typeahead"  />
                            
                        </div>
                    </div>
                         
                    <div class="control-group hidden-phone">
                        <label class="control-label" for="textarea2">Manufacturer Description</label>
                        <div class="controls">
                            <textarea class="cleditor" id="textarea2" name="manufacturer_description" rows="3">{{$manufacturer_info->manufacturer_description}}</textarea>
                        </div>
                    </div>
                    <div class="control-group hidden-phone">
                        <label class="control-label" for="textarea2">Manufacturer Image</label>
                        <div class="controls">
                            <input type="file" class="span6 typeahead" name="manufacturer_image" id="typeahead"  />
                            <img src="{{asset($manufacturer_info->manufacturer_image)}}" width="100" height="100">
                            <input type="hidden" name="manufacturer_old_image_path" value="{{$manufacturer_info->manufacturer_image}}">
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
                        <button type="submit" class="btn btn-primary">Update Manufacturer</button>
                        <button type="reset" class="btn">Reset</button>
                    </div>
                </fieldset>
            {!! Form::close() !!}   

        </div>
    </div><!--/span-->

</div>
<script>
    document.forms['edit_manufacturer_form'].elements['publication_status'].value = {{$manufacturer_info->publication_status}};
</script>

@endsection
