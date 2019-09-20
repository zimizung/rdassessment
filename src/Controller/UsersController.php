<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
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
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['ContactEmails', 'ContactNumbers']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('ContactEmails');
        $this->loadModel('ContactNumbers');
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            //echo "<pre>";print_r($this->request->getData(['ContactEmails']));die;
            if ($this->Users->save($user)) {

                $email_user_id = ['user_id'=> $user->id];
                $email = $this->ContactEmails->newEntity($email_user_id);
                $email = $this->ContactEmails->patchEntity($email, $this->request->getData(['ContactEmails']));
                if($this->ContactEmails->save($email))

                    $number_user_id = ['user_id'=> $user->id];
                    $number = $this->ContactNumbers->newEntity($number_user_id);
                    $number = $this->ContactNumbers->patchEntity($number, $this->request->getData(['ContactNumbers']));
                    if($this->ContactNumbers->save($number))
                        $this->Flash->success(__('The user has been saved.'));


                //print_r($user->id);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $user = $this->Users->get($id, ['contain' => ['ContactEmails','ContactNumbers']]);
        foreach ($user->contact_numbers as $contact_id) {
            $contact_id_all[]=$contact_id['id'];
        }
        if(!empty($contact_id_all))
        {
            $this->Flash->error(__('The contact could not be deleted. Please, delete contact numbers.'));
            return $this->redirect(['action' => 'index']);
        }

        foreach ($user->contact_emails as $email_id) {
            $email_id_all[]=$email_id['id'];
        }
        if(!empty($email_id_all))
        {
            $this->Flash->error(__('The contact could not be deleted. Please, delete contact and email.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The contact has been deleted.'));
        } else {
            $this->Flash->error(__('The contact could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
