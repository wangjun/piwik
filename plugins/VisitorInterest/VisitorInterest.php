<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\VisitorInterest;

use Piwik\ArchiveProcessor;
use Piwik\Container\StaticContainer;
use Piwik\FrontController;
use Piwik\Metrics;
use Piwik\Piwik;
use Piwik\Plugins\CoreVisualizations\Visualizations\Cloud;
use Piwik\Plugins\CoreVisualizations\Visualizations\Graph;

class VisitorInterest extends \Piwik\Plugin
{

    /**
     * @see Piwik\Plugin::getListHooksRegistered
     */
    public function getListHooksRegistered()
    {
        return array(
            'Live.getAllVisitorDetails' => 'extendVisitorDetails',
            'Template.footerVisitsFrequency' => 'footerVisitsFrequency',
        );
    }

   public function footerVisitsFrequency(&$out)
    {
        /** @var FrontController $frontController */
        $frontController = StaticContainer::get('Piwik\FrontController');

        $out .= $frontController->fetchDispatch('VisitorInterest', 'index');
    }

    public function extendVisitorDetails(&$visitor, $details)
    {
        $visitor['daysSinceLastVisit'] = $details['visitor_days_since_last'];
    }

}
