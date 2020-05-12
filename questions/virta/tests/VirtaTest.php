<?php

namespace Tests;

use Virta\Classes\Comment;
use Virta\Classes\MarkDownPaser;
use PHPUnit\Framework\TestCase;
use Virta\Classes\Moderator;
use Virta\Classes\MorseTranslator;
use Virta\Classes\SJF;
use Virta\Classes\User;

class VirtaTest extends TestCase
{
    private $mardown;
    private $morseDecoder;
    private $sjf;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mardown = new MarkDownPaser();
        $this->morseDecoder = new MorseTranslator();
        $this->sjf = new SJF();
    }

    /**
     *test will convert specified text which is written in markdown style and convert
     * it into specified html
     */
    public function test_markdown_format_to_html()
    {
        $this->assertEquals ($this->mardown->format ('# dolor sit amet, consectetur adipiscing elit. Integer a neque eros. Integer pellentesque leo'), '< h1>dolor sit amet, consectetur adipiscing elit. Integer a neque eros. Integer pellentesque leo< /h1>', 'Should work for level-1 header');
        $this->assertEquals($this->mardown->format ('## consectetur adipiscing elit. Integer a neque eros. Integer pellentesque leo'), '< h2>consectetur adipiscing elit. Integer a neque eros. Integer pellentesque leo< /h2>', 'Should work for level-2 header');
        $this->assertEquals ($this->mardown->format ('### sed, viverra'), '< h3>sed, viverra< /h3>', 'Should work for level-3 header');
        $this->assertEquals ($this->mardown->format ('#### Class aptent'), '< h4>Class aptent< /h4>', 'Should work for level-4 header');
        $this->assertEquals ($this->mardown->format ('##### rutrum mi eu, finibus interdum tortor. Class aptent taciti sociosqu ad'), '< h5>rutrum mi eu, finibus interdum tortor. Class aptent taciti sociosqu ad< /h5>', 'Should work for level-5 header');
        $this->assertEquals ($this->mardown->format ('###### pellentesque leo ac blandit luctus. Sed a eros eget arcu laoreet'), '< h6>pellentesque leo ac blandit luctus. Sed a eros eget arcu laoreet< /h6>', 'Should work for level-6 header');
        $this->assertEquals ($this->mardown->format ('####### Maecenas erat dolor, euismod rutrum mi eu, finibus interdum tortor.'), '< h6># Maecenas erat dolor, euismod rutrum mi eu, finibus interdum tortor.< /h6>', 'Should for strings starting with more than 6 hashtags');
        $this->assertEquals ($this->mardown->format ('* eget'), '< li>eget< /li>', 'Should work for list items');
        $this->assertEquals ($this->mardown->format ('# **ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas rutrum nisl eu**'), '< h1>< strong>ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas rutrum nisl eu< /strong>< /h1>', 'Should work for strings with emphasis');
        $this->assertEquals ($this->mardown->format ('blandit luctus. Sed a eros eget arcu laoreet suscipit. Maecenas ac urna tincidunt, fermentum'), '< p>blandit luctus. Sed a eros eget arcu laoreet suscipit. Maecenas ac urna tincidunt, fermentum< /p>', 'Should work for text without markup');
        $this->assertEquals($this->mardown->format ('**ad litora torquent per conubia nostra, per inceptos himenaeos.**'), '< p>< strong>ad litora torquent per conubia nostra, per inceptos himenaeos.< /strong>< /p>', 'Should work for strings with emphasis');
        $this->assertEquals ($this->mardown->format ('suscipit. Maecenas ac urna tincidunt, **fermentum** massa sed, viverra elit. Maecenas'), '< p>suscipit. Maecenas ac urna tincidunt, < strong>fermentum< /strong> massa sed, viverra elit. Maecenas< /p>', 'Should work for strings with partial emphasis');
        $this->assertEquals ($this->mardown->format ('# rutrum mi eu, **finibus interdum** tortor. Class aptent'), '< h1>rutrum mi eu, < strong>finibus interdum< /strong> tortor. Class aptent< /h1>', 'Should work for strings with partial emphasis');
        $this->assertEquals($this->mardown->format ('* elit. Maecenas **e**rat dolor,'), '< li>elit. Maecenas < strong>e< /strong>rat dolor,< /li>', 'Should work for strings with partial emphasis');
        $this->assertEquals ($this->mardown->format ('eros eget arcu **laoreet** suscipit. Maecenas ac urna tincidunt, **fermentum** massa sed, viverra'), '< p>eros eget arcu < strong>laoreet< /strong> suscipit. Maecenas ac urna tincidunt, < strong>fermentum< /strong> massa sed, viverra< /p>', 'Should work for strings where 2 parts of the string are emphasized');
        $this->assertEquals ($this->mardown->format ('# pellentesque leo ac **blandit luctus**. Sed a eros eget **arcu laoreet suscipit. Maecenas ac**'), '< h1>pellentesque leo ac < strong>blandit luctus< /strong>. Sed a eros eget < strong>arcu laoreet suscipit. Maecenas ac< /strong>< /h1>', 'Should work for strings where 2 parts of the string are emphasized');
        $this->assertEquals ($this->mardown->format ('* **himenaeos. Maecenas** rutrum **nisl eu** bibendum sodales'), '< li>< strong>himenaeos. Maecenas< /strong> rutrum < strong>nisl eu< /strong> bibendum sodales< /li>', 'Should work for strings where 2 parts of the string are emphasized');
        $this->assertEquals ($this->mardown->format ('rutrum mi e*u, finibus **inter**dum**'), '< p>rutrum mi e*u, finibus < strong>inter< /strong>dum**< /p>', 'Should work when string contains random asterisks');
        $this->assertEquals ($this->mardown->format ('****'), '< p>****< /p>', 'Compound asterisks 1');
        $this->assertEquals ($this->mardown->format ('*****'), '< p>< strong>*< /strong>< /p>', 'Compound asterisks 2');
        $this->assertEquals ($this->mardown->format ('***** **** *** ** *'), '< p>< strong>*< /strong> < strong>** < /strong>* ** *< /p>', 'Compound asterisks 4');
        $this->assertEquals ($this->mardown->format ('* ** *** **** *****'), '< li>< strong> < /strong>* < strong>** < /strong>***< /li>', 'Compound asterisks 3');

    }

    /**
     *test will convert specified text which is written in markdown style and convert
     * it into specified html
     */
    public function test_will_convert_morse_code_into_human_readble_text()
    {
        $this->assertEquals ($this->morseDecoder->decode_morse ('.... . -.--   .--- ..- -.. .'),
            'HEY JUDE', 'Should display HEY JUDE');
        $this->assertEquals ($this->morseDecoder->decode_morse ('.   .'),
            'E E', 'Should display E E');
        $this->assertEquals ($this->morseDecoder->decode_morse ('.'),
            'E', 'Should display HEY JUDE');
    }

    public function test_short_job_first()
    {
        $this->assertEquals ($this->sjf->compute([100], 0), 100);
        $this->assertEquals($this->sjf->compute([3,10,20,1,2], 0), 6);
        $this->assertEquals ($this->sjf->compute([3,10,20,1,2], 1), 16);
    }


    /**
     * virta markdown question tests
     */
    public function testBasicValidCases() {
        $this->assertSame("<h1>header</h1>",  $this->mardown->markdown_parser ("# header"));
        $this->assertSame("<h2>smaller header</h2>",  $this->mardown->markdown_parser ("## smaller header"));
    }
    public function testBasicInvalidCases() {
        $this->assertSame("#Invalid", $this->mardown->markdown_parser ("#Invalid"));
    }

    /**
     * Virta sjfs tests
     */
    public function testShouldHandleTheExample() {
        $this->assertSame(6, $this->sjf->compute(array(3,10,20,1,2),0));
        $this->assertSame(26, $this->sjf->compute(array(3,10,10,20,1,2),2));
        $this->assertSame(40, $this->sjf->compute(array(10,10,10,10),3));
    }

    /**
     * virta comments section tests
     */
    public function testExample() {
        $user = new User("User 1");
        $this->assertEquals("User 1", $user->getName(), "User name is set correctly");
        $mod = new Moderator("Moderator");
        $this->assertInstanceOf(User::class, $mod, "Moderator is a User");
    }

    public function testExample2() {
        $user1 = new User("User 1");
        $user2 = new User("User 2");
        $comment1 = new Comment($user1, 'I am User 1');
        $comment2 = new Comment($user2, 'I am User 2');


        $this->assertEquals(false, $user1->canEdit($comment2), "User 1 should not be able to edit User 2 comments");
    }

    /**
     * Virta morse code tests
     */
    public function testBasicCases() {
        $this->assertEquals(["E"], $this->morseDecoder->possibilities("."));
        $this->assertEquals(["A"], $this->morseDecoder->possibilities(".-"));
    }

    public function testAWordWithASingleUnknownSignal() {
        $this->assertEquals(["E","T"], $this->morseDecoder->possibilities("?"));
        $this->assertEquals(["I","N"], $this->morseDecoder->possibilities("?."));
        $this->assertEquals(["I","A"], $this->morseDecoder->possibilities(".?"));
    }

    protected function tearDown() : void
    {
        $this->mardown = null;
    }
}
