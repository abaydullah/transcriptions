<?php

namespace Abaydullah\Transcriptions;

class Line
{
        public function __construct(public int $position, public string $timestamp, public string $body)
        {

        }

        public function beginningTimestamp()
        {
            preg_match('/^\d{2}:(\d{2}:\d{2})\.\d{3}/', $this->timestamp,$matches);
            return $matches[1];
        }
        public function toAnchorTag()
        {
            return "<a href=\"?time={$this->beginningTimestamp()}\">{$this->body}</a>";
        }
}