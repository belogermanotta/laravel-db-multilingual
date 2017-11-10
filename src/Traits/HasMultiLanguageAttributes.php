<?php

/**
 * Created by PhpStorm.
 * User: emillion
 * Date: 09/02/2017
 * Time: 23:12
 */

namespace Lionch\Multilingual\Helpers;

use Lionch\Multilingual\Exceptions\MultilingualException;

trait HasMultiLanguageAttributes
{

    /**
     * The model's multi language attributes.
     *
     * @var array
     */
    protected $multilingualAttributes = [];

    /**
     * The languages supported.
     *
     * @var array
     */
    protected $languages = [];

    /**
     * @return mixed
     */
    public function attributesToArray()
    {
        $attributes = parent::attributesToArray();
        $attributes = $this->updateToSelectedLanguageAttributes($attributes);

        return $attributes;
    }

    /**
     * @param $attributes
     * @return array
     */
    private function updateToSelectedLanguageAttributes($attributes)
    {
        if (empty($attributes)) {
            return $attributes;
        }
        $this->languages = $this->loadLanguages();
        $languages = array_merge([], $this->languages);
        $key = array_search(HeaderHelper::getLanguage(), $languages);
        $language = $languages[$key];
        $attributes = $this->convertLanguage($attributes, $language, $languages);

        return $attributes;
    }

    private function loadLanguages()
    {
        $languages = explode(',', env('AVAILABLE_LANGUAGES', 'en'));

        return $languages;
    }

    /**
     * @param $attributes
     * @param $language
     * @param $languages
     * @return array
     */
    private function convertLanguage($attributes, $language, $languages)
    {
        try {
            foreach ($this->multilingualAttributes as $multilingualAttribute) {
                if ($language != env('DEFAULT_LANGUAGE', 'en')) {
                    $source = $attributes[$multilingualAttribute . '_' . $language];
                    $attributes[$multilingualAttribute] = $source;
                }

                $attributes = $this->removeUnusedLanguageAttributes($multilingualAttribute, $languages, $attributes);
            }
        } catch (\ErrorException $e) {
            throw new MultilingualException('Undefined column(s): ' . implode(", ", $this->multilingualAttributes));
        }

        return $attributes;
    }

    /**
     * @param $selectedAttribute
     * @param $languages
     * @param $attributes
     * @return mixed
     */
    private function removeUnusedLanguageAttributes($selectedAttribute, $languages, $attributes)
    {
        foreach ($languages as $removedLanguage) {
            unset($attributes[$selectedAttribute . '_' . $removedLanguage]);
        }

        return $attributes;
    }

}
