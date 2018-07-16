<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>排序</th>
            <th>大頭貼</th>
            <th>聯絡資料</th>
            <th>業務內容</th>
            <th>動作</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($personalDuties as $item)
        <tr id="row{{ $item->id }}">
            <td>
                <span class="glyphicon glyphicon-menu-up"
                      aria-hidden="true"
                      @click="up({{ $item->id }}, '/personalduty/number1/priority/number2')"></span>
                <br>
                <span class="glyphicon glyphicon-menu-down"
                      aria-hidden="true"
                      @click="down({{ $item->id }}, '/personalduty/number1/priority/number2')"></span>
            </td>
            <td>{{ $loop->iteration }}</td>
            <td>
                <a class="media-left">
                @if($item->img_path)
                <img class="media-object"
                     style="height: 200px"
                     src="{{ asset($item->img_path) }}"
                     alt="{{ $item->name }}的大頭貼">
                @else
                <img class="media-object"
                     style="height: 200px"
                     src="{{ asset('/storage/001.jpg') }}"
                     alt="沒有大頭貼">
                @endif
                </a>
            </td>
            <td>
                <h4>{{ $item->name }}</h4>
                <p>
                    職位：{{ $item->position }} <br>
                    電話：{{ $item->telephone }}<br>
                    分機：{{ $item->telephone_extension }}<br>
                    專線：{{ $item->direct_telephone }}<br>
                    傳真：{{ $item->fax }}<br>
                    聯絡信箱：{{ $item->email }}
                </p>
            </td>
            <td>
                <p>
                    代理人：{{ $item->agent }}<br>
                    業務內容：<br>
                    <div class="ql-editor">{!! $item->duty !!}</div>
                </p>
            </td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-primary"
                       href="{{ route('personalduty.edit', $item->id) }}"
                    >修改</a>
                    @unless(in_array($item->position, ['局長', '副局長', '主任秘書']))
                    <a class="btn btn-danger"
                       @click="deleteItem('{{ route('personalduty.destroy', $item->id) }}')"
                    >刪除</a>
                    @endunless
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
