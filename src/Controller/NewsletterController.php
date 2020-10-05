<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Newsletter Controller
 *
 * @property \App\Model\Table\NewsletterTable $Newsletter
 *
 * @method \App\Model\Entity\Newsletter[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NewsletterController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['subscribe']);
    }

    public function subscribe()
    {
        $message = "Intentelo nuevamente más tarde.";

        if ($this->request->is(['options'])) {
            $this->response = $this->response->withHeader('Access-Control-Allow-Headers','X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding, X-Auth-Token, content-type');
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subscription = $this->Newsletter->find('all', ['contain' => []])->where(['Newsletter.email' => $this->request->getData('email')])->first();
            if(!empty($subscription)) {
                $message = "Ya estás registrado.";
            }
            else {
                $newsletter = $this->Newsletter->newEntity();
                $newsletter = $this->Newsletter->patchEntity($newsletter, ['email' => $this->request->getData('email'), 'project' => $this->request->getData('project')]);
                if ($this->Newsletter->save($newsletter)) {
                    $message = "¡Suscripción realizada!";
                }
            }
        }
        
        $this->set([
            'message' => $message,
            '_serialize' => 'message'
        ]);
        $this->RequestHandler->renderAs($this, 'json');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $newsletter = $this->paginate($this->Newsletter);

        $this->set(compact('newsletter'));
    }

    /**
     * View method
     *
     * @param string|null $id Newsletter id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $newsletter = $this->Newsletter->get($id, [
            'contain' => []
        ]);

        $this->set('newsletter', $newsletter);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $newsletter = $this->Newsletter->newEntity();
        if ($this->request->is('post')) {
            $newsletter = $this->Newsletter->patchEntity($newsletter, $this->request->getData());
            if ($this->Newsletter->save($newsletter)) {
                $this->Flash->success(__('The newsletter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The newsletter could not be saved. Please, try again.'));
        }
        $this->set(compact('newsletter'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Newsletter id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $newsletter = $this->Newsletter->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $newsletter = $this->Newsletter->patchEntity($newsletter, $this->request->getData());
            if ($this->Newsletter->save($newsletter)) {
                $this->Flash->success(__('The newsletter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The newsletter could not be saved. Please, try again.'));
        }
        $this->set(compact('newsletter'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Newsletter id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $newsletter = $this->Newsletter->get($id);
        if ($this->Newsletter->delete($newsletter)) {
            $this->Flash->success(__('The newsletter has been deleted.'));
        } else {
            $this->Flash->error(__('The newsletter could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
