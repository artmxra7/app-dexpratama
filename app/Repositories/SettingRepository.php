<?php

namespace App\Repositories;

use App\Models\Setting;
use InfyOm\Generator\Common\BaseRepository;

class SettingRepository extends BaseRepository
{
    use ApiTrait;
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Setting::class;
    }

    public function api()
    {
      	$_q = $this->model->query();
    		if (request('query')) {
    			$_q->where('name', 'like', "%". request('query') ."%");
    		}
        $_q->latest();

	      // Search by query
        return $this->apiTools($_q, 'name');
    }

    public function getName()
    {
      	$_q = $this->model->pluck('name');
        $_q->latest();

        return $_q;
    }
}
