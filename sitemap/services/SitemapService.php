<?php
/**
 * Created by PhpStorm.
 * User: Andy
 * Date: 16/01/2015
 * Time: 09:55
 */

namespace Craft;

class SitemapService extends BaseApplicationComponent
{
    public function getSections()
    {
        return craft()->sections->getAllSections();
    }

    public function getCategoryGroups()
    {
        return craft()->categories->getAllGroups();
    }

    public function getSettingsForCategoryGroup(CategoryGroupModel $group) {
        $plugin = craft()->plugins->getPlugin('sitemap');

        if (is_null($plugin))
        {
            return array();
        }

        $settings = $plugin->getSettings();

        $isEnabled = sprintf('category_group_%d_isEnabled', $group->id);
        $frequency = sprintf('category_group_%d_frequency', $group->id);
        $priority = sprintf('category_group_%d_priority', $group->id);

        $result = array();

        if (isset($settings->$isEnabled))
        {
            $result['isEnabled'] = $settings->$isEnabled;
        }

        if (isset($settings->$frequency))
        {
            $result['frequency'] = $settings->$frequency;
        }

        if (isset($settings->$priority))
        {
            $result['priority'] = $settings->$priority;
        }

        return $result;
    }

    public function getSettingsForSection(SectionModel $section)
    {
        $plugin = craft()->plugins->getPlugin('sitemap');

        if (is_null($plugin))
        {
            return array();
        }

        $settings = $plugin->getSettings();

        $isEnabled = sprintf('section_%d_isEnabled', $section->id);
        $frequency = sprintf('section_%d_frequency', $section->id);
        $priority = sprintf('section_%d_priority', $section->id);

        $result = array();

        if (isset($settings->$isEnabled))
        {
            $result['isEnabled'] = $settings->$isEnabled;
        }

        if (isset($settings->$frequency))
        {
            $result['frequency'] = $settings->$frequency;
        }

        if (isset($settings->$priority))
        {
            $result['priority'] = $settings->$priority;
        }

        return $result;
    }
}