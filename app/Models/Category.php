<?php

namespace App\Models;

//模型树
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	//模型树
	use ModelTree, AdminBuilder;

	protected $fillable = [
        'title', 'en_title', 'parent_id', 'discription', 'order'
    ];

    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('parent_id');
        $this->setOrderColumn('order');
        $this->setTitleColumn('title');
    }

}
