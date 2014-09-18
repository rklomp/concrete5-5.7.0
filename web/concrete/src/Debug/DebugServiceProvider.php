<?php
namespace Concrete\Core\Debug;


use DebugBar\StandardDebugBar;
use Illuminate\Support\ServiceProvider;

class DebugServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->instance('debugbar', $bar = new StandardDebugBar());
        $debugStack = new \Doctrine\DBAL\Logging\DebugStack();

        // Cache javascript renderer object.
        $renderer = $bar->getJavascriptRenderer('/concrete/vendor/maximebf/debugbar/src/DebugBar/Resources');

        \Database::connection()->getConfiguration()->setSQLLogger($debugStack);
        $bar->addCollector(new \DebugBar\Bridge\DoctrineCollector($debugStack));

        \View::getInstance()->addHeaderItem($renderer->renderHead());

        \Events::addListener('on_shutdown', function() use ($renderer) {
            echo $renderer->render();
        });
    }

}