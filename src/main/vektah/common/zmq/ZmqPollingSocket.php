<?php

namespace vektah\common\zmq;

use ZMQPoll;
use ZMQPollException;
use ZMQSocket;

/**
 * Wraps the ZeroMQ poll class http://php.zero.mq/zmqpoll.poll.html
 *
 * Provides a nicer interface.
 */
class ZmqPollingSocket
{
    /** @var ZMQPoll  */
    private $poll;

    /** @var callable */
    private $on_writeable;

    /** @var callable */
    private $on_readable;

    /** @var callable */
    private $on_timeout;

    /** @var int timeout in milliseconds */
    private $timeout = -1;

    public function __construct() {
        $this->poll = new ZMQPoll();
    }

    /**
     * @param int $timeout timeout in milliseconds
     */
    public function setTimeout($timeout = -1)
    {
        $this->timeout = $timeout;
    }

    /**
     * @param ZMQSocket    $socket     the socket to add
     * @param int          $direction  An or'd combination of ZMQ::POLL_IN and ZMQ::POLL_OUT
     */
    public function add(ZMQSocket $socket, $direction)
    {
        $this->poll->add($socket, $direction);
    }

    /**
     * Blocks waiting for input unless a timeout is specified. Once the timeout is reached execution is returned.
     *
     * Will call the given on_{readable,writable,idle} functions depending on what is available.
     */
    public function poll()
    {
        $readable = [];
        $writable = [];

        $on_readable = $this->on_readable;
        $on_writable = $this->on_writeable;

        $events = $this->poll->poll($readable, $writable, $this->timeout);

        if ($events == 0) {
            if ($this->on_timeout) {
                call_user_func($this->on_timeout);
            }
        } else {
            foreach ($this->poll->getLastErrors() as $error) {
                throw new ZMQPollException($error);
            }

            if ($this->on_readable) {
                foreach ($readable as $read) {
                    $on_readable($read);
                }
            }

            if ($this->on_writeable) {
                foreach ($writable as $write) {
                    $on_writable($write);
                }
            }
        }
    }

    /**
     * Set the callback to run when a socket becomes writable
     *
     * @param callable $function
     */
    public function onWritable(callable $function)
    {
        $this->on_writeable = $function;
    }

    /**
     * Set the callback to run when a socket becomes readable
     *
     * @param callable $function
     */
    public function onReadable(callable $function)
    {
        $this->on_readable = $function;
    }

    /**
     * Set the callback to run when a socket times out.
     *
     * @param callable $function
     */
    public function onTimeout(callable $function)
    {
        $this->on_timeout = $function;
    }
}
