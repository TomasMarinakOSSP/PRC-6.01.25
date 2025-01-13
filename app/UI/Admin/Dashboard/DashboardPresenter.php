<?php

declare(strict_types=1);
namespace App\UI\Admin\Dashboard;
use Nette\Database\Explorer;
use Nette\Application\UI\Form;
use Ublaboo\DataGrid\DataGrid;

use App\UI\Accessory\RequireLoggedUser;
use Nette;


/**
 * Presenter for the dashboard view.
 * Ensures the user is logged in before access.
 */
final class DashboardPresenter extends Nette\Application\UI\Presenter
{
	public function __construct(
		private Nette\Database\Explorer $database,
	) {
	}
    public function renderDefault(): void
    {
        // Render the dashboard view
    }public function createComponentBooksGrid(): DataGrid
    {
        $grid = new DataGrid();
    
        // Nastavení zdroje dat - databázová tabulka 'books'
        $grid->setDataSource($this->database->table('books'));
        
        $grid->addColumnNumber('id', 'ID')
            ->setSortable();
        // Sloupec pro název knihy
        $grid->addColumnText('title', 'Název knihy')
            ->setSortable()
            ->setFilterText('title');
    
        // Sloupec pro autora
        $grid->addColumnText('author', 'Autor')
            ->setSortable()
            ->setFilterText('author');
    
        // Sloupec pro cenu
        $grid->addColumnNumber('price', 'Cena')
            ->setSortable();
    
        // Sloupec pro rok vydání
        $grid->addColumnNumber('year', 'Rok vydání')
            ->setSortable();
    
        // Sloupec pro kategorii (s vazbou na tabulku category)
        $grid->addColumnText('category', 'Kategorie')
    ->setRenderer(function ($item) {
        // Předpokládám, že $item je záznam z tabulky books a má vztah k tabulce categories
        $category = $this->database->table('category')->get($item->category_id);
        return $category ? $category->category_name : '-';
    })
    ->setSortable('category_id'); // Řazení podle sloupce category_id
    
    
        // Akce - například upravit knihu
        $grid->addAction('edit', 'Upravit', 'Book:editBook', ['id' => 'id'])
            ->setIcon('edit')
            ->setClass('btn btn-sm btn-primary');
    
        // Akce - smazat knihu
        $grid->addAction('delete', 'Smazat', 'deleteBook!')
        ->setIcon('trash')
        ->setClass('btn btn-sm btn-danger');
    
        return $grid;
    }
    public function handleDeleteBook(int $id): void
    {
        $book = $this->database->table('books')->get($id);

        if (!$book) {
            $this->flashMessage('Kniha nebyla nalezena.', 'danger');
            $this->redirect('this');
        }

        // Smazání knihy
        $book->delete();
        $this->flashMessage('Kniha byla úspěšně smazána.', 'success');
        $this->redirect('this'); // Obnoví stránku s DataGridem
    }
    public function handleEdit($id)
    {
        $this->redirect('Book:editBook', $id);
    }
	// Incorporates methods to check user login status
    use RequireLoggedUser;
}