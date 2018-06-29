<?php

namespace backend\modules\siti\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\siti\models\TJabatan;

/**
 * TJabatanSearch represents the model behind the search form about `backend\modules\siti\models\TJabatan`.
 */
class TJabatanSearch extends TJabatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_jabatan'], 'integer']
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
    public function search($params)
    {
        $query = TJabatan::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_jabatan' => $this->id_jabatan,
        ]);

        $query->andFilterWhere(['like', 'jabatan', $this->jabatan]);

        return $dataProvider;
    }
}
