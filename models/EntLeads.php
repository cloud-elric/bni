<?php

namespace app\models;

use Yii;
use app\modules\ModUsuarios\models\EntUsuarios;

/**
 * This is the model class for table "ent_leads".
 *
 * @property integer $id_lead
 * @property integer $id_usuario_lead_destino
 * @property integer $id_usuario_lead_origen
 * @property string $txt_descripcion
 * @property string $txt_nombre_contacto
 * @property string $txt_numero_contacto
 * @property string $fch_creacion
 * @property string $fch_atencion_lead
 * @property integer $b_habilitado
 *
 * @property ModUsuariosEntUsuarios $idUsuarioLeadDestino
 * @property ModUsuariosEntUsuarios $idUsuarioLeadOrigen
 */
class EntLeads extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_leads';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario_lead_destino', 'id_usuario_lead_origen', 'txt_descripcion', 'txt_nombre_contacto', 'txt_numero_contacto', 'b_habilitado'], 'required'],
            [['id_usuario_lead_destino', 'id_usuario_lead_origen', 'b_habilitado'], 'integer'],
            [['txt_descripcion'], 'string'],
            [['fch_creacion', 'fch_atencion_lead'], 'safe'],
            [['txt_nombre_contacto'], 'string', 'max' => 100],
            [['txt_numero_contacto'], 'string', 'max' => 12],
            [['id_usuario_lead_destino'], 'exist', 'skipOnError' => true, 'targetClass' => EntUsuarios::className(), 'targetAttribute' => ['id_usuario_lead_destino' => 'id_usuario']],
            [['id_usuario_lead_origen'], 'exist', 'skipOnError' => true, 'targetClass' => EntUsuarios::className(), 'targetAttribute' => ['id_usuario_lead_origen' => 'id_usuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_lead' => 'Id Lead',
            'id_usuario_lead_destino' => 'Id Usuario Lead Destino',
            'id_usuario_lead_origen' => 'Id Usuario Lead Origen',
            'txt_descripcion' => 'Txt Descripcion',
            'txt_nombre_contacto' => 'Txt Nombre Contacto',
            'txt_numero_contacto' => 'Txt Numero Contacto',
            'fch_creacion' => 'Fch Creacion',
            'fch_atencion_lead' => 'Fch Atencion Lead',
            'b_habilitado' => 'B Habilitado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuarioLeadDestino()
    {
        return $this->hasOne(ModUsuariosEntUsuarios::className(), ['id_usuario' => 'id_usuario_lead_destino']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuarioLeadOrigen()
    {
        return $this->hasOne(ModUsuariosEntUsuarios::className(), ['id_usuario' => 'id_usuario_lead_origen']);
    }

    public function getByToken($token){
        return EntLeads::find()->where(['txt_token'=>$token])->one();
    }
}
