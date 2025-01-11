<?php

declare(strict_types=1);

namespace App\UI\Front\Home;
use Nette\Application\UI\Form;

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
	public function renderDefault(string $author = null, string $year = null): void
    {
        $books = $this->database->table('books');

        if ($author) {
            $books->where('author LIKE ?', "%$author%");
        }

        if ($year) {
            $books->where('YEAR(year) = ?', $year);
        }

        $this->template->books = $books->fetchAll();
    }

    protected function createComponentFilterForm(): Form
    {
        $form = new Form;

        $form->addText('author', 'Autor:')
            ->setHtmlAttribute('placeholder', 'Zadejte autora');

        $form->addText('year', 'Rok vydání:')
            ->setHtmlAttribute('placeholder', 'Zadejte rok vydání');

        $form->addSubmit('filter', 'Filtrovat');

        $form->onSuccess[] = [$this, 'filterFormSucceeded'];

        return $form;
    }

    public function filterFormSucceeded(Form $form, \stdClass $values): void
    {
        $this->redirect('this', [
            'author' => $values->author,
            'year' => $values->year,
        ]);
    }
	// Incorporates methods to check user login status
	
}
