<?php

namespace SeoThemes\IconWidget;

abstract class Container {

	/**
	 * @var array
	 */
	protected $services = [];

	/**
	 * Registers a service.
	 *
	 * @since 1.2.0
	 *
	 * @param string $service
	 *
	 * @return void
	 *
	 * @throws \Exception
	 */
	public function register( $service ) {
		if ( array_key_exists( strtolower( $service ), $this->services ) ) {
			throw new \Exception( $service . __( ' service is already registered.', 'icon-widget' ) );
		} else {
			$this->services[ strtolower( $service ) ] = new $service( $this );
		}
	}

	/**
	 * Runs all services.
	 *
	 * @since 1.2.0
	 *
	 * @return void
	 *
	 * @throws \Exception
	 */
	public function run() {
		foreach ( $this->services as $service => $class ) {
			if ( ! method_exists( $class, 'run' ) ) {
				throw new \Exception( $service . __( ' does not have a run method.', 'icon-widget' ) );
			}

			$class->run();
		}
	}
}
