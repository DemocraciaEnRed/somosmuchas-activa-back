<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Districts Controller
 *
 * @property \App\Model\Table\DistrictsTable $Districts
 *
 * @method \App\Model\Entity\District[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DistrictsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $nav = $this->nav;
        $nav[3] = true;
        $this->set(compact('nav'));
    }

    public function getAll()
    {
        $data = $this->Districts->find('all')/*->where(['hierarchy' => 1])*/;

        $this->set([
            'districts' => $data,
            '_serialize' => 'districts',
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
        $districts = $this->paginate($this->Districts);

        $this->set(compact('districts'));
    }

    /**
     * View method
     *
     * @param string|null $id District id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($name = null)
    {
        $district = $this->Districts->find('all', ['contain' => ['Politicians']])->where(['Districts.name' => $name]);
        $this->set('district', $district->first());
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $district = $this->Districts->newEntity();
        if ($this->request->is('post')) {
            $district = $this->Districts->patchEntity($district, $this->request->getData());
            if ($this->Districts->save($district)) {
                $this->Flash->success(__('El distrito fue creado con éxito.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Ocurrió un error en la creación, intentelo nuevamente.'));
        }
        $this->set(compact('district'));
    }

    /**
     * Edit method
     *
     * @param string|null $id District id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $district = $this->Districts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $district = $this->Districts->patchEntity($district, $this->request->getData());
            if ($this->Districts->save($district)) {
                $this->Flash->success(__('Los cambios se guardaron con éxito.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Ocurrió un error al guardar los cambios, intentelo nuevamente.'));
        }
        $this->set(compact('district'));
    }

    /**
     * Delete method
     *
     * @param string|null $id District id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $district = $this->Districts->get($id);
        if ($this->Districts->delete($district)) {
            $this->Flash->success(__('El distrito fue eliminado.'));
        } else {
            $this->Flash->error(__('Ocurrio un error al eliminar el distrito, intentelo nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
