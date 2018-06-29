<?php

namespace backend\modules\siti\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\siti\models\TStruktur;

/**
 * TStrukturSearch represents the model behind the search form about `backend\modules\siti\models\TStruktur`.
 */
class TStrukturSearch extends TStruktur
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_struktur', 'id_atasan', 'id_bawahan'], 'integer'],
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
        $query = TStruktur::find();

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
            'id_struktur' => $this->id_struktur,
            'id_atasan' => $this->id_atasan,
            'id_bawahan' => $this->id_bawahan,
        ]);

        return $dataProvider;
    }
}
