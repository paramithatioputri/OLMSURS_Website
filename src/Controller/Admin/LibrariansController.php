<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Librarians Controller
 *
 *
 * @method \App\Model\Entity\Librarian[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LibrariansController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        // $librarians = $this->paginate($this->Librarians);

        // $this->set(compact('librarians'));
    }

    /**
     * View method
     *
     * @param string|null $id Librarian id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $librarian = $this->Librarians->get($id, [
            'contain' => [],
        ]);

        $this->set('librarian', $librarian);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $librarian = $this->Librarians->newEntity();
        if ($this->request->is('post')) {
            $librarian = $this->Librarians->patchEntity($librarian, $this->request->getData());
            if ($this->Librarians->save($librarian)) {
                $this->Flash->success(__('The librarian has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The librarian could not be saved. Please, try again.'));
        }
        $this->set(compact('librarian'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Librarian id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $librarian = $this->Librarians->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $librarian = $this->Librarians->patchEntity($librarian, $this->request->getData());
            if ($this->Librarians->save($librarian)) {
                $this->Flash->success(__('The librarian has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The librarian could not be saved. Please, try again.'));
        }
        $this->set(compact('librarian'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Librarian id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $librarian = $this->Librarians->get($id);
        if ($this->Librarians->delete($librarian)) {
            $this->Flash->success(__('The librarian has been deleted.'));
        } else {
            $this->Flash->error(__('The librarian could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function register(){

    }
}
