<table class="table table-bordered">
    <thead>
    <tr>
        <th width="50px">#</th>
        <th>Name</th>
        <th>Read</th>
        <th>Write</th>
        <th>Listen</th>
        <th>Speak</th>
        <th width="87px">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($experiences as $index => $experience)
        <tr>
            <td>{!! $index + 1 !!}</td>
            <td>
                {!! $experience->name !!}
            </td>
            <td>
                @if($experience->read=='b')
                    <span>Beginner</span>
                @elseif($experience->read=='c')
                    <span>Conversation</span>
                @elseif($experience->read=='d')
                    <span>Business</span>
                @elseif($experience->read=='e')
                    <span>Fluent</span>
                @else
                    <span>Mother Tongue</span>
                @endif
            </td>
            <td>
                @if($experience->write=='b')
                    <span>Beginner</span>
                @elseif($experience->write=='c')
                    <span>Conversation</span>
                @elseif($experience->write=='d')
                    <span>Business</span>
                @elseif($experience->write=='e')
                    <span>Fluent</span>
                @else
                    <span>Mother Tongue</span>
                @endif
            </td>
            <td>
                @if($experience->listen=='b')
                    <span>Beginner</span>
                @elseif($experience->listen=='c')
                    <span>Conversation</span>
                @elseif($experience->listen=='d')
                    <span>Business</span>
                @elseif($experience->listen=='e')
                    <span>Fluent</span>
                @else
                    <span>Mother Tongue</span>
                @endif
            </td>
            <td>
                @if($experience->speak=='b')
                    <span>Beginner</span>
                @elseif($experience->speak=='c')
                    <span>Conversation</span>
                @elseif($experience->speak=='d')
                    <span>Business</span>
                @elseif($experience->speak=='e')
                    <span>Fluent</span>
                @else
                    <span>Mother Tongue</span>
                @endif
            </td>
            <td>
                {!! Form::open(['route' => ['candidate.destroy.language.details', $experience->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('candidate.edu.details.show', [$experience->id]) !!}"--}}
                    {{--class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('candidate.edit.language.details', [$experience->id]) !!}"
                       class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>