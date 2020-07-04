<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Books Controller
 *
 * @property \App\Model\Table\BooksTable $Books
 *
 * @method \App\Model\Entity\Book[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BooksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function booklist()
    {
        $books = $this->Books->find();
        
        $this->set('books', $this->paginate($books));
    }

    /**
     * View method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $book = $this->Books->get($id);

        $this->set('book', $book);
    }

    public function viewBookBorrowingHistory(){

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addBooks()
    {
        $book = $this->Books->newEntity();
        if ($this->request->is('post')) {
            $book = $this->Books->patchEntity($book, $this->request->getData());
            dd($book);
            $bookNumber = $this->Books->find()
            ->where([
                'Books.book_number' => $book->book_number
            ])
            ->first();

            if($bookNumber){
                $this->Flash->error(__("The book with this book number already exists"));
                return $this->redirect($this->referer());
            }
            else{
                if ($this->Books->save($book)) {
                    $this->Flash->success(__('The book has been saved.'));
    
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The book could not be saved. Please, try again.'));
            }
        }
        $librarians = $this->Books->Librarians->find('list', ['limit' => 200]);
        $subjects = $this->Books->Subjects->find('list', ['limit' => 200]);
        $languages = $this->Books->Languages->find('list', ['limit' => 200]);
        $this->set(compact('book', 'librarians', 'subjects', 'languages'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function updateBooks($id = null)
    {
        $book = $this->Books->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $book = $this->Books->patchEntity($book, $this->request->getData());
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book could not be saved. Please, try again.'));
        }
        $librarians = $this->Books->Librarians->find('list', ['limit' => 200]);
        $subjects = $this->Books->Subjects->find('list', ['limit' => 200]);
        $languages = $this->Books->Languages->find('list', ['limit' => 200]);
        $this->set(compact('book', 'librarians', 'subjects', 'languages'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $book = $this->Books->get($id);
        if ($this->Books->delete($book)) {
            $this->Flash->success(__('The book has been deleted.'));
        } else {
            $this->Flash->error(__('The book could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function issueBooks(){

    }
}
