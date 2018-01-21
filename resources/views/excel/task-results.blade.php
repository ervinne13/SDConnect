<table class="table">
    <thead>
        <tr>
            <th>Student Number</th>
            <th>Student</th>
            <th>Total Points</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($results as $result)
        
        @php
        $submitted = $result['total_points'] != 'x';
        @endphp
        
        <tr>
            <td>{{$result['student_number']}}</td>
            <td>{{$result['student_display_name']}}</td>
            <td class="text-right">
                @if ($submitted)
                {{ $result['total_points'] }}
                @else
                <span class="badge badge-warning">Did not submit</span>
                @endif                
            </td>
            <td class="text-right">
                @if ($submitted)
                <a href="javascript:;">View Answers</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>