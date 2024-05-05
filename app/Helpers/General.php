<?php

use Illuminate\Http\RedirectResponse;

if (!function_exists('generateToken')) {
    function generateToken(int $length): string
    {
        $digits = range(0, 9);
        shuffle($digits);

        $uniqueNumber = '';
        for ($i = 0; $i < $length; $i++) {
            $uniqueNumber .= $digits[$i];
        }

        return $uniqueNumber;
    }
}

if (!function_exists('checkPermission')) {
    function checkPermission($request, array $permissions): RedirectResponse|array
    {
        $pageData = null;
        foreach ($permissions as $permission)
        {
            foreach ($permission["items"] as $item)
            {
                if (str_contains("api/".$request, $item["link"]))
                {
                    $pageData = [
                        "route" => $permission["title"]["translates"][app()->getLocale()],
                        "page" => $item["title"]["translates"][app()->getLocale()],
                        "actions" => $item["actions"],
                        "link" => $item["link"],
                        "belongsTo" => $item["specific_actions_belongs_to"]
                    ];
                    break;
                }
            }
            if (isset($pageData)) break;
        }

        if (isset($pageData) && $pageData["actions"]["read"]) return $pageData;
        return redirect()->route("noPage");
    }
}
