<?php


namespace App\UI\Admin\Book;
use Nette;

use Nette\Application\UI\Form;

class BookPresenter extends Nette\Application\UI\Presenter
{
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    public function createComponentAddBookForm(): Form
    {
        $form = new Form;

        // Pole pro název knihy
        $form->addText('title', 'Název knihy:')
            ->setRequired('Zadejte název knihy.');

        // Pole pro autora knihy
        $form->addText('description', 'Popisek:')
            ->setRequired('Zadejte popisek knihy.');

        $form->addText('author', 'Autor:')
            ->setRequired('Zadejte autora knihy.');
        // Pole pro rok vydání
        $form->addText('publication_year', 'Rok vydání:')
            ->setRequired('Zadejte rok vydání.')
            ->addRule(Form::INTEGER, 'Rok vydání musí být číslo.')
            ->addRule(Form::MIN, 'Rok vydání musí být větší než 1000.', 1000);

        // Tlačítko pro odeslání formuláře
        $form->addSubmit('send', 'Přidat knihu');

        // Zpracování formuláře
        $form->onSuccess[] = [$this, 'addBookSucceeded'];

        return $form;
    }

    public function addBookSucceeded(Form $form, \stdClass $values): void
    {
        // Uložení dat do databáze
        $this->database->table('books')->insert([
            'title' => $values->title,
            'author' => $values->author,
            'publication_year' => $values->publication_year,
            'user_id' => 1, // Předpokládáme, že uživatel má ID 1
        ]);

        // Po přidání knihy přesměrování zpět na seznam knih
        $this->flashMessage('Kniha byla úspěšně přidána.');
        $this->redirect('this');
    }
}
?>