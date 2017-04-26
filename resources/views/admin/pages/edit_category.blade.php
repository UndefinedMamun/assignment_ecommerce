@extends('admin.admin')
@section('main_content')

<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="{{url('/dashboard')}}">Home</a>
        <i class="icon-angle-right"></i> 
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="{{url('/edit-category')}}">Edit Category</a>
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
                $message=Session::get('message');
                if($message){
                    echo $message;
                    Session::put('message','');
                }
            ?></h2>
            {!! Form::open(['url'=>'/update-category', 'method'=>'POST','name'=>'edit_category_form', 'class'=>'form-horizontal']) !!}    
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Category Name </label>
                        <div class="controls">
                            <input type="text" class="span6 typeahead" name="category_name" id="typeahead" value="{{$category_info->category_name}}" />
                            <input type="hidden" class="span6 typeahead" name="category_id" id="typeahead" value="{{$category_info->category_id}}" />

                        </div>
                    </div>

                    <div class="control-group hidden-phone">
                        <label class="control-label" for="textarea2">Category Description</label>
                        <div class="controls">
                            <textarea class="cleditor" id="textarea2" name="category_description" rows="3">{{$category_info->category_description}}</textarea>
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
                        <button type="submit" class="btn btn-primary">Update Category</button>
                        <button type="reset" class="btn">Reset</button>
                    </div>
                </fieldset>
            {!! Form::close() !!}   

        </div>
    </div><!--/span-->

</div>

<script>
    document.forms['edit_category_form'].elements['publication_status'].value = {{$category_info->publication_status}};
</script>


@endsection
