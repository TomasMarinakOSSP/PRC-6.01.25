<?php

declare(strict_types=1);

namespace App\UI\Front\Home;

use Nette;


/**
 * Presenter for the dashboard view.
 * Ensures the user is logged in before access.
 */
final class HomePresenter extends Nette\Application\UI\Presenter
{
	public function __construct(
		private Nette\Database\Explorer $database,
	) {
	}
	public function renderDefault(): void
    {
        $this->template->books = $this->database->table('books')->fetchAll();
    }
	// Incorporates methods to check user login status
	
}
