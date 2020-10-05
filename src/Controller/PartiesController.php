<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Parties Controller
 *
 * @property \App\Model\Table\PartiesTable $Parties
 *
 * @method \App\Model\Entity\Party[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PartiesController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $nav = $this->nav;
        $nav[2] = true;
        $this->set(compact('nav'));
    }

    public function getAll()
    {
        $data = $this->Parties->find('all');
        
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
        $parties = $this->paginate($this->Parties);

        $this->set(compact('parties'));
    }

    /**
     * View method
     *
     * @param string|null $id Party id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($name = null)
    {
        $party = $this->Parties->find('all', ['contain' => ['Politicians']])->where(['Parties.name' => $name]);
        $this->set('party', $party->first());
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $party = $this->Parties->newEntity();
        if ($this->request->is('post')) {
            $party = $this->Parties->patchEntity($party, $this->request->getData());
            if ($this->Parties->save($party)) {
                $this->Flash->success(__('El bloque fue creado exitosamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Ocurrió un error en la creación, intentelo nuevamente.'));
        }
        $this->set(compact('party'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Party id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $party = $this->Parties->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $party = $this->Parties->patchEntity($party, $this->request->getData());
            if ($this->Parties->save($party)) {
                $this->Flash->success(__('Los cambios se guardaron con éxito.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Ocurrió un error al guardar los cambios, intentelo nuevamente.'));
        }
        $this->set(compact('party'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Party id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $party = $this->Parties->get($id);
        if ($this->Parties->delete($party)) {
            $this->Flash->success(__('El bloque fue eliminado.'));
        } else {
            $this->Flash->error(__('Ocurrio un error al eliminar el bloque, intentelo nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
