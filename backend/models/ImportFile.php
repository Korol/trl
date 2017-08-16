<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImportFile extends Model
{
    /**
     * @var UploadedFile
     */
    public $importfile;
    /**
     * @var Catalog ID
     */
    public $catalog_id;

    public function rules()
    {
        return [
            [['catalog_id'], 'integer'],
            [['importfile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xls, xlsx', 'checkExtensionByMimeType'=>false],
        ];
    }

    public function attributeLabels()
    {
        return [
            'catalog_id' => Yii::t('app', 'Catalog') . ':',
            'importfile' => Yii::t('app', 'Import file') . ':',
        ];
    }

    public function upload($filename)
    {
        if ($this->validate()) {
            $this->importfile->saveAs('import/' . $filename . '.' . $this->importfile->extension);
            return true;
        } else {
//            var_dump($this->errors, $this->importfile->extension);
            return false;
        }
    }
}