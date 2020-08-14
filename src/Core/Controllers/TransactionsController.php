<?php
namespace Digitalis\Core\Controllers;

use Digitalis\Core\Controllers\Controller;
use Digitalis\Core\Handlers\ErrorHandler;
use Digitalis\Core\Models\Data;
use Digitalis\Core\Models\DataBase\DBase;
use Digitalis\Core\Models\DataTable;
use Digitalis\Core\Models\DbAdapters\AffectationDbAdapter;
use Digitalis\Core\Models\DbAdapters\AgenceDbAdapter;
use Digitalis\Core\Models\DbAdapters\CityDbAdapter;
use Digitalis\Core\Models\DbAdapters\CountryDbAdapter;
use Digitalis\Core\Models\DbAdapters\EntrepriseDbAdapter;
use Digitalis\Core\Models\DbAdapters\PartnerDbAdapter;
use Digitalis\Core\Models\DbAdapters\RegionDbAdapter;
use Digitalis\Core\Models\DbAdapters\CaisseDbAdapter;
use Digitalis\Core\Models\DbAdapters\OperatorDbAdapter;
use Digitalis\Core\Models\DbAdapters\TransactionDbAdapter;
use Digitalis\Core\Models\Entities\transaction;
use Digitalis\Core\Models\JsonResponse;
use Digitalis\Core\Models\Lexique;
use Digitalis\Core\Models\SessionManager;
use Digitalis\Core\Models\SysConst;
use Digitalis\Core\Models\ViewModels\AffectationViewModel;
use Digitalis\Core\Models\ViewModels\EntrepriseViewModel;
use Imediatis\EntityAnnotation\ModelState;
use Imediatis\EntityAnnotation\Security\InputValidator;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * TransactionsController Controleur de gestion des transactions
 * @copyright  2016 ADS LTD http://www.adsyst-secure.com
 * @license    Intellectual property rights of ADS LTD
 * @version    Release: 1.0 
 */
class TransactionsController extends Controller
{
    public function __construct($container)
    {
        parent::__construct($container);
        parent::setCurrentController(__class__);
    }

    public function index(Request $request, Response $response)
    {
        $this->title(Lexique::GetString(CUR_LANG, 'transactions'));

        return $this->render($response, 'index', true);
    }

    public function listtransactions(Request $request, Response $response)
    {
        $output = array("draw" => 1, "recordsTotal" => 0, "recordsFiltered" => 0, "data" => []);
        try {
            // DB table to use
            $table = 'view_transactions';

            // Table's primary key
            $primaryKey = 'trans_id';
            $router = $this->router;
            // indexes tdoc_code
            $columns = array(
                //array('db' => 'trans_id', 'dt' => 0),
                array('db' => 'trans_customer', 'dt' => 6),
                array('db' => 'box_code', 'dt' => 5),
                array('db' => 'ope_fname', 'dt' => 4),
                array('db' => 'trans_accountnumber', 'dt' => 7),
                array('db' => 'agc_code', 'dt' => 3),
                array('db' => 'trans_date', 'dt' => 0, 'formatter' => function ($d) {
                return (new \DateTime($d))->format('Y-m-d');
                }),
                array('db' => 'trans_partnercode', 'dt' => 2),
                array('db' => 'trans_amount', 'dt' => 8),
                array('db' => 'trans_reference', 'dt' => 1),
                array('db' => 'trans_fees', 'dt' => 9),
                array('db' => 'trans_status', 'dt' => 10),
                array('db' => 'trans_doctype', 'dt' => 11),
                array('db' => 'trans_docnumer', 'dt' => 12),
            );
            $output = DataTable::complex($_POST, DBase::paramsPDO(), $table, $primaryKey, $columns);
        } catch (\Exception $exc) {
            Data::setErrorMessage(Lexique::GetString(CUR_LANG, an_error_occured));
            ErrorHandler::writeLog($exc);
            $output['error'] = Lexique::GetString(CUR_LANG, an_error_occured);
        }
        return $this->renderJson($response, $output);
    }

	/*public function print(Request $request, Response $response)
	{
		$this->title(Lexique::GetString(CUR_LANG, 'transactions'));

		return $this->render($response, 'print', true);
	}*/


}
