<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 *
 * @method \App\Model\Entity\Project[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProjectsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $nav = $this->nav;
        $nav[1] = true;
        $this->Auth->allow(['getByName', 'getTally', 'getFullTally']);
        $this->set(compact('nav'));
    }

    public function getAll()
    {
        
        $data = $this->Projects->find('all', [
            'fields' => [
                'id',
                'name',
                'short_text',
                'slider_text',
                'highlighted',
                'text',
                'image',
                'cover_image',
                'dir',
                'c_dir',
                'slug',
                'primary_color',
                'secondary_color',
                'show_tally',
                'show_videos',
                'show_text',
            ],
            'contain' => [
                'Stances' => [
                    'fields' => [
                        'id',
                        'name',
                        'value',
                        'project_id',
                    ]
                ],
                'Stances.Tweets',
                'Videos'
            ]
        ]);
        
        $this->set([
            'projects' => $data,
            '_serialize' => 'projects',
        ]);
        $this->RequestHandler->renderAs($this, 'json');
    }

    public function getByName($slug = null)
    {
        $data = $this->Projects->find('all', [
                'fields' => [
                    'id',
                    'name',
                    'short_text',
                    'slider_text',
                    'highlighted',
                    'text',
                    'image',
                    'cover_image',
                    'dir',
                    'c_dir',
                    'slug',
                    'tally',
                    'primary_color',
                    'secondary_color',
                    'show_tally',
                    'show_videos',
                    'show_text',
                ],
                'contain' => [
                    'Stances' => [
                        'fields' => [
                            'id',
                            'name',
                            'value',
                            'project_id',
                        ]
                    ],
                    'Stances.Tweets',
                    'Videos'
                ]
            ])->where(['Projects.slug' => $slug])->first();
        
        $this->set([
            'projects' => $data,
            '_serialize' => 'projects',
        ]);
        $this->RequestHandler->renderAs($this, 'json');
    }

    public function getTally($slug = null)
    {
        if ($this->request->is(['options'])) {
            $this->response = $this->response->withHeader('Access-Control-Allow-Headers','X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding, X-Auth-Token, content-type');
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->get($this->request->getData('id'), [
                'contain' => []
            ]);
            if(!empty($project)) {
                $project->tally++;
                $project = $this->Projects->patchEntity($project, compact('project'));
                $result = $this->Projects->save($project);
            }
        }

        $data = $this->Projects->find('all', [
                'fields' => [
                    'id',
                    'slug',
                    'tally',
                ],
                'contain' => []
            ])->where(['Projects.slug' => $slug])->first();

        $data = $data->tally;
        
        $this->set([
            'tally' => $data,
            '_serialize' => 'tally',
        ]);
        $this->RequestHandler->renderAs($this, 'json');
    }

    public function getFullTally()
    {
        $projects = $this->Projects->find('all', [
                'fields' => [
                    'id',
                    'tally'
                ],
                'contain' => []
            ]);

        $data = 0;

        foreach($projects as $project) {
            $data += $project->tally;
        }
        
        $this->set([
            'tally' => $data,
            '_serialize' => 'tally',
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
        $projects = $this->paginate($this->Projects);

        $this->set(compact('projects'));
    }

    /**
     * View method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $project = $this->Projects->get($id, [
            'contain' => ['PoliticiansProject', 'PoliticiansStances', 'Stances', 'Stances.Tweets', 'Videos']
        ]);

        $this->set('project', $project);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $project = $this->Projects->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $project = $this->Projects->patchEntity($project, $data);
            if ($result = $this->Projects->save($project)) {
                $this->Flash->success(__('El proyecto fue creado exitosamente.'));
                if(array_key_exists('highlighted', $data) && $data['highlighted'] == 1) {
                    $this->Projects->updateAll(['highlighted' => 0], ['id !=' => $result->id]);
                }
                $stanceName = ['AFavor', 'EnContra', 'SeAbstiene', 'NoConfirmado'];
                for($i = 0; $i < 4; $i++) {
                    $stance = $this->Projects->Stances->newEntity();
                    $stance = $this->Projects->Stances->patchEntity($stance, ['name' => $stanceName[$i], 'value' => $i, 'project_id' => $result->id]);
                    if($stanceResult = $this->Projects->Stances->save($stance)) {
                        if(!empty($data['Tweet'][$i])) {
                            for($j = 0; $j < count($data['Tweet'][$i]); $j++) {
                                if(array_key_exists('text', $data['Tweet'][$i][$j]) && !empty($data['Tweet'][$i][$j]['text'])) {
                                    $tweet = $this->Projects->Stances->Tweets->newEntity();
                                    $tweet = $this->Projects->Stances->Tweets->patchEntity($tweet, ['text' => $data['Tweet'][$i][$j]['text'], 'stance_id' => $stanceResult->id]);
                                    $this->Projects->Stances->Tweets->save($tweet);
                                }
                            }
                        }
                    }
                }
                if(array_key_exists('Video', $data)) {
                    foreach($data['Video'] as $video) {
                        if(array_key_exists('url', $video) && !empty($video['url']) && array_key_exists('name', $video)) {
                            $vid = $this->Projects->Videos->newEntity();
                            $vid = $this->Projects->Videos->patchEntity($vid, ['url' => $this->_parseURL($video['url']), 'name' => $video['name'], 'project_id' => $result->id]);
                            $this->Projects->Videos->save($vid);
                        }
                    }
                }

                return $this->redirect(['action' => 'edit', $result->id]);
            }
            $this->Flash->error(__('Ocurrió un error en la creación, intentelo nuevamente.'));
        }
        $positions = $this->Projects->Positions->find('list', ['limit' => 200, 'keyField' => 'id', 'valueField' => 'pluralization']);
        $this->set(compact('project', 'positions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $project = $this->Projects->get($id, [
            'contain' => ['Stances', 'Videos', 'Positions', 'Politicians', 'Stances.Tweets']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $project = $this->Projects->patchEntity($project, $data);
            if ($result = $this->Projects->save($project)) {
                if(array_key_exists('highlighted', $data) && $data['highlighted'] == 1) {
                    $this->Projects->updateAll(['highlighted' => 0], ['id !=' => $result->id]);
                }
                $stanceName = ['AFavor', 'EnContra', 'SeAbstiene', 'NoConfirmado'];
                for($i = 0; $i < 4; $i++) {
                    if(!empty($data['Tweet'][$i])) {
                        for($j = 0; $j < count($data['Tweet'][$i]); $j++) {
                            if(array_key_exists('text', $data['Tweet'][$i][$j]) && !empty($data['Tweet'][$i][$j]['text'])) {
                                if(!empty($data['Tweet'][$i][$j]['id'])) {
                                    $tweet = $this->Projects->Stances->Tweets->get($data['Tweet'][$i][$j]['id'], [
                                        'contain' => []
                                    ]);
                                }
                                else {
                                    $tweet = $this->Projects->Stances->Tweets->newEntity();
                                }
                                $tweet = $this->Projects->Stances->Tweets->patchEntity($tweet, ['text' => $data['Tweet'][$i][$j]['text'], 'stance_id' => $project->stances[$i]->id]);
                                $this->Projects->Stances->Tweets->save($tweet);
                            }
                        }
                    }
                }
                if(array_key_exists('TweetDelete', $data)) {
                    foreach($data['TweetDelete'] as $tweetDelete) {
                        $this->Projects->Stances->Tweets->delete($this->Projects->Stances->Tweets->get($tweetDelete['id']));
                    }
                }
                if(array_key_exists('Video', $data) && !empty($data['Video'])) {
                    foreach($data['Video'] as $video) {
                        if(!empty($video['id'])) {
                            $vid = $this->Projects->Videos->get($video['id'], [
                                'contain' => []
                            ]);
                        }
                        else {
                            $vid = $this->Projects->Videos->newEntity();
                        }
                        if(
                            array_key_exists('url', $video) &&
                            array_key_exists('name', $video) &&
                            $url = $this->_parseURL($video['url'])
                            ) {
                            $vid = $this->Projects->Videos->patchEntity($vid, ['name' => $video['name'], 'url' => $url, 'project_id' => $result->id]);
                            $this->Projects->Videos->save($vid);
                        }
                    }
                }
                if(array_key_exists('VideoDelete', $data)) {
                    foreach($data['VideoDelete'] as $videoDelete) {
                        $this->Projects->Videos->delete($this->Projects->Videos->get($videoDelete['id']));
                    }
                }
                $project = $this->Projects->get($id, [
                    'contain' => ['Stances', 'Videos', 'Positions', 'Stances.Tweets']
                ]);
                $this->Flash->success(__('Los cambios se guardaron con éxito.'));
            }
            else {
                $this->Flash->error(__('Ocurrió un error al guardar los cambios, intentelo nuevamente.'));
            }
        }
        $positions = $this->Projects->Positions->find('list', ['limit' => 200, 'keyField' => 'id', 'valueField' => 'pluralization']);
        $this->set(compact('project', 'positions'));
    }

    private function _parseURL($url) {
        $array = [];
        parse_str(parse_url($url, PHP_URL_QUERY), $array);
        if(!empty($array['v'])) {
            $id = $array['v'];
        }
        elseif(stripos($url, 'youtu.be') !== false || stripos($url, 'youtube.com/embed')) {
            $array = [];
            $array = explode("/", $url);
            $id = $array[count($array) - 1];
        }
        else {
            $id = false;
        }
        return $id;
    }

    /**
     * Delete method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $project = $this->Projects->get($id);
        //$this->Projects->Tweets->deleteAll(['stance_id' => $id]);
        if($this->Projects->Stances->deleteAll(['project_id' => $id])) {
            if ($this->Projects->delete($project)) {
                $this->Flash->success(__('El proyecto fue eliminado.'));
            } else {
                $this->Flash->error(__('Ocurrió un error al eliminar el proyecto, intentelo nuevamente.'));
            }
        } else {
            $this->Flash->error(__('Ocurrió un error al eliminar el proyecto, intentelo nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
