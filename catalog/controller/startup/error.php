<?php
namespace Opencart\Catalog\Controller\Startup;
/**
 * Class Error
 *
 * @package Opencart\Catalog\Controller\Startup
 */
class Error extends \Opencart\System\Engine\Controller {
	/**
	 * @return void
	 */
	public function index(): void {
		$this->registry->set('log', new \Opencart\System\Library\Log($this->config->get('config_error_filename')));

		set_error_handler([$this, 'error']);
		set_exception_handler([$this, 'exception']);
	}

	/**
	 * Error
	 *
	 * @param int    $code
	 * @param string $message
	 * @param string $file
	 * @param int    $line
	 *
	 * @return bool
	 */
	public function error(int $code, string $message, string $file, int $line): bool {
		switch ($code) {
			case E_NOTICE:
			case E_USER_NOTICE:
				$error = 'Notice';
				break;
			case E_WARNING:
			case E_USER_WARNING:
				$error = 'Warning';
				break;
			case E_ERROR:
			case E_USER_ERROR:
				$error = 'Fatal Error';
				break;
			default:
				$error = 'Unknown';
				break;
		}

		if ($this->config->get('config_error_log')) {
			$this->log->write('PHP ' . $error . ':  ' . $message . ' in ' . $file . ' on line ' . $line);
		}

		if ($this->config->get('config_error_display')) {
			echo '<b>' . $error . '</b>: ' . $message . ' in <b>' . $file . '</b> on line <b>' . $line . '</b>';
		} else {
			header('Location: ' . $this->config->get('error_page'));
			exit();
		}

		return true;
	}

	/**
	 * Exception
	 *
	 * @param \Throwable $e
	 *
	 * @return void
	 */
	public function exception(\Throwable $e): void {
		if ($this->config->get('config_error_log')) {
			$this->log->write($e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
		}

		if ($this->config->get('config_error_display')) {
			echo '<b>' . $e->getMessage() . '</b>: in <b>' . $e->getFile() . '</b> on line <b>' . $e->getLine() . '</b>';
		} else {
			header('Location: ' . $this->config->get('error_page'));
			exit();
		}
	}
}
