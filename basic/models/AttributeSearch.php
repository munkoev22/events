<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Attribute;

/**
 * AttributeSearch represents the model behind the search form of `app\models\Attribute`.
 */
class AttributeSearch extends Attribute
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attribute_id'], 'integer'],
            [['attribute_name', 'attribute_type'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Attribute::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'attribute_id' => $this->attribute_id,
        ]);

        $query->andFilterWhere(['like', 'attribute_name', $this->attribute_name])
            ->andFilterWhere(['like', 'attribute_type', $this->attribute_type]);

        return $dataProvider;
    }
}