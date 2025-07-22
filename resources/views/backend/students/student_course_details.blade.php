<x-backend.layouts.student-master>

    <div class="course-page-container">
        <div class="main-content">
            <div class="video-player-section">
                <video id="lesson-player" controls width="100%" height="auto" poster="https://via.placeholder.com/800x450/4A67ED/FFFFFF?text=Course+Video+Placeholder">
                    <source id="videoSource" src="{{ asset('storage/'.$chapterLessons[0]->file_path) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <div class="course-meta">
                <div class="tags">
                    <span>{{ $course->audience }}</span>
                    <span>{{ $course->total_lesson }} Lessons</span>
                    <span>{{ $course->total_chapter }} Chapters</span>
                    <span>Duration: {{ $course->total_duration }}</span>
                </div>
                <h1>{{ $course->title }}</h1>
                <p class="description">
                    {{ $course->description }}    
                </p>
            </div>
        </div>

        <div class="sidebar2">
            <div class="student-profile-card">
                <div class="profile-avatar">
                    <img src="https://via.placeholder.com/50/4A67ED/FFFFFF?text=MS" alt="Img">
                </div>
                <div class="profile-info">
                    <div class="name">Mubhir Student</div>
                    <div class="role">SAT Student</div>
                </div>
                {{-- <div class="progress-info">
                    <div style="display: flex; justify-content: space-between;">
                        <div class="progress-label">In Progress</div>
                        <div class="progress-percentage">67%</div>
                    </div>
                    <div class="progress-bar-container">
                        <div class="progress-bar" style="width: 67%;"></div>
                    </div>
                </div> --}}
            </div>

            <div class="course-lessons-list" id="courseLessonsList">
            </div>
        </div>
    </div>

    @push('css')
        <link rel="stylesheet" href="{{ asset('css/courses.css') }}">
    @endpush

    @push('js')
        <script>
            const chapters = @json($groupedChapters);
            const appUrl = @json(config('app.url'));

            $(document).ready(function () {
                const $courseLessonsList = $('#courseLessonsList');

                function renderCourseContent() {
                    $courseLessonsList.empty();

                    chapters.forEach((chapter, index) => {
                        let lessonsHtml = '';
                        let totalSeconds = 0;

                        chapter.lessons.forEach(lesson => {

                            const seconds = timeStringToSeconds(lesson.duration);
                            totalSeconds += seconds;

                            const iconClass = lesson.type === 'video' ? 'fa-play' : 'fa-file-pdf';
                            const statusHtml = lesson.completed
                                ? '<i class="fas fa-check-circle"></i>'
                                : (lesson.progress > 0 && lesson.progress < 100
                                    ? `<div class="progress-bar-tiny"><div style="width: ${lesson.progress}%"></div></div><span class="progress-percentage-small">${lesson.progress}%</span>`
                                    : '');
// class="lesson-item ${lesson.completed ? 'completed' : ''} ${lesson.progress > 0 && !lesson.completed ? 'in-progress' : ''}"
                            lessonsHtml += `
                                <div class="lesson-item ${lesson.completed ? 'completed' : ''} ${lesson.progress > 0 && !lesson.completed ? 'in-progress' : ''}" data-lesson-id="${lesson.id}">
                                    <div class="lesson-item-icon">
                                        <i class="fas ${iconClass}"></i>
                                    </div>
                                    <div class="lesson-details">
                                        <div class="lesson-name" data-lesson-id="${lesson.id}" data-lesson-path="${lesson.path}">${lesson.name}</div>
                                        <div class="lesson-duration">${lesson.duration}</div>
                                    </div>
                                    <div class="lesson-status">
                                        ${statusHtml}
                                    </div>
                                </div>
                            `;
                        });

                        let durations = secondsToTimeString(totalSeconds);

                        const chapterHtml = `
                            <div class="chapter-section ${chapter.expanded ? 'expanded' : ''}" data-chapter-id="${chapter.id}">
                                <div class="chapter-header ${chapter.expanded ? 'active' : ''}">
                                    <div class="chapter-title">
                                        <i class="fas fa-chevron-right chapter-toggle-icon"></i>
                                        <span>${chapter.title}</span>
                                    </div>
                                    <div class="chapter-meta">
                                        <span>${chapter.lessonsCount} Lessons</span>
                                        <span>${durations}</span>
                                    </div>
                                </div>
                                <div class="chapter-content" ${chapter.expanded ? 'style="display: block;"' : ''}>
                                    ${lessonsHtml}
                                </div>
                            </div>
                        `;

                        $courseLessonsList.append(chapterHtml);
                    });

                    $('.chapter-section.expanded .chapter-toggle-icon').css('transform', 'rotate(90deg)');
                }

                renderCourseContent();

                $courseLessonsList.on('click', '.chapter-header', function () {
                    const $chapterSection = $(this).closest('.chapter-section');
                    const $chapterContent = $chapterSection.find('.chapter-content');
                    const $toggleIcon = $(this).find('.chapter-toggle-icon');

                    $chapterContent.slideToggle(300, function () {
                        $chapterSection.toggleClass('expanded');
                        if ($chapterSection.hasClass('expanded')) {
                            $toggleIcon.css('transform', 'rotate(90deg)');
                        } else {
                            $toggleIcon.css('transform', 'rotate(0deg)');
                        }
                    });
                    $(this).toggleClass('active');
                });

                $courseLessonsList.on('click', '.lesson-item', function () {
                    $('.lesson-item').removeClass('active');
                    $(this).addClass('active');
                });

                const overallProgress = 67;
                $('.student-profile-card .progress-bar').css('width', `${overallProgress}%`);

                function timeStringToSeconds(timeStr) {
                    const [hours, minutes, seconds] = timeStr.split(':').map(Number);
                    return hours * 3600 + minutes * 60 + seconds;
                }

                // Converts seconds to "HH:MM:SS"
                function secondsToTimeString(totalSeconds) {
                    const hours = String(Math.floor(totalSeconds / 3600)).padStart(2, '0');
                    const minutes = String(Math.floor((totalSeconds % 3600) / 60)).padStart(2, '0');
                    const seconds = String(totalSeconds % 60).padStart(2, '0');
                    return `${hours}:${minutes}:${seconds}`;
                }
                $(document).on('click', '.lesson-item', selectedVideo);

                function selectedVideo() {
                    const $lessonItem = $(this).find('.lesson-name');
                    const lessonId = $lessonItem.data('lesson-id');
                    console.log($lessonItem.data('lesson-path'));
                    
                    const filePath = 'storage/'+$lessonItem.data('lesson-path');

                    if (filePath) {
                        const fullUrl = `${appUrl}${filePath}`;
                        $('#videoSource').attr('src', fullUrl);
                        $('#lesson-player')[0].load();
                        const video = $('#lesson-player')[0];
                        video.load();
                        video.play()
                    } else {
                        console.error('File path is not available for this lesson.');
                    }
                }
            });

            

        </script>
    @endpush

</x-backend.layouts.student-master>
