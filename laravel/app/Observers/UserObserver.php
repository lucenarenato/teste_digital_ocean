<?php

namespace App\Observers;

use App\User;

class UserObserver
{
	public function creating(User $user)
	{
		var_dump('Estou enviando uma imagem');
	}

	public function updating(User $user)
	{
		var_dump('zzzz');
	}

	public function deleting(User $user)
	{
		var_dump('zzzz');
	}
}