<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EntLeads;

/**
 * EntLeadsSearch represents the model behind the search form about `app\models\EntLeads`.
 */
class EntLeadsSearch extends EntLeads
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_lead', 'id_usuario_lead_destino', 'id_usuario_lead_origen', 'b_habilitado', 'b_atendido'], 'integer'],
            [['enviadoNombre','txt_descripcion', 'txt_token', 'txt_nombre_contacto', 'txt_numero_contacto', 'fch_creacion', 'fch_atencion_lead'], 'safe'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchMisLeads($params, $idUsuario)
    {
        $query = EntLeads::find();
        $query->joinWith(['idUsuarioLeadOrigen']);
        $query->where(['id_usuario_lead_destino'=>$idUsuario]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
               
            ],
        ]);

        // Important: here is how we set up the sorting
    // The key is the attribute name on our "TourSearch" instance
    $dataProvider->sort->attributes['enviadoNombre'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['mod_usuarios_ent_usuarios.txt_username' => SORT_ASC],
        'desc' => ['mod_usuarios_ent_usuarios.txt_username' => SORT_DESC],
    ];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }


        // grid filtering conditions
        $query->andFilterWhere([
            'id_lead' => $this->id_lead,
            'id_usuario_lead_destino' => $this->id_usuario_lead_destino,
            'id_usuario_lead_origen' => $this->id_usuario_lead_origen,
            'ent_leads.fch_creacion' => $this->fch_creacion,
            'fch_atencion_lead' => $this->fch_atencion_lead,
            'b_habilitado' => $this->b_habilitado,
            'b_atendido' => $this->b_atendido,
        ]);

        $query->andFilterWhere(['like', 'txt_descripcion', $this->txt_descripcion])
            ->andFilterWhere(['like', 'txt_token', $this->txt_token])
            ->andFilterWhere(['like', 'txt_nombre_contacto', $this->txt_nombre_contacto])
            ->andFilterWhere(['like', 'txt_numero_contacto', $this->txt_numero_contacto])
            ->andFilterWhere(['like', 'mod_usuarios_ent_usuarios.txt_username', $this->enviadoNombre]);

        return $dataProvider;
    }

    public function searchLeadsEnviados($params, $idUsuario)
    {
        $query = EntLeads::find();
        $query->joinWith(['idUsuarioLeadDestino']);
        $query->where(['id_usuario_lead_origen'=>$idUsuario]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
               
            ],
        ]);

        // Important: here is how we set up the sorting
    // The key is the attribute name on our "TourSearch" instance
    $dataProvider->sort->attributes['enviadoNombre'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['mod_usuarios_ent_usuarios.txt_username' => SORT_ASC],
        'desc' => ['mod_usuarios_ent_usuarios.txt_username' => SORT_DESC],
    ];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }


        // grid filtering conditions
        $query->andFilterWhere([
            'id_lead' => $this->id_lead,
            'id_usuario_lead_destino' => $this->id_usuario_lead_destino,
            'id_usuario_lead_origen' => $this->id_usuario_lead_origen,
            'ent_leads.fch_creacion' => $this->fch_creacion,
            'fch_atencion_lead' => $this->fch_atencion_lead,
            'b_habilitado' => $this->b_habilitado,
            'b_atendido' => $this->b_atendido,
        ]);

        $query->andFilterWhere(['like', 'txt_descripcion', $this->txt_descripcion])
            ->andFilterWhere(['like', 'txt_token', $this->txt_token])
            ->andFilterWhere(['like', 'txt_nombre_contacto', $this->txt_nombre_contacto])
            ->andFilterWhere(['like', 'txt_numero_contacto', $this->txt_numero_contacto])
            ->andFilterWhere(['like', 'mod_usuarios_ent_usuarios.txt_username', $this->enviadoNombre]);

        return $dataProvider;
    }
}
