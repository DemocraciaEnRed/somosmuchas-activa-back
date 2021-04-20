<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Log\Log;

/**
 * Politicians Controller
 *
 * @property \App\Model\Table\PoliticiansTable $Politicians
 *
 * @method \App\Model\Entity\Politician[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PoliticiansController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $nav = $this->nav;
        $nav[0] = true;
        $this->set(compact('nav'));

        // lo pidieron a último momento así que lo dejo hardcodeado
        // lo hice en el initialize así no se re-procesa en cada request
        $candidatxsAMostrar = "Miguel Ángel ,Pinto Hernández
Paloma ,Valencia Laserna
Angélica Lizbeth,Lozano Correa
Esperanza,Andrade de Osso
María Fernanda,Cabal Molina
Alexander,López Maya
Gustavo Francisco ,Petro Urrego
Iván Leónidas ,Name Vásquez
Julián,Gallo Cubillos
Luis Fernando ,Velasco Chaves
Fabio Raúl ,Amín Salame
Roy Leonardo ,Barreras
Armando,Benedetti Villaneda
Rodrigo ,Lara Restrepo
Roosvelt ,Rodríguez Rengifo
Temístocles,Ortega Narváez
Germán,Varón Cotrino
Carlos Eduardo,Enríquez Maya
Juan Carlos,García Gómez
Carlos Eduardo,Guevara Villabón
José Obdulio ,Gaviria Vélez
Santiago,Valencia González

Adriana Magali,Matiz Vargas
Alejandro Alberto,Vega Pérez
Alfredo Rafael ,Deluque Zuleta
Álvaro Hernán ,Prada Artunduaga
Andrés David ,Calle Aguas
Ángela María,Robledo Gómez
Buenaventura ,León León
Carlos German,Navas Talero
Cesar Augusto ,Lorduy Maldonado
David Ernesto ,Pulido Novoa
Edward David,Rodríguez Rodríguez
Elbert ,Díaz Lozano
Erwin ,Arias Betancur
Gabriel ,Santos García
Gabriel Jaime ,Vallejo Chujfi
Harry Giovanny ,González García
Hernán Gustavo ,Estupiñan Calvache
Inti Raúl ,Asprilla Reyes
Jaime,Rodríguez Contreras
John Jairo ,Hoyos García
Jorge ,Méndez Hernández
Jorge Eliecer ,Tamayo Marulanda
Jorge Enrique ,Burgos Lugo
José Daniel ,López Jiménez
José Gustavo ,Padilla Orozco
José Jaime ,Uscategui Pastrana
Juan Carlos,Wills Ospina
Juan Carlos ,Losada Vargas
Juan Fernando ,Reyes Kuri
Juan Manuel ,Daza Iguarán
Juanita María,Goebertus Estrada
Julián,Peinado Ramírez
Julio Cesar ,Triana Quintero
Luis Alberto,Albán Urbano
Margarita María,Restrepo Arango
Nilton,Córdoba Manyoma
Oscar Hernán ,Sánchez León
Oscar Leonardo ,Villamizar Meneses
";
        // armamos array de líneas
        $candidatxsArray = explode("\n", $candidatxsAMostrar);
        $this->candidatxsCondition = array();
        // iteramos líneas armando la condición
        for ($i = 0; $i < count($candidatxsArray); $i++) {
          if (empty(trim($candidatxsArray[$i])))
            continue;
          $split = explode(",", $candidatxsArray[$i]);
          // esto después se procesa como un AND (dentro del OR global)
          array_push($this->candidatxsCondition, array(
            "first_name "=> trim($split[0]),
            "last_name" => trim($split[1]),
          ));
        }
    }

    public function getAll($projectSlug = null, $cover = false)
    {

        $data = $this->Politicians->find('all', [
            'fields' => [
                'id',
                'first_name',
                'last_name',
                'birthday',
                'gender',
                'marital_status',
                'facebook',
                'twitter',
                'instagram',
                'phone',
                'image',
                'dir',
                'position_id',
            ],
            'contain' => [
                'Districts' => [
                    'fields' => ['name', 'hasc', 'id']
                ],
                'Parties' => [
                    'fields' => ['name']
                ],
                'Positions' => [
                    'fields' => ['name']
                ],
                'Stances',
                'Stances.Projects' => [
                    'fields' => ['slug']
                ]
//            ],
//            'conditions' => [
//              'OR' => $this->candidatxsCondition
            ]
        ]);

        if(!empty($projectSlug)) {
            $this->loadModel('Projects');
            $project = $this->Projects->find('all', [
                'fields' => [
                    'id',
                    'slug',
                ],
                'contain' => [
                    'Positions',
                    'Politicians',
                    'Politicians.Districts' => [
                        'fields' => ['name', 'hasc', 'id']
                    ],
                    'Politicians.Parties' => [
                        'fields' => ['name']
                    ],
                    'Politicians.Positions' => [
                        'fields' => ['name']
                    ],
                    'Politicians.Stances',
                    'Politicians.Stances.Projects' => [
                        'fields' => ['slug']
                    ]
                ]
            ])->where(['Projects.slug' => $projectSlug])->first();
            if(!empty($project)) {
                // ESTA COSA ESTABA COMO FALSE, LO PASE A TRUE PARA QUE ME DE LOS QUE YOOOOOO DECIDO PONER EN EL CARROUSEL
                if(true/*$cover*/ && !empty($project->politicians)) {
                    $data = $project->politicians;
                }
                else {
                    $positions = [];
                    foreach($project->positions as $position) {
                        array_push($positions, $position->id);
                    }
                    $data = $data->where(['position_id IN' => $positions]);
                }
            }
        }

        $this->set([
            'politicians' => $data,
            '_serialize' => 'politicians',
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
        $this->paginate = [
            'contain' => ['Districts', 'Positions', 'Parties']
        ];
        $politicians = $this->paginate($this->Politicians);

        $this->set(compact('politicians'));
    }

    /**
     * View method
     *
     * @param string|null $id Politician id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $politician = $this->Politicians->get($id, [
            'contain' => ['Districts', 'Parties', 'Stances', 'PoliticiansProject', 'Stances.Projects']
        ]);

        $this->set('politician', $politician);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $politician = $this->Politicians->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $politician = $this->Politicians->patchEntity($politician, $data);
            if ($result = $this->Politicians->save($politician)) {
                $this->Flash->success(__('El candidatx fue creado con éxito.'));
                if(array_key_exists('stances', $data)) {
                    foreach($data['stances'] as $key => $val) {
                        $politiciansStance = $this->Politicians->PoliticiansStances->newEntity();
                        $politiciansStance = $this->Politicians->PoliticiansStances->patchEntity($politiciansStance, ['politician_id' => $result->id, 'project_id' => $key, 'stance_id' => $val]);
                        $this->Politicians->PoliticiansStances->save($politiciansStance);
                    }
                }
                if(array_key_exists('projects', $data)) {
                    foreach($data['projects'] as $key => $val) {
                        if($val) {
                            $politiciansProject = $this->Politicians->PoliticiansProject->newEntity();
                            $politiciansProject = $this->Politicians->PoliticiansProject->patchEntity($politiciansProject, ['politician_id' => $result->id, 'project_id' => $key]);
                            $this->Politicians->PoliticiansProject->save($politiciansProject);
                        }
                    }
                }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Ocurrió un error al crear el candidatx, intentelo nuevamente.'));
        }
        $districts = $this->Politicians->Districts->find('list', ['limit' => 200]);
        $positions = $this->Politicians->Positions->find('list', ['limit' => 200]);
        $parties = $this->Politicians->Parties->find('list', ['limit' => 200]);
        $projects = $this->Politicians->Stances->Projects->find('all', ['fields' => ['id', 'name'], 'limit' => 200])->contain(['stances', 'positions']);
        $this->set(compact('politician', 'districts', 'positions', 'parties', 'projects'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Politician id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $politician = $this->Politicians->get($id, [
            'contain' => ['Stances', 'Positions', 'PoliticiansProject']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $politician = $this->Politicians->patchEntity($politician, $data);
            if ($this->Politicians->save($politician)) {
                $this->Flash->success(__('Los cambios se guardaron con éxito.'));
                foreach($data['stances'] as $key => $val) {
                    $politiciansStance = $this->Politicians->PoliticiansStances->find('all', ['conditions' => ['project_id'=> $key, 'politician_id' => $politician->id]]);
                    if($politiciansStance->isEmpty()) {
                        $politiciansStance = $this->Politicians->PoliticiansStances->newEntity();
                    }
                    else {
                        $politiciansStance = $politiciansStance->first();
                    }
                    $politiciansStance = $this->Politicians->PoliticiansStances->patchEntity($politiciansStance, ['politician_id' => $politician->id, 'project_id' => $key, 'stance_id' => $val]);
                    $this->Politicians->PoliticiansStances->save($politiciansStance);
                }
                if(array_key_exists('projects', $data)) {
                    $this->Politicians->PoliticiansProject->deleteAll(['politician_id' => $politician->id]);
                    foreach($data['projects'] as $key => $val) {
                        if($val) {
                            if(!$result = $this->Politicians->PoliticiansProject->find()->where(['politician_id' => $politician->id, 'project_id' => $val])->first()) {
                                $politiciansProject = $this->Politicians->PoliticiansProject->newEntity();
                            }
                            $politiciansProject = $this->Politicians->PoliticiansProject->patchEntity($politiciansProject, ['politician_id' => $politician->id, 'project_id' => $key]);
                            $this->Politicians->PoliticiansProject->save($politiciansProject);
                        }
                    }
                }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Ocurrió un error al guardar los cambios, intentelo nuevamente.'));
        }
        $districts = $this->Politicians->Districts->find('list', ['limit' => 200]);
        $positions = $this->Politicians->Positions->find('list', ['limit' => 200]);
        $parties = $this->Politicians->Parties->find('list', ['limit' => 200]);
        $projects = $this->Politicians->Stances->Projects->find('all', ['fields' => ['id', 'name'], 'limit' => 200])->contain(['stances', 'positions']);
        $this->set(compact('politician', 'districts', 'positions', 'parties', 'projects'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Politician id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $politician = $this->Politicians->get($id);
        if ($this->Politicians->delete($politician)) {
            $this->Flash->success(__('El candidatx fue eliminado.'));
        } else {
            $this->Flash->error(__('Ocurrió un error al eliminar al candidatx.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
