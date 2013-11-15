<?php

// @codingStandardsIgnoreFile
/**
 * This is a stub class for documentation of the ZMQ library. It should NEVER be autoloaded.
 * @see http://php.zero.mq/class.zmqsocket.html
 */
class ZMQSocket {
	/**
	 * @param ZMQContext $context
	 * @param int $type one of the ZMQ::SOCKET_* contants
	 * @param string $persistent_id
	 * @param callable $on_new_socket
	 */
	public function __construct(ZMQContext $context, $type, $persistent_id = null, callable $on_new_socket = null) {
		// Native code
	}

	/**
	 * @param string $dsn the bind descriptor
	 * @param bool $force
	 */
	public function bind($dsn, $force = false) {
		// Native code
	}

	/**
	 * @param string $dsn the connect descriptor
	 * @param bool $force
	 */
	public function connect($dsn, $force = false) {
		// Native code
	}

	/**
	 * @return array
	 */
	public function getEndpoints() {
		// Native code
	}

	/**
	 * @return string
	 */
	public function getPersistentId() {
		// Native code
	}

	/**
	 * @return int one of the ZMQ::SOCKET_* constants
	 */
	public function getSocketType() {
		// Native code
	}

	/**
	 * @param int $key one of the ZMQ::SOCKETOPT_* constants
	 */
	public function getSockOpt($key) {
		// Native code
	}

	/**
	 * @return bool
	 */
	public function isPersistent() {
		// Native code
	}

	/**
	 * @param int $mode One of the ZMQ::MODE_* constants
	 * @return string
	 */
	public function recv($mode = 0) {
		// Native code
	}

	/**
	 * @param int $mode One of the ZMQ::MODE_* constants
	 * @return string
	 */
	public function recvMulti($mode = 0) {
		// Native code
	}

	/**
	 * @param string $message
	 * @param int $mode
	 *
	 * @return ZMQSocket
	 */
	public function send($message, $mode = 0) {
		// Native code
	}

	/**
	 * @param string[] $message
	 * @param int $mode
	 *
	 * @return ZMQSocket
	 */
	public function sendmulti(array $message, $mode =0) {
		// Native code
	}

	/**
	 * @param int $key      one of the ZMQ::SOCKETOPT_* constants
	 * @param mixed $value
	 *
	 * @return ZMQSocket
	 */
	public function setSockOpt($key, $value) {
		// Native code
	}

	/**
	 * @param string $dsn
	 * @return ZMQSocket
	 */
	public function unbind($dsn) {
		// Native code
	}
}
