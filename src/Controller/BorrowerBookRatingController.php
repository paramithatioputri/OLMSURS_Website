<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BorrowerBookRating Controller
 *
 * @property \App\Model\Table\BorrowerBookRatingTable $BorrowerBookRating
 *
 * @method \App\Model\Entity\BorrowerBookRating[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BorrowerBookRatingController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Borrowers', 'Books'],
        ];
        $borrowerBookRating = $this->paginate($this->BorrowerBookRating);

        $this->set(compact('borrowerBookRating'));
    }

    /**
     * View method
     *
     * @param string|null $id Borrower Book Rating id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $borrowerBookRating = $this->BorrowerBookRating->get($id, [
            'contain' => ['Borrowers', 'Books'],
        ]);

        $this->set('borrowerBookRating', $borrowerBookRating);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $borrowerBookRating = $this->BorrowerBookRating->newEntity();
        if ($this->request->is('post')) {
            $borrowerBookRating = $this->BorrowerBookRating->patchEntity($borrowerBookRating, $this->request->getData());
            if ($this->BorrowerBookRating->save($borrowerBookRating)) {
                $this->Flash->success(__('The borrower book rating has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The borrower book rating could not be saved. Please, try again.'));
        }
        $borrowers = $this->BorrowerBookRating->Borrowers->find('list', ['limit' => 200]);
        $books = $this->BorrowerBookRating->Books->find('list', ['limit' => 200]);
        $this->set(compact('borrowerBookRating', 'borrowers', 'books'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Borrower Book Rating id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $borrowerBookRating = $this->BorrowerBookRating->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $borrowerBookRating = $this->BorrowerBookRating->patchEntity($borrowerBookRating, $this->request->getData());
            if ($this->BorrowerBookRating->save($borrowerBookRating)) {
                $this->Flash->success(__('The borrower book rating has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The borrower book rating could not be saved. Please, try again.'));
        }
        $borrowers = $this->BorrowerBookRating->Borrowers->find('list', ['limit' => 200]);
        $books = $this->BorrowerBookRating->Books->find('list', ['limit' => 200]);
        $this->set(compact('borrowerBookRating', 'borrowers', 'books'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Borrower Book Rating id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $borrowerBookRating = $this->BorrowerBookRating->get($id);
        if ($this->BorrowerBookRating->delete($borrowerBookRating)) {
            $this->Flash->success(__('The borrower book rating has been deleted.'));
        } else {
            $this->Flash->error(__('The borrower book rating could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
