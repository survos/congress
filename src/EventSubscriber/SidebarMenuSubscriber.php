<?php // generated by @SurvosBase/SidebarMenuSubscriber.php.twig

namespace App\EventSubscriber;

use Knp\Menu\ItemInterface;
use Survos\BaseBundle\Menu\BaseMenuSubscriber;
use Survos\BaseBundle\Menu\MenuBuilder;
use Survos\BaseBundle\Traits\KnpMenuHelperTrait;
use KevinPapst\AdminLTEBundle\Event\KnpMenuEvent;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;


class SidebarMenuSubscriber extends BaseMenuSubscriber implements EventSubscriberInterface
{
    use KnpMenuHelperTrait;

    private $security;

    public function __construct(AuthorizationCheckerInterface $security)
    {
        $this->security = $security;
    }

    public function onKnpMenuEvent(KnpMenuEvent $event)
    {
        $menu = $event->getMenu();
        $this->addMenuItem($menu, ['route' => 'app_homepage']);
        $this->addMenuItem($menu, ['route' => 'app_typography']);
        $this->addMenuItem($menu, ['route' => 'app_heroku']);
// https://dashboard.heroku.com/apps/agile-chamber-52782/resources
        // for nested menus, don't add a route, just a label, then use it for the argument to addMenuItem
        $nestedMenu = $this->addMenuItem($menu, ['label' => 'Credits']);
        foreach (['bundles', 'javascript'] as $type) {
            $this->addMenuItem($nestedMenu, [
                'route' => 'survos_base_credits', 'rp' => ['type' => $type], 'label' => ucfirst($type)]);
        }

        // add the login/logout menu items.
        $this->authMenu($this->security, $menu);

    }

    public static function getSubscribedEvents()
    {
        return [
            MenuBuilder::SIDEBAR_MENU_EVENT => 'onKnpMenuEvent',
        ];
    }
}