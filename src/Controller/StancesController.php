<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Stances Controller
 *
 * @property \App\Model\Table\StancesTable $Stances
 *
 * @method \App\Model\Entity\Stance[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StancesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Projects']
        ];
        $stances = $this->paginate($this->Stances);

        $this->set(compact('stances'));
    }

    /**
     * View method
     *
     * @param string|null $id Stance id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $stance = $this->Stances->get($id, [
            'contain' => ['Projects', 'Politicians', 'Tweets']
        ]);

        $this->set('stance', $stance);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $stance = $this->Stances->newEntity();
        if ($this->request->is('post')) {
            $stance = $this->Stances->patchEntity($stance, $this->request->getData());
            if ($this->Stances->save($stance)) {
                $this->Flash->success(__('The stance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stance could not be saved. Please, try again.'));
        }
        $projects = $this->Stances->Projects->find('list', ['limit' => 200]);
        $politicians = $this->Stances->Politicians->find('list', ['limit' => 200]);
        $this->set(compact('stance', 'projects', 'politicians'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Stance id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $stance = $this->Stances->get($id, [
            'contain' => ['Politicians']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stance = $this->Stances->patchEntity($stance, $this->request->getData());
            if ($this->Stances->save($stance)) {
                $this->Flash->success(__('The stance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The stance could not be saved. Please, try again.'));
        }
        $projects = $this->Stances->Projects->find('list', ['limit' => 200]);
        $politicians = $this->Stances->Politicians->find('list', ['limit' => 200]);
        $this->set(compact('stance', 'projects', 'politicians'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Stance id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $stance = $this->Stances->get($id);
        if ($this->Stances->delete($stance)) {
            $this->Flash->success(__('The stance has been deleted.'));
        } else {
            $this->Flash->error(__('The stance could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
