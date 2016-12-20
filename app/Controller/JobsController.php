<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Jobs Controller
 *
 * @property Job $Job
 * @property PaginatorComponent $Paginator
 */
class JobsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Email', 'Security');

/**
 * Helpers
 *
 * @var array
 */
    public $helpers = array('Html', 'Form');

    //Prevents multiple submitting of the same Form
    public function beforeFilter() {
        $this->Security->csrfUseOnce = true;
        $this->Security->blackHoleCallback = 'blackhole';
    }

    //Handles Blackholes
    public function blackhole($type) {
        $this->redirect(array('action' => 'index'));
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Job->recursive = 0;
		$this->set('jobs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Job->exists($id)) {
			throw new NotFoundException(__('Invalid job'));
		}
		$options = array('conditions' => array('Job.' . $this->Job->primaryKey => $id));
		$this->set('job', $this->Job->find('first', $options));
	}

/**
 * add method
 *
 * sends email if job has been saved successfully
 * treatment of id and token need improvement
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Job->create();
			//create random token - probably there is a better way
			$this->Job->set('token', md5(uniqid(rand(), true)));
			if ($this->Job->save($this->request->data)) {
				$this->Flash->success(__('The job has been saved and you will receive an 
				email containing your Edit Link'));


                //there's probably a better way
                $this->Email->smtpOptions = array(
                    'port'=>'yourPort',
                    'timeout'=>'30',
                    'host' => 'yourHost',
                    'username'=>'yourUsername',
                    'password'=>'yourPassword',
                    'client' => 'yourdomain.com'
                );

                //TODO NEEDS PROPER QUERIES AND VARIABLE HANDLING
                $this->Email->delivery = 'smtp';
                $this->Email->from = 'yourSenderEmailAddress';
                $this->Email->to = $this->request->data['Job']['firmEmail'];
                $id=$this->Job->query("SELECT id FROM heroku_9769d7896c5d624.jobs WHERE id=(
                SELECT max(id) FROM heroku_9769d7896c5d624.jobs
                )");
                $idSingle=reset($id);
                $idSingle2=reset($idSingle);
                $idSingle3=reset($idSingle2);
                $this->set('id', $idSingle3);
                $token=$this->Job->query("SELECT token FROM heroku_9769d7896c5d624.jobs WHERE id=$idSingle3");
                $token1=reset($token);
                $token2=reset($token1);
                $token3=reset($token2);
                $this->set('token', $token3);
                $this->Email->subject = 'Jobportal: Your Editing Link';
                $this->Email->template = 'editlink';
                $this->Email->sendAs = 'both';
                $this->Email->send();

				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The job could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * treatment of token needs improvement
 * only works if correct token is given
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */


	public function edit($id = null) {
		if (!$this->Job->exists($id)) {
			throw new NotFoundException(__('Invalid job'));
		}
		//TODO NEEDS PROPER SOLUTION
        $token=$this->Job->query("SELECT token FROM heroku_9769d7896c5d624.jobs WHERE id=$id");
        $token1=reset($token);
        $token2=reset($token1);
        $token3=reset($token2);
		    if($_GET["token"]==$token3&&isset($_GET["token"])) {

                if ($this->request->is(array('post', 'put'))) {
                    if ($this->Job->save($this->request->data)) {
                        $this->Flash->success(__('The job has been edited.'));
                        return $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Flash->error(__('The job could not be edited. Please, try again.'));
                    }
                } else {
                    $options = array('conditions' => array('Job.' . $this->Job->primaryKey => $id));
                    $this->request->data = $this->Job->find('first', $options);
                }
            }else{
                $this->Flash->error(__('Wrong Token'));
                return $this->redirect(array('action' => 'index'));
            }
        }


/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null)
    {
        $this->Job->id = $id;
        if (!$this->Job->exists()) {
            throw new NotFoundException(__('Invalid job'));
        }

            $this->request->allowMethod('post', 'delete');
            if ($this->Job->delete()) {
                $this->Flash->success(__('The job has been deleted.'));
            } else {
                $this->Flash->error(__('The job could not be deleted. Please, try again.'));
            }
            return $this->redirect(array('action' => 'index'));
    }

}
