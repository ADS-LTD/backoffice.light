<?php
namespace Digitalis\Core\Models\Security;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Body;
use Slim\Container;
use Digitalis\Core\Models\SessionManager;
use Digitalis\Core\Models\SysConst;
use Digitalis\Core\Models\Data;


/**
 * CsrfMiddleware Middleware permettant de valider l'AntiForgeryToken
 *
 * @copyright  2016 ADS LTD http://www.adsyst-secure.com
 * @license    Intellectual property rights of ADS LTD
 * @version    Release: 1.0 
 */
class CsrfMiddleware
{

    /**
     * Conteneur
     *
     * @var \Slim\Container
     */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        if (in_array($request->getMethod(), ['POST', 'PUT', 'DELETE', 'PATCH'])) {
            $csrfToken = AntiForgeryToken::getAntiForgeryToken();

            if (!$csrfToken->validateAntiForgeryToken()) {
                $refererHeader = $request->getHeader('HTTP_REFERER');
                SessionManager::set(SysConst::ICSRF, "Invalid csrf token!");
                if ($refererHeader) {
                    $referer = array_shift($refererHeader);
                    return $response->withRedirect($referer);
                } else {
                    $uri = $request->getUri();
                    $curUrl = (string)$uri;
                    return $response->withStatus(405)->withRedirect($this->container->baseUrl . CUR_LANG);
                }
                $body = new Body(fopen('php://temp', 'r+'));
                $body->write('Invalid crsf token!');
                return $response->withStatus(405)->withBody($body);
            }
            SessionManager::remove(SysConst::ICSRF);
        }
        return $next($request, $response);

    }
}