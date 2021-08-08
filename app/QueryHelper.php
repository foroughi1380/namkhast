<?php


namespace App;

use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\Builder;

trait QueryHelper
{
    public function parseQueries(Request $request)
    {
        $query = $this::query();

        /** parse findable */
        $columns = $request->input("parsable", []);
        foreach ($columns as $column) {
            $query = $this->parseFind($query, json_decode($column));
        }

        /** parse search */
        $columns = $request->input("search", []);
        foreach ($columns as $column) {
            $query = $this->parseSearch($query, json_decode($column));
        }

        return $query;
    }

    public function parseSearch(Builder $query, $input): Builder
    {
        if (!isset($input->target)) return $query;
        if (!strlen($input->target)) return $query;
        return $query->where($input->column, "LIKE", "%$input->target%");
    }

    public function parseFind(Builder $query, $input): Builder
    {
        if (!(isset($input->column) && isset($input->queries))) return $query;

        $column = $input->column;
        $queries = $input->queries;

        if (!strlen($queries)) return $query;

        if (strpos($queries, ",") !== false) {
            return $query->whereIn($column, explode(",", $queries));
        }

        if (strpos($queries, "-") !== false) {
            $array = explode("-", $queries);

            if (count($array) == 2)
                return $query->whereBetween($column, $array);
            else
                return $query->whereIn($column, $array);
        }

        return $query->where($column, $queries);
    }
}
