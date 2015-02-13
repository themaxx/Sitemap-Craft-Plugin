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

	public function getSettingsKeyPrefixFor(BaseModel $item) {
		return sprintf('%s_%d', $item->classHandle, $item->id);
	}

	private function getSettingsFor(BaseModel $item) {
		$plugin = craft()->plugins->getPlugin('sitemap');

		if (is_null($plugin))
		{
			return array();
		}

		$settings = $plugin->getSettings();

		$prefix = $this->getSettingsKeyPrefixFor($item);
		$isEnabled = sprintf('%s_isEnabled', $prefix);
		$frequency = sprintf('%s_frequency', $prefix);
		$priority = sprintf('%s_priority', $prefix);

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

	public function getSettingsForCategoryGroup(CategoryGroupModel $group)
	{
		return $this->getSettingsFor($group);
	}

	public function getSettingsForSection(SectionModel $section)
	{
		return $this->getSettingsFor($section);
	}
}
