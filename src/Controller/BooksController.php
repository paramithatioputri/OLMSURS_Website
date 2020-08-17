<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Routing\Router;
use Cake\Utility\Security;
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


    public function beforeFilter(){

        $this->Auth->allow([
            'booklist', 'view'
        ]);
    }
    
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth');
    } 

    public function isAuthorized($user = null){
        if($this->request->action === 'checkout'
        || $this->request->action === 'viewBookBorrowingHistory'
        || $this->request->action === 'rateBooks'
        || $this->request->action === 'deleteBorrowerRating')
        {
            return true;
        }
        else if($this->request->action === 'addBooks'
        || $this->request->action === 'updateBooks'
        || $this->request->action === 'delete'
        || $this->request->action === 'returnBooks'
        || $this->request->action === 'issueBookList'
        || $this->request->action === 'issueBooks'
        || $this->request->action === 'fines'){
            if($user['role'] === 'librarian'){

                return true;

            }
        }
        //Default deny
        return false;

        return parent::isAuthorized($user);
    }
    
    public function booklist()
    {
        $this->loadModel('BookCopies');

        $bookCopies = $this->BookCopies->find()
        ->contain(['Books'])
        ->toArray();

        $query = $this->request->query();

        if((!empty($query['query1'])) && ($query['query2'] == 0)){
            $this->set('query1', $query['query1']);
            
            $q = str_replace(' ', '%', $query['query1']);

            $books = $this->Books->find()
            ->contain(['Subjects', 'Users'])
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
            ->contain(['Subjects', 'Languages', 'Users'])
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
            ->contain(['Subjects', 'Languages', 'Users'])
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
            ->contain(['Subjects', 'Languages', 'Users'])
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
            ->contain(['Subjects', 'Languages', 'Users'])
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
            ->contain(['Subjects', 'Languages', 'Users'])
            ->where([
                'OR' => [
                    'Books.book_number LIKE' => '%' . $q . '%',
                ]
            ]);
        }
        else{
            $books = $this->Books->find()
            ->contain(['Subjects', 'Languages', 'Users']);
        }

        $this->set(compact('books', 'bookCopies'));
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
            'BookCopies.availability_status' => 'Available'
        ])
        ->count();

        $this->loadModel('BorrowerBookRating');

        $totalBorrowersRateThisBook = $this->BorrowerBookRating->find()
        ->where([
            'BorrowerBookRating.book_number' => $id,
            'BorrowerBookRating.rating_given > ' => 0,
        ])
        ->count();

        $borrowerRatings = $this->BorrowerBookRating->find()
        ->contain('Users', 'Books')
        ->where([
            'BorrowerBookRating.book_number' => $id,
            'BorrowerBookRating.rating_given >' => 0, 
        ])
        ->toArray();

        $rateThisBook = $this->BorrowerBookRating->find()
        ->where([
            'BorrowerBookRating.book_number' => $id,
            'BorrowerBookRating.user_id' => $this->Auth->user('user_id'),
        ])
        ->first();

        if($this->request->is('post')){
            $data = $this->request->getData();
            if(empty($rateThisBook)){
                $rateThisBook = $this->BorrowerBookRating->newEntity();
                $rateThisBook = $this->BorrowerBookRating->patchEntity($rateThisBook, $data);
                $rateThisBook->user_id = $this->Auth->user('user_id');
                if(!$this->BorrowerBookRating->save($rateThisBook)){
                    $this->Flash->error(__('Fail to rate this book!'));
                    return $this->redirect($this->referer());
                }
            }
            else if(!empty($rateThisBook) && ($rateThisBook->rating_given == 0 || empty($rateThisBook->rating_given))){
                $rateThisBook = $this->BorrowerBookRating->patchEntity($rateThisBook, $data);
                if(!$this->BorrowerBookRating->save($rateThisBook)){
                    $this->Flash->error(__('Fail to rate this book!'));
                    return $this->redirect($this->referer());
                }
            }
            else{
                $rateThisBook = $this->BorrowerBookRating->patchEntity($rateThisBook, $data);
                if(!$this->BorrowerBookRating->save($rateThisBook)){
                    $this->Flash->error(__('Fail to rate this book!'));
                    return $this->redirect($this->referer());
                }
            }
            //Update the average rating of the book
            $bookAverageRating = $this->Books->find()
            ->where([
                'book_number' => $data['book_number'],
            ])
            ->first();

            $calcBookAvgs= $this->BorrowerBookRating->find()
            ->where([
                'book_number' => $data['book_number'],
            ])
            ->toArray();

            //Calculate the average rating of the book
            $count = 0;
            foreach($calcBookAvgs as $calcBookAvg){
                if(!empty($calcBookAvg->rating_given)){
                    $total += $calcBookAvg->rating_given;
                    $count++;
                }
            }
            $avg = $total/$count;

            $bookAverageRating->average_rating = $avg;
            
            if($this->Books->save($bookAverageRating)){
                $this->Flash->success(__('The book has been rated successfully!'));
                return $this->redirect($this->referer());
            }
        }

        $this->set(compact('book', 'borrowerRatings', 'totalBookCopies', 'totalBorrowersRateThisBook', 'rateThisBook'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addBooks()
    {
        $currDate = date("Y-m-d");
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
                        $book->user_id = $this->Auth->user('user_id');
                        $book->date_created = $currDate;
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
                    $book->user_id = $this->Auth->user('user_id');
                    $book->date_created = $currDate;
                    if ($this->Books->save($book)) {
                        $this->Flash->success(__('The book has been saved.'));
        
                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('The book could not be saved. Please, try again.'));
                }
            }

        }
        $subjects = $this->Books->Subjects->find('list', ['limit' => 200, 'keyField' => 'subject_id', 'valueField' => 'subject_name']);
        $languages = $this->Books->Languages->find('list', ['limit' => 200, 'keyField' => 'language_id', 'valueField' => 'language_name']);
        $this->set(compact('book', 'subjects', 'languages'));
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
        $currDate = date("Y-m-d");

        $book = $this->Books->get($id, [
            'contain' => [],
        ]);

        $bookImagePath = $book->book_cover_image;

        if ($this->request->is(['patch', 'post', 'put'])) {
            // Deleting the image from the webroot
            $bookUrlExplode = explode('/', $book->book_cover_image);
            $bookImgLocalPath = WWW_ROOT . 'img' . DS . 'book-cover-img' . DS . $bookUrlExplode[6];

            $book = $this->Books->patchEntity($book, $this->request->getData());

            if(!empty($this->request->data['book_cover_image']['name'])){
                if(file_exists($bookImgLocalPath)){
                    unlink($bookImgLocalPath);
                };

                $temp = explode(".", $_FILES['book_cover_image']['name']);
                $filename = 'bookcover_' . $book->book_number . '.' . $temp[1];
                $url = Router::url('/', true). 'img/book-cover-img/' . $filename;
                $uploadPath = 'img/book-cover-img/';

                $uploadfile = $uploadPath . $filename;
                if(move_uploaded_file($this->request->data['book_cover_image']['tmp_name'],$uploadfile)){
                    $book->book_cover_image = $url;
                    $book->user_id = $this->Auth->user('user_id');
                    $book->last_modified = $currDate;
                    if ($this->Books->save($book)) {
                        $this->Flash->success(__('The book has been updated successfully.'));
        
                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('The book could not be updated. Please, try again.'));
                }
            }
            else{
                $book->user_id = $this->Auth->user('user_id');
                $book->last_modified = $currDate;
                $book->book_cover_image = $bookImagePath;
                if ($this->Books->save($book)) {
                    $this->Flash->success(__('The book has been updated successfully.'));
    
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The book could not be updated. Please, try again.'));
                    
            }
        }

        $subjects = $this->Books->Subjects->find('list', ['limit' => 200, 'keyField' => 'subject_id', 'valueField' => 'subject_name']);
        $languages = $this->Books->Languages->find('list', ['limit' => 200, 'keyField' => 'language_id', 'valueField' => 'language_name']);
        $this->set(compact('book', 'subjects', 'languages'));
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

        $this->loadModel('BookCopies');
        $this->loadModel('BorrowerBookStatus');
        $this->loadModel('BorrowerBookRating');

        $book = $this->Books->get($id);

        $bookCopies = $this->BookCopies->find()
        ->where([
            'BookCopies.book_number' => $id,
        ])
        ->toArray();

        foreach($bookCopies as $bookCopy){
            if($bookCopy->availability_status == "On Loan"){
                $this->Flash->error(__("The book record cannot be deleted since the copies of this book are still on loan"));
                return $this->redirect($this->referer());
                break;
            }
        }

        $borrowerBookRatings = $this->BorrowerBookRating->find()
        ->where([
            'BorrowerBookRating.book_number' => $id,
        ])
        ->toArray();

        $borrowerBookStatuses = $this->BorrowerBookStatus->find()
        ->contain('BookCopies')
        ->toArray();


        $bookUrlExplode = explode('/', $book->book_cover_image);
        $bookImgLocalPath = WWW_ROOT . 'img' . DS . 'book-cover-img' . DS . $bookUrlExplode[6];

        if ($this->Books->delete($book)) {
            //deleting the image from webroot
            if(file_exists($bookImgLocalPath)){
                unlink($bookImgLocalPath);
            };

            foreach($borrowerBookStatuses as $borrowerBookStatus){
                if($borrowerBookStatus->book_copy->book_number == $id){
                    $this->BorrowerBookStatus->delete($borrowerBookStatus);
                }
            }

            foreach($bookCopies as $bookCopy){
                $this->BookCopies->delete($bookCopy);
            }
            foreach($borrowerBookRatings as $borrowerBookRating){
                $this->BorrowerBookRating->delete($borrowerBookRating);
            }
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
        $currDate = date("Y-m-d");

        $bookAvailabilityStatus = ['Available', 'On Loan'];
        $status = ['Place Hold', 'Checked Out', 'Returned', 'Overdue'];

        $query = $this->request->query();
        $this->loadModel('Users');

        if(!empty($query['searchborrower'])){
            $this->set('searchborrower', $query['searchborrower']);

            $q = str_replace(' ', '%', $query['searchborrower']);

            $borrowers = $this->Users->find()
            ->where([
                'Users.role' => 'borrower',
                'OR' => [
                    'Users.user_id LIKE' => '%' . $q . '%',
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

            $this->loadModel('Users');
            $this->loadModel('BookCopies');
            $this->loadModel('BorrowerBookRating');

            $data = $this->request->getData();

            $borrower_issue_book = $this->BorrowerBookStatus->patchEntity($borrower_issue_book, $data);
            $borrower_issue_book->status = $status[1];
            $borrower_issue_book->book_checkout_date = $currDate;

            if(empty($data['book_date_due'])){
                $this->Flash->error(__('Please enter the due date for returning the book'));
                return $this->redirect($this->referer());
            }

            $bookCopy = $this->BookCopies->find()
            ->where([
                'BookCopies.book_call_number' => $borrower_issue_book->book_call_number,
            ])
            ->first();

            if($bookCopy->availability_status == $bookAvailabilityStatus[1]){
                $this->Flash->error(__("This book is loaned to another borrower"));
                return $this->redirect(['controller' => 'books', 'action' => 'issue_book_list']);
            }


            $bookCopy->availability_status = $bookAvailabilityStatus[1];

            $borrower = $this->Users->find()
            ->where([
                'Users.user_id' => $borrower_issue_book->user_id,
            ])
            ->first();

            if($borrower->num_of_books_taken >= 5){
                $this->Flash->error(__("You have borrowed 5 books or more"));
                return $this->redirect($this->referer());
            }

            $borrower->num_of_books_taken = $borrower->num_of_books_taken + 1;

            $borrowerBookRating = $this->BorrowerBookRating->find()
            ->where([
                'BorrowerBookRating.user_id' => $borrower_issue_book->user_id,
                'BorrowerBookRating.book_number' => $bookCopy->book_number,
            ])
            ->first();
            
            if($this->BorrowerBookStatus->save($borrower_issue_book) && $this->Users->save($borrower) && $this->BookCopies->save($bookCopy)){
                if(empty($borrowerBookRating)){
                    $borrowerBookRatingNew = $this->BorrowerBookRating->newEntity();
                    $borrowerBookRatingNew->user_id = $borrower_issue_book->user_id;
                    $borrowerBookRatingNew->book_number = $bookCopy->book_number;
                    $this->BorrowerBookRating->save($borrowerBookRatingNew);
                }
                $this->Flash->success(__("The book has been issued"));
                return $this->redirect(['controller' => 'books', 'action' => 'issue_book_list']);
            }
            else{
                $this->Flash->error(__("Fail to issue the book. Please insert all the fields before issuing the book!"));
                return $this->redirect($this->referer());
            }
            
        } 

    }

    public function checkout(){
        $currDate = date("Y-m-d");

        $this->loadModel('Users');

        $borrower = $this->Users->find()
        ->where([
            'Users.user_id' => $this->Auth->user('user_id'),
            'Users.role' => 'borrower'
        ])
        ->first();

        $this->loadModel('BorrowerBookStatus');

        $borrower_book_statuses = $this->BorrowerBookStatus->find()
        ->contain(['BookCopies.Books'])
        ->where([
            'BorrowerBookStatus.user_id' => $this->Auth->user('user_id'),
        ])
        ->toArray();

        $overdueBooks = $this->BorrowerBookStatus->find()
        ->contain(['BookCopies.Books'])
        ->where([
            'BorrowerBookStatus.user_id' => $this->Auth->user('user_id'),
            'BorrowerBookStatus.status' => 'Checked Out',
            'BorrowerBookStatus.book_date_due <' => $currDate,
        ])
        ->count();

        $this->set(compact('borrower', 'borrower_book_statuses', 'overdueBooks'));

        if($this->request->is('post')){
            $data = $this->request->getData();
            $bookIds = $data['id'];
            $bookIdArr = explode(",", $bookIds);

            for($i = 0; $i < count($bookIdArr); $i++){
                $bookIdFine = explode(" ", $bookIdArr[$i]);

                $bookRenew = $this->BorrowerBookStatus->find()
                ->where([
                    'BorrowerBookStatus.id' => $bookIdFine[0],
                ])
                ->first();

                if($bookRenew->status == "Returned"){
                    continue;
                }

                if($bookRenew->times_renewed >= 2){
                    continue;
                }

                $bookRenew->times_renewed = $bookRenew->times_renewed + 1 ;
                $bookRenew->charge_amount = $bookRenew->charge_amount + $bookIdFine[1];
                $bookRenew->billing_date = $currDate;

                $bookDateDue = date('Y-m-d', strtotime($bookRenew->book_date_due));
                if($currDate >= $bookDateDue){
                    $bookRenew->book_date_due = date('Y-m-d', strtotime($currDate . ' + 7 days'));
                }
                else{
                    $bookRenew->book_date_due = date('Y-m-d', strtotime($bookRenew->book_date_due . ' + 7 days'));
                }

                if($this->BorrowerBookStatus->save($bookRenew)){
                    $flag = 0;
                }
            }

            $this->Flash->success(__("The books selected have been renewed"));
            return $this->redirect($this->referer());
        }
    }

    public function returnBooks(){
        $this->loadModel('BorrowerBookStatus');
        $this->loadModel('Users');
        $this->loadModel('BookCopies');

        $query = $this->request->query();

        if(!empty($query['borrower_return_q'])){
            $this->set('borrower_return_q', $query['borrower_return_q']);

            $q = str_replace(' ', '%', $query['borrower_return_q']);

            $borrower = $this->Users->find()
            ->where([
                'Users.user_id' => $q,
                'Users.role' => 'borrower'
            ])
            ->first();

            $borrowerTransacts = $this->BorrowerBookStatus->find()
            ->contain(['BookCopies.Books'])
            ->where([
                'BorrowerBookStatus.user_id' => $q,
                // 'BorrowerBookStatus.status' => 'Checked Out',
            ])
            ->toArray();
        }


        $this->set(compact('borrowerTransacts', 'borrower'));

        if($this->request->is('post')){
            $currDate = date("Y-m-d");
            $data = $this->request->getData();

            $bookTobeReturned = $data['borrower-transaction'];
            $bookReturnedArr = explode(" ", $bookTobeReturned);

            $returnThisBook = $this->BorrowerBookStatus->find()
            ->contain(['BookCopies.Books', 'Users'])
            ->where([
                'BorrowerBookStatus.user_id' => $bookReturnedArr[0],
                'BorrowerBookStatus.book_call_number' => $bookReturnedArr[1],
                'BorrowerBookStatus.status' => 'Checked Out',
            ])
            ->first();

            $returnThisBook->charge_amount = $returnThisBook->charge_amount + $bookReturnedArr[2];
            $returnThisBook->billing_date = $currDate;
            $returnThisBook->status = 'Returned';
            $returnThisBook->book_return_date = $currDate;
            $returnThisBook->book_copy->availability_status = 'Available';
            $returnThisBook->user->num_of_books_taken = $returnThisBook->user->num_of_books_taken - 1;

            if($this->BorrowerBookStatus->save($returnThisBook) && $this->Users->save($returnThisBook->user) && $this->BookCopies->save($returnThisBook->book_copy)){
                $this->Flash->success(__("The book has been returned successfully"));
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__("Fail to return the book"));
        }

    }

    public function fines($id=null){
        $this->loadModel('BorrowerBookStatus');
        $this->loadModel('Users');
        
        $borrower = $this->Users->find()
        ->where([
            'Users.user_id' =>$id,
        ])
        ->first();

        $borrower_book_statuses = $this->BorrowerBookStatus->find()
        ->contain(['BookCopies.Books', 'Users'])
        ->where([
            'BorrowerBookStatus.user_id' => $id,
        ])
        ->toArray();
        
        $this->set(compact('borrower', 'borrower_book_statuses'));

        if($this->request->is('post')){
            $data = $this->request->getData();
            $finesToBePaid = $data['charge_amount'];
            $finesToBePaidArr = explode(",", $finesToBePaid);

            for($i = 0; $i < count($finesToBePaidArr); $i++){
                $fineAndIdArr = explode(" ",$finesToBePaidArr[$i]);
            
                $borrowerPay = $this->BorrowerBookStatus->find()
                ->where([
                    'BorrowerBookStatus.id' => $fineAndIdArr[1],
                    'BorrowerBookStatus.user_id' => $id,
                    'BorrowerBookStatus.charge_amount' => $fineAndIdArr[0],
                ])
                ->first();
                $borrowerPay->charge_amount = (int)($borrowerPay->charge_amount - $fineAndIdArr[0]);

                if($this->BorrowerBookStatus->save($borrowerPay)){
                }
            }
            $this->Flash->success(__('The fines have been paid'));
            return $this->redirect($this->referer());
        }
    }

    public function viewBookBorrowingHistory(){
        $this->loadModel('BorrowerBookStatus');
        $borrowerBookStatuses = $this->BorrowerBookStatus->find()
        ->contain(['BookCopies.Books', 'Users'])
        ->where([
            'BorrowerBookStatus.user_id' => $this->Auth->user('user_id'),
        ])
        ->toArray();
        $this->set(compact('borrowerBookStatuses'));

    }

    public function rateBooks(){
        $this->loadModel('BorrowerBookRating');

        $borrowerBookRatings = $this->BorrowerBookRating->find()
        ->contain('Books')
        ->where([
            'BorrowerBookRating.user_id' => $this->Auth->user('user_id'),
        ])
        ->toArray();

        $this->set(compact('borrowerBookRatings'));

        if($this->request->is('post')){
            $data = $this->request->getData();

            if(empty($data['rating_given'])){
                $this->Flash->error(__('The book is not rated yet'));
                return $this->redirect($this->referer());
            }

            $ratedBook = $this->BorrowerBookRating->find()
            ->contain('Books')
            ->where([
                'BorrowerBookRating.user_id' => $this->Auth->user('user_id'),
                'BorrowerBookRating.book_number' => $data['book_number'],
            ])
            ->first();

            $ratedBook->rating_given = $data['rating_given'];
            $ratedBook->comment = $data['comment'];

            if($this->BorrowerBookRating->save($ratedBook)){
                //Update the average rating of the book
                $bookAverageRating = $this->Books->find()
                ->where([
                    'book_number' => $data['book_number'],
                ])
                ->first();

                $calcBookAvgs= $this->BorrowerBookRating->find()
                ->where([
                    'book_number' => $data['book_number'],
                ])
                ->toArray();

                //Calculate the average rating of the book
                $count = 0;
                foreach($calcBookAvgs as $calcBookAvg){
                    if(!empty($calcBookAvg->rating_given)){
                        $total += $calcBookAvg->rating_given;
                        $count++;
                    }
                }
                $avg = $total/$count;

                $bookAverageRating->average_rating = $avg;
                
                if($this->Books->save($bookAverageRating)){
                    $this->Flash->success(__('The book has been rated successfully'));
                    return $this->redirect($this->referer());
                }
            }
        }
    }

    public function deleteBorrowerRating(){
        if($this->request->is('post')){
            $data = $this->request->getData();

            $this->loadModel('BorrowerBookRating');

            $ratingDeleted = $this->BorrowerBookRating->get($data);

            $ratingDeleted->rating_given = '';
            $ratingDeleted->comment = '';

            if($this->BorrowerBookRating->save($ratingDeleted)){
                //Update the average rating of the book
                $bookAverageRating = $this->Books->find()
                ->where([
                    'book_number' => $ratingDeleted['book_number'],
                ])
                ->first();


                $calcBookAvgs= $this->BorrowerBookRating->find()
                ->where([
                    'book_number' => $ratingDeleted['book_number'],
                ])
                ->toArray();

                //Calculate the average rating of the book
                $count = 0;
                foreach($calcBookAvgs as $calcBookAvg){
                    if(!empty($calcBookAvg->rating_given)){
                        $total += $calcBookAvg->rating_given;
                        $count++;
                    }
                }
                $avg = $total/$count;

                $bookAverageRating->average_rating = $avg;
                
                if($this->Books->save($bookAverageRating)){
                    $this->Flash->success(__('The rating has been deleted successfully'));
                    return $this->redirect($this->referer());
                }
            }
        }
    }
}
