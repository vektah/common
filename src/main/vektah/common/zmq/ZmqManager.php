<?php

namespace vektah\common\zmq;

use InvalidArgumentException;
use ZMQContext;
use ZMQSocket;

/**
 * ZMQ Contexts should be created only once per process. This is a simple singleton that allows the per-process
 * context to be created and accessed. Also provides common functionality for creating sockets.
 */
class ZmqManager
{
    private static $context;

    /** @var callable[] */
    private static $socket_creation_routines = [];

    /**
     * @return ZMQContext
     */
    public static function getContext()
    {
        if (!self::$context) {
            self::$context = new ZMQContext();
        }

        return self::$context;
    }

    /**
     * @param int $type one of the ZMQ::SOCKET_* constants
     * @param string $persistent_id
     * @param callable $on_new_socket
     *
     * @return ZMQSocket
     */
    public static function getSocket($type, $persistent_id = null, callable $on_new_socket = null)
    {
        // Rather then rely on keeping the defaults of this method and the constructor in sync we do this weird
        // if else thing. Different versions of ZMQ may have different defaults, this is the safest bet.
        if ($persistent_id === null) {
            $sock = new ZMQSocket(self::getContext(), $type);
        } elseif ($on_new_socket === null) {
            $sock = new ZMQSocket(self::getContext(), $type, $persistent_id);
        } else {
            $sock = new ZMQSocket(self::getContext(), $type, $persistent_id, $on_new_socket);

        }

        foreach (self::$socket_creation_routines as $routine) {
            $routine($sock);
        }

        return $sock;
    }

    /**
     * @param int $type one of the ZMQ::SOCKET_* constants
     * @param string $url
     * @param string $persistent_id
     * @param callable $on_new_socket
     *
     * @return ZMQSocket
     */
    public static function getSocketAndBind($type, $url, $persistent_id = null, callable $on_new_socket = null)
    {
        self::checkUrl($url);
        $sock = self::getSocket($type, $persistent_id, $on_new_socket);

        try {
            $sock->bind($url);
        } catch (\ZMQSocketException $e) {
            throw new InvalidArgumentException("Unable to bind to $url");
        }

        return $sock;
    }

    /**
     * @param int $type one of the ZMQ::SOCKET_* constants
     * @param string $url
     * @param string $persistent_id
     * @param callable $on_new_socket
     *
     * @return ZMQSocket
     */
    public static function getSocketAndConnect($type, $url, $persistent_id = null, callable $on_new_socket = null)
    {
        self::checkUrl($url);
        $sock = self::getSocket($type, $persistent_id, $on_new_socket);

        try {
            $sock->connect($url);
        } catch (\ZMQSocketException $e) {
            throw new InvalidArgumentException("Unable to connect to $url");
        }

        return $sock;
    }

    /**
     * Set a routine to be called during creation of a new zmq socket
     *
     * This makes it as lazily as possible to avoid per-test setup overhead
     */
    public static function socketCreationRoutine(callable $routine)
    {
        self::$socket_creation_routines[] = $routine;
    }

    public static function reset()
    {
        self::$context = null;
        self::$socket_creation_routines = [];
    }

    /**
     * Ensures that if the given ZMQ url requires and setup that it is done. Currently this is only ipc which must
     * have a local file created.
     */
    private static function checkUrl($url)
    {
        if (preg_match('#^ipc://(.*)#', $url, $matches)) {

            $file = $matches[1];

            $dir = dirname($file);

            if (!file_exists($dir)) {
                mkdir($dir, 0775, true);
            }

            if (!file_exists($file)) {
                touch($file);
            }
        }
    }
}
