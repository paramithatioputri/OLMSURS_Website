<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Routing\Router;
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
        $query = $this->request->query();

        if((!empty($query['query1'])) && ($query['query2'] == 0)){
            $this->set('query1', $query['query1']);
            
            $q = str_replace(' ', '%', $query['query1']);

            $books = $this->Books->find()
            ->contain(['Subjects', 'Languages'])
            ->where([
                'OR' => [
                    'Books.book_number LIKE' => '%' . $q . '%',
                    'Books.title LIKE' => '%' . $q . '%',
                    'Books.author LIKE' => '%' . $q . '%',
                    'Subjects.subject_name LIKE' => '%' . $q . '%',
                    'Books.isbn LIKE' => '%' . $q . '%',
                ]
            ]);
            
        }
        else if((!empty($query['query1'])) && ($query['query2'] == 1)){
            $this->set('query1', $query['query1']);
            $q = str_replace(' ', '%', $query['query1']);

            $books = $this->Books->find()
            ->contain(['Subjects', 'Languages'])
            ->where([
                'OR' => [
                    'Books.title LIKE' => '%' . $q . '%',
                ]
            ]);
        }
        else if((!empty($query['query1'])) && ($query['query2'] == 2)){
            $this->set('query1', $query['query1']);
            $q = str_replace(' ', '%', $query['query1']);

            $books = $this->Books->find()
            ->contain(['Subjects', 'Languages'])
            ->where([
                'OR' => [
                    'Books.author LIKE' => '%' . $q . '%',
                ]
            ]);
        }
        else if((!empty($query['query1'])) && ($query['query2'] == 3)){
            $this->set('query1', $query['query1']);
            $q = str_replace(' ', '%', $query['query1']);

            $books = $this->Books->find()
            ->contain(['Subjects', 'Languages'])
            ->where([
                'OR' => [
                    'Subjects.subject_name LIKE' => '%' . $q . '%',
                ]
            ]);
        }
        else if((!empty($query['query1'])) && ($query['query2'] == 4)){
            $this->set('query1', $query['query1']);
            $q = str_replace(' ', '%', $query['query1']);

            $books = $this->Books->find()
            ->contain(['Subjects', 'Languages'])
            ->where([
                'OR' => [
                    'Books.isbn LIKE' => '%' . $q . '%',
                ]
            ]);
        }
        else if((!empty($query['query1'])) && ($query['query2'] == 5)){
            $this->set('query1', $query['query1']);
            $q = str_replace(' ', '%', $query['query1']);

            $books = $this->Books->find()
            ->contain(['Subjects', 'Languages'])
            ->where([
                'OR' => [
                    'Books.book_number LIKE' => '%' . $q . '%',
                ]
            ]);
        }
        else{
            $books = $this->Books->find()
            ->contain(['Subjects', 'Languages']);
        }

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
        $book = $this->Books->get($id, [
            'contain' => ['Subjects', 'Languages'],
        ]);

        $this->loadModel('BookCopies');

        $totalBookCopies = $this->BookCopies->find()
        ->where([
            'BookCopies.book_number' => $id,
        ])
        ->count();

        $this->set(compact('book', 'totalBookCopies'));
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

            $bookNumber = $this->Books->find()
            ->where([
                'Books.book_number' => $book->book_number
            ])
            ->first();

            if(!empty($this->request->data['book_cover_image']['name'])){
                $temp = explode(".", $_FILES['book_cover_image']['name']);
                $filename = 'bookcover_' . $book->book_number . '.' . $temp[1];
                $url = Router::url('/', true). 'img/book-cover-img/' . $filename;
                $uploadPath = 'img/book-cover-img/';

                $uploadfile = $uploadPath . $filename;
                if($bookNumber){
                    $this->Flash->error(__("The book with this book number already exists"));
                    return $this->redirect($this->referer());
                }
                else{
                    if(move_uploaded_file($this->request->data['book_cover_image']['tmp_name'],$uploadfile)){
                        $book->book_cover_image = $url;
                        if ($this->Books->save($book)) {
                            $this->Flash->success(__('The book has been saved.'));
            
                            return $this->redirect(['action' => 'index']);
                        }
                        $this->Flash->error(__('The book could not be saved. Please, try again.'));
                    }
                }
            }
            else{
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

            
        }
        $librarians = $this->Books->Librarians->find('list', ['limit' => 200]);
        $subjects = $this->Books->Subjects->find('list', ['limit' => 200, 'keyField' => 'subject_id', 'valueField' => 'subject_name']);
        $languages = $this->Books->Languages->find('list', ['limit' => 200, 'keyField' => 'language_id', 'valueField' => 'language_name']);
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
        $subjects = $this->Books->Subjects->find('list', ['limit' => 200, 'keyField' => 'subject_id', 'valueField' => 'subject_name']);
        $languages = $this->Books->Languages->find('list', ['limit' => 200, 'keyField' => 'language_id', 'valueField' => 'language_name']);
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

    public function issueBookList(){
        $bookAvailabilityStatus = ['Available', 'On Loan'];
        $query = $this->request->query();

        if(!empty($query['searchq'])){
            $this->set('searchq', $query['searchq']);

            $q = str_replace(' ', '%', $query['searchq']);
    
            $this->loadModel('BookCopies');

            $bookCopies = $this->BookCopies->find()
            ->contain(['Books'])
            ->where([
                'BookCopies.availability_status' => $bookAvailabilityStatus[0],
                'OR' =>[
                    'BookCopies.book_number LIKE' => '%' . $q . '%',
                ]
            ])
            ->toArray();
        }

        $this->set('bookCopies', $bookCopies);
        
    }

    public function issueBooks($id=null){
        $bookAvailabilityStatus = ['Available', 'On Loan'];
        $status = ['Place Hold', 'Checked Out', 'Returned', 'Overdue'];

        $query = $this->request->query();
        $this->loadModel('Borrowers');

        if(!empty($query['searchborrower'])){
            $this->set('searchborrower', $query['searchborrower']);

            $q = str_replace(' ', '%', $query['searchborrower']);

            $borrowers = $this->Borrowers->find()
            ->where([
                'OR' => [
                    'Borrowers.user_id LIKE' => '%' . $q . '%',
                ]
            ])
            ->toArray();
        }

        $this->set('borrowers', $borrowers);

        $this->loadModel('BookCopies');

        $bookCopy = $this->BookCopies->find()
        ->contain(['Books'])
        ->where([
            'BookCopies.book_call_number' => $id,
            'BookCopies.availability_status' => $bookAvailabilityStatus[0],
        ])
        ->first();

        $this->set('bookCopy', $bookCopy);


        $this->loadModel('BorrowerBookStatus');

        $borrower_issue_book = $this->BorrowerBookStatus->newEntity();
         
        if($this->request->is('post')){

            $this->loadModel('Borrowers');
            $this->loadModel('BookCopies');

            $borrower_issue_book = $this->BorrowerBookStatus->patchEntity($borrower_issue_book, $this->request->getData());
            $borrower_issue_book->status = $status[1];


            $bookCopy = $this->BookCopies->find()
            ->where([
                'BookCopies.book_call_number' => $borrower_issue_book->book_call_number,
            ])
            ->first();

            if($bookCopy->availability_status == $bookAvailabilityStatus[1]){
                $this->Flash->error(__("This book is loaned by another borrower"));
                return $this->redirect(['controller' => 'books', 'action' => 'issue_book_list']);
            }

            $bookCopy->availability_status = $bookAvailabilityStatus[1];

            $borrower = $this->Borrowers->find()
            ->where([
                'Borrowers.user_id' => $borrower_issue_book->user_id,
            ])
            ->first();

            if($borrower->num_of_books_taken >= 5){
                $this->Flash->error(__("You have borrowed 5 books or more"));
                return $this->redirect(['controller' => 'books', 'action' => 'issue_book_list']);
            }

            $borrower->num_of_books_taken = $borrower->num_of_books_taken + 1;
            
            if($this->BorrowerBookStatus->save($borrower_issue_book) && $this->Borrowers->save($borrower) && $this->BookCopies->save($bookCopy)){
                $this->Flash->success(__("The book has been issued"));
                return $this->redirect(['controller' => 'books', 'action' => 'issue_book_list']);
            }
            else{
                $this->Flash->error(__("Fail to issue the book"));
                return $this->redirect(['controller' => 'books', 'action' => 'issue_book_list']);
            }
        }

        

    }
}
