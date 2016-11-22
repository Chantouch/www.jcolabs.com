<div class="row" style="background-color: #ECF0F1;">

    <div id="edu_details" class="col-md-12 aug_group">
        <div class="form-group aug_legend"> Education Details :</div>
        <div class="_details">
            <div class="form-group col-md-4">
                <label for="exam_id" class="control-label"> Exam Passed: </label>
                {!! Form::select('exam_id[]', $exams, null, ['class'=>'exam_id form-control', 'required']) !!}
            </div>

            <div class="form-group col-md-4">
                <label for="board_id" class="control-label"> Board/university :</label>
                {!! Form::select('board_id[]', $boards, null, ['class'=>'board_id form-control', 'required']) !!}
            </div>

            <div class="form-group col-md-4">
                <label for="subject_id" class="control-label">Subject/Trade :</label>
                {!! Form::select('subject_id[]', $subjects, null, ['class'=>'subject_id form-control', 'required']) !!}
            </div>
            <div class="form-group col-md-4">
                <label for="specialization" class="control-label">Specialization :</label>
                {!! Form::text('specialization[]', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group col-md-4">
                <label for="pass_year" class="control-label">Year of Passing :</label>
                {!! Form::selectYear('pass_year[]', 2020,1950, null, ['id'=>'pass_year', 'class' => 'form-control', 'required']) !!}
            </div>
            <div class="form-group col-md-4">
                <label for="percentage" class="control-label">% of marks :</label>
                {!! Form::text('percentage[]', null, ['class'=>'form-control', 'required']) !!}
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