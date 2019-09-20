<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ContactEmails Controller
 *
 * @property \App\Model\Table\ContactEmailsTable $ContactEmails
 *
 * @method \App\Model\Entity\ContactEmail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContactEmailsController extends AppController
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
        $contactEmails = $this->paginate($this->ContactEmails);

        $this->set(compact('contactEmails'));
    }

    /**
     * View method
     *
     * @param string|null $id Contact Email id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contactEmail = $this->ContactEmails->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('contactEmail', $contactEmail);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contactEmail = $this->ContactEmails->newEntity();
        if ($this->request->is('post')) {
            $contactEmail = $this->ContactEmails->patchEntity($contactEmail, $this->request->getData());
            if ($this->ContactEmails->save($contactEmail)) {
                $this->Flash->success(__('The contact email has been saved.'));

                return $this->redirect(['controller' => 'Users', 'action' => 'index']);
            }
            $this->Flash->error(__('The contact email could not be saved. Please, try again.'));
        }
        $users = $this->ContactEmails->Users->find('list', ['limit' => 200]);
        $this->set(compact('contactEmail', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact Email id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contactEmail = $this->ContactEmails->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contactEmail = $this->ContactEmails->patchEntity($contactEmail, $this->request->getData());
            if ($this->ContactEmails->save($contactEmail)) {
                $this->Flash->success(__('The contact email has been saved.'));
                //echo "<pre>";
                //print_r($contactEmail);die;

                return $this->redirect(['controller' => 'Users', 'action' => 'view', $contactEmail->user_id]);
            }
            $this->Flash->error(__('The contact email could not be saved. Please, try again.'));
        }
        $users = $this->ContactEmails->Users->find('list', ['limit' => 200]);
        $this->set(compact('contactEmail', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact Email id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $user = $this->ContactEmails->get($id, ['contain' => ['Users']]);
        $user_exist = $this->ContactEmails->find('all', ['conditions' => ['user_id'=>$user->user->id]]);
        $record = $user_exist->first();
        $this->request->allowMethod(['post', 'delete']);
        $contactEmail = $this->ContactEmails->get($id);
        if ($this->ContactEmails->delete($contactEmail)) {
            $this->Flash->success(__('The contact email has been deleted.'));
            if(!empty($record))
                return $this->redirect(['controller' => 'Users', 'action' => 'view', $user->user->id]);
                return $this->redirect(['controller' => 'Users', 'action' => 'index']);
        } else {
            $this->Flash->error(__('The contact email could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'Users', 'action' => 'index']);
    }
}
