<?php
/**
 *   +----------------------------------------------------------------------
 *   | PROJECT:   [ KaadonThinkQueue ]
 *   +----------------------------------------------------------------------
 *   | 官方网站:   [ https://developer.kaadon.com ]
 *   +----------------------------------------------------------------------
 *   | Author:    [ kaadon.com <kaadon.com@gmail.com>]
 *   +----------------------------------------------------------------------
 *   | Tool:      [ PhpStorm ]
 *   +----------------------------------------------------------------------
 *   | Date:      [ 2024/8/5 ]
 *   +----------------------------------------------------------------------
 *   | 版权所有    [ 2020~2024 kaadon.com ]
 *   +----------------------------------------------------------------------
 **/

use Kaadon\ThinkQueue\base\KaadonThinkQueueException;

if (!function_exists('kaadon_queue')) {
    /**
     * 获取类名
     * @param string $class
     * @param string $task
     * @param array $data
     * @param string $queue
     * @param int $delay
     * @return bool
     * @throws \Kaadon\ThinkQueue\base\KaadonThinkQueueException
     */
    function kaadon_queue(string $class,string $task,array $data,string $queue = 'default',int $delay = 0): bool
    {
        if (!method_exists($class, "Push")) throw new KaadonThinkQueueException('必须是任务类'); //判断是否是任务类
        if (!method_exists($class,$task)) throw new KaadonThinkQueueException('任务名称不能为空'); //判断任务名称是否为空
        if (empty($data)) throw new KaadonThinkQueueException('数据不能为空'); //判断数据是否为空
        return $class::Push($data, $task, $delay, $queue, $class);
    }
}