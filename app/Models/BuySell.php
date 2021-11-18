<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Traits\BuySellMediaTrait;
use App\Traits\StatusTrait;
use Illuminate\Pipeline\Pipeline;
use Session;

class BuySell extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Relation belongs to Buy Sell Media are in this trait.
    use BuySellMediaTrait;
    use StatusTrait;

    protected $table = 'buy_sells';

    // const EXCERPT_LENGTH = 250;

    protected $fillable = [
        'type', 'property_type', 'promotional_flag', 'state_id',
        'city_id', 'suburb_id', 'price', 'title', 'number',
        'email', 'description', 'user_id', 'created_at', 'updated_at'
    ];

    /**
     * Function for return excerpt of given text.
     * 
     * @return "returns excerpt for given text"
     */
    public function excerpt()
    {
        return Str::limit($this->description, env('EXCERPT_LENGTH', 250));
        // return Str::limit($this->description, BuySell::EXCERPT_LENGTH);
    }

    /**
     * Function for return base_url buysell image.
     * 
     * @return "returns excerpt for given text"
     */
    public function imageurl()
    {
        return url('/images/buysell/') . "/";
    }

    /**
     * Search function that implement QueryFilter on Query..
     * 
     * @return "returns search result based according to various query filter defined."
     */
    public static function searchResult()
    {
        $buysells = app(Pipeline::class)
            ->send(\App\Models\BuySell::query()->active()->with("associatedSuburb"))
            ->through([
                \App\QueryFilters\BuySellState::class,
                \App\QueryFilters\CityString::class,
                \App\QueryFilters\PostCode::class,
                \App\QueryFilters\Price::class,
            ])
            ->thenReturn()
            ->simplePaginate(3);
        // ->get();

        return $buysells;
    }
}
