<?php

declare(strict_types=1);

namespace App\UI\Front\Detail;
use Nette\Application\UI\Form;

use Nette;


/**
 * Presenter for the dashboard view.
 * Ensures the user is logged in before access.
 */
final class DetailPresenter extends Nette\Application\UI\Presenter
{
	public function __construct(
		private Nette\Database\Explorer $database,
	) {
	}
    public function renderDefault(int $id): void
    {
        $book = $this->database->table('books')->get($id);
        if (!$book) {
            $this->error('Book not found');
        }
        $this->template->book = $book;
    }
	
}
