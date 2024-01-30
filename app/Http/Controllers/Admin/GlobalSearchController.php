<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GlobalSearchController extends Controller {

    private $models = [
        #CRUD-NEW-ITEM
        #CRUD-ITEM-BLOGCATEGORYITEM-START
        'BlogcategoryitemTranslation' => [
            'blogcategoryitems',
            'cruds.blogcategoryitems',
            'blogcategoryitem_edit',
            'blogcategoryitem_id',
            'module',
        ],
        #CRUD-ITEM-BLOGCATEGORYITEM-END
        #CRUD-ITEM-VALUESITEM-START
        'ValuesitemTranslation' => [
            'valuesitems',
            'cruds.valuesitems',
            'valuesitem_edit',
            'valuesitem_id',
            'module',
        ],
        #CRUD-ITEM-VALUESITEM-END
        #CRUD-ITEM-SERVICEPOINTITEM-START
        'ServicepointitemTranslation' => [
            'servicepointitems',
            'cruds.servicepointitems',
            'servicepointitem_edit',
            'servicepointitem_id',
            'module',
        ],
        #CRUD-ITEM-SERVICEPOINTITEM-END
        #CRUD-ITEM-SYSTEMPAGESITEM-START
        'SystempagesitemTranslation' => [
            'systempagesitems',
            'cruds.systempagesitems',
            'systempagesitem_edit',
            'systempagesitem_id',
            'module',
        ],
        #CRUD-ITEM-SYSTEMPAGESITEM-END
        #CRUD-ITEM-REQUESTSITEM-START
        'RequestsitemTranslation' => [
            'requestsitems',
            'cruds.requestsitems',
            'requestsitem_edit',
            'requestsitem_id',
            'module',
        ],
        #CRUD-ITEM-REQUESTSITEM-END
        #CRUD-ITEM-BLOGITEM-START
        'BlogitemTranslation' => [
            'blogitems',
            'cruds.blogitems',
            'blogitem_edit',
            'blogitem_id',
            'module',
        ],
        #CRUD-ITEM-BLOGITEM-END
        #CRUD-ITEM-PORTFOLIOITEM-START
        'PortfolioitemTranslation' => [
            'portfolioitems',
            'cruds.portfolioitems',
            'portfolioitem_edit',
            'portfolioitem_id',
            'module',
        ],
        #CRUD-ITEM-PORTFOLIOITEM-END
        #CRUD-ITEM-APPPROACHITEM-START
        'AppproachitemTranslation' => [
            'appproachitems',
            'cruds.appproachitems',
            'appproachitem_edit',
            'appproachitem_id',
            'module',
        ],
        #CRUD-ITEM-APPPROACHITEM-END
        #CRUD-ITEM-TESTIMONIALSITEM-START
        'TestimonialsitemTranslation' => [
            'testimonialsitems',
            'cruds.testimonialsitems',
            'testimonialsitem_edit',
            'testimonialsitem_id',
            'module',
        ],
        #CRUD-ITEM-TESTIMONIALSITEM-END
        #CRUD-ITEM-WHYUSHOMEPAGEITEM-START
        'WhyushomepageitemTranslation' => [
            'whyushomepageitems',
            'cruds.whyushomepageitems',
            'whyushomepageitem_edit',
            'whyushomepageitem_id',
            'module',
        ],
        #CRUD-ITEM-WHYUSHOMEPAGEITEM-END
        #CRUD-ITEM-SERVICEITEM-START
        'ServiceitemTranslation' => [
            'serviceitems',
            'cruds.serviceitems',
            'serviceitem_edit',
            'serviceitem_id',
            'module',
        ],
        #CRUD-ITEM-SERVICEITEM-END
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
