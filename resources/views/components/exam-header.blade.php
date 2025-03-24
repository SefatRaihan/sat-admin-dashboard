<a href="{{ url('/exams') }}" class="text-dark">
    <i class="fa-solid fa-angle-left mr-2"></i> 
    Create Exam : Add Question to Section <span class="section_order"></span>
</a>

<div class="heading-summary">
    <ul class="pl-4 m-0">
        <li id="type" style="list-style: none">{{ $exam->sections[0]->audience }}</li>
        <li id="total-section">{{ $exam->section }} sections</li>
        <li id="total-question">{{ $exam->sections[0]->num_of_question }} Questions</li>
        <li id="total-time">{{ $exam->sections[0]->duration }}</li>
    </ul>
</div>
