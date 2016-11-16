@if($employers->count())
    <table class="table table-hover">
        <thead>
        <tr>
            <th width="1%">#</th>
            <th width="10%">Organisation Name</th>
            <th width="5%">Type</th>
            <th width="5%">Sector</th>
            <th width="5%">Industry</th>
            <th width="7%">Contact Person</th>
            <th width="6%">Verification Status</th>
            <th width="6%">Created</th>
        </tr>
        </thead>
        <tbody>

        @foreach($employers as $index => $employer)
            <tr>
                <td>{!! $index + 1 !!}</td>
                <td>
                    <a href="{!!route('admin.employer_view_profile', [Hashids::encode($employer->id)])!!}"
                       class="emp_link">
                        {{ $employer->organization_name }}
                    </a>
                </td>
                <td>{{ $employer->organization_type }}</td>
                <td>{{ $employer->organization_sector }}</td>
                <td>
                    @if($employer->industry_id == '' || $employer->industry_id == null)
                        <span>No industry</span>
                    @else
                        {{ $employer->industry->name }}
                    @endif
                </td>
                <td>
                    {{ $employer->contact_name }}
                </td>
                <td>
                    @if($employer->verified_by == 0) {{ $employer->verification_status}}
                    @else
                        <a href="{!! route('admin.admins_accounts.view', Hashids::encode($employer->verified_by)) !!}"> {{ $employer->verification_status}} </a>
                    @endif
                </td>
                <td> {{ $employer->created_at->diffforhumans()}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $employers->render() !!}
@else
    <p style="text-align: center;"> No records found.</p>
@endif