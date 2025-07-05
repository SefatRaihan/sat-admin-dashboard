<x-backend.layouts.student-master>

    <div class="course-page-container">
        <div class="main-content">
            <div class="video-player-section">
                <video controls width="100%" height="auto" poster="https://via.placeholder.com/800x450/4A67ED/FFFFFF?text=Course+Video+Placeholder">
                    <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <div class="course-meta">
                <div class="tags">
                    <span>High School</span>
                    <span>20 Lessons</span>
                    <span>6 Chapters</span>
                    <span>Duration: 2h 30m</span>
                </div>
                <h1>SAT (MATH) - Solving Linear Equations & Inequalities</h1>
                <p class="description">
                    This advanced algebra course delves deeper into the complexities of algebraic concepts, focusing on enhancing number sense and operations. Students will solidify their understanding by engaging with integers, fractions, and decimals, while mastering essential properties such as commutativity and associativity. They will apply these skills to tackle linear equations and inequalities with confidence.
                </p>
                <p class="description">
                    Through a variety of practical examples and challenging problem-solving exercises, this course empowers learners to navigate numerical relationships effectively and lays the groundwork for exploring more sophisticated algebraic theories.
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
                <div class="progress-info">
                    <div style="display: flex; justify-content: space-between;">
                        <div class="progress-label">In Progress</div>
                        <div class="progress-percentage">67%</div>
                    </div>
                    <div class="progress-bar-container">
                        <div class="progress-bar" style="width: 67%;"></div>
                    </div>
                </div>
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
            $(document).ready(function() {

                // --- Data Definition (Simulated Course Structure) ---
                const courseData = [
                    {
                        id: 'chapter1',
                        title: "Fundamentals of Algebra: Variables & Expressions",
                        lessonsCount: 6,
                        duration: "30min",
                        expanded: true, // Initially expanded
                        lessons: [
                            { id: 'lesson1-1', type: 'video', name: 'Introduction', duration: '08 min, 27 Sec', completed: true, progress: 100 },
                            { id: 'lesson1-2', type: 'video', name: 'Structure', duration: '08 min, 27 Sec', completed: true, progress: 100 },
                            { id: 'lesson1-3', type: 'video', name: 'Strategy', duration: '08 min, 27 Sec', completed: true, progress: 100 },
                            { id: 'lesson1-4', type: 'video', name: 'Understanding', duration: '08 min, 27 Sec', completed: false, progress: 72 }, // Partially completed
                            { id: 'lesson1-5', type: 'pdf', name: 'Probability & Statistics Basics.pdf', duration: '04 min', completed: false, progress: 0 } // PDF
                        ]
                    },
                    {
                        id: 'chapter2',
                        title: "Solving Linear Equations & Inequalities",
                        lessonsCount: 4,
                        duration: "20min",
                        expanded: false,
                        lessons: [
                            { id: 'lesson2-1', type: 'video', name: 'Linear Equations Basics', duration: '05 min, 10 Sec', completed: false, progress: 0 },
                            { id: 'lesson2-2', type: 'video', name: 'Graphing Linear Equations', duration: '07 min, 00 Sec', completed: false, progress: 0 },
                            { id: 'lesson2-3', type: 'pdf', name: 'Inequalities Practice.pdf', duration: '08 min', completed: false, progress: 0 }
                        ]
                    },
                    {
                        id: 'chapter3',
                        title: "Systems of Equations: Solving by Substitution & Elimination",
                        lessonsCount: 2,
                        duration: "10min",
                        expanded: false,
                        lessons: [
                            { id: 'lesson3-1', type: 'video', name: 'Substitution Method', duration: '04 min, 30 Sec', completed: false, progress: 0 },
                            { id: 'lesson3-2', type: 'video', name: 'Elimination Method', duration: '05 min, 30 Sec', completed: false, progress: 0 }
                        ]
                    },
                    {
                        id: 'chapter4',
                        title: "Probability: Basic Concepts & Applications",
                        lessonsCount: 3,
                        duration: "15min",
                        expanded: false,
                        lessons: [
                            { id: 'lesson4-1', type: 'video', name: 'Introduction to Probability', duration: '06 min, 00 Sec', completed: false, progress: 0 },
                            { id: 'lesson4-2', type: 'video', name: 'Combinations & Permutations', duration: '05 min, 00 Sec', completed: false, progress: 0 },
                            { id: 'lesson4-3', type: 'pdf', name: 'Probability Exercises.pdf', duration: '04 min', completed: false, progress: 0 }
                        ]
                    },
                    {
                        id: 'chapter5',
                        title: "Introduction to Trigonometry: Ratios & Functions",
                        lessonsCount: 2,
                        duration: "10min",
                        expanded: false,
                        lessons: [
                            { id: 'lesson5-1', type: 'video', name: 'Trigonometric Ratios', duration: '05 min, 00 Sec', completed: false, progress: 0 },
                            { id: 'lesson5-2', type: 'video', name: 'Unit Circle Basics', duration: '05 min, 00 Sec', completed: false, progress: 0 }
                        ]
                    },
                    {
                        id: 'chapter6',
                        title: "Rational Expressions: Simplifying, Multiplying, & Dividing",
                        lessonsCount: 3,
                        duration: "20min",
                        expanded: false,
                        lessons: [
                            { id: 'lesson6-1', type: 'video', name: 'Simplifying Rational Expressions', duration: '07 min, 00 Sec', completed: false, progress: 0 },
                            { id: 'lesson6-2', type: 'video', name: 'Multiplying & Dividing Rational Expressions', duration: '08 min, 00 Sec', completed: false, progress: 0 },
                            { id: 'lesson6-3', type: 'pdf', name: 'Rational Expressions Quiz.pdf', duration: '05 min', completed: false, progress: 0 }
                        ]
                    }
                ];

                const $courseLessonsList = $('#courseLessonsList');

                // --- Function to Render Course Sections and Lessons ---
                function renderCourseContent() {
                    $courseLessonsList.empty(); // Clear existing content

                    courseData.forEach(chapter => {
                        let lessonsHtml = '';
                        chapter.lessons.forEach(lesson => {
                            const iconClass = lesson.type === 'video' ? 'fa-play' : 'fa-file-pdf';
                            const statusHtml = lesson.completed ? '<i class="fas fa-check-circle"></i>' :
                                            (lesson.progress > 0 && lesson.progress < 100 ?
                                                `<div class="progress-bar-tiny"><div style="width: ${lesson.progress}%;"></div></div><span class="progress-percentage-small">${lesson.progress}%</span>` :
                                                ''); // Empty if 0% progress

                            lessonsHtml += `
                                <div class="lesson-item ${lesson.completed ? 'completed' : ''} ${lesson.progress > 0 && !lesson.completed ? 'in-progress' : ''}" data-lesson-id="${lesson.id}">
                                    <div class="lesson-item-icon">
                                        <i class="fas ${iconClass}"></i>
                                    </div>
                                    <div class="lesson-details">
                                        <div class="lesson-name">${lesson.name}</div>
                                        <div class="lesson-duration">${lesson.duration}</div>
                                    </div>
                                    <div class="lesson-status">
                                        ${statusHtml}
                                    </div>
                                </div>
                            `;
                        });

                        const chapterClass = chapter.expanded ? 'expanded' : '';
                        const toggleIconClass = chapter.expanded ? 'fa-chevron-right' : 'fa-chevron-right'; // Initial state arrow
                        const chapterHeaderActiveClass = chapter.expanded ? 'active' : '';

                        const chapterHtml = `
                            <div class="chapter-section ${chapterClass}" data-chapter-id="${chapter.id}">
                                <div class="chapter-header ${chapterHeaderActiveClass}">
                                    <div class="chapter-title">
                                        <i class="fas fa-chevron-right chapter-toggle-icon"></i>
                                        <span>${chapter.title}</span>
                                    </div>
                                    <div class="chapter-meta">
                                        <span>${chapter.lessonsCount} Lessons</span>
                                        <span>${chapter.duration}</span>
                                    </div>
                                </div>
                                <div class="chapter-content" ${chapter.expanded ? 'style="display: block;"' : ''}>
                                    ${lessonsHtml}
                                </div>
                            </div>
                        `;
                        $courseLessonsList.append(chapterHtml);
                    });

                    // Set initial toggle icon rotation for expanded chapters
                    $('.chapter-section.expanded .chapter-toggle-icon').css('transform', 'rotate(90deg)');
                }

                // Call render function on page load
                renderCourseContent();

                // --- Event Listeners ---

                // Toggle chapter expansion
                $courseLessonsList.on('click', '.chapter-header', function() {
                    const $chapterSection = $(this).closest('.chapter-section');
                    const $chapterContent = $chapterSection.find('.chapter-content');
                    const $toggleIcon = $(this).find('.chapter-toggle-icon');

                    $chapterContent.slideToggle(300, function() {
                        $chapterSection.toggleClass('expanded');
                        if ($chapterSection.hasClass('expanded')) {
                            $toggleIcon.css('transform', 'rotate(90deg)');
                            $(this).addClass('active'); // Add active class to header
                        } else {
                            $toggleIcon.css('transform', 'rotate(0deg)');
                            $(this).removeClass('active'); // Remove active class from header
                        }
                    });
                    $(this).toggleClass('active'); // Toggle active class on header itself
                });

                // Handle lesson item click (simulated active lesson)
                $courseLessonsList.on('click', '.lesson-item', function() {
                    // Remove active class from all lessons first
                    $('.lesson-item').removeClass('active');
                    // Add active class to the clicked lesson
                    $(this).addClass('active');

                    // Optional: In a real app, update main video player source here
                    // const lessonType = $(this).find('.lesson-item-icon i').hasClass('fa-play') ? 'video' : 'pdf';
                    // const lessonName = $(this).find('.lesson-name').text();
                    // console.log(`Simulating playing: ${lessonName} (Type: ${lessonType})`);

                    // You could also update the main video src based on lesson id/data
                    // For example: $('#mainVideoPlayer source').attr('src', 'new-video-url.mp4');
                    // $('#mainVideoPlayer')[0].load(); // Reload video player
                });

                // Simulate overall course progress
                // This could be calculated based on completed lessons in a real app
                const overallProgress = 67; // Hardcoded for this example
                $('.student-profile-card .progress-bar').css('width', `${overallProgress}%`);
            });
        </script>
    @endpush

</x-backend.layouts.student-master>
