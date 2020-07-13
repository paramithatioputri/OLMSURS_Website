<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Borrowers Controller
 *
 *
 * @method \App\Model\Entity\Borrower[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BorrowersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        // $borrowers = $this->paginate($this->Borrowers);

        // $this->set(compact('borrowers'));
    }

    public function checkouts(){

    }

    public function personalAccount($id = null){
        $borrower = $this->Borrowers->find()
        ->where([
            'user_id' => $id
        ])
        ->first();

        $this->set(compact('borrower'));
    }

    public function borrowerHolds(){
        
    }
}
