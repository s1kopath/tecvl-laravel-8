<?php

namespace App\Services\Mail;

use App\Models\EmailTemplate;
use App\Models\Language;

abstract class SendMail
{
    abstract public function send($request);

    /**
     * Mail setting
     * @param string $langName, $slug
     * @return object
     */
    protected function setting($langName, $slug)
    {
        $languageId = Language::getAll()->where('short_name', $langName)->first()->id;

        // Retrieve user refund email template
        $parent = EmailTemplate::getAll()->where('slug', $slug)->where('language_id', $languageId)->first();
        $parentId = EmailTemplate::getAll()->where('slug', $slug)->first()->id;

        return !empty($parent) ? $parent : EmailTemplate::getAll()->where('parent_id', $parentId)->where('language_id', $languageId)->first();
    }
}
