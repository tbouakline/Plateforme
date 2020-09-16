<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "entreprise".
 *
 * @property int $id_entreprise
 * @property int $secteur_eco
 * @property string $branche
 * @property string $taille
 * @property string $nom_entreprise
 * @property string $siege_social
 * @property int $id_admin
 */
class Entreprise extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entreprise';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_activite', 'taille', 'nom_entreprise', 'siege_social'], 'required'],
            [['id_activite', 'id_admin','wilaya','commune'], 'integer'],
            [['taille'], 'string'],
            [['branche','statut_juridique'], 'string', 'max' => 100],
            [['nom_entreprise'], 'string', 'max' => 250],
            [['siege_social'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_entreprise' => 'Id Entreprise',
            'id_activite' => 'Activité',
            'branche' => 'Branche',
            'taille' => 'Taille',
            'nom_entreprise' => 'Nom de l\'Entreprise',
            'siege_social' => 'Siège Social',
            'id_admin' => 'Id Admin',
            'statut_juridique'=>'Statut juridique',
            'wilaya'=>'Wilaya',
            'commune'=>'Commune',
        ];
    }
}
