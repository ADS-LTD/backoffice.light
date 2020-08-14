<?php
namespace Digitalis\Core\Models;
/**
 * Mail Représente un mail à envoyer à un seul destinataire. pour l'envoi d'un mail à plusieurs personnes
 * faire usage de phpmailer
 *
 * @copyright  2016 ADS LTD http://www.adsyst-secure.com
 * @license    Intellectual property rights of ADS LTD
 * @version    Release: 1.0 
 */
class Mail
{

    /**
     * Adresse de l'éxpéditeur du mail
     *
     * @var string
     */
    public $senderMail;

    /**
     * Nom de l'expéditeur
     *
     * @var string
     */
    public $senderName;

    /**
     * Adresse du destinataire
     *
     * @var string
     */
    public $destMail;

    /**
     * Nom du destinataire
     *
     * @var string
     */
    public $destName;

    /**
     * Sujet du mail
     *
     * @var string
     */
    public $subject;

    /**
     * Message à envoyer
     *
     * @var string
     */
    public $mailBody;

    /**
     * Destinataire en copy du mail
     *
     * @var string
     */
    public $copy;

    /**
     * Copy cache du mail
     *
     * @var string
     */
    public $bcopy;
}
