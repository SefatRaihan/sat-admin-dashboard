<x-backend.layouts.student-master>
    <div class="p-4">
        <div class="row">
           <div class="col-md-3">
              <div class="header-content">
                 <h5 class="p-0 m-0" style="color: #344054; font: Inter; font-size: 20px; font-weight: 600;">
                    Exam Name
                 </h5>
                 <div class="heading-summary d-flex justify-content-left">
                    <ul class="p-0 m-0">
                       <li id="audience" style="list-style: none">Hi School</li>
                       <li id="total-section">4 sections</li>
                       <li id="total-question">80 Questions</li>
                    </ul>
                 </div>
              </div>
           </div>
           <div class="col-md-9 d-flex justify-content-left align-items-center gap-2">
              <span class="text-center p-1" style="margin-right: 18px; border: 1px solid #ddd; border-radius: 50%; width: 32px; height: 32px; cursor: pointer;"><i class="fas fa-chevron-left text-center"></i></span>
              <div class="pagination-1">
                 <p class="p-0 m-0 text-center">Varbal</p>
                 <div class="box-pagination">
                    <span class="box active"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                 </div>
              </div>
              <div class="pagination-1">
                 <p class="p-0 m-0 text-center">Quant</p>
                 <div class="box-pagination">
                    <span class="box active"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                 </div>
              </div>
              <div class="pagination-1">
                 <p class="p-0 m-0 text-center">Writing</p>
                 <div class="box-pagination">
                    <span class="box active"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                 </div>
              </div>
              <div class="pagination-1">
                 <p class="p-0 m-0 text-center">Mathmatics</p>
                 <div class="box-pagination">
                    <span class="box active"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                    <span class="box"></span>
                 </div>
              </div>
              <span class="text-center p-1" style="margin-left: 18px; border: 1px solid #ddd; border-radius: 50%; width: 32px; height: 32px; cursor: pointer;"><i class="fas fa-chevron-right"></i></span>
           </div>
        </div>
     </div>
     <div class="p-4">
        <div class="row">
           <div class="col-md-3" style="border-right: 1px solid #ddd; min-height: 100vh">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                 <button class="nav-link text-left" id="v-pills-question-context-tab" data-toggle="pill" data-target="#v-pills-question-context" type="button" role="tab" aria-controls="v-pills-question-context" aria-selected="true">
                    <i class="far fa-file-word" style="margin-right: 18px"></i>Question & Context
                 </button>
                 <button class="nav-link text-left" id="v-pills-analytics-tab" data-toggle="pill" data-target="#v-pills-analytics" type="button" role="tab" aria-controls="v-pills-analytics" aria-selected="false">
                    <i class="fas fa-chart-line" style="margin-right: 18px"></i>Analytics
                 </button>
                 <button class="nav-link active text-left" id="v-pills-messages-tab" data-toggle="pill" data-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                    <i class="far fa-lightbulb" style="margin-right: 18px"></i>Explanation
                 </button>
              </div>
           </div>
           <div class="col-9">
              <div class="tab-content position-relative" id="v-pills-tabContent">
                 <div class="tab-pane fade" id="v-pills-question-context" role="tabpanel"aria-labelledby="v-pills-question-context-tab">
                 </div>
                 <div class="tab-pane fade" id="v-pills-analytics" role="tabpanel" aria-labelledby="v-pills-analytics-tab">
                 </div>
                 <div class="tab-pane fade show active" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <div class="row">
                       <div class="col-md-6">
                          <h4>Context</h4>
                          <p class="p-0 m-0">
                             <b>The tensionin in the rope has two components :</b>
                          </p>
                          <li class="p-0" style="margin-left: 18px">
                             Horizontal component:  T_x = T \cos(30°) 
                          </li>
                          <li class="p-0" style="margin-left: 18px">
                             Vertical component:  T_y = T \sin(30°) 
                          </li>
                          <p style="margin-top: 18px">
                             2. Since the surface is frictionless, only the horizontal
                             force affects the sled’s motion. Using Newton’s second law,  F
                             = ma :
                          </p>
                          <p>T_x = ma \quad \Rightarrow \quad a = \frac{T_x m}</p>
                          <p><b>3.Substituting values:</b></p>
                          <p>T_x = 50 \cos(30°) = 50 \times 0.866 \approx 43.3 N</p>
                          <p>a = \frac{43.3}{20} \approx 2.17 m/s^2</p>
                          <p>
                             The horizontal acceleration of the sled is approximately  2.17
                             m/s^2 .
                          </p>
                          <p style="text-align: justify">
                             Here’s an illustration of the physics scenario. It shows a
                             sled being pulled on an icy surface with the force diagram
                             clearly depicted. The labeled vectors for tension, its
                             components, and the acceleration highlight the problem-solving
                             process described in the explanation.
                          </p>
                       </div>
                       <div class="col-md-6">
                          <div class="row p-2">
                             <h4 class="col-md-6">Question</h4>
                             <h4 class="col-md-6 text-right">23/30</h4>
                          </div>
                          <div class="question-box">
                             <img src="{{ asset('image/chart.png') }}" alt=""
                                style="height: 296px" />
                             <p style="margin-top: 8px">
                                A sled is being pulled along a flat, icy surface by a rope
                                that makes an angle of 30° with the horizontal. The sled has
                                a mass of 20 kg, and the tension in the rope is 50 N. Assume
                                the surface is frictionless.
                             </p>
                             <p>
                                What is the horizontal acceleration of the sled? (Take  g =
                                9.8 m/s^2 ).
                             </p>
                             <div class="check-box-field">
                                <label><input type="radio" name="option" class="m-0 p-0" /> 1.25 m/s^2</label><br />
                                <label><input type="radio" name="option" /> 2.50 m/s^2</label><br />
                                <label><input type="radio" name="option" /> 2.17 m/s^2</label><br />
                                <label><input type="radio" name="option" /> 3.25 m/s^2</label>
                             </div>
                          </div>
                       </div>
                    </div>
                    <p style="border-bottom: 1px solid #ddd; margin-top: 30px;"></p>
                    <div class="profileTableWrapper ">
                        <table class="table profileTable">
                            <thead style="background-color: #F9FAFB">
                            <tr>
                                <td style="width: 480px;">Question</td>
                                <td>Section</td>
                                <td>Difficulty</td>
                                <td>Your Time</td>
                                <td>Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span><i class="fas fa-check p-2 text-center" style="color: #079455; background-color: #ECFDF3;margin-right: 8px; border: 1px solid #079455; border-radius: 5px;"></i></span>
                                        <div>
                                            <p class="p-0 m-0">Question 1</p>
                                            <p><b>What type of bond is formed between two oxygen atoms in an O₂
                                                molecule? What is the chemical formula of water?</b>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>2</td>
                                <td><span class="badge badge-pill badge-hard">Hard</span></td>
                                <td>1 min 32 s</td>
                                <td>
                                    <button type="button" class="btn p-1" style="width: 94px; height: 36px; border: 1px solid #D0D5DD; border-radius: 5px;"  data-toggle="modal" data-target="#feedBackModal">Feedback</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <p style="border-bottom: 1px solid #ddd; margin-top: 30px;"></p>
                    <div style="margin-bottom: 30px;">
                        <div class="p-4"
                            style=" border-radius: 10px;border: 1px solid #ddd; min-height: 100vh;width: 100%;">
                            <h4>Explanation</h4>
                            <p style="border-bottom: 1px solid #ddd;width: 100%;margin-top: 20px; text-align: center;"></p>
                            <p><b>About the question</b></p>
                            <p> 2. Since the surface is frictionless, only the horizontal force affects <br>
                            the sled’s motion. Using Newton’s second law,  F = ma : <br>
                            T_x = ma \quad \Rightarrow \quad a = \frac{T_x m}
                            </p>
                            <p class="p-0 m-0"><b>The tension in the rope has two components</b></p>
                            <li class="p-0" style="margin-left: 18px;">Horizontal component:  T_x = T \cos(30°) </li>
                            <li class="p-0 " style="margin-left: 18px;">Vertical component:  T_y = T \sin(30°) </li>
                            <li class="p-0 " style="margin-left: 18px;">Non pellentesque congue eget consectetur turpis.
                            </li>
                            <p style="margin-top: 20px;margin-bottom: 20px;"><b>3.Substituting values:</b></p>
                            <p>T_x = 50 \cos(30°) = 50 \times 0.866 \approx 43.3 N</p>
                            <p>a = \frac{43.3}{20} \approx 2.17 m/s^2</p>
                            <p>The horizontal acceleration of the sled is approximately  2.17 m/s^2 .</p>
                            <img src="{{ asset('image/chart.png') }}" alt="" style="height: 504x;width: 925px;"  />
                            <p style="margin-top: 20px;margin-bottom: 20px;"><b>Traget</b></p>
                            <p>Here’s an illustration of the physics scenario. It shows a sled being pulled on an icy surface with the force diagram clearly depicted. The labeled vectors for tension, its components.
                            And the acceleration highlight the problem-solving process described in the explanation
                            </p>
                            <p><b>What does success look like?</b></p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Scelerisque tellus vel pretium posuere. Id maecenas a tristique in fusce hendrerit. Amet, mattis in vitae, est urna, diam. Ante fringilla nulla at sed tincidunt. Et aliquam neque cras mauris non bibendum. Hac ut ridiculus enim urna felis amet. Dolor aliquam diam suspendisse non elit faucibus id orci, mi.
                            Pharetra nam gravida commodo accumsan sapien aliquet bibendum purus nunc. Quam cursus at eu, aliquam integer. Accumsan, nisi ultricies ut pulvinar fames neque risus. Eu et, elementum leo amet bibendum gravida vitae ridiculus.
                            </p>
                        </div>
                    </div>
                 </div>
              </div>
              
           </div>
        </div>
        <p style="border-bottom: 1px solid #ddd; "></p>
        <div style="width: 100%;" class="d-flex text-align-right justify-content-end">
           <a href="" style="text-decoration: none;color: #521749;"><i class="far fa-flag" style="margin-right: 5px;"></i>Feedback</a>
        </div>
     </div>

     {{-- feadback modal --}}
     <div class="modal fade" id="feedBackModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="feedBackModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px;">
                <div class="modal-header text-center" style="background-color: #F9FAFB; border-radius: 24px 24px 0px 0px; display: inline-block;">
                    <h5 class="" id="exampleModalLongTitle"><b>Provide Feedback</b></h5>
                    <p>Your feedback helps us create a great experience. Please let us know what went wrong.</p>
                </div>
                <div class="modal-body text-center feedback-modal">
                    <div class="row">
                        <div class="col-md-12 feedback-option mt-2">
                            <div class="form-check custom-radio">
                                <input class="form-check-input" type="radio" name="feedback" id="" value="The answer choice is incorrect">
                                <label class="form-check-label" for="">
                                    The answer choice is incorrect
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 feedback-option mt-2">
                            <div class="form-check custom-radio">
                                <input class="form-check-input" type="radio" name="feedback" id="" value="The question contains an issue">
                                <label class="form-check-label" for="">
                                    The question contains an issue
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 feedback-option mt-2">
                            <div class="form-check custom-radio">
                                <input class="form-check-input" type="radio" name="feedback" id="" value="No relevance between context and question">
                                <label class="form-check-label" for="">
                                    No relevance between context and question
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 feedback-option mt-2">
                            <div class="form-check custom-radio">
                                <input class="form-check-input" type="radio" name="feedback" id="" value="Something else went wrong">
                                <label class="form-check-label" for="">
                                    Something else went wrong
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <textarea name="description" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer pb-0 pt-3">
                        <button type="button" class="btn btn-outline-dark" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn save" style="background-color:#691D5E ;border-radius: 8px; color:#fff">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>  

     @push('css')
         <link rel="stylesheet" href="{{ asset('css/explanation.css') }}">
     @endpush

     @push('js')
         <script>
            $(document).on('click', '.feedback-option', function() {
                $(this).find('input[type="radio"]').prop('checked', true);
            });
         </script>
     @endpush
</x-backend.layouts.student-master>