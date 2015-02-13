<?php
/**
 * Created by PhpStorm.
 * User: Andy
 * Date: 16/01/2015
 * Time: 12:32
 */

namespace Craft;

class SitemapVariable
{
	public function getSettingsForSection(SectionModel $section)
	{
		return craft()->sitemap->getSettingsForSection($section);
	}

	public function getSettingsForCategoryGroup(CategoryGroupModel $group)
	{
		return craft()->sitemap->getSettingsForCategoryGroup($group);
	}

	public function getSettingsKeyPrefixFor(BaseModel $item) {
		return craft()->sitemap->getSettingsKeyPrefixFor($item);
	}
}
