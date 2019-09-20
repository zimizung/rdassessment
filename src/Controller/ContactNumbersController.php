<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ContactNumbers Controller
 *
 * @property \App\Model\Table\ContactNumbersTable $ContactNumbers
 *
 * @method \App\Model\Entity\ContactNumber[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContactNumbersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

        public $paginate = [
        'limit' => 10,
        'order' => [
            'Articles.title' => 'asc'
        ]
    ];

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        parent::initialize();
        $this->viewBuilder()->setlayout('bootstraplayout');
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $contactNumbers = $this->paginate($this->ContactNumbers);

        $this->set(compact('contactNumbers'));
    }

    /**
     * View method
     *
     * @param string|null $id Contact Number id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contactNumber = $this->ContactNumbers->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('contactNumber', $contactNumber);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contactNumber = $this->ContactNumbers->newEntity();
        if ($this->request->is('post')) {
            $contactNumber = $this->ContactNumbers->patchEntity($contactNumber, $this->request->getData());
            if ($this->ContactNumbers->save($contactNumber)) {
                $this->Flash->success(__('The contact number has been saved.'));

                return $this->redirect(['controller' => 'Users', 'action' => 'index']);
            }
            $this->Flash->error(__('The contact number could not be saved. Please, try again.'));
        }
        $users = $this->ContactNumbers->Users->find('list', ['limit' => 200]);
        $this->set(compact('contactNumber', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact Number id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contactNumber = $this->ContactNumbers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contactNumber = $this->ContactNumbers->patchEntity($contactNumber, $this->request->getData());
            if ($this->ContactNumbers->save($contactNumber)) {
                $this->Flash->success(__('The contact number has been saved.'));

                return $this->redirect(['controller' => 'Users', 'action' => 'index']);
            }
            $this->Flash->error(__('The contact number could not be saved. Please, try again.'));
        }
        $users = $this->ContactNumbers->Users->find('list', ['limit' => 200]);
        $this->set(compact('contactNumber', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact Number id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $user = $this->ContactNumbers->get($id, ['contain' => ['Users']]);
        $user_exist = $this->ContactNumbers->find('all', ['conditions' => ['user_id'=>$user->user->id]]);
        $record = $user_exist->first();
        //echo "<pre>";print_r($record);die;
        $this->request->allowMethod(['post', 'delete']);
        $contactNumber = $this->ContactNumbers->get($id);
        if ($this->ContactNumbers->delete($contactNumber)) {
            $this->Flash->success(__('The contact number has been deleted.'));
            if(!empty($record))
                return $this->redirect(['controller' => 'Users', 'action' => 'view', $user->user->id]);
                return $this->redirect(['controller' => 'Users', 'action' => 'index']);
    
        } else {
            $this->Flash->error(__('The contact number could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'Users', 'action' => 'index']);
    }
}
