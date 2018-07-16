<table class="table table-hover">
    <tbody>
        @foreach($news as $new)
        <tr>
            <td>{{ $new->sort }}</td>
            <td>
                <script>
                    var ScheduleDate = "{{ $new->announce_start}}", CurrentDate =  "{{date('Y-m-d')}}";
                    
                    if ( (Date.parse(ScheduleDate)).valueOf() > ((Date.parse(CurrentDate)).valueOf()-(2*1000 * 60 * 60 * 24)))
                        {
                            document.write('<img src="https://www.tyc.edu.tw/storage/new.gif" width="40" height="7"> ')
                        }                  
                </script>
                <a href="{{ route('news.show', $new->id) }}"
                   title="{{ $new->title }}"
                >
                {{ mb_strlen($new->title, 'utf-8') > 20 ? mb_substr($new->title, 0, 20, 'utf-8') . '...' : $new->title }}
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
