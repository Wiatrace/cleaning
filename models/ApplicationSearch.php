<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Application;
use Yii;

/**
 * ApplicationSearch represents the model behind the search form of `app\models\Application`.
 */
class ApplicationSearch extends Application
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_application', 'user_id', 'vid_uslugi', 'rejection'], 'integer'],
            [['address', 'phone_number', 'other_usluga_description', 'oplata', 'time', 'create_time', 'status'], 'safe'],
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
        $query = Application::find();

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
            'id_application' => $this->id_application,
            'user_id' => $this->user_id,
            'vid_uslugi' => $this->vid_uslugi,
            'time' => $this->time,
            'create_time' => $this->create_time,
            'rejection' => $this->rejection,
        ]);

        $query->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'other_usluga_description', $this->other_usluga_description])
            ->andFilterWhere(['like', 'oplata', $this->oplata])
            ->andFilterWhere(['like', 'status', $this->status]);

if(!Yii::$app->user->identity->isAdmin()){
    $query->andFilterWhere([
        'user_id' => Yii::$app->user->identity->id,
    ]);

}


        return $dataProvider;
    }
}
