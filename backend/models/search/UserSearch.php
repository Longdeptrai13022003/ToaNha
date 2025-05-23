<?php

namespace backend\models\search;

use backend\models\UserVaitroDonvi;
use common\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CauHinh;
use backend\models\QuanLyVanBanDen;
use common\models\myAPI;


/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'don_vi_id'], 'safe'],
            [['hoten', 'username', 'password_hash', 'hoten'], 'safe'],
            [['chuc_vu', 'vai_tro'], 'safe'],
            [['hoten', 'username', 'password_hash', 'password_reset_token', 'email', 'auth_key', 'password', 'vaitro', 'tenDonVi'], 'safe'],
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
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'VIP' => $this->VIP,
        ]);
        if($this->vi_tu){
            $query->andFilterWhere(['>=', 'vi_dien_tu', $this->vi_dien_tu]);
        }
        if($this->vi_den){
            $query->andFilterWhere(['<=', 'vi_dien_tu', $this->vi_dien_tu]);
        }

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'hoten', $this->hoten])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password', $this->password]);

        return $dataProvider;
    }
}
