<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BorrowerBookStatus Controller
 *
 * @property \App\Model\Table\BorrowerBookStatusTable $BorrowerBookStatus
 *
 * @method \App\Model\Entity\BorrowerBookStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BorrowerBookStatusController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Borrowers', 'BookCopies'],
        ];
        $borrowerBookStatus = $this->paginate($this->BorrowerBookStatus);

        $this->set(compact('borrowerBookStatus'));
    }

    /**
     * View method
     *
     * @param string|null $id Borrower Book Status id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $borrowerBookStatus = $this->BorrowerBookStatus->get($id, [
            'contain' => ['Borrowers', 'BookCopies'],
        ]);

        $this->set('borrowerBookStatus', $borrowerBookStatus);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $borrowerBookStatus = $this->BorrowerBookStatus->newEntity();
        if ($this->request->is('post')) {
            $borrowerBookStatus = $this->BorrowerBookStatus->patchEntity($borrowerBookStatus, $this->request->getData());
            if ($this->BorrowerBookStatus->save($borrowerBookStatus)) {
                $this->Flash->success(__('The borrower book status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The borrower book status could not be saved. Please, try again.'));
        }
        $borrowers = $this->BorrowerBookStatus->Borrowers->find('list', ['limit' => 200]);
        $bookCopies = $this->BorrowerBookStatus->BookCopies->find('list', ['limit' => 200]);
        $this->set(compact('borrowerBookStatus', 'borrowers', 'bookCopies'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Borrower Book Status id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $borrowerBookStatus = $this->BorrowerBookStatus->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $borrowerBookStatus = $this->BorrowerBookStatus->patchEntity($borrowerBookStatus, $this->request->getData());
            if ($this->BorrowerBookStatus->save($borrowerBookStatus)) {
                $this->Flash->success(__('The borrower book status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The borrower book status could not be saved. Please, try again.'));
        }
        $borrowers = $this->BorrowerBookStatus->Borrowers->find('list', ['limit' => 200]);
        $bookCopies = $this->BorrowerBookStatus->BookCopies->find('list', ['limit' => 200]);
        $this->set(compact('borrowerBookStatus', 'borrowers', 'bookCopies'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Borrower Book Status id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $borrowerBookStatus = $this->BorrowerBookStatus->get($id);
        if ($this->BorrowerBookStatus->delete($borrowerBookStatus)) {
            $this->Flash->success(__('The borrower book status has been deleted.'));
        } else {
            $this->Flash->error(__('The borrower book status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
