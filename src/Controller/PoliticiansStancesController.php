<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PoliticiansStances Controller
 *
 * @property \App\Model\Table\PoliticiansStancesTable $PoliticiansStances
 *
 * @method \App\Model\Entity\PoliticiansStance[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PoliticiansStancesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Politicians', 'Projects', 'Stances']
        ];
        $politiciansStances = $this->paginate($this->PoliticiansStances);

        $this->set(compact('politiciansStances'));
    }

    /**
     * View method
     *
     * @param string|null $id Politicians Stance id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $politiciansStance = $this->PoliticiansStances->get($id, [
            'contain' => ['Politicians', 'Projects', 'Stances']
        ]);

        $this->set('politiciansStance', $politiciansStance);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $politiciansStance = $this->PoliticiansStances->newEntity();
        if ($this->request->is('post')) {
            $politiciansStance = $this->PoliticiansStances->patchEntity($politiciansStance, $this->request->getData());
            if ($this->PoliticiansStances->save($politiciansStance)) {
                $this->Flash->success(__('The politicians stance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The politicians stance could not be saved. Please, try again.'));
        }
        $politicians = $this->PoliticiansStances->Politicians->find('list', ['limit' => 200]);
        $projects = $this->PoliticiansStances->Projects->find('list', ['limit' => 200]);
        $stances = $this->PoliticiansStances->Stances->find('list', ['limit' => 200]);
        $this->set(compact('politiciansStance', 'politicians', 'projects', 'stances'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Politicians Stance id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $politiciansStance = $this->PoliticiansStances->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $politiciansStance = $this->PoliticiansStances->patchEntity($politiciansStance, $this->request->getData());
            if ($this->PoliticiansStances->save($politiciansStance)) {
                $this->Flash->success(__('The politicians stance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The politicians stance could not be saved. Please, try again.'));
        }
        $politicians = $this->PoliticiansStances->Politicians->find('list', ['limit' => 200]);
        $projects = $this->PoliticiansStances->Projects->find('list', ['limit' => 200]);
        $stances = $this->PoliticiansStances->Stances->find('list', ['limit' => 200]);
        $this->set(compact('politiciansStance', 'politicians', 'projects', 'stances'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Politicians Stance id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $politiciansStance = $this->PoliticiansStances->get($id);
        if ($this->PoliticiansStances->delete($politiciansStance)) {
            $this->Flash->success(__('The politicians stance has been deleted.'));
        } else {
            $this->Flash->error(__('The politicians stance could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
