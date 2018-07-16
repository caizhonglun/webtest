<div class="panel panel-info">
    <div class="panel-heading">
        <h1 class="panel-title">副局長介紹 <small>Vice Director-general</small></h1>
    </div>

    @foreach ($viceDirectors as $viceDirector)
    <div class="panel-body">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <img class="media-object img-thumbnail" style="height: 200px" alt="{{ $viceDirector->name }} 副局長個人照"
                src="{{ asset($viceDirector->img_path) }}">
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
            <h3>{{ $viceDirector->name }} 副局長</h3>
            <p>
                電話：{{ $viceDirector->telephone }} 分機：{{ $viceDirector->telephone_extension }}<br>
                專線：{{ $viceDirector->direct_telephone }}<br>
                傳真：{{ $viceDirector->fax }}<br>
                E-Mail：{{ $viceDirector->email }}<br>
            </p>
        </div>
    </div>

    <ul class="list-group">
        @if ($viceDirector->education)
        <li class="list-group-item">
            <h4>學歷</h4>
            <blockquote>{!! $viceDirector->education !!}</blockquote>
        </li>
        @endif

        @if ($viceDirector->experience)
        <li class="list-group-item">
            <h4>經歷</h4>
            <blockquote>{!! $viceDirector->experience !!}</blockquote>
        </li>
        @endif

        @if ($viceDirector->honor)
        <li class="list-group-item">
            <h4>榮耀</h4>
            <blockquote>{!! $viceDirector->honor !!}</blockquote>
        </li>
        @endif
    </ul>
    @endforeach
</div>
