<div class="container-fluid">
  <div class="row text-right">
    <ol class="breadcrumb">
      <li><a href="{{ route('Index') }}">回首頁</a></li>
      <li><a href="http://www2.tyc.edu.tw/english/" target="_blank">English</a></li>
      <li><a href="http://www.tycg.gov.tw" target="_blank">桃園市政府</a></li>
      <li><a href="http://www.edu.tw/" target="_blank">教育部</a></li>
      <li><a href="{{ route('qa.index') }}">常見問題</a></li>
      <li><a href="https://bossmail.tycg.gov.tw/" target="_blank">意見信箱</a></li>
      <li><a href="{{ route('sitemaps') }}">網站地圖</a></li>
    </ol>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">

          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav navbar-left">
              @foreach ($menu as $item)
                @include('partials.dropdownMenu', ['menu' => $item])
              @endforeach
            </ul>

            <form class="navbar-form navbar-right"
                  method="GET" action="{{ route('search') }}"
                  role="search">
              <div class="form-group">
                <input type="text" class="form-control"
                       placeholder="搜尋"
                       name="q" value="{{ isset($q) ? $q : '' }}">
              </div>
              <button type="submit" class="btn btn-default">搜尋</button>
            </form>

          </div>
        </div>
        <!-- /.navbar-collapse -->
      </nav>
    </div>
  </div>
</div>

