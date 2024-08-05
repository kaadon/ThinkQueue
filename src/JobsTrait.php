<?php
declare(strict_types=1);

namespace Kaadon\ThinkQueue;

use think\queue\Job;

/**
 * 队列基类
 */
trait JobsTrait
{
    /**
     * @return bool
     */
    public function doJOb(): bool
    {
        /** @noinspection PhpUndefinedClassInspection */
        return parent::doJOb();
    }

    /**
     * @param Job   $job
     * @param array $data
     *
     * @return void
     */
    public function fire(Job $job, array $data): void
    {
        /** @noinspection PhpUndefinedClassInspection */
        parent::fire($job, $data);
    }

    /**
     * @param array       $data
     * @param string      $task
     * @param int         $delay
     * @param string|null $queue
     * @param string|null $JobClass
     *
     * @return bool|string
     */
    public static function Push(array $data, string $task, int $delay = 0, ?string $queue = null, ?string $JobClass = null)
    {
        if (is_null($JobClass)) $JobClass = self::class;
        if (empty($task) || !method_exists($JobClass, $task)) {
            return false;
        }
        if (empty($queue)) {
            $queue = "default";
        } else if ($queue === "class") {
            $queue = class_basename(self::class . "_" . $task);
        }
        /** @noinspection PhpUndefinedClassInspection */
        return parent::Push($data, $task, $delay, $queue, $JobClass);
    }
}