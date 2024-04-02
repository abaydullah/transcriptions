<?php

namespace tests;

use Abaydullah\Transcriptions\Line;
use Abaydullah\Transcriptions\Transcription;
use PHPUnit\Framework\TestCase;

class TranscriptionTest extends TestCase
{
        protected Transcription $transcription;
        protected function setUp(): void
        {
            $this->transcription = Transcription::load(__DIR__.'/stubs/basic-example.vtt');
        }

     /** @test */
    function it_loads_a_vtt_file_as_a_string()
    {

        $this->assertStringContainsString('In this Larabit',$this->transcription);
        $this->assertStringContainsString('I\'ll give you some basic advice',$this->transcription);

    }
        /** @test */
    function it_can_convert_to_an_array_of_lines_objects(){

        $lines = $this->transcription->lines();

        $this->assertCount(2,$lines);
        $this->assertContainsOnlyInstancesOf(Line::class,$lines);
    }

    /** @test */
    function it_discard_irrelevant_lines_from_the_vtt_file(){

        $this->assertStringNotContainsString('WEBVTT', $this->transcription);
        $this->assertCount(2,$this->transcription->lines());
    }
  /** @test */
    function it_renders_the_lines_as_html()
    {
     $expected =<<<EOT
<a href="?time=00:03">In this Larabit</a>
<a href="?time=00:04">I'll give you some basic advice</a>
EOT;
        $this->assertEquals($expected,$this->transcription->lines()->asHtml());
    }


}