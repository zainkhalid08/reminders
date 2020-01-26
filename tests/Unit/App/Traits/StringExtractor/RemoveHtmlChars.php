<?php

namespace Tests\Unit\App\Traits\StringExtractor;

use App\Jobs\ExtractAyah;
use App\Post;
use App\Traits\StringExtractor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * The way we structure testContent and correct
 * answers is the array's key is testContent
 * while the value is the correct answer
 *
 * eg.
 * 
 * $tests = ['' => []];
 * 
 * '' is the testContent (key)
 * [] is the correct answer (value)
 * 
 */
class RemoveHtmlChars extends TestCase
{
	use StringExtractor;

// no content
// not found start & end while other stuff is present
// similar like starting and ending is present
// only starting delimiter is present
// only ending delimiter is present
// no content within ayah
// 1 ayah
// 1 ayah with html
// more than 1 ayahs
	// more ayahs with html

	protected $post;
	protected $extractAyah;
	protected $startingDelimiter;
	protected $endingDelimiter;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    // protected function setUp(): void
    // {
    // 	parent::setUp();

    // 	$this->post = new Post;

    // 	$this->extractAyah = new ExtractAyah($this->post);

    // 	$this->startingDelimiter = ExtractAyah::AYAH_STARTING_DELIMITER_FOREVER;

    // 	$this->endingDelimiter = ExtractAyah::AYAH_ENDING_DELIMITER_FOREVER;
    // }

    // html tags are presnt    

    function test_html_tags_are_removed()
    {
        $tests = [
        	'contents' => [
                // no space
                'look<p>this carefully</p>as there is a space before and after the html tag.',

                // 1 space before <
                'look <p>this carefully </p>as there is a space before and after the html tag.',
                'look  <p>this carefully  </p>as there is a space before and after the html tag.',
                'look   <p>this carefully   </p>as there is a space before and after the html tag.',
                'look    <p>this carefully    </p>as there is a space before and after the html tag.',
                'look     <p>this carefully     </p>as there is a space before and after the html tag.',
                'look      <p>this carefully      </p>as there is a space before and after the html tag.',
                'look       <p>this carefully       </p>as there is a space before and after the html tag.',

                // speacial ampersand ones &hellip; chars
                'look &hellip;this carefully&hellip; as there is a space before and after the html tag.',
                'look &hellip; this carefully &hellip; as there is a space before and after the html tag.',
                'look&hellip;this carefully&hellip;as there is a space before and after the html tag.',

                // speacial non ampersand ones \n \r
                'look this carefully as there is a space before and after the html tag.
                another text', // 16 spaces from the editor's left side
            ],
        	'answers' => [
                // no space THEN add one space 
                'look this carefully as there is a space before and after the html tag.',

                // 1 space before < THEN just remove tags 
                'look this carefully as there is a space before and after the html tag.',
                'look  this carefully  as there is a space before and after the html tag.', 
                'look  this carefully  as there is a space before and after the html tag.',
                'look   this carefully   as there is a space before and after the html tag.',
                'look   this carefully   as there is a space before and after the html tag.',
                'look    this carefully    as there is a space before and after the html tag.',
                'look    this carefully    as there is a space before and after the html tag.',

                // if speacial chars just replace them with one space
                'look  this carefully  as there is a space before and after the html tag.',
                'look   this carefully   as there is a space before and after the html tag.',
                'look this carefully as there is a space before and after the html tag.',

                // speacial non ampersand ones \n \r just replace them
                'look this carefully as there is a space before and after the html tag.        another text', // 8 spaces between
            ]
        ];

        foreach ($tests['contents'] as $key => $testContent) {
        	$result = $this->removeHtmlChars($testContent);	
            $this->assertEquals($tests['answers'][$key], $result);
        }

    }

}
