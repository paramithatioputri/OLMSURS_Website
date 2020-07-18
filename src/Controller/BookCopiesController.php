<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BookCopies Controller
 *
 * @property \App\Model\Table\BookCopiesTable $BookCopies
 *
 * @method \App\Model\Entity\BookCopy[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BookCopiesController extends AppController
{

    public function index()
    {
        $bookCopies = $this->paginate($this->BookCopies);

        $this->set(compact('bookCopies'));
    }

    /**
     * View method
     *
     * @param string|null $id Book Copy id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewBookCopies($id = null)
    {
        $bookCopies = $this->BookCopies->find('all')
        ->where([
            'book_number'  => $id,
        ])
        ->toArray();

        $this->loadModel("Books");

        $book = $this->Books->find()
        ->contain(['Subjects', 'Languages'])
        ->where([
            "Books.book_number" => $id,
        ])
        ->first();

        $totalBookCopies = $this->BookCopies->find()
        ->where([
            'book_number' => $id
        ])
        ->count();

        $this->set(compact('book', 'bookCopies', 'totalBookCopies'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addBookCopies($id = null)
    {
        $bookAvailabilityStatus = ['Available', 'On Loan'];

        $addBookCopy = $this->BookCopies->newEntity();
        if ($this->request->is('post')) {
            $addBookCopy = $this->BookCopies->patchEntity($addBookCopy, $this->request->getData());
            
            $addBookCopy->book_number = $id;
            $addBookCopy->availability_status = $bookAvailabilityStatus[0];

            if ($this->BookCopies->save($addBookCopy)) {
                $this->Flash->success(__('The book copy has been saved.'));

                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The book copy could not be saved. Please, try again.'));
        }
        $this->set(compact('addBookCopy'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Book Copy id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bookCopy = $this->BookCopies->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bookCopy = $this->BookCopies->patchEntity($bookCopy, $this->request->getData());
            if ($this->BookCopies->save($bookCopy)) {
                $this->Flash->success(__('The book copy has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book copy could not be saved. Please, try again.'));
        }
        $this->set(compact('bookCopy'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Book Copy id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteBookCopies($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $deleteBookCopy = $this->BookCopies->get($id);
        
        if ($this->BookCopies->delete($deleteBookCopy)) {
            $this->Flash->success(__('The book copy has been deleted.'));
        } else {
            $this->Flash->error(__('The book copy could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }
}
