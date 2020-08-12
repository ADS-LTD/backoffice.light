<?php
namespace Digitalis\Core\Models;

/**
 * JsonResponse Réponse json des requêtes
 *
 * @copyright  2016 ADS LTD http://www.adsyst-secure.com
 * @license    Intellectual property rights of ADS LTD
 * @version    Release: 1.0 
 */
class JsonResponse implements \JsonSerializable
{

	/**
	 * Statut
	 *
	 * @var boolean
	 */
	public $isSuccess;

	/**
	 * Message de la réponse
	 *
	 * @var string
	 */
	public $message;

	/**
	 * donnée à retourner
	 *
	 * @var object
	 */
	public $data;

	public function __construct()
	{
		$this->isSuccess = true;
	}

	public function asArray()
	{
		return [
			'isSuccess' => $this->isSuccess,
			'message' => $this->message,
			'data' => $this->data
		];
	}
	public function jsonSerialize()
	{
		return [
			'isSuccess' => $this->isSuccess,
			'message' => $this->message,
			'data' => $this->data
		];
	}
}