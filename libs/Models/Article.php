<?php

namespace App\Models;

use App\Models\Model;

class Article
    extends Model
{

    protected const TABLE = 'news';

    public $title;
    public $lead;

}