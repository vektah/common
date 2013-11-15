<?php

// @codingStandardsIgnoreFile
/**
 * This is a stub class for documentation of the ZMQ library. It should NEVER be autoloaded.
 * @see http://php.zero.mq/class.zmqpoll.html
 */
class ZMQPoll {
	/**
	 * @param ZMQSocket|resource $entry
	 * @param int $type one of ZMQ::POLL_IN or ZMQ::POLL_OUT
	 */
	public function add($entry, $type) {
		// Native code
	}

	/**
	 * @return ZMQPoll
	 */
	public function clear() {
		// Native code
	}

	/**
	 * @return int
	 */
	public function count() {
		// Native code
	}

	/**
	 * @return string[]
	 */
	public function getLastErrors() {
		// Native code
	}

	/**
	 * @param array $readable
	 * @param array $writeable
	 * @param int $timeout
	 *
	 * @return integer
	 */
	public function poll(&$readable, &$writeable, $timeout = -1){
		// Native code
	}

	/**
	 * @param ZMQSocket|resource $item
	 */
	public function remove($item){
		// Native code
	}
}
