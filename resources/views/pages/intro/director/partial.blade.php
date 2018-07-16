<div class="panel panel-info">
    <div class="panel-heading">
        <h1 class="panel-title">局長介紹 <small>Director-general</small></h1>
    </div>

    <div class="panel-body">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <img class="media-object img-thumbnail" style="height: 200px" alt="個人照"
                src="{{ asset($director->img_path) }}">
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
            <h3>{{ $director->name }} 局長</h3>
            <p>
                電話：{{ $director->telephone }} 分機：{{ $director->telephone_extension }}<br>
                專線：{{ $director->direct_telephone }}<br>
                傳真：{{ $director->fax }}<br>
                E-Mail：{{ $director->email }}<br>
            </p>
        </div>
    </div>

    <ul class="list-group">
        <li class="list-group-item">
            <h4>學歷</h4>
            <blockquote>{!! $director->education !!}</blockquote>
        </li>
        <li class="list-group-item">
            <h4>經歷</h4>
            <blockquote>{!! $director->experience !!}</blockquote>
        </li>
        <li class="list-group-item">
            <h4>榮耀</h4>
            <blockquote>{!! $director->honor !!}</blockquote>
        </li>
    </ul>
</div>
<div class="panel panel-info">
    <div class="panel-heading">
        <h1 class="panel-title">局長的話<small>Words from the Director</small></h1>
    </div>
    <div class="panel-body">{!! $directorWords !!}</div>
</div>
