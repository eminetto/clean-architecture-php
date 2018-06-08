<?php

namespace Bookmark\Driver\Queue;

interface QueueInterface
{
    public function publish($subject, $message);
}
