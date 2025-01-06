<?php


namespace App\UI\Admin\Book;
use Nette;

use Nette\Application\UI\Form;

class BookPresenter extends Nette\Application\UI\Presenter
{

	public function __construct(
		private Nette\Database\Explorer $database,
	) {
	}
    public function renderEditBook(int $id): void
    {
        $book = $this->database->table('books')->get($id);
        if (!$book) {
            $this->error('Kniha nebyla nalezena');
        }
        $this->template->book = $book;
    
        $this['addBookForm']->setDefaults([
            'title' => $book->title,
            'author' => $book->author,
            'price' => $book->price,
            'year' => $book->year,
            'description' => $book->description,
            'category' => $book->category_id,
        ]);
    }
    public function createComponentAddBookForm(): Form
    {
        $form = new Form;
    
        $form->addText('title', 'Název knihy:')
            ->setRequired('Zadejte název knihy.');
    
        $form->addText('author', 'Autor:')
            ->setRequired('Zadejte autora knihy.');
    
        $form->addText('price', 'Cena:')
            ->setRequired('Zadejte cenu knihy.')
            ->addRule(Form::FLOAT, 'Cena musí být číslo.');
    
        $form->addText('year', 'Rok vydání:')
            ->setRequired('Zadejte rok vydání.')
            ->addRule(Form::INTEGER, 'Rok vydání musí být číslo.')
            ->addRule(Form::MIN, 'Rok vydání musí být větší než 1000.', 1000);
    
        $form->addText('description', 'Popisek:')
            ->setRequired('Zadejte popisek knihy.');
    
        // Přidání výběru kategorie
        $form->addSelect('category', 'Kategorie:', [
            1 => 'Klasická literatura',
            2 => 'Sci-fi / Dystopie',
            3 => 'Psychologie / Romány',
            4 => 'Dobrodružné příběhy',
            5 => 'Fantasy',
            6 => 'Thriller / Detektivky',
            7 => 'Filozofie / Duchovní',
        ])->setRequired('Vyberte kategorii.');
    
        $form->addSubmit('send', 'Přidat knihu');
    
        $form->onSuccess[] = [$this, 'addBookSucceeded'];
    
        return $form;
    }
    
    public function addBookSucceeded(Form $form, \stdClass $values): void
    {
        $id = $this->getParameter('id');
       
        if ($id) {
            $book = $this->database->table('books')->get($id);
            $book->update([
                'title' => $values->title,
                'author' => $values->author,
                'price' => $values->price,
                'year' => $values->year,
                'description' => $values->description,
                'category_id' => $values->category,
            ]);
    
            $this->flashMessage('Kniha byla úspěšně upravena.');
            $this->redirect('Dashboard:default');
        }
        else{
            $this->database->table('books')->insert([
                'title' => $values->title,
                'author' => $values->author,
                'price' => $values->price,
                'year' => $values->year,
                'description' => $values->description,
                'category_id' => $values->category, // Uložení ID kategorie
                ]);
        
            $this->flashMessage('Kniha byla úspěšně přidána.');
            $this->redirect('Dashboard:default');
            }
       
        
    }



}
?>