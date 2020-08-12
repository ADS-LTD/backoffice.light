<?php
namespace Digitalis\Core\Models\ViewModels;

/**
 * LoginViewModel Modèle pour l'authentification de l'utilisateur
 *
 * @copyright  2016 ADS LTD http://www.adsyst-secure.com
 * @license    Intellectual property rights of ADS LTD
 * @version    Release: 1.0 
 */
class LoginViewModel implements ViewModelInterface
{

    /**
     * adresse mail de l'utilisateur
     *
     * @IME\Required{"errMsg":"Ce champ est obligatoire"}
     * @IME\DataType{"type":"email","errMsg":"Adresse mail invalide"}
     * @var string
     */
    public $email;

    /**
     * Mot de passe de l'utilisateur
     *
     * @IME\Required{"errMsg":"Ce champ est obligatoire"}
     * @IME\DataType{"type":"string"}
     * @IME\Length{"max":15,"min":5,"errMsg":"Le mot de passe doit avoir entre 5 et 15 caractères"}
     * @var string
     */
    public $password;

    public function toArray()
    {
        return ['email' => $this->email, 'password' => $this->password];
    }

    public function convertToEntity()
    {

    }
    public static function buildFromEntity($entitySource = null)
    {

    }
}