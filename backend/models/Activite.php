<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "activite".
 *
 * @property int $id_activite
 * @property string $libelli
 * @property int $id_secteur
 *
 * @property Secteur $secteur
 * @property Entreprise[] $entreprises
 */
class Activite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activite';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['libelli', 'id_secteur'], 'required'],
            [['id_secteur'], 'integer'],
            [['libelli'], 'string', 'max' => 200],
            [['id_secteur'], 'exist', 'skipOnError' => true, 'targetClass' => Secteur::className(), 'targetAttribute' => ['id_secteur' => 'id_secteur']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_activite' => 'Id Activite',
            'libelli' => 'Nom de l\'activité',
            'id_secteur' => 'Id Secteur',
        ];
    }

    /**
     * Gets query for [[Secteur]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSecteur()
    {
        return $this->hasOne(Secteur::className(), ['id_secteur' => 'id_secteur']);
    }

    /**
     * Gets query for [[Entreprises]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntreprises()
    {
        return $this->hasMany(Entreprise::className(), ['id_activite' => 'id_activite']);
    }
}
