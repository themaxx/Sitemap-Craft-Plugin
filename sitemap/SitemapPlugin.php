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
		return 'Andy Heathershaw (modified by NextThought)';
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
		return '1.1.0';
	}

	protected function defineSettings()
	{
		$settings = array();

		foreach (craft()->sitemap->getSections() as $section)
		{
			$this->_settings($section, $settings);
		}

		foreach (craft()->sitemap->getCategoryGroups() as $group) {
			$this->_settings($group, $settings);
		}

		return $settings;
	}

	private function _settings(BaseModel $item, &$settings) {
		$prefix = craft()->sitemap->getSettingsKeyPrefixFor($item);
		$settingKeyEnabled = sprintf('%s_isEnabled', $prefix);
		$settingKeyFreq = sprintf('%s_frequency', $prefix);
		$settingKeyPriority = sprintf('%s_priority', $prefix);

		$settings[$settingKeyEnabled] = array(AttributeType::Bool, 'default' => true);
		$settings[$settingKeyFreq] = array(AttributeType::String, 'default' => 'weekly');
		$settings[$settingKeyPriority] = array(AttributeType::String, 'default' => '0.5');
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