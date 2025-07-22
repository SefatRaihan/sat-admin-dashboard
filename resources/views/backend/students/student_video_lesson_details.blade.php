<x-backend.layouts.student-master>

    <div class="">

        <div class="row">
            <div class="col-md-8">
                <div class="video-player-section">
                    <div class="video-player-container">
                        <video width="100%" height="500" controls>
                            <source src="{{ asset('storage/'. $lesson->file_path) }}" type="video/mp4">
                        </video>
                    </div>
                </div>

                <div class="course-details">
                    <div class="d-flex">
                        <div class="back-link">
                            <a href="{{ route('student.course') }}"><i class="fas fa-arrow-left"></i></a>
                            <span>Back to Lessons</span>
                        </div>
                        <div class="tags ml-2">
                            <span class="tag">{{ $lesson->question_type }} - {{ $lesson->audience }}</span>
                            <span class="tag">Duration: {{ $lesson->total_length }}</span>
                        </div>
                    </div>
                    <h1 class="lesson-title">{{ $lesson->title }}</h1>
                    <p class="lesson-description">
                        {{ $lesson->description }}
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="related-videos">
                    @foreach ($relatedLessons as $item)
                    <div class="related-video-card">
                        <a href="{{ route('student.video.lesson.details', $item->uuid) }}">
                            <video class="card-img-top course-image video-thumbnail" style="width: 50%;" controlsList="nodownload" disablePictureInPicture preload="metadata" onloadeddata="this.currentTime=0;" muted>
                                <source src="{{ asset('storage/' . $item->file_path) }}" type="video/mp4">
                                {{-- Add more source types if you support other formats, e.g., <source src="..." type="video/webm"> --}}
                                Your browser does not support the video tag.
                            </video>
                            <div class="related-video-info">
                                <h4 class="related-video-title">{{ $item->title }}</h4>
                                <p class="related-video-description">{{ \Illuminate\Support\Str::words(strip_tags($item->description), 100, '...') }}</p>
                                <div class="related-video-meta">
                                    <span class="related-level"><i class="fas fa-graduation-cap"></i> {{ $item->audience }}</span>
                                    <span class="related-duration"><i class="fas fa-clock"></i> Duration: {{ $item->total_length }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    @push('css')
        <link rel="stylesheet" href="{{ asset('css/video-lesson.css') }}">
    @endpush

</x-backend.layouts.student-master>
