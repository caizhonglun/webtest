<div class="panel panel-info">
    <div class="panel-heading">
        <h1 class="panel-title">主任秘書介紹 <small>Chief Secretary</small></h1>
    </div>

    <div class="panel-body">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <img class="media-object img-thumbnail" style="height: 200px" alt="個人照"
                src="{{ asset($chiefSecretary->img_path) }}">
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
            <h3>{{ $chiefSecretary->name }}</h3>
            <p>
                電話：{{ $chiefSecretary->telephone }} 分機：{{ $chiefSecretary->telephone_extension }}<br>
                專線：{{ $chiefSecretary->direct_telephone }}<br>
                傳真：{{ $chiefSecretary->fax }}<br>
                E-Mail：{{ $chiefSecretary->email }}<br>
            </p>
        </div>
    </div>

    <ul class="list-group">
        @if ($chiefSecretary->education)
        <li class="list-group-item">
            <h4>學歷</h4>
            <blockquote>{!! $chiefSecretary->education !!}</blockquote>
        </li>
        @endif

        @if ($chiefSecretary->experience)
        <li class="list-group-item">
            <h4>經歷</h4>
            <blockquote>{!! $chiefSecretary->experience !!}</blockquote>
        </li>
        @endif

        @if ($chiefSecretary->honor)
        <li class="list-group-item">
            <h4>榮耀</h4>
            <blockquote>{!! $chiefSecretary->honor !!}</blockquote>
        </li>
        @endif
    </ul>
</div>
