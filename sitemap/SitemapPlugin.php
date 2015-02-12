<?php
/**
 * Created by PhpStorm.
 * User: Andy
 * Date: 16/01/2015
 * Time: 09:53
 */

namespace Craft;

class SitemapPlugin extends BasePlugin
{
    function getDeveloper()
    {
        return 'Andy Heathershaw';
    }

    function getDeveloperUrl()
    {
        return 'http://www.andys.website/software/sitemap';
    }

    function getName()
    {
        return Craft::t('XML Sitemap');
    }

    function getVersion()
    {
        return '1.0.0';
    }

    protected function defineSettings()
    {
        $settings = array();

        foreach (craft()->sitemap->getSections() as $section)
        {
            $settingKey = sprintf('section_%d', $section->id);
            $settingKeyEnabled = sprintf('%s_isEnabled', $settingKey);
            $settingKeyFreq = sprintf('%s_frequency', $settingKey);
            $settingKeyPriority = sprintf('%s_priority', $settingKey);

            $settings[$settingKeyEnabled] = array(AttributeType::Bool, 'default' => true);
            $settings[$settingKeyFreq] = array(AttributeType::String, 'default' => 'weekly');
            $settings[$settingKeyPriority] = array(AttributeType::String, 'default' => '0.5');
        }

        foreach (craft()->sitemap->getCategoryGroups() as $group) {
            $settingKey = sprintf('category_group_%d', $group->id);
            $settingKeyEnabled = sprintf('%s_isEnabled', $settingKey);
            $settingKeyFreq = sprintf('%s_frequency', $settingKey);
            $settingKeyPriority = sprintf('%s_priority', $settingKey);

            $settings[$settingKeyEnabled] = array(AttributeType::Bool, 'default' => true);
            $settings[$settingKeyFreq] = array(AttributeType::String, 'default' => 'weekly');
            $settings[$settingKeyPriority] = array(AttributeType::String, 'default' => '0.5');
        }

        return $settings;
    }

    public function hasCpSection()
    {
        return false;
    }

    public function getSettingsHtml()
    {
        return craft()->templates->render('sitemap/_settings', array(
            'sections' => craft()->sitemap->getSections(),
            'categoryGroups' => craft()->sitemap->getCategoryGroups(),
            'settings' => $this->getSettings()
        ));
    }

    public function prepSettings($settings)
    {
        // Modify $settings here...

        return $settings;
    }

    public function registerSiteRoutes()
    {
        return array(
            'sitemap.xml' => array('action' => 'sitemap/render/renderSitemap')
        );
    }
}