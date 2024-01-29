<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GlobalSearchController extends Controller {

    private $models = [
        #CRUD-NEW-ITEM
        'RoleTranslation' => [
            'roles',
            'global.roles',
            'role_edit',
            'role_id',
            'core',
        ],
        'User' => [
            'users',
            'global.users',
            'user_edit',
            false,
            'core',
        ],
    ];

    public function search(Request $request) {
        $search = $request->input('search');

        if ($search === null || !isset($search['term'])) {
            abort(400);
        }

        $term = $search['term'];
        $searchableData = [];
        foreach ($this->models as $model => $translation) {
            if (auth()->user()->can($translation[2])) {
                $modelClass = 'App\Models\\' . $model;
                $query = $modelClass::query();
                $fields = $modelClass::$searchable;

                foreach ($fields as $field) {
                    $query->orWhere($field, 'LIKE', '%' . $term . '%');
                }

                $results = $query->take(10)
                        ->get();

                foreach ($results as $result) {
                    $parsedData = $result->only($fields);
                    $parsedData['model'] = trans($translation[1]);
                    $parsedData['fields'] = $fields;
                    $formattedFields = [];
                    foreach ($fields as $field) {
                        $formattedFields[$field] = Str::title(str_replace('_', ' ', $field));
                    }
                    $parsedData['fields_formated'] = $formattedFields;
                    if ($translation[3] == false) {
                        $id = $result->id;
                    } else {
                        $id = $result->{$translation[3]};
                    }

                    $parsedData['url'] = url(config('cms.admin_panel_url') . '/' . $translation[4] . '/' . Str::plural(Str::snake($translation[0], '-')) . '/' . $id . '/edit');

                    $searchableData[] = $parsedData;
                }
            }
        }

        return response()->json(['results' => $searchableData]);
    }

}
