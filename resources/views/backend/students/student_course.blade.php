<x-backend.layouts.student-master>
<div class="my-4">
        <header class="header">
            <div class="d-flex align-items-center flex-wrap gap-3 w-100">
                <ul class="nav nav-pills custom-main-tabs me-auto" id="mainTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="courses-tab" data-toggle="tab" data-target="#courses" type="button" role="tab" aria-controls="courses" aria-selected="true">Courses</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="video-lessons-tab" data-toggle="tab" data-target="#video-lessons" type="button" role="tab" aria-controls="video-lessons" aria-selected="false">Video lessons</button>
                    </li>
                </ul>
            </div>
        </header>

        <div class="tab-content" id="mainTabContent">
            <div class="tab-pane fade show active" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                <div class="d-flex justify-content-end flex-wrap gap-2">
                    <div class="search-bar">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search Courses...">
                    </div>
                    <ul class="nav nav-pills custom-filter-tabs" id="courseFilterTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="all-courses-tab" data-toggle="tab" data-target="#all-courses" type="button" role="tab" aria-controls="all-courses" aria-selected="true">All courses</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="completed-tab" data-toggle="tab" data-target="#completed" type="button" role="tab" aria-controls="completed" aria-selected="false">Completed</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="incomplete-tab" data-toggle="tab" data-target="#incomplete" type="button" role="tab" aria-controls="incomplete" aria-selected="false">Incomplete</button>
                        </li>
                    </ul>
                </div>


                <div class="tab-content" id="courseFilterTabContent">
                    <div class="tab-pane fade show active" id="all-courses" role="tabpanel" aria-labelledby="all-courses-tab">
                        <h2 class="section-title mb-2">All Courses</h2>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 course-grid">
                            @foreach ($courses as $course) 
                            <div class="col-md-3 mb-4">
                                    <div class="card course-card h-100">
                                        <img src="https://via.placeholder.com/300x180" class="card-img-top course-image" alt="Course Image">
                                        <div class="card-body d-flex flex-column">
                                            <div class="course-meta">
                                                <ul class="d-flex" style="padding-left: 17px; margin-bottom: 0px;">
                                                    <li>{{ $course->audience }}</li>
                                                    <li style="margin-left:28px">{{ $course->total_lesson }} Lessons</li>
                                                </ul>
                                            </div>
                                            <h5 class="card-title course-title">{{ $course->title }}</h5>
                                            <p class="card-text course-description">{{ $course->description }}</p>
                                            <a href="{{ route('student.course.details', $course->uuid) }}" class="btn view-course-btn mt-auto">View Course</a>
                                        </div>
                                    </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                        <h2 class="section-title mb-2">Completed</h2>

                        <p class="text-muted text-center mt-5">No completed courses yet.</p>
                        </div>

                    <div class="tab-pane fade" id="incomplete" role="tabpanel" aria-labelledby="incomplete-tab">
                        <h2 class="section-title mb-2">Incomplete</h2>

                        <p class="text-muted text-center mt-5">No incomplete courses yet.</p>
                        </div>
                </div>
            </div>

            <div class="tab-pane fade" id="video-lessons" role="tabpanel" aria-labelledby="video-lessons-tab">
                <div class="d-flex justify-content-end flex-wrap gap-2">
                    <div class="search-bar">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search Lessons">
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 course-grid mt-4">
                    @foreach ($lessons as $lesson)
                    <div class="col-md-3 mb-4">
                        <a href="{{ route('student.video.lesson.details', $lesson->uuid) }}">
                        <div class="card lesson-card h-100">
                            <img src="https://via.placeholder.com/300x180" class="card-img-top course-image" alt="Course Image">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title course-title">Introduction to Physics</h5>
                                <p class="card-text course-description pb-0 mb-0">Learn the fundamental concepts of physics designed for high school students</p>
                                <div class="course-meta">
                                    <ul class="d-flex" style="padding-left: 17px; margin-bottom: 0px;">
                                        <li>{{ $lesson->audience }}</li>
                                        <li style="margin-left:28px">Duration: {{ $lesson->total_length }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    @endforeach
                </div>

                {{-- <p class="text-muted text-center mt-5">Video lessons content will go here.</p> --}}
            </div>
        </div>
    </div>

    @push('css')
        <link rel="stylesheet" href="{{ asset('css/student-course.css') }}">
    @endpush

</x-backend.layouts.student-master>
