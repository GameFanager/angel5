<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

namespace App\Http\Controllers;

use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
	use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

	/**
	 * @var array Data to be passed to all views.
	 */
	protected $data = [];

	/**
	 * @var A MessageBag of success messages to be passed using:
	 *      ->with('successes', $this->successes)
	 *      when redirecting.
	 */
	protected $successes;

	public function __construct()
	{
		$this->successes = new MessageBag();
		$this->data['successes'] = session('successes', new MessageBag());
		$this->data['errors'] = session('errors', new ViewErrorBag())->getBag('default');
	}

	protected function redirectSuccessMessage($message)
	{
		$this->successes->add('messages', $message);
	}

	/**
	 * Add a success message to be displayed at the top of the page.
	 *
	 * @param $message The message to add.
	 */
	protected function viewSuccessMessage($message)
	{
		$this->data['successes']->add('messages', $message);
	}

	/**
	 * Add an error message to be displayed at the top of the page.
	 *
	 * @param $message The message to add.
	 */
	protected function viewErrorMessage($message)
	{
		$this->data['errors']->add('messages', $message);
	}
}
