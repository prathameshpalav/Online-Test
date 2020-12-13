<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTag extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }

    public static function allTags()
    {
        return QuestionTag::pluck('tag')->unique()->toArray();
    }

    public static function addTagsToQuestion(Question $question)
    {
        $tags = [];
        foreach(request('tags') as $tag) {
            $tags[] = ['tag' => $tag];
        }

        $question->tags()->createMany($tags);
    }
}
