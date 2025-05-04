<x-backend.layouts.student-master>

    <div class="">
        <div class="header p-4">
            <div class="header-content">
                <h5 class="p-0 m-0" style="color: #344054;font: Inter;font-size: 20px;font-weight: 600;">Exam Name</h5>
                <div class="heading-summary d-flex justify-content-center">
                    <ul class="p-0 m-0">
                        <li id="audience" style="list-style: none">Hi School</li>
                        <li id="total-section">4 sections</li>
                        <li id="total-question">80 Questions</li>
                    </ul>
                </div>
            </div>
            <div class="header-pagination">
                @foreach ($data as $key => $group)
                <div class="pagination-1">
                    <p class="p-0 m-0 text-center groupActive">{{ $key }}</p>
                    <div class="box-pagination">
                        @foreach ($group as $index => $question)
                            <span class="box question-{{ $question['id'] }}"></span>
                        @endforeach
                    </div>
                </div>
                @endforeach
                {{-- <div class="pagination-1">
                    <p class="p-0 m-0 text-center groupActive">Varbal</p>
                    <div class="box-pagination">
                        <span class="box completed"></span>
                        <span class="box completed"></span>
                        <span class="box completed"></span>
                        <span class="box incomplete"></span>
                        <span class="box active"></span>
                        <span class="box"></span>
                        <span class="box"></span>
                        <span class="box"></span>
                        <span class="box"></span>
                        <span class="box"></span>
                        <span class="box"></span>
                    </div>
                </div> --}}
            </div>
            <div id="timer-container">
                <h2>Digital Countdown Timer</h2>
                <input type="number" id="timeInput" placeholder="Enter time in minutes" />
                <button onclick="startTimer()">Start</button>
                <div id="clock-wrapper" style="display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-stopwatch" style="font-size: 20px; "></i>
                    <div id="clock">00:00:00</div>
                </div>
            </div>
        </div>

        <div class="p-4">
            <div class="row">
                <div class="col-md-6 pl-4 pr-4">
                    <h4><b>Context</b></h4>
                    <div>
                        <p class="p-0 m-0"><b>The tensionin in the rope has two components :</b></p>
                        <li class="p-0" style="margin-left: 18px;">Horizontal component:  T_x = T \cos(30°) </li>
                        <li class="p-0 " style="margin-left: 18px;">Vertical component:  T_y = T \sin(30°) </li>
                        <p style="margin-top: 18px;"> 2. Since the surface is frictionless, only the horizontal force affects
                            the sled’s motion. Using Newton’s second law,  F = ma :</p>
                        <p>T_x = ma \quad \Rightarrow \quad a = \frac{T_x m}</p>
                        <p><b>3.Substituting values:</b></p>
                        <p>T_x = 50 \cos(30°) = 50 \times 0.866 \approx 43.3 N</p>
                        <p>a = \frac{43.3}{20} \approx 2.17 m/s^2</p>
                        <p>The horizontal acceleration of the sled is approximately  2.17 m/s^2 .</p>
                        <p>Here’s an illustration of the physics scenario. It shows a
                            sled being pulled on an icy surface with the force diagram clearly depicted. The labeled vectors for
                            tension, its components, and the acceleration highlight the problem-solving process described in the
                            explanation.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4><b>Question</b></h4>
                        </div>
                        <div class="mr-3" style="color:#344054; font-size: 20px; font-weight: 400;">
                            <span class="answered-count">15</span>/<span class="total-questions">80</span>
                        </div>
                    </div>
                    <div class="question-box">
                        <img src="./cca83fda833255720ffecc4977e7ebe26d919222.png" alt="" style="width: 536px; height: 296px;">
                        <p style="margin-top: 8px;">A sled is being pulled along a flat, icy surface by a rope that makes an
                            angle of 30° with the horizontal. The sled has a mass of 20 kg, and the tension in the rope is 50 N.
                            Assume the surface is frictionless.</p>
                        <p>What is the horizontal acceleration of the sled? (Take  g = 9.8 m/s^2 ).</p>
                        <div class="check-box-field">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="question_pool" id="" value="1.25 m/s^2">
                                        <label class="form-check-label" for="">
                                            1.25 m/s^2
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="question_pool" id="" value="2.50 m/s^2">
                                        <label class="form-check-label" for="">
                                            2.50 m/s^2
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="question_pool" id="" value="inc2.17 m/s^2orrect">
                                        <label class="form-check-label" for="">
                                            2.17 m/s^2
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="question_pool" id="" value="3.25 m/s^2">
                                        <label class="form-check-label" for="">
                                            3.25 m/s^2
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer m-0 p-0" style="border-top: 1px solid #ddd;">
            <div class="footer-content p-4">
                <div class="footer-left">
                    <button type="button" class="btn" style="width: 112px; height: 44px; border-radius: 5px; border: 1px solid #FDA29B; color: #B42318;">End Exam</button>
                </div>
                <div class="footer-right">
                    
                    <button class="btn mr-2" style="width: 108px; height: 44px; border-radius: 8px; border: 1px solid #A16A99; color: #521749;">Previous</button>
                    <button type="button" class="btn" style="width: 108px; height: 44px; border-radius: 8px; background: #691D5E; color: #FFFF;">Next</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Time Expired Modal -->
    <div class="modal fade" id="expiredModal" tabindex="-1" aria-labelledby="expiredModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <h5 class="modal-title w-100" id="expiredModalLabel">Time Expired</h5>
                </div>
                <div class="modal-body">
                    Your time has ended.
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    @push('css')
        <link rel="stylesheet" href="{{ asset('css/student-exam.css') }}">
    @endpush

    @push('js')
    <script>
        // Add active state for .box on click
        const boxes = document.querySelectorAll('.box');
        boxes.forEach((box) => {
            box.addEventListener('click', () => {
                // Remove active from all boxes in the same pagination row
                const parent = box.parentElement;
                const allBoxes = parent.querySelectorAll('.box');
                allBoxes.forEach(b => b.classList.remove('active'));

                // Add active to clicked one
                box.classList.add('active');
            });
        });

        let timerInterval;

        function startTimer(minutes = 60) { // default 1 hour
            clearInterval(timerInterval);
            let totalSeconds = minutes * 60;

            timerInterval = setInterval(() => {
                let hrs = Math.floor(totalSeconds / 3600);
                let mins = Math.floor((totalSeconds % 3600) / 60);
                let secs = totalSeconds % 60;

                document.getElementById("clock").innerText =
                    `${pad(hrs)}:${pad(mins)}:${pad(secs)}`;

                if (totalSeconds <= 0) {
                    clearInterval(timerInterval);
                    document.getElementById("clock").innerText = "Time Expired!";
                    document.getElementById("clock").classList.add("expired");

                    // Show Bootstrap modal
                    var expiredModal = new bootstrap.Modal(document.getElementById('expiredModal'));
                    expiredModal.show();
                }


                totalSeconds--;
            }, 1000);
        }

        function pad(num) {
            return num.toString().padStart(2, '0');
        }

        // পেজ লোড হতেই টাইমার শুরু (manual 60 minutes)
        window.onload = () => startTimer(60); 
    </script>
    @endpush

</x-backend.layouts.student-master>