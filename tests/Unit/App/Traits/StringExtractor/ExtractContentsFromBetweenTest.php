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
class ExtractContentsFromBetweenTest extends TestCase
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
    protected function setUp(): void
    {
    	parent::setUp();

    	$this->post = new Post;

    	$this->extractAyah = new ExtractAyah($this->post);

    	$this->startingDelimiter = ExtractAyah::AYAH_STARTING_DELIMITER_FOREVER;

    	$this->endingDelimiter = ExtractAyah::AYAH_ENDING_DELIMITER_FOREVER;
    }

    function test_when_no_content_is_present_then_emtpy_array()
    {
        $test = [
        	'content' => '',
        	'answer' => []
        ];

    	$result = $this->extractAyah->extractContentsFromBetween($test['content'], $this->startingDelimiter, $this->endingDelimiter);	
        $this->assertEquals($result, $test['answer']);
    }

    /** @test */
    function test_when_no_delimiter_is_present_then_empty_array()
    {	
        $test = [
        	'content' => '<p></p> sldj fsdo jkd sd <b>sfldks jfsd</b> slfs so no delimiter s present',
        	'answer' => []
        ];

    	$result = $this->extractAyah->extractContentsFromBetween($test['content'], $this->startingDelimiter, $this->endingDelimiter);	
        $this->assertEquals($result, $test['answer']);
    }

    function test_when_similar_to_delimiter_is_present_then_empty_array()
    {	
        $test = [
        	'content' => '<p></p> sldj fsdo jkd sd <b>sfldks jfsd</b> slfs so no delimiter s present "ayat>not ayah </ayat>',
        	'answer' => []
        ];

    	$result = $this->extractAyah->extractContentsFromBetween($test['content'], $this->startingDelimiter, $this->endingDelimiter);	
        $this->assertEquals($result, $test['answer']);
    }

    function test_when_only_starting_delimiter_is_present_then_empty_array()
    {	
        $test = [
        	'content' => '<p></p> sldj fsdo jkd sd <b>sfldks jfsd</b> slfs so no delimiter s present ""ayah>>sfdsds sdss',
        	'answer' => []
        ];

    	$result = $this->extractAyah->extractContentsFromBetween($test['content'], $this->startingDelimiter, $this->endingDelimiter);	
        $this->assertEquals($result, $test['answer']);
    }

    function test_when_only_ending_delimiter_is_present_then_empty_array()
    {	
        $test = [
        	'content' => '<p></p> sldj fsdo jkd sd <b>sfldks jfsd</b> slfs so no delimiter s present </ayah> sdss',
        	'answer' => []
        ];

    	$result = $this->extractAyah->extractContentsFromBetween($test['content'], $this->startingDelimiter, $this->endingDelimiter);	
        $this->assertEquals($result, $test['answer']);
    }

    function test_when_no_content_within_delimiters_then_an_array_with_first_index_having_empty_value()
    {	
        $test = [
        	'content' => $this->startingDelimiter. '' .$this->endingDelimiter ,
        	'answer' => [0 => '']
        ];

    	$result = $this->extractAyah->extractContentsFromBetween($test['content'], $this->startingDelimiter, $this->endingDelimiter);	
        $this->assertEquals($result, $test['answer']);
    }

    function test_when_content_within_delimiters_is_present_then_an_array_with_first_index_having_value()
    {	
        $test = [
        	'content' => $this->startingDelimiter. 'asdf sdfs dfsd' .$this->endingDelimiter ,
        	'answer' => [0 => 'asdf sdfs dfsd']
        ];

    	$result = $this->extractAyah->extractContentsFromBetween($test['content'], $this->startingDelimiter, $this->endingDelimiter);	
        $this->assertEquals($result, $test['answer']);
    }

    function test_when_content_within_delimiters_has_html_then_an_array_with_first_index_having_value()
    {	
        $tests = [
        	'contents' => [
        		$this->startingDelimiter. 'asdf <b>sdfs</b> dfsd' .$this->endingDelimiter, 
        		$this->startingDelimiter. '&hellip; asdf <b>sdfs</b> dfsd &hellip;' .$this->endingDelimiter, 
        		$this->startingDelimiter. '... <i></i> &hellip; asdf <b>sdfs</b> dfsd &hellip; ...' .$this->endingDelimiter, 
        	],
        	'answers' => [
        		['asdf <b>sdfs</b> dfsd'],
        		['&hellip; asdf <b>sdfs</b> dfsd &hellip;'],
        		['... <i></i> &hellip; asdf <b>sdfs</b> dfsd &hellip; ...'],
        	]
        ];

        foreach ($tests['contents'] as $key => $test['content']) {
	    	$result = $this->extractAyah->extractContentsFromBetween($test['content'], $this->startingDelimiter, $this->endingDelimiter);	
	        $this->assertEquals($result, $tests['answers'][$key]);
        }
    }

    /** @test */
    function test_when_more_occurances_are_present_then_an_array_of_all_values_in_correct_order()
    {
        $tests = [
        	'contents' => [
        		'asdf <b>sdfs</b> dfsd', 
        		'&hellip; asdf <b>sdfs</b> dfsd &hellip;', 
        		'... <i></i> &hellip; asdf <b>sdfs</b> dfsd &hellip; ...', 
        	],
			'answers' => [
        		'asdf <b>sdfs</b> dfsd',
        		'&hellip; asdf <b>sdfs</b> dfsd &hellip;',
        		'... <i></i> &hellip; asdf <b>sdfs</b> dfsd &hellip; ...',
        	]
        ];

    	$testContent = '';
        foreach ($tests['contents'] as $content) {
        	$testContent .= $this->startingDelimiter.$content.$this->endingDelimiter;
        }

    	$result = $this->extractAyah->extractContentsFromBetween($testContent, $this->startingDelimiter, $this->endingDelimiter);	
        $this->assertEquals($result, $tests['answers']);
    }   

    /** @test */
    function test_when_more_occurances_are_present_with_mixed_html_then_an_array_of_all_values_in_correct_order()
    {
    	$testContent = '<p>lsdjfo sdijfskld fjsdo fsifj sd fksdj </p>
    	 	<p>dslfk jsdof ksdjf lsad fjsd </p>
    	 	'.$this->startingDelimiter.'...first ayah content...'.$this->endingDelimiter. 
    	 	'<p>ds lfkjsd lfksdjf sdlk fjd</p>
    	 	<p>dsfasdd fddddddddddddddddd fjd</p>
    	 	'.$this->startingDelimiter.'...second ayah content...'.$this->endingDelimiter. 
    	 	'<hr><p>sldkfjsd ofjisd iojsdfio sdjoij</p>
	 	';

    	$answer = [
    	 	'...first ayah content...',
    	 	'...second ayah content...',
    	];

    	$result = $this->extractAyah->extractContentsFromBetween($testContent, $this->startingDelimiter, $this->endingDelimiter);	
        $this->assertEquals($result, $answer);
    } 


}
