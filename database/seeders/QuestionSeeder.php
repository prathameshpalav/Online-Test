<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::create([
            'question'          => 'What does PHP stand for?',
            'description'       => '',
            'option1'           => 'Personal Home Page',
            'option2'           => 'Hypertext Preprocessor',
            'option3'           => 'Pretext Hypertext Processor',
            'option4'           => 'Preprocessor Home Page',
            'correct_option'    => 2,
            'marks'             => 1,
            'created_by'        => 2,
            'updated_by'        => 2
        ]);

        Question::create([
            'question'          => 'PHP files have a default file extension of_______',
            'description'       => '',
            'option1'           => '.html',
            'option2'           => '.xml',
            'option3'           => '.php',
            'option4'           => '.ph',
            'correct_option'    => 3,
            'marks'             => 1,
            'created_by'        => 2,
            'updated_by'        => 2
        ]);

        Question::create([
            'question'          => 'What should be the correct syntax to write a PHP code?',
            'description'       => '',
            'option1'           => '< php >',
            'option2'           => '< ? php ?>',
            'option3'           => '<? ?>',
            'option4'           => '<?php ?>',
            'correct_option'    => 4,
            'marks'             => 1,
            'created_by'        => 2,
            'updated_by'        => 2
        ]);

        Question::create([
            'question'          => 'Which version of PHP introduced Try/catch Exception?',
            'description'       => '',
            'option1'           => 'PHP 4',
            'option2'           => 'PHP 5',
            'option3'           => 'PHP 6',
            'option4'           => 'PHP 5 and later',
            'correct_option'    => 4,
            'marks'             => 1,
            'created_by'        => 2,
            'updated_by'        => 2
        ]);

        Question::create([
            'question'          => 'Which of the below statements is equivalent to $add += $add?',
            'description'       => '',
            'option1'           => '$add = $add',
            'option2'           => '$add = $add +$add',
            'option3'           => '$add = $add + 1',
            'option4'           => '$add = $add + $add + 1',
            'correct_option'    => 2,
            'marks'             => 1,
            'created_by'        => 2,
            'updated_by'        => 2
        ]);
    }
}
