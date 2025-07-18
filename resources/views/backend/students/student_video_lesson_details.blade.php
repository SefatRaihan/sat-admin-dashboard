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
                    <h1 class="lesson-title">SAT (MATH) - Solving Linear Equations & Inequalities</h1>
                    <p class="lesson-description">
                        This advanced algebra course delves deeper into the complexities of algebraic concepts, focusing on enhancing
                        number sense and operations. Students will solidify their understanding by engaging with integers, fractions, and
                        decimals, while mastering essential properties such as commutativity and associativity. They will apply these skills
                        to tackle linear equations and inequalities with confidence.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="related-videos">
                    @foreach ($relatedLessons as $item)
                    <div class="related-video-card">
                        <a href="{{ route('student.video.lesson.details', $lesson->uuid) }}">
                            <img src="https://via.placeholder.com/150x90" alt="Related Video Thumbnail" class="related-video-thumbnail">
                            <div class="related-video-info">
                                <h4 class="related-video-title">Introduction to Physics</h4>
                                <p class="related-video-description">Learn the fundamental concepts of physics design...</p>
                                <div class="related-video-meta">
                                    <span class="related-level"><i class="fas fa-graduation-cap"></i> {{ $lesson->audience }}</span>
                                    <span class="related-duration"><i class="fas fa-clock"></i> Duration: {{ $lesson->total_length }}</span>
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
