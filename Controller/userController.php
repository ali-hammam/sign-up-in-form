<?php
error_reporting(0);

use Model\user;
use \Nesc\Router\Request;

class userController
{
	public function add()
	{
		$name = $this->stringify(Request::get('name'));
		$email = $this->stringify(Request::get('email'));
		$password = $this->stringify(Request::get('password'));

		$user = new user();
		$user->insert($user->fillable, [$name, $email, $password])
			->run();

		echo json_encode([
			'status' => '204',
			"data" => Request::getData()
		]);
	}

	public function compareUsers()
	{
		$user = new user;

		$email = (Request::get('email'));
		$password = (Request::get('password'));
		$credentials = false;

		$data = $user->select($user->fillable)->runSelect()->get();

		foreach ($data as $user) {
			if (!strcmp($user['email'], $email) && !strcmp($user['password'], $password)) {
				$credentials = $user;
			}
		}

		echo json_encode([
			'status' => '204',
			"data" => $credentials
		]);
	}

	public function display()
	{
		$user = new user;
		$data = $user->select($user->fillable)->runSelect()->get();

		echo json_encode([
			'status' => '200',
			"data" => $data,
		]);
	}

	private function stringify($val)
	{
		return "'" . $val . "'";
	}
}
