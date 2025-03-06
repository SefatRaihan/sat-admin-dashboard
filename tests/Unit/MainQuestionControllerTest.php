<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\ExamQuestion;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class MainQuestionControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_can_create_a_question()
    {
        // ✅ Ensure user exists
        $user = User::factory()->create();

        // ✅ Use `create()` instead of `make()`
        $question = ExamQuestion::factory()->create([
            'question_text' => 'What is Laravel?',
            'question_type' => 'MCQ',
            'options' => json_encode(['Framework', 'CMS', 'Library', 'Package']),
            'correct_answer' => 'Framework',
            'difficulty' => 'Medium',
            'created_by' => $user->id, // ✅ Ensure valid user ID
        ]);

        $this->assertInstanceOf(ExamQuestion::class, $question);
        $this->assertEquals('What is Laravel?', $question->question_text);
    }

    /** @test */
    public function it_can_validate_question_data()
    {
        $this->expectException(\InvalidArgumentException::class);

        // ✅ Create a test user
        $user = User::factory()->create();

        // ✅ No need to manually assign `question_id`
        $question = new ExamQuestion([
            'question_text' => '', // ❌ Invalid (empty)
            'question_type' => 'InvalidType', // ❌ Invalid
            'correct_answer' => '', // ❌ Invalid (empty)
            'difficulty' => 'SuperHard', // ❌ Invalid (should be Easy, Medium, Hard, Very Hard)
            'created_by' => $user->id,
        ]);

        $question->save(); // ❌ Should trigger an exception due to validation
    }

    /** @test */
    public function it_can_update_a_question()
    {
        $question = ExamQuestion::factory()->create();

        // ✅ Update question text
        $question->update(['question_text' => 'Updated Question']);

        $this->assertEquals('Updated Question', $question->fresh()->question_text);
    }

    /** @test */
    public function it_can_delete_a_question()
    {
        $question = ExamQuestion::factory()->create();
        $questionId = $question->id;

        $question->delete();

        // ✅ Ensure soft delete works correctly
        $this->assertSoftDeleted('exam_questions', ['id' => $questionId]);
    }

    /** @test */
    public function it_can_check_question_relationships()
    {
        $user = User::factory()->create();
        $question = ExamQuestion::factory()->create(['created_by' => $user->id]);

        $this->assertEquals($user->id, $question->createdBy->id);
    }
}
