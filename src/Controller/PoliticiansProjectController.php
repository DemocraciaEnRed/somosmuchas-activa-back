<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PoliticiansProject Controller
 *
 * @property \App\Model\Table\PoliticiansProjectTable $PoliticiansProject
 *
 * @method \App\Model\Entity\PoliticiansProject[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PoliticiansProjectController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Politicians', 'Projects']
        ];
        $politiciansProject = $this->paginate($this->PoliticiansProject);

        $this->set(compact('politiciansProject'));
    }

    /**
     * View method
     *
     * @param string|null $id Politicians Project id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $politiciansProject = $this->PoliticiansProject->get($id, [
            'contain' => ['Politicians', 'Projects']
        ]);

        $this->set('politiciansProject', $politiciansProject);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $politiciansProject = $this->PoliticiansProject->newEntity();
        if ($this->request->is('post')) {
            $politiciansProject = $this->PoliticiansProject->patchEntity($politiciansProject, $this->request->getData());
            if ($this->PoliticiansProject->save($politiciansProject)) {
                $this->Flash->success(__('The politicians project has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The politicians project could not be saved. Please, try again.'));
        }
        $politicians = $this->PoliticiansProject->Politicians->find('list', ['limit' => 200]);
        $projects = $this->PoliticiansProject->Projects->find('list', ['limit' => 200]);
        $this->set(compact('politiciansProject', 'politicians', 'projects'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Politicians Project id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $politiciansProject = $this->PoliticiansProject->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $politiciansProject = $this->PoliticiansProject->patchEntity($politiciansProject, $this->request->getData());
            if ($this->PoliticiansProject->save($politiciansProject)) {
                $this->Flash->success(__('The politicians project has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The politicians project could not be saved. Please, try again.'));
        }
        $politicians = $this->PoliticiansProject->Politicians->find('list', ['limit' => 200]);
        $projects = $this->PoliticiansProject->Projects->find('list', ['limit' => 200]);
        $this->set(compact('politiciansProject', 'politicians', 'projects'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Politicians Project id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $politiciansProject = $this->PoliticiansProject->get($id);
        if ($this->PoliticiansProject->delete($politiciansProject)) {
            $this->Flash->success(__('The politicians project has been deleted.'));
        } else {
            $this->Flash->error(__('The politicians project could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
