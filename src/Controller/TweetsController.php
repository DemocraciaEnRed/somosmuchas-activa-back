<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Tweets Controller
 *
 * @property \App\Model\Table\TweetsTable $Tweets
 *
 * @method \App\Model\Entity\Tweet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TweetsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Stances']
        ];
        $tweets = $this->paginate($this->Tweets);

        $this->set(compact('tweets'));
    }

    /**
     * View method
     *
     * @param string|null $id Tweet id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tweet = $this->Tweets->get($id, [
            'contain' => ['Stances']
        ]);

        $this->set('tweet', $tweet);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tweet = $this->Tweets->newEntity();
        if ($this->request->is('post')) {
            $tweet = $this->Tweets->patchEntity($tweet, $this->request->getData());
            if ($this->Tweets->save($tweet)) {
                $this->Flash->success(__('The tweet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tweet could not be saved. Please, try again.'));
        }
        $stances = $this->Tweets->Stances->find('list', ['limit' => 200]);
        $this->set(compact('tweet', 'stances'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tweet id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tweet = $this->Tweets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tweet = $this->Tweets->patchEntity($tweet, $this->request->getData());
            if ($this->Tweets->save($tweet)) {
                $this->Flash->success(__('The tweet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tweet could not be saved. Please, try again.'));
        }
        $stances = $this->Tweets->Stances->find('list', ['limit' => 200]);
        $this->set(compact('tweet', 'stances'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tweet id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tweet = $this->Tweets->get($id);
        if ($this->Tweets->delete($tweet)) {
            $this->Flash->success(__('The tweet has been deleted.'));
        } else {
            $this->Flash->error(__('The tweet could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
