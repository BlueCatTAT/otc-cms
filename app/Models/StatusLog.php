<?php

namespace OtcCms\Models;

final class StatusLog
{
    /**
     * @var NumericCodeInterface
     */
    private $targetStatus;
    /**
     * @var NumericCodeInterface
     */
    private $previousStatus;
    /**
     * @var NumericCodeInterface
     */
    private $postStatus;

    private function __construct(NumericCodeInterface $target,
        NumericCodeInterface $previous,
        NumericCodeInterface $post)
    {
        $this->targetStatus = $target;
        $this->previousStatus = $previous;
        $this->postStatus = $post;
    }

    public static function createInstance(
        NumericCodeInterface $target,
        NumericCodeInterface  $previous,
        NumericCodeInterface $post)
    {
        return new self($target, $previous, $post);
    }

    public function getPreviousStatusCode()
    {
        return $this->previousStatus->getCode();
    }

    public function getPostStatusCode()
    {
        return $this->postStatus->getCode();
    }

    public function getTargetStatusCode()
    {
        return $this->targetStatus->getCode();
    }

    public function getPreviousStatusText()
    {
        return $this->previousStatus->getText();
    }

    public function getPostStatusText()
    {
        return $this->postStatus->getText();
    }

    public function getTargetStatusText()
    {
        return $this->targetStatus->getText();
    }
}
