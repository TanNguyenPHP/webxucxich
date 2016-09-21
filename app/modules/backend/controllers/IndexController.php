<?php
namespace Webxucxich\Modules\Backend\Controllers;
use Webxucxich\Modules\Modeldb\Models\Webconfig;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        return $this->view->data = $this::LoadWebConfig();
    }

    public function saveconfigAction()
    {
        $config = $this::LoadWebConfig();

        if (!$config) {
            $this->flash->error("Cấu hình không tồn lại");

            $this->dispatcher->forward(array(
                'controller' => "index",
                'action' => 'index'
            ));

            return;
        }

        $config->title = $this->request->getPost("title");
        $config->meta = $this->request->getPost("description");
        $config->address = $this->request->getPost("address");
        $config->companyname = $this->request->getPost("companyname");
        $config->cellphone = $this->request->getPost("cellphone");
        $config->email = $this->request->getPost("email");
        $config->facebook = $this->request->getPost("facebook");

        if (!$config->save()) {

            foreach ($config->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "index",
                'action' => 'index',
                'params' => array($config->id_lang)
            ));

            return;
        }

        $this->flash->success("Đã lưu");
        $this->dispatcher->forward(array(
            'controller' => "index",
            'action' => 'index'
        ));
    }

    private function LoadWebConfig()
    {
        $webconfig = Webconfig::findFirst();
        return $webconfig;
    }
}

