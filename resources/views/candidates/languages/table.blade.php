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
    @foreach($lang as $index => $language)
        <tr>
            <td>{!! $index + 1 !!}</td>
            <td>
                {!! $language->name !!}
            </td>
            <td>
                @if($language->read=='b')
                    <span>Beginner</span>
                @elseif($language->read=='c')
                    <span>Conversation</span>
                @elseif($language->read=='d')
                    <span>Business</span>
                @elseif($language->read=='e')
                    <span>Fluent</span>
                @else
                    <span>Mother Tongue</span>
                @endif
            </td>
            <td>
                @if($language->write=='b')
                    <span>Beginner</span>
                @elseif($language->write=='c')
                    <span>Conversation</span>
                @elseif($language->write=='d')
                    <span>Business</span>
                @elseif($language->write=='e')
                    <span>Fluent</span>
                @else
                    <span>Mother Tongue</span>
                @endif
            </td>
            <td>
                @if($language->listen=='b')
                    <span>Beginner</span>
                @elseif($language->listen=='c')
                    <span>Conversation</span>
                @elseif($language->listen=='d')
                    <span>Business</span>
                @elseif($language->listen=='e')
                    <span>Fluent</span>
                @else
                    <span>Mother Tongue</span>
                @endif
            </td>
            <td>
                @if($language->speak=='b')
                    <span>Beginner</span>
                @elseif($language->speak=='c')
                    <span>Conversation</span>
                @elseif($language->speak=='d')
                    <span>Business</span>
                @elseif($language->speak=='e')
                    <span>Fluent</span>
                @else
                    <span>Mother Tongue</span>
                @endif
            </td>
            <td>
                {!! Form::open(['route' => ['candidate.languages.destroy', $language->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('candidate.languages.show', [$language->id]) !!}"--}}
                    {{--class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('candidate.languages.edit', [$language->id]) !!}"
                       class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>