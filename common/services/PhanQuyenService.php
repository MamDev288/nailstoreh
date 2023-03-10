<?php

namespace common\services;

use backend\models\form\VaiTroForm;
use backend\models\search\VaiTroSearch;
use backend\models\VaiTro;
use backend\models\Vaitrouser;
use backend\services\VaiTroService;
use Yii;
use backend\models\ChucNang;
use backend\models\search\ChucDanhSearch;
use backend\models\search\ChucNangSearch;
use backend\services\ChucNangService;
use yii\db\Exception;
use yii\web\NotFoundHttpException;
use function Symfony\Component\Translation\t;

class PhanQuyenService extends Service implements PhanQuyenServiceInterface
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function getSearchModel(array $options = [])
    {
        throw new Exception("Not need");
    }

    public function getModel($id, array $options = [])
    {
        throw new Exception("Not need");
    }

    public function newModel(array $options = [])
    {
        throw new Exception("Not need");
    }

    public function getNewChucNangModel()
    {
        return new ChucNang();
    }

    public function getChucNangSearchModel(array $options = [])
    {
        return new ChucNangSearch();
    }

    public function getChucNangList(array $query = [])
    {
        $searchModel = $this->getChucNangSearchModel();
        $dataProvider = $searchModel->search($query);

        return [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ];
    }

    public function createChucNang(array $postData = [])
    {
        $formModel = $this->getNewChucNangModel();
        if (!$formModel->load($formModel)) {
            return $formModel;
        }

        if (ChucNangService::getChucNangByName($formModel->name) !== null) {
            $formModel->addError('name', Yii::t('app', 'Chức năng đã tồn tại'));
            return false;
        }

        if (ChucNangService::createChucNang($formModel)) {
            return true;
        }
        return false;
    }

    public function getChucNangDetail($id)
    {
        $chucNang = ChucNangService::getChucNangById($id);
        return $chucNang;
    }

    public function updateChucNang($id, array $postData = [])
    {
        $formModel = $this->getChucNangDetail($id);
        if (!$formModel->load($postData)) {
            return $formModel->getErrors();
        }

//        $oldChucNang = $this->getChucNangDetail($name);
        if ($formModel->save()) {
            return true;
        }
        return false;
    }

    public function deleteChucNang($id)
    {
        if ($chucNang = $this->getChucNangDetail($id)) {
            return $chucNang->delete();
        }
        return false;
    }

    public function getNewVaiTroModel()
    {
        return new VaiTroForm();
    }

    public function getVaiTroSearchModel(array  $options = []){
        return new VaiTroSearch();
    }

    public function getVaiTroList(array $query = [])
    {
        $searchModel = $this->getVaiTroSearchModel();
        $dataProvider = $searchModel->search($query);
        return [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ];
    }

    public function createVaiTro(array $postData = [])
    {
        $formModel = $this->getNewVaiTroModel();
        if(!$formModel->load($formModel)){
            return $formModel->getErrors();
        }

        if(VaiTroService::getVaiTroByName($formModel->name) !== null){
            $formModel->addError('name', Yii::t('app', 'Vai trò đã tồn tại'));
            return false;
        }

        if(VaiTroService::createVaiTro($formModel)){
            return true;
        }
        return false;
    }

    public function getVaiTroDetail($id)
    {
        if($vaiTro = VaiTroService::getVaiTroById($id)){
            $vaiTro->setChucNangs(VaiTroService::getChucNangsByVaiTroId($id));
            return $vaiTro;
        }
        return null;
    }

    public function updateVaiTro($name, array $postData = []){
        $formModel = $this->getVaiTroDetail($name);
        if(!$formModel->load($postData)){
            return $formModel->getErrors();
        }
        return VaiTroService::updateVaiTro($formModel);
    }

    public function deleteVaiTro($id)
    {
        $vaiTro = $this->getVaiTroDetail($id);
        if(is_null($vaiTro)) throw new NotFoundHttpException("Không tìm thấy vai trò ". $id);
        return VaiTroService::deleteVaiTro($id);
    }

    public function getVaiTros()
    {
        $vaiTros = [];
        foreach (array_keys(VaiTroService::getVaiTros()) as $key){
            $vaiTros[$key] = $key;
        }
        return $vaiTros;
    }

    public function getChucNangsNhoms()
    {
        $chucNangs = ChucNangService::getChucNangs();

        $data = [];

        foreach ($chucNangs as $chucNang){
            $data[$chucNang->nhom][] = $chucNang;
        }
        return $data;
    }

    public function getChucNangNhoms()
    {
        $chucNangs = $this->getChucNangsNhoms();
        $nhoms = array_keys($chucNangs);
        $newNhoms = [];
        foreach ($nhoms as $nhom){
            $newNhoms[$nhom] = $nhom;
        }
        return $newNhoms;
    }


    public function newVaiTroUserModel()
    {
        return new Vaitrouser();
    }

    public function getVaiTroUserDetail($userId)
    {

    }

    public function phanQuyen($postData, $userId){

    }
}