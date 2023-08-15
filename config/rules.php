<?php

return [
    'color' => ['required', new \Azuriom\Rules\Color()],
    'title' => 'required|string',
    'subtitle' => 'required|string',
    'description' => 'required|string',
    'footer_links' => 'nullable|array',
];
