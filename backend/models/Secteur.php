<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "secteur".
 *
 * @property int $id_secteur
 * @property string $libelli
 *
 * @property SecteurEconomique[] $secteurEconomiques
 */
class Secteur extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'secteur';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['libelli'], 'required'],
            [['libelli'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_secteur' => 'Id Secteur',
            'libelli' => 'Libelli',
        ];
    }

    /**
     * Gets query for [[SecteurEconomiques]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSecteurEconomiques()
    {
        return $this->hasMany(SecteurEconomique::className(), ['id_secteur' => 'id_secteur']);
    }
}
