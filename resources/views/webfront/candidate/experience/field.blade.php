<div class="row" style="background-color: #ECF0F1;">

    <div id="edu_details" class="col-md-12 aug_group">
        <div class="form-group aug_legend"> Experience Details :</div>
        <div class="col-md-12"></div>
        <div class="row _details">
            <div class="form-group col-md-4">
                <label for="employers_name" class="control-label">Employer's Name :</label>
                {!! Form::text('employers_name[]', '', ['id'=>'employers_name', 'class' => 'form-control', 'required']) !!}
            </div>
            <div class="form-group col-md-4">
                <label for="post_held" class="control-label">Position Held :</label>
                {!! Form::text('post_held[]', '', ['id'=>'post_held', 'class' => 'form-control', 'required']) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="year_experience" class="control-label">Years of Experience :</label>
                {!! Form::number('year_experience[]', '', ['maxlength'=>'3', 'id'=>'year_experience', 'class' => 'form-control', 'required']) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="salary" class="control-label">Salary :</label>
                {!! Form::number('salary[]', '', ['id' =>'salary_drawn', 'class' => 'form-control', 'required']) !!}
            </div>
            <div class="form-group col-md-4">
                <label for="experience_id" class="control-label">Exp Type :</label>
                {!! Form::select('experience_id[]', $subjects, '', ['class'=>'form-control', 'required']) !!}
            </div>
            <div class="form-group col-md-4">
                <label for="percentage" class="control-label">Sector :</label>
                {!! Form::select('industry_id[]', $sectors, '', ['class'=>'form-control', 'required']) !!}
            </div>

        </div>
    </div>

    <div class="form-group">
        <button id="add" class="btn btn-sm" type="button"><i class="fa fa-plus"></i> Add New
        </button>
        <button id="minus" class="btn btn-sm" type="button"><i class="fa fa-minus"></i> Remove
        </button>
    </div>

    <div class="form-group col-sm-12 text-center" style="margin-top:40px;">
        <button class="my_button"> Save and Proceed to Next Step >></button>
    </div>
</div>