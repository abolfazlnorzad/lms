<div class="episodes-list">
    <div class="episodes-list--title">
        فهرست جلسات
        @if(auth()->check() && auth()->user()->hasAccessToCourse($lesson->course))
            <span>
            <a href="{{route('courses.downloadLinks',$course)}}">
                دریافت همه لینک های دانلود
            </a>
        </span>

        @endif

    </div>
    <div class="episodes-list-section">
        @foreach($lessons as $lesson)
            <div
                class="episodes-list-item {{auth()->check()  &&( auth()->user()->hasAccessToCourse($lesson->course) || auth()->user()->AccessToFreeLesson($lesson))? '' : 'lock' }}">
                <div class="section-right">
                    <span class="episodes-list-number">{{ $lesson->priority }}</span>
                    <div class="episodes-list-title">
                        <a href="{{ $lesson->path() }}">{{ $lesson->title }}</a>
                    </div>
                </div>
                <div class="section-left">
                    <div class="episodes-list-details">
                        <div class="episodes-list-details">
                            <span class="detail-type">@lang($lesson->type)</span>
                            <span class="detail-time">{{ $lesson->time }} دقیقه</span>
                            @auth()
                                @if( auth()->user()->hasAccessToCourse($lesson->course) || auth()->user()->AccessToFreeLesson($lesson) || auth()->user()->isAdmin())
                                    <a class="detail-download" href="{{$lesson->downloadLink()}}">
                                        <i class="icon-download"></i>
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
