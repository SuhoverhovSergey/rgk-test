<?php

namespace app\components\notice;

interface EventInterface
{
    /**
     * @return array
     */
    public function getNoticeParams();
}