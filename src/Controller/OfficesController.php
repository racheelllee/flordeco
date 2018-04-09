<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Orm\TableRegistry;

/**
 * Offices Controller
 * @accesslevel 1
 * @property \App\Model\Table\OfficesTable $Offices
 */
class OfficesController extends AppController
{

    /**
     * 
     * @accesslevel 1
     */
    public function index()
    {
        $page = __('Offices');
        $this->paginate = [
            'conditions' => ['deleted' => 0], 
            'contain' => ['Municipalities', 'States.Municipalities'],
            'limit' => 10,
            'sortWhitelist' => [
                'name',
                'street',
                'number',
                'colony',
                'Municipalities.name',
                'States.name',
                'postal_code',
                'phone',
                'email',
                'opening_year',
                'created',
            ]
        ];
        $offices = $this->paginate($this->Offices);

        $this->loadModel('Offices');
        $office = $this->Offices->newEntity();
        $states = $this->Offices->States->find('list', ['limit' => 200]);
        $municipalities = $this->Offices->Municipalities->find('list', ['conditions' => ['state_id' => 1], 'limit' => 200]);

        $this->set(compact('offices', 'office', 'municipalities', 'states', 'page'));
        $this->set('_serialize', ['offices']);
    }

    /**
     * 
     * @accesslevel 1
     */
    public function view($id = null)
    {
        $office = $this->Offices->get($id, [
            'contain' => ['Municipalities', 'States']
        ]);

        $this->set('office', $office);
        $this->set('_serialize', ['office']);
    }

    /**
     * 
     * @accesslevel 1
     */
    public function add()
    {
        $office = $this->Offices->newEntity();
        if ($this->request->is('post')) {
            $office = $this->Offices->patchEntity($office, $this->request->data);
            if ($this->Offices->save($office)) {
                $this->Flash->success(__('The office has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The office could not be saved. Please, try again.'));
            }
        }
        $municipalities = $this->Offices->Municipalities->find('list', ['limit' => 200]);
        $states = $this->Offices->States->find('list', ['limit' => 200]);
        $this->set(compact('office', 'municipalities', 'states'));
        $this->set('_serialize', ['office']);
    }

    /**
     * 
     * @accesslevel 1
     */
    public function edit($id = null)
    {
        $office = $this->Offices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $office = $this->Offices->patchEntity($office, $this->request->data);
            if ($this->Offices->save($office)) {
                $this->Flash->success(__('The office has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The office could not be saved. Please, try again.'));
            }
        }
        $municipalities = $this->Offices->Municipalities->find('list', ['limit' => 200]);
        $states = $this->Offices->States->find('list', ['limit' => 200]);
        $this->set(compact('office', 'municipalities', 'states'));
        $this->set('_serialize', ['office']);
    }

    /**
     * 
     * @accesslevel 1
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $office = $this->Offices->get($id);
        $office->deleted = 1;
        if ($this->Offices->save($office)) {
            $this->Flash->success(__('The office has been deleted.'));
        } else {
            $this->Flash->error(__('The office could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * 
     * @accesslevel 1
     */
    public function municipalities($state_id = 0)
    {
        $CountriesTable = TableRegistry::get('municipalities');
        $municipalities = $CountriesTable->find('list', ['conditions' => ['state_id' => $state_id],'keyField' => 'id', 'valueField' => 'name']);
        $this->set(compact('municipalities'));
        $this->set('_serialize', ['municipalities']);
    }

    /**
     * 
     * @accesslevel 1
     */
    public function officeEditForm($id = 0)
    {
        $office = $this->Offices->get($id, [
            'contain' => ['Municipalities', 'States.Municipalities'],
        ]);
        $municipalities = $this->Offices->Municipalities->find('list', ['limit' => 200]);
        $states = $this->Offices->States->find('list', ['limit' => 200]);
        $this->viewBuilder()->layout('ajax');
        $this->set(compact('office', 'municipalities', 'states'));
        $this->render('/Element/edit_office_form');
    }
}
