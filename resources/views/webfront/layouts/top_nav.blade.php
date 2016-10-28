<div class="top"><!-- top -->
    <div class="container">
        <div class="media-top-right">
            <ul class="media-top clearfix">
                <li class="item"><a href="" target="blank"><i class="fa fa-twitter"></i></a></li>
                <li class="item"><a href="" target="blank"><i class="fa fa-facebook"></i></a></li>
                <li class="item"><a href="" target="blank"><i class="fa fa-linkedin"></i></a></li>
                <li class="item"><a href="" target="blank"><i class="fa fa-rss"></i></a></li>
                <li class="item"><a href="" target="blank"><i class="fa fa-google-plus"></i></a></li>
            </ul>
            <ul class="media-top-2 clearfix">
                @if (Auth::guest())
                    <li><a href="#" class="btn btn-default btn-blue btn-sm">REGISTER</a></li>
                    <li><a href="#" class="btn btn-default btn-green btn-sm">LOG IN</a></li>
                @else
                    <li><a href="#" class="btn btn-default btn-blue btn-sm">
                            <span>Logged in as &nbsp;</span>{{ Auth::guest()->get()->name }}</a>
                    </li>
                    <li><a href="#" class="btn btn-default btn-blue btn-sm">
                            Log Out
                        </a>
                    </li>
                @endif
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
