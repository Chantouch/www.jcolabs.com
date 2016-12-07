<div class="job-finder">
    <div class="container">
        <h3>Find a Job</h3>
        {!! Form::open(array('route' => 'job.search', 'role'=>'search', 'method' => 'GET')) !!}
        <div class="col-md-7 form-group group-1">
            <label for="name" class="label">Job Title</label>
            {!! Form::text('name', null, ['class' => 'input-job', 'placeholder' => 'Keywords (IT Engineer, Shop Manager, Hr Manager...)', 'id' => 'name']) !!}
        </div>
        <div class="col-md-5 form-group group-2">
            <label for="search-city" class="label">Job Location</label>
            {!! Form::select('city', $city_list, null, ['class' => 'cs-select cs-skin-elastic', 'id' => 'city', 'placeholder' => 'Select city']) !!}
            {{--<select class="cs-select cs-skin-elastic" id="search-city">--}}
            {{--<option value="" disabled selected>Select a Country</option>--}}
            {{--<option value="france" data-class="flag-france">France</option>--}}
            {{--<option value="brazil" data-class="flag-brazil">Brazil</option>--}}
            {{--<option value="argentina" data-class="flag-argentina">Argentina</option>--}}
            {{--<option value="south-africa" data-class="flag-safrica">South Africa</option>--}}
            {{--</select>--}}
        </div>

        <div class="form-group">
            <label for="experiences_search" class="label clearfix">Experiences(-/+)</label>
            {{--<input id="experiences" class="value-slider" type="text" name="experiences" value="0"/>--}}
            <input type="text" id="experiences_search" name="experiences" value="" />
        </div>
        <div class="clearfix"></div>
        <br/>
        <div class="form-group">
            <label for="salary_search" class="label clearfix">Salary ($)/per month</label>
            <input id="salary_search" class="value-slider" type="text" name="salary_min" value=""/>
            <div class="clearfix"></div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                {{ Form::submit('Find Your Dream Job', array('class' => 'btn btn-default btn-green btn-search')) }}
            </div>
        </div>

        {{ Form::close() }}

    </div>
</div>